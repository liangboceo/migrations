<?php

/**
 * MIT License
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Netease\Config;

/**
 * Config aware getNamespaceByPath method.
 *
 * @package Netease\Config
 * @author Andrey N. Mokhov
 */
interface NamespaceAwareInterface
{
    /**
     * Get Migration Namespace associated with path.
     *
     * @param string $path Path
     * @return string|null
     */
    public function getMigrationNamespaceByPath($path);

    /**
     * Get Seed Namespace associated with path.
     *
     * @param string $path Path
     * @return string|null
     */
    public function getSeedNamespaceByPath($path);
}
