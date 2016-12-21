<?php

namespace Challenge\Repository;

use Doctrine\ORM\EntityRepository;

class CustomerRepository extends EntityRepository
{
    public function findAll()
    {
        return $this->findBy([], ['name' => 'ASC']);
    }
}
