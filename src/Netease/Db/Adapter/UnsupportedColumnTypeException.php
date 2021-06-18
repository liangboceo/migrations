<?php

/**
 * MIT License
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Netease\Db\Adapter;

use RuntimeException;

/**
 * Exception thrown when a column type doesn't match a Netease type.
 *
 * @author Martijn Gastkemper <martijngastkemper@gmail.com>
 */
class UnsupportedColumnTypeException extends RuntimeException
{
}
