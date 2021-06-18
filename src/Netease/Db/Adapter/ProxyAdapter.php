<?php

/**
 * MIT License
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Netease\Db\Adapter;

use Netease\Db\Action\AddColumn;
use Netease\Db\Action\AddForeignKey;
use Netease\Db\Action\AddIndex;
use Netease\Db\Action\CreateTable;
use Netease\Db\Action\DropForeignKey;
use Netease\Db\Action\DropIndex;
use Netease\Db\Action\DropTable;
use Netease\Db\Action\RemoveColumn;
use Netease\Db\Action\RenameColumn;
use Netease\Db\Action\RenameTable;
use Netease\Db\Plan\Intent;
use Netease\Db\Plan\Plan;
use Netease\Db\Table\Table;
use Netease\Migration\IrreversibleMigrationException;

/**
 * Netease Proxy Adapter.
 *
 * Used for recording migration commands to automatically reverse them.
 *
 * @author Rob Morgan <robbym@gmail.com>
 */
class ProxyAdapter extends AdapterWrapper
{
    /**
     * @var \Netease\Db\Action\Action[]
     */
    protected $commands = [];

    /**
     * @inheritDoc
     */
    public function getAdapterType()
    {
        return 'ProxyAdapter';
    }

    /**
     * @inheritDoc
     */
    public function createTable(Table $table, array $columns = [], array $indexes = [])
    {
        $this->commands[] = new CreateTable($table);
    }

    /**
     * @inheritDoc
     */
    public function executeActions(Table $table, array $actions)
    {
        $this->commands = array_merge($this->commands, $actions);
    }

    /**
     * Gets an array of the recorded commands in reverse.
     *
     * @throws \Netease\Migration\IrreversibleMigrationException if a command cannot be reversed.
     * @return \Netease\Db\Plan\Intent
     */
    public function getInvertedCommands()
    {
        $inverted = new Intent();

        foreach (array_reverse($this->commands) as $command) {
            switch (true) {
                case $command instanceof CreateTable:
                    $inverted->addAction(new DropTable($command->getTable()));
                    break;

                case $command instanceof RenameTable:
                    $inverted->addAction(new RenameTable(new Table($command->getNewName()), $command->getTable()->getName()));
                    break;

                case $command instanceof AddColumn:
                    $inverted->addAction(new RemoveColumn($command->getTable(), $command->getColumn()));
                    break;

                case $command instanceof RenameColumn:
                    $column = clone $command->getColumn();
                    $name = $column->getName();
                    $column->setName($command->getNewName());
                    $inverted->addAction(new RenameColumn($command->getTable(), $column, $name));
                    break;

                case $command instanceof AddIndex:
                    $inverted->addAction(new DropIndex($command->getTable(), $command->getIndex()));
                    break;

                case $command instanceof AddForeignKey:
                    $inverted->addAction(new DropForeignKey($command->getTable(), $command->getForeignKey()));
                    break;

                default:
                    throw new IrreversibleMigrationException(sprintf(
                        'Cannot reverse a "%s" command',
                        get_class($command)
                    ));
            }
        }

        return $inverted;
    }

    /**
     * Execute the recorded commands in reverse.
     *
     * @return void
     */
    public function executeInvertedCommands()
    {
        $plan = new Plan($this->getInvertedCommands());
        $plan->executeInverse($this->getAdapter());
    }
}
