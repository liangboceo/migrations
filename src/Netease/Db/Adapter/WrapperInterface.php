<?php

/**
 * MIT License
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Netease\Db\Adapter;

/**
 * Wrapper Interface.
 *
 * @author Woody Gilk <woody.gilk@gmail.com>
 */
interface WrapperInterface
{
    /**
     * Class constructor, must always wrap another adapter.
     *
     * @param \Netease\Db\Adapter\AdapterInterface $adapter Adapter
     */
    public function __construct(AdapterInterface $adapter);

    /**
     * Sets the database adapter to proxy commands to.
     *
     * @param \Netease\Db\Adapter\AdapterInterface $adapter Adapter
     * @return \Netease\Db\Adapter\AdapterInterface
     */
    public function setAdapter(AdapterInterface $adapter);

    /**
     * Gets the database adapter.
     *
     * @throws \RuntimeException if the adapter has not been set
     * @return \Netease\Db\Adapter\AdapterInterface
     */
    public function getAdapter();
}
