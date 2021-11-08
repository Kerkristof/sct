<?php

namespace ContainerVpU7mYe;
include_once \dirname(__DIR__, 4).'/vendor/doctrine/persistence/lib/Doctrine/Persistence/ObjectManager.php';
include_once \dirname(__DIR__, 4).'/vendor/doctrine/orm/lib/Doctrine/ORM/EntityManagerInterface.php';
include_once \dirname(__DIR__, 4).'/vendor/doctrine/orm/lib/Doctrine/ORM/EntityManager.php';

class EntityManager_9a5be93 extends \Doctrine\ORM\EntityManager implements \ProxyManager\Proxy\VirtualProxyInterface
{

    /**
     * @var \Doctrine\ORM\EntityManager|null wrapped object, if the proxy is initialized
     */
    private $valueHolderf104c = null;

    /**
     * @var \Closure|null initializer responsible for generating the wrapped object
     */
    private $initializer45889 = null;

    /**
     * @var bool[] map of public properties of the parent class
     */
    private static $publicProperties03711 = [
        
    ];

    public function getConnection()
    {
        $this->initializer45889 && ($this->initializer45889->__invoke($valueHolderf104c, $this, 'getConnection', array(), $this->initializer45889) || 1) && $this->valueHolderf104c = $valueHolderf104c;

        return $this->valueHolderf104c->getConnection();
    }

    public function getMetadataFactory()
    {
        $this->initializer45889 && ($this->initializer45889->__invoke($valueHolderf104c, $this, 'getMetadataFactory', array(), $this->initializer45889) || 1) && $this->valueHolderf104c = $valueHolderf104c;

        return $this->valueHolderf104c->getMetadataFactory();
    }

    public function getExpressionBuilder()
    {
        $this->initializer45889 && ($this->initializer45889->__invoke($valueHolderf104c, $this, 'getExpressionBuilder', array(), $this->initializer45889) || 1) && $this->valueHolderf104c = $valueHolderf104c;

        return $this->valueHolderf104c->getExpressionBuilder();
    }

    public function beginTransaction()
    {
        $this->initializer45889 && ($this->initializer45889->__invoke($valueHolderf104c, $this, 'beginTransaction', array(), $this->initializer45889) || 1) && $this->valueHolderf104c = $valueHolderf104c;

        return $this->valueHolderf104c->beginTransaction();
    }

    public function getCache()
    {
        $this->initializer45889 && ($this->initializer45889->__invoke($valueHolderf104c, $this, 'getCache', array(), $this->initializer45889) || 1) && $this->valueHolderf104c = $valueHolderf104c;

        return $this->valueHolderf104c->getCache();
    }

    public function transactional($func)
    {
        $this->initializer45889 && ($this->initializer45889->__invoke($valueHolderf104c, $this, 'transactional', array('func' => $func), $this->initializer45889) || 1) && $this->valueHolderf104c = $valueHolderf104c;

        return $this->valueHolderf104c->transactional($func);
    }

    public function wrapInTransaction(callable $func)
    {
        $this->initializer45889 && ($this->initializer45889->__invoke($valueHolderf104c, $this, 'wrapInTransaction', array('func' => $func), $this->initializer45889) || 1) && $this->valueHolderf104c = $valueHolderf104c;

        return $this->valueHolderf104c->wrapInTransaction($func);
    }

    public function commit()
    {
        $this->initializer45889 && ($this->initializer45889->__invoke($valueHolderf104c, $this, 'commit', array(), $this->initializer45889) || 1) && $this->valueHolderf104c = $valueHolderf104c;

        return $this->valueHolderf104c->commit();
    }

    public function rollback()
    {
        $this->initializer45889 && ($this->initializer45889->__invoke($valueHolderf104c, $this, 'rollback', array(), $this->initializer45889) || 1) && $this->valueHolderf104c = $valueHolderf104c;

        return $this->valueHolderf104c->rollback();
    }

