<?php

/**
 * MIT License
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Netease\Db\Plan;

use Netease\Db\Action\Action;
use Netease\Db\Table\Table;

/**
 * A collection of ALTER actions for a single table
 */
class AlterTable
{
    /**
     * The table
     *
     * @var \Netease\Db\Table\Table
     */
    protected $table;

    /**
     * The list of actions to execute
     *
     * @var \Netease\Db\Action\Action[]
     */
    protected $actions = [];

    /**
     * Constructor
     *
     * @param \Netease\Db\Table\Table $table The table to change
     */
    public function __construct(Table $table)
    {
        $this->table = $table;
    }

    /**
     * Adds another action to the collection
     *
     * @param \Netease\Db\Action\Action $action The action to add
     * @return void
     */
    public function addAction(Action $action)
    {
        $this->actions[] = $action;
    }

    /**
     * Returns the table associated to this collection
     *
     * @return \Netease\Db\Table\Table
     */
    public function getTable()
    {
        return $this->table;
    }

    /**
     * Returns an array with all collected actions
     *
     * @return \Netease\Db\Action\Action[]
     */
    public function getActions()
    {
        return $this->actions;
    }
}
