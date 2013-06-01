<?php

namespace AtCms\Mapper;

use ZfcBase\Mapper\AbstractDbMapper;
use Zend\Stdlib\Hydrator\HydratorInterface;

class Page extends AbstractDbMapper implements PageInterface
{
    protected $tableName  = 'cms_page';

    /**
     * @param $id
     * @return object
     */
    public function findById($id)
    {
        $select = $this->getSelect()->where(array('page_id' => $id));
        $entity = $this->select($select)->current();

        $this->getEventManager()->trigger('find', $this, array('entity' => $entity));

        return $entity;
    }

    /**
     * @param $identifier
     * @return object
     */
    public function findByIdentifier($identifier)
    {
        $select = $this->getSelect()->where(array('identifier' => $identifier));
        $entity = $this->select($select)->current();

        $this->getEventManager()->trigger('find', $this, array('entity' => $entity));

        return $entity;
    }

    /**
     * @param array|object $entity
     * @param null $tableName
     * @param \Zend\Stdlib\Hydrator\HydratorInterface $hydrator
     * @return \Zend\Db\Adapter\Driver\ResultInterface
     */
    public function insert($entity, $tableName = null, HydratorInterface $hydrator = null)
    {
        $result = parent::insert($entity, $tableName, $hydrator);
        $entity->setId($result->getGeneratedValue());

        return $result;
    }

    /**
     * @param array|object $entity
     * @param null $where
     * @param null $tableName
     * @param \Zend\Stdlib\Hydrator\HydratorInterface $hydrator
     * @return \Zend\Db\Adapter\Driver\ResultInterface
     */
    public function update($entity, $where = null, $tableName = null, HydratorInterface $hydrator = null)
    {
        if (!$where) {
            $where = 'page_id = ' . $entity->getId();
        }

        return parent::update($entity, $where, $tableName, $hydrator);
    }
}