    public function getClassMetadata($className)
    {
        $this->initializer45889 && ($this->initializer45889->__invoke($valueHolderf104c, $this, 'getClassMetadata', array('className' => $className), $this->initializer45889) || 1) && $this->valueHolderf104c = $valueHolderf104c;

        return $this->valueHolderf104c->getClassMetadata($className);
    }

    public function createQuery($dql = '')
    {
        $this->initializer45889 && ($this->initializer45889->__invoke($valueHolderf104c, $this, 'createQuery', array('dql' => $dql), $this->initializer45889) || 1) && $this->valueHolderf104c = $valueHolderf104c;

        return $this->valueHolderf104c->createQuery($dql);
    }

    public function createNamedQuery($name)
    {
        $this->initializer45889 && ($this->initializer45889->__invoke($valueHolderf104c, $this, 'createNamedQuery', array('name' => $name), $this->initializer45889) || 1) && $this->valueHolderf104c = $valueHolderf104c;

        return $this->valueHolderf104c->createNamedQuery($name);
    }

    public function createNativeQuery($sql, \Doctrine\ORM\Query\ResultSetMapping $rsm)
    {
        $this->initializer45889 && ($this->initializer45889->__invoke($valueHolderf104c, $this, 'createNativeQuery', array('sql' => $sql, 'rsm' => $rsm), $this->initializer45889) || 1) && $this->valueHolderf104c = $valueHolderf104c;

        return $this->valueHolderf104c->createNativeQuery($sql, $rsm);
    }

    public function createNamedNativeQuery($name)
    {
        $this->initializer45889 && ($this->initializer45889->__invoke($valueHolderf104c, $this, 'createNamedNativeQuery', array('name' => $name), $this->initializer45889) || 1) && $this->valueHolderf104c = $valueHolderf104c;

        return $this->valueHolderf104c->createNamedNativeQuery($name);
    }

    public function createQueryBuilder()
    {
        $this->initializer45889 && ($this->initializer45889->__invoke($valueHolderf104c, $this, 'createQueryBuilder', array(), $this->initializer45889) || 1) && $this->valueHolderf104c = $valueHolderf104c;

        return $this->valueHolderf104c->createQueryBuilder();
    }

    public function flush($entity = null)
    {
        $this->initializer45889 && ($this->initializer45889->__invoke($valueHolderf104c, $this, 'flush', array('entity' => $entity), $this->initializer45889) || 1) && $this->valueHolderf104c = $valueHolderf104c;

        return $this->valueHolderf104c->flush($entity);
    }

    public function find($className, $id, $lockMode = null, $lockVersion = null)
    {
        $this->initializer45889 && ($this->initializer45889->__invoke($valueHolderf104c, $this, 'find', array('className' => $className, 'id' => $id, 'lockMode' => $lockMode, 'lockVersion' => $lockVersion), $this->initializer45889) || 1) && $this->valueHolderf104c = $valueHolderf104c;

        return $this->valueHolderf104c->find($className, $id, $lockMode, $lockVersion);
    }

    public function getReference($entityName, $id)
    {
        $this->initializer45889 && ($this->initializer45889->__invoke($valueHolderf104c, $this, 'getReference', array('entityName' => $entityName, 'id' => $id), $this->initializer45889) || 1) && $this->valueHolderf104c = $valueHolderf104c;

        return $this->valueHolderf104c->getReference($entityName, $id);
    }

    public function getPartialReference($entityName, $identifier)
    {
        $this->initializer45889 && ($this->initializer45889->__invoke($valueHolderf104c, $this, 'getPartialReference', array('entityName' => $entityName, 'identifier' => $identifier), $this->initializer45889) || 1) && $this->valueHolderf104c = $valueHolderf104c;

        return $this->valueHolderf104c->getPartialReference($entityName, $identifier);
    }

