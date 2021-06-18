<?php

/**
 * MIT License
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Netease\Db\Action;

use Netease\Db\Table\Index;
use Netease\Db\Table\Table;

class AddIndex extends Action
{
    /**
     * The index to add to the table
     *
     * @var \Netease\Db\Table\Index
     */
    protected $index;

    /**
     * Constructor
     *
     * @param \Netease\Db\Table\Table $table The table to add the index to
     * @param \Netease\Db\Table\Index $index The index to be added
     */
    public function __construct(Table $table, Index $index)
    {
        parent::__construct($table);
        $this->index = $index;
    }

    /**
     * Creates a new AddIndex object after building the index object with the
     * provided arguments
     *
     * @param \Netease\Db\Table\Table $table The table to add the index to
     * @param mixed $columns The columns to index
     * @param array $options Additional options for the index creation
     * @return \Netease\Db\Action\AddIndex
     */
    public static function build(Table $table, $columns, array $options = [])
    {
        // create a new index object if strings or an array of strings were supplied
        $index = $columns;

        if (!$columns instanceof Index) {
            $index = new Index();

            if (is_string($columns)) {
                $columns = [$columns]; // str to array
            }

            $index->setColumns($columns);
            $index->setOptions($options);
        }

        return new static($table, $index);
    }

    /**
     * Returns the index to be added
     *
     * @return \Netease\Db\Table\Index
     */
    public function getIndex()
    {
        return $this->index;
    }
}
