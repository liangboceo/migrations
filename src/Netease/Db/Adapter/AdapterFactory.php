<?php

/**
 * MIT License
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Netease\Db\Adapter;

use RuntimeException;

/**
 * Adapter factory and registry.
 *
 * Used for registering adapters and creating instances of adapters.
 *
 * @author Woody Gilk <woody.gilk@gmail.com>
 */
class AdapterFactory
{
    /**
     * @var \Netease\Db\Adapter\AdapterFactory|null
     */
    protected static $instance;

    /**
     * Get the factory singleton instance.
     *
     * @return \Netease\Db\Adapter\AdapterFactory
     */
    public static function instance()
    {
        if (!static::$instance) {
            static::$instance = new static();
        }

        return static::$instance;
    }

    /**
     * Class map of database adapters, indexed by PDO::ATTR_DRIVER_NAME.
     *
     * @var string[]
     */
    protected $adapters = [
        'mysql' => 'Netease\Db\Adapter\MysqlAdapter',
        'pgsql' => 'Netease\Db\Adapter\PostgresAdapter',
        'sqlite' => 'Netease\Db\Adapter\SQLiteAdapter',
        'sqlsrv' => 'Netease\Db\Adapter\SqlServerAdapter',
    ];

    /**
     * Class map of adapters wrappers, indexed by name.
     *
     * @var string[]
     */
    protected $wrappers = [
        'prefix' => 'Netease\Db\Adapter\TablePrefixAdapter',
        'proxy' => 'Netease\Db\Adapter\ProxyAdapter',
        'timed' => 'Netease\Db\Adapter\TimedOutputAdapter',
    ];

    /**
     * Add or replace an adapter with a fully qualified class name.
     *
     * @param string $name Name
     * @param string $class Class
     * @throws \RuntimeException
     * @return $this
     */
    public function registerAdapter($name, $class)
    {
        if (!is_subclass_of($class, 'Netease\Db\Adapter\AdapterInterface')) {
            throw new RuntimeException(sprintf(
                'Adapter class "%s" must implement Netease\\Db\\Adapter\\AdapterInterface',
                $class
            ));
        }
        $this->adapters[$name] = $class;

        return $this;
    }

    /**
     * Get an adapter class by name.
     *
     * @param string $name Name
     * @throws \RuntimeException
     * @return string
     */
    protected function getClass($name)
    {
        if (empty($this->adapters[$name])) {
            throw new RuntimeException(sprintf(
                'Adapter "%s" has not been registered',
                $name
            ));
        }

        return $this->adapters[$name];
    }

    /**
     * Get an adapter instance by name.
     *
     * @param string $name Name
     * @param array $options Options
     * @return \Netease\Db\Adapter\AdapterInterface
     */
    public function getAdapter($name, array $options)
    {
        $class = $this->getClass($name);

        return new $class($options);
    }

    /**
     * Add or replace a wrapper with a fully qualified class name.
     *
     * @param string $name Name
     * @param string $class Class
     * @throws \RuntimeException
     * @return $this
     */
    public function registerWrapper($name, $class)
    {
        if (!is_subclass_of($class, 'Netease\Db\Adapter\WrapperInterface')) {
            throw new RuntimeException(sprintf(
                'Wrapper class "%s" must be implement Netease\\Db\\Adapter\\WrapperInterface',
                $class
            ));
        }
        $this->wrappers[$name] = $class;

        return $this;
    }

    /**
     * Get a wrapper class by name.
     *
     * @param string $name Name
     * @throws \RuntimeException
     * @return string
     */
    protected function getWrapperClass($name)
    {
        if (empty($this->wrappers[$name])) {
            throw new RuntimeException(sprintf(
                'Wrapper "%s" has not been registered',
                $name
            ));
        }

        return $this->wrappers[$name];
    }

    /**
     * Get a wrapper instance by name.
     *
     * @param string $name Name
     * @param \Netease\Db\Adapter\AdapterInterface $adapter Adapter
     * @return \Netease\Db\Adapter\AdapterInterface
     */
    public function getWrapper($name, AdapterInterface $adapter)
    {
        $class = $this->getWrapperClass($name);

        return new $class($adapter);
    }
}