    public function clear($entityName = null)
    {
        $this->initializer45889 && ($this->initializer45889->__invoke($valueHolderf104c, $this, 'clear', array('entityName' => $entityName), $this->initializer45889) || 1) && $this->valueHolderf104c = $valueHolderf104c;

        return $this->valueHolderf104c->clear($entityName);
    }

    public function close()
    {
        $this->initializer45889 && ($this->initializer45889->__invoke($valueHolderf104c, $this, 'close', array(), $this->initializer45889) || 1) && $this->valueHolderf104c = $valueHolderf104c;

        return $this->valueHolderf104c->close();
    }

    public function persist($entity)
    {
        $this->initializer45889 && ($this->initializer45889->__invoke($valueHolderf104c, $this, 'persist', array('entity' => $entity), $this->initializer45889) || 1) && $this->valueHolderf104c = $valueHolderf104c;

        return $this->valueHolderf104c->persist($entity);
    }

    public function remove($entity)
    {
        $this->initializer45889 && ($this->initializer45889->__invoke($valueHolderf104c, $this, 'remove', array('entity' => $entity), $this->initializer45889) || 1) && $this->valueHolderf104c = $valueHolderf104c;

        return $this->valueHolderf104c->remove($entity);
    }

    public function refresh($entity)
    {
        $this->initializer45889 && ($this->initializer45889->__invoke($valueHolderf104c, $this, 'refresh', array('entity' => $entity), $this->initializer45889) || 1) && $this->valueHolderf104c = $valueHolderf104c;

        return $this->valueHolderf104c->refresh($entity);
    }

    public function detach($entity)
    {
        $this->initializer45889 && ($this->initializer45889->__invoke($valueHolderf104c, $this, 'detach', array('entity' => $entity), $this->initializer45889) || 1) && $this->valueHolderf104c = $valueHolderf104c;

        return $this->valueHolderf104c->detach($entity);
    }

    public function merge($entity)
    {
        $this->initializer45889 && ($this->initializer45889->__invoke($valueHolderf104c, $this, 'merge', array('entity' => $entity), $this->initializer45889) || 1) && $this->valueHolderf104c = $valueHolderf104c;

        return $this->valueHolderf104c->merge($entity);
    }

    public function copy($entity, $deep = false)
    {
        $this->initializer45889 && ($this->initializer45889->__invoke($valueHolderf104c, $this, 'copy', array('entity' => $entity, 'deep' => $deep), $this->initializer45889) || 1) && $this->valueHolderf104c = $valueHolderf104c;

        return $this->valueHolderf104c->copy($entity, $deep);
    }

    public function lock($entity, $lockMode, $lockVersion = null)
    {
        $this->initializer45889 && ($this->initializer45889->__invoke($valueHolderf104c, $this, 'lock', array('entity' => $entity, 'lockMode' => $lockMode, 'lockVersion' => $lockVersion), $this->initializer45889) || 1) && $this->valueHolderf104c = $valueHolderf104c;

        return $this->valueHolderf104c->lock($entity, $lockMode, $lockVersion);
    }

    public function getRepository($entityName)
    {
        $this->initializer45889 && ($this->initializer45889->__invoke($valueHolderf104c, $this, 'getRepository', array('entityName' => $entityName), $this->initializer45889) || 1) && $this->valueHolderf104c = $valueHolderf104c;

        return $this->valueHolderf104c->getRepository($entityName);
    }

    public function contains($entity)
    {
        $this->initializer45889 && ($this->initializer45889->__invoke($valueHolderf104c, $this, 'contains', array('entity' => $entity), $this->initializer45889) || 1) && $this->valueHolderf104c = $valueHolderf104c;

        return $this->valueHolderf104c->contains($entity);
    }

    public function getEventManager()
    {
        $this->initializer45889 && ($this->initializer45889->__invoke($valueHolderf104c, $this, 'getEventManager', array(), $this->initializer45889) || 1) && $this->valueHolderf104c = $valueHolderf104c;

        return $this->valueHolderf104c->getEventManager();
    }

