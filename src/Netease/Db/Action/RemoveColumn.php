<?php

/**
 * MIT License
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Netease\Db\Action;

use Netease\Db\Table\Column;
use Netease\Db\Table\Table;

class RemoveColumn extends Action
{
    /**
     * The column to be removed
     *
     * @var \Netease\Db\Table\Column
     */
    protected $column;

    /**
     * Constructor
     *
     * @param \Netease\Db\Table\Table $table The table where the column is
     * @param \Netease\Db\Table\Column $column The column to be removed
     */
    public function __construct(Table $table, Column $column)
    {
        parent::__construct($table);
        $this->column = $column;
    }

    /**
     * Creates a new RemoveColumn object after assembling the
     * passed arguments.
     *
     * @param \Netease\Db\Table\Table $table The table where the column is
     * @param mixed $columnName The name of the column to drop
     * @return \Netease\Db\Action\RemoveColumn
     */
    public static function build(Table $table, $columnName)
    {
        $column = new Column();
        $column->setName($columnName);

        return new static($table, $column);
    }

    /**
     * Returns the column to be dropped
     *
     * @return \Netease\Db\Table\Column
     */
    public function getColumn()
    {
        return $this->column;
    }
}
