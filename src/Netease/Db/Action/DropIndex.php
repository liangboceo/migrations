<?php

/**
 * MIT License
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Netease\Db\Action;

use Netease\Db\Table\Index;
use Netease\Db\Table\Table;

class DropIndex extends Action
{
    /**
     * The index to drop
     *
     * @var \Netease\Db\Table\Index
     */
    protected $index;

    /**
     * Constructor
     *
     * @param \Netease\Db\Table\Table $table The table owning the index
     * @param \Netease\Db\Table\Index $index The index to be dropped
     */
    public function __construct(Table $table, Index $index)
    {
        parent::__construct($table);
        $this->index = $index;
    }

    /**
     * Creates a new DropIndex object after assembling the passed
     * arguments.
     *
     * @param \Netease\Db\Table\Table $table The table where the index is
     * @param string[] $columns the indexed columns
     * @return \Netease\Db\Action\DropIndex
     */
    public static function build(Table $table, array $columns = [])
    {
        $index = new Index();
        $index->setColumns($columns);

        return new static($table, $index);
    }

    /**
     * Creates a new DropIndex when the name of the index to drop
     * is known.
     *
     * @param \Netease\Db\Table\Table $table The table where the index is
     * @param string $name The name of the index
     * @return \Netease\Db\Action\DropIndex
     */
    public static function buildFromName(Table $table, $name)
    {
        $index = new Index();
        $index->setName($name);

        return new static($table, $index);
    }

    /**
     * Returns the index to be dropped
     *
     * @return \Netease\Db\Table\Index
     */
    public function getIndex()
    {
        return $this->index;
    }
}