    public function getConfiguration()
    {
        $this->initializer45889 && ($this->initializer45889->__invoke($valueHolderf104c, $this, 'getConfiguration', array(), $this->initializer45889) || 1) && $this->valueHolderf104c = $valueHolderf104c;

        return $this->valueHolderf104c->getConfiguration();
    }

    public function isOpen()
    {
        $this->initializer45889 && ($this->initializer45889->__invoke($valueHolderf104c, $this, 'isOpen', array(), $this->initializer45889) || 1) && $this->valueHolderf104c = $valueHolderf104c;

        return $this->valueHolderf104c->isOpen();
    }

    public function getUnitOfWork()
    {
        $this->initializer45889 && ($this->initializer45889->__invoke($valueHolderf104c, $this, 'getUnitOfWork', array(), $this->initializer45889) || 1) && $this->valueHolderf104c = $valueHolderf104c;

        return $this->valueHolderf104c->getUnitOfWork();
    }

    public function getHydrator($hydrationMode)
    {
        $this->initializer45889 && ($this->initializer45889->__invoke($valueHolderf104c, $this, 'getHydrator', array('hydrationMode' => $hydrationMode), $this->initializer45889) || 1) && $this->valueHolderf104c = $valueHolderf104c;

        return $this->valueHolderf104c->getHydrator($hydrationMode);
    }

    public function newHydrator($hydrationMode)
    {
        $this->initializer45889 && ($this->initializer45889->__invoke($valueHolderf104c, $this, 'newHydrator', array('hydrationMode' => $hydrationMode), $this->initializer45889) || 1) && $this->valueHolderf104c = $valueHolderf104c;

        return $this->valueHolderf104c->newHydrator($hydrationMode);
    }

    public function getProxyFactory()
    {
        $this->initializer45889 && ($this->initializer45889->__invoke($valueHolderf104c, $this, 'getProxyFactory', array(), $this->initializer45889) || 1) && $this->valueHolderf104c = $valueHolderf104c;

        return $this->valueHolderf104c->getProxyFactory();
    }

    public function initializeObject($obj)
    {
        $this->initializer45889 && ($this->initializer45889->__invoke($valueHolderf104c, $this, 'initializeObject', array('obj' => $obj), $this->initializer45889) || 1) && $this->valueHolderf104c = $valueHolderf104c;

        return $this->valueHolderf104c->initializeObject($obj);
    }

    public function getFilters()
    {
        $this->initializer45889 && ($this->initializer45889->__invoke($valueHolderf104c, $this, 'getFilters', array(), $this->initializer45889) || 1) && $this->valueHolderf104c = $valueHolderf104c;

        return $this->valueHolderf104c->getFilters();
    }

    public function isFiltersStateClean()
    {
        $this->initializer45889 && ($this->initializer45889->__invoke($valueHolderf104c, $this, 'isFiltersStateClean', array(), $this->initializer45889) || 1) && $this->valueHolderf104c = $valueHolderf104c;

        return $this->valueHolderf104c->isFiltersStateClean();
    }

    public function hasFilters()
    {
        $this->initializer45889 && ($this->initializer45889->__invoke($valueHolderf104c, $this, 'hasFilters', array(), $this->initializer45889) || 1) && $this->valueHolderf104c = $valueHolderf104c;

        return $this->valueHolderf104c->hasFilters();
    }

    /**
     * Constructor for lazy initialization
     *
     * @param \Closure|null $initializer
     */
    public static function staticProxyConstructor($initializer)
    {
        static $reflection;

        $reflection = $reflection ?? new \ReflectionClass(__CLASS__);
        $instance   = $reflection->newInstanceWithoutConstructor();

        \Closure::bind(function (\Doctrine\ORM\EntityManager $instance) {
            unset($instance->config, $instance->conn, $instance->metadataFactory, $instance->unitOfWork, $instance->eventManager, $instance->proxyFactory, $instance->repositoryFactory, $instance->expressionBuilder, $instance->closed, $instance->filterCollection, $instance->cache);
        }, $instance, 'Doctrine\\ORM\\EntityManager')->__invoke($instance);

        $instance->initializer45889 = $initializer;

        return $instance;
    }

