<?php

/**
 * MIT License
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Netease\Db\Action;

use Netease\Db\Table\ForeignKey;
use Netease\Db\Table\Table;

class DropForeignKey extends Action
{
    /**
     * The foreign key to remove
     *
     * @var \Netease\Db\Table\ForeignKey
     */
    protected $foreignKey;

    /**
     * Constructor
     *
     * @param \Netease\Db\Table\Table $table The table to remove the constraint from
     * @param \Netease\Db\Table\ForeignKey $foreignKey The foreign key to remove
     */
    public function __construct(Table $table, ForeignKey $foreignKey)
    {
        parent::__construct($table);
        $this->foreignKey = $foreignKey;
    }

    /**
     * Creates a new DropForeignKey object after building the ForeignKey
     * definition out of the passed arguments.
     *
     * @param \Netease\Db\Table\Table $table The table to delete the foreign key from
     * @param string|string[] $columns The columns participating in the foreign key
     * @param string|null $constraint The constraint name
     * @return \Netease\Db\Action\DropForeignKey
     */
    public static function build(Table $table, $columns, $constraint = null)
    {
        if (is_string($columns)) {
            $columns = [$columns];
        }

        $foreignKey = new ForeignKey();
        $foreignKey->setColumns($columns);

        if ($constraint) {
            $foreignKey->setConstraint($constraint);
        }

        return new static($table, $foreignKey);
    }

    /**
     * Returns the foreign key to remove
     *
     * @return \Netease\Db\Table\ForeignKey
     */
    public function getForeignKey()
    {
        return $this->foreignKey;
    }
}
