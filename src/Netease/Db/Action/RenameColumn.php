<?php

/**
 * MIT License
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Netease\Db\Action;

use Netease\Db\Table\Column;
use Netease\Db\Table\Table;

class RenameColumn extends Action
{
    /**
     * The column to be renamed
     *
     * @var \Netease\Db\Table\Column
     */
    protected $column;

    /**
     * The new name for the column
     *
     * @var string
     */
    protected $newName;

    /**
     * Constructor
     *
     * @param \Netease\Db\Table\Table $table The table where the column is
     * @param \Netease\Db\Table\Column $column The column to be renamed
     * @param mixed $newName The new name for the column
     */
    public function __construct(Table $table, Column $column, $newName)
    {
        parent::__construct($table);
        $this->newName = $newName;
        $this->column = $column;
    }

    /**
     * Creates a new RenameColumn object after building the passed
     * arguments
     *
     * @param \Netease\Db\Table\Table $table The table where the column is
     * @param mixed $columnName The name of the column to be changed
     * @param mixed $newName The new name for the column
     * @return \Netease\Db\Action\RenameColumn
     */
    public static function build(Table $table, $columnName, $newName)
    {
        $column = new Column();
        $column->setName($columnName);

        return new static($table, $column, $newName);
    }

    /**
     * Returns the column to be changed
     *
     * @return \Netease\Db\Table\Column
     */
    public function getColumn()
    {
        return $this->column;
    }

    /**
     * Returns the new name for the column
     *
     * @return string
     */
    public function getNewName()
    {
        return $this->newName;
    }
}
