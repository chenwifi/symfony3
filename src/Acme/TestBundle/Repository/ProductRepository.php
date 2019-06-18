<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2019/4/25
 * Time: 17:18
 */
namespace Acme\TestBundle\Repository;

use Doctrine\ORM\EntityRepository;

class ProductRepository extends EntityRepository{
    public function findAllOrderedByName(){
        return $this->getEntityManager()->createQuery(
            'SELECT p FROM AcmeTestBundle:Product p ORDER BY p.name ASC'
        )->getResult();
    }
}