    protected function __construct(\Doctrine\DBAL\Connection $conn, \Doctrine\ORM\Configuration $config, \Doctrine\Common\EventManager $eventManager)
    {
        static $reflection;

        if (! $this->valueHolderf104c) {
            $reflection = $reflection ?? new \ReflectionClass('Doctrine\\ORM\\EntityManager');
            $this->valueHolderf104c = $reflection->newInstanceWithoutConstructor();
        \Closure::bind(function (\Doctrine\ORM\EntityManager $instance) {
            unset($instance->config, $instance->conn, $instance->metadataFactory, $instance->unitOfWork, $instance->eventManager, $instance->proxyFactory, $instance->repositoryFactory, $instance->expressionBuilder, $instance->closed, $instance->filterCollection, $instance->cache);
        }, $this, 'Doctrine\\ORM\\EntityManager')->__invoke($this);

        }

        $this->valueHolderf104c->__construct($conn, $config, $eventManager);
    }

    public function & __get($name)
    {
        $this->initializer45889 && ($this->initializer45889->__invoke($valueHolderf104c, $this, '__get', ['name' => $name], $this->initializer45889) || 1) && $this->valueHolderf104c = $valueHolderf104c;

        if (isset(self::$publicProperties03711[$name])) {
            return $this->valueHolderf104c->$name;
        }

        $realInstanceReflection = new \ReflectionClass('Doctrine\\ORM\\EntityManager');

        if (! $realInstanceReflection->hasProperty($name)) {
            $targetObject = $this->valueHolderf104c;

            $backtrace = debug_backtrace(false, 1);
            trigger_error(
                sprintf(
                    'Undefined property: %s::$%s in %s on line %s',
                    $realInstanceReflection->getName(),
                    $name,
                    $backtrace[0]['file'],
                    $backtrace[0]['line']
                ),
                \E_USER_NOTICE
            );
            return $targetObject->$name;
        }

        $targetObject = $this->valueHolderf104c;
        $accessor = function & () use ($targetObject, $name) {
            return $targetObject->$name;
        };
        $backtrace = debug_backtrace(true, 2);
        $scopeObject = isset($backtrace[1]['object']) ? $backtrace[1]['object'] : new \ProxyManager\Stub\EmptyClassStub();
        $accessor = $accessor->bindTo($scopeObject, get_class($scopeObject));
        $returnValue = & $accessor();

        return $returnValue;
    }

    public function __set($name, $value)
    {
        $this->initializer45889 && ($this->initializer45889->__invoke($valueHolderf104c, $this, '__set', array('name' => $name, 'value' => $value), $this->initializer45889) || 1) && $this->valueHolderf104c = $valueHolderf104c;

        $realInstanceReflection = new \ReflectionClass('Doctrine\\ORM\\EntityManager');

        if (! $realInstanceReflection->hasProperty($name)) {
            $targetObject = $this->valueHolderf104c;

            $targetObject->$name = $value;

            return $targetObject->$name;
        }

        $targetObject = $this->valueHolderf104c;
        $accessor = function & () use ($targetObject, $name, $value) {
            $targetObject->$name = $value;

            return $targetObject->$name;
        };
        $backtrace = debug_backtrace(true, 2);
        $scopeObject = isset($backtrace[1]['object']) ? $backtrace[1]['object'] : new \ProxyManager\Stub\EmptyClassStub();
        $accessor = $accessor->bindTo($scopeObject, get_class($scopeObject));
        $returnValue = & $accessor();

        return $returnValue;
    }

