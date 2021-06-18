<?php

/**
 * MIT License
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Netease\Db\Action;

use Netease\Db\Table\Table;

abstract class Action
{
    /**
     * @var \Netease\Db\Table\Table
     */
    protected $table;

    /**
     * Constructor
     *
     * @param \Netease\Db\Table\Table $table the Table to apply the action to
     */
    public function __construct(Table $table)
    {
        $this->table = $table;
    }

    /**
     * The table this action will be applied to
     *
     * @return \Netease\Db\Table\Table
     */
    public function getTable()
    {
        return $this->table;
    }
}
