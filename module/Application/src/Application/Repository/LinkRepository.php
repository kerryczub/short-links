<?php

namespace Application\Repository;

use Doctrine\ORM\EntityManager;

/**
 * Class LinkRepository
 * @package Application\Repository
 */
class LinkRepository
{
    /**
     * @var \Doctrine\ORM\EntityManager
     */
    protected $entityManager;

    /**
     * @param EntityManager $em
     */
    public function __construct(EntityManager $em)
    {
        $this->entityManager = $em;
    }

    /**
     * @return array
     */
    public function getAll()
    {
        return $this->entityManager->getRepository('Application\Model\Link')->findAll();
    }

    /**
     * @param $id
     * @return object
     */
    public function getById($id)
    {
        return $this->entityManager->getRepository('Application\Model\Link')->find($id);
    }

    /**
     * @param $entity
     * @return $this
     */
    public function persist($entity)
    {
        $this->entityManager->persist($entity);
        return $this;
    }

    /**
     * @return $this
     */
    public function flush()
    {
        $this->entityManager->flush();
        return $this;
    }

    /**
     * @param $entity
     * @return $this
     */
    public function remove($entity)
    {
        $this->entityManager->remove($entity);
        return $this;
    }
}