    public function __isset($name)
    {
        $this->initializer45889 && ($this->initializer45889->__invoke($valueHolderf104c, $this, '__isset', array('name' => $name), $this->initializer45889) || 1) && $this->valueHolderf104c = $valueHolderf104c;

        $realInstanceReflection = new \ReflectionClass('Doctrine\\ORM\\EntityManager');

        if (! $realInstanceReflection->hasProperty($name)) {
            $targetObject = $this->valueHolderf104c;

            return isset($targetObject->$name);
        }

        $targetObject = $this->valueHolderf104c;
        $accessor = function () use ($targetObject, $name) {
            return isset($targetObject->$name);
        };
        $backtrace = debug_backtrace(true, 2);
        $scopeObject = isset($backtrace[1]['object']) ? $backtrace[1]['object'] : new \ProxyManager\Stub\EmptyClassStub();
        $accessor = $accessor->bindTo($scopeObject, get_class($scopeObject));
        $returnValue = $accessor();

        return $returnValue;
    }

    public function __unset($name)
    {
        $this->initializer45889 && ($this->initializer45889->__invoke($valueHolderf104c, $this, '__unset', array('name' => $name), $this->initializer45889) || 1) && $this->valueHolderf104c = $valueHolderf104c;

        $realInstanceReflection = new \ReflectionClass('Doctrine\\ORM\\EntityManager');

        if (! $realInstanceReflection->hasProperty($name)) {
            $targetObject = $this->valueHolderf104c;

            unset($targetObject->$name);

            return;
        }

        $targetObject = $this->valueHolderf104c;
        $accessor = function () use ($targetObject, $name) {
            unset($targetObject->$name);

            return;
        };
        $backtrace = debug_backtrace(true, 2);
        $scopeObject = isset($backtrace[1]['object']) ? $backtrace[1]['object'] : new \ProxyManager\Stub\EmptyClassStub();
        $accessor = $accessor->bindTo($scopeObject, get_class($scopeObject));
        $accessor();
    }

    public function __clone()
    {
        $this->initializer45889 && ($this->initializer45889->__invoke($valueHolderf104c, $this, '__clone', array(), $this->initializer45889) || 1) && $this->valueHolderf104c = $valueHolderf104c;

        $this->valueHolderf104c = clone $this->valueHolderf104c;
    }

    public function __sleep()
    {
        $this->initializer45889 && ($this->initializer45889->__invoke($valueHolderf104c, $this, '__sleep', array(), $this->initializer45889) || 1) && $this->valueHolderf104c = $valueHolderf104c;

        return array('valueHolderf104c');
    }

    public function __wakeup()
    {
        \Closure::bind(function (\Doctrine\ORM\EntityManager $instance) {
            unset($instance->config, $instance->conn, $instance->metadataFactory, $instance->unitOfWork, $instance->eventManager, $instance->proxyFactory, $instance->repositoryFactory, $instance->expressionBuilder, $instance->closed, $instance->filterCollection, $instance->cache);
        }, $this, 'Doctrine\\ORM\\EntityManager')->__invoke($this);
    }

    public function setProxyInitializer(\Closure $initializer = null) : void
    {
        $this->initializer45889 = $initializer;
    }

    public function getProxyInitializer() : ?\Closure
    {
        return $this->initializer45889;
    }

    public function initializeProxy() : bool
    {
        return $this->initializer45889 && ($this->initializer45889->__invoke($valueHolderf104c, $this, 'initializeProxy', array(), $this->initializer45889) || 1) && $this->valueHolderf104c = $valueHolderf104c;
    }

    public function isProxyInitialized() : bool
    {
        return null !== $this->valueHolderf104c;
    }

    public function getWrappedValueHolderValue()
    {
        return $this->valueHolderf104c;
    }


}

if (!\class_exists('EntityManager_9a5be93', false)) {
    \class_alias(__NAMESPACE__.'\\EntityManager_9a5be93', 'EntityManager_9a5be93', false);
}
