<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2019/4/26
 * Time: 11:46
 */
namespace Acme\TestBundle\Service;

use Doctrine\Common\Persistence\ManagerRegistry;

class MessageGenerator{

    private $doctrine;
    private $area;
    private $getNumSer;

    public function __construct(ManagerRegistry $doctrine,$area)
    {
        $this->doctrine = $doctrine;
        $this->area = $area;
    }

    public function getHappyMessage(){
        $messages = [
            'you did it!!',
            'so cool!! amazing!!!',
            'they are so big!!!',
        ];

        $index = array_rand($messages);
        return $messages[$index];
    }

    public function addGetNumSer($numSer){
        $this->getNumSer = $numSer;
    }

    public function getProductName(){
        $entityManager = $this->doctrine->getManager();
        $products = $entityManager->createQuery(
            'SELECT p FROM AcmeTestBundle:Product p ORDER BY p.name ASC'
        )->getResult();

        foreach ($products as $product) {
            $productNames[] = $product->getName();
        }

        $productNum = $this->getNumSer->getNum();

        $index = array_rand($productNames);
        return $productNames[$index] . ' made in ' . $this->area . ' num is ' . $productNum;
    }
}