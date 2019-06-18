<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2019/4/24
 * Time: 14:50
 */
namespace Acme\TestBundle\Controller;

use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
//use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Acme\TestBundle\Entity\Product;
use Acme\TestBundle\Service\MessageGenerator;
use Symfony\Component\Cache\Simple\FilesystemCache;

class RandomController extends Controller{
    /**
     * @Route("/random/number/{max}",name="randomnum")
     */
    public function randNumAction(Request $request,$max=666){

        $number = random_int(0,100);
        $host = $request->headers->get('host');
        $string = $host . $max;
        //$response = $this->container->get('AppBundle\Controller\LuckyController')->luckySer();
        $logger = $this->container->get('logger');
        $logger->info('Look! I just used a service');
        return new Response('ok!!');
        //$url = $this->container->get('router')->generate('randomnum',['num'=>$number], UrlGeneratorInterface::ABSOLUTE_URL);
        //return new Response('the randomnum url is ' . $url . '---' . $string);
    }

    /**
     * @Route("/create",name="create")
     */
    public function createAction(){
        $entityManager = $this->getDoctrine()->getManager();

        $product = new Product();
        //$product->setName('Mouse');
        $product->setPrice(39.99);
        $product->setDescription('So Big!!!!');

        $validator = $this->get('validator');
        $errors = $validator->validate($product);

        if(count($errors) > 0){
            $errorString = (string)$errors;
            return new Response($errorString);
        }else {

            $entityManager->persist($product);

            $entityManager->flush();

            return new Response('saved new product with id ' . $product->getId());
        }
    }

    /**
     * @Route("/show/{productId}",name="show")
     */
    public function showAction($productId){
        $repository = $this->getDoctrine()->getRepository(Product::class);
        $product = $repository->find($productId);

        if(!$product){
            throw $this->createNotFoundException('No product found for id ' . $productId);
        }

        return new Response('name: ' . $product->getName() . ' price: ' . $product->getPrice() . ' description: ' . $product->getDescription());
    }

    /**
     * @Route("/update/{productId}",name="update")
     */
    public function updateAction($productId){
        $entityManager = $this->getDoctrine()->getManager();
        $product = $entityManager->getRepository(Product::class)->find($productId);

        if(!$product){
            throw $this->createNotFoundException('No product found for id ' . $productId);
        }

        $product->setName('computer');
        $product->setPrice('5999.99');
        $entityManager->flush();

        return new Response('successfully update product id :' . $productId);
    }

    /**
     * @Route("/list",name="list")
     */
    public function listAction(){
        $entityManager = $this->getDoctrine()->getManager();
        $query = $entityManager->createQuery(
            'SELECT p FROM AcmeTestBundle:Product p WHERE p.price > :price ORDER BY p.price ASC'
        )->setParameter('price',19.99);
        $products = $query->getResult();

        return new Response('the first product name is: ' . $products[0]->getName());
    }

    /**
     * @Route("/listres",name="listres")
     */
    public function listResAction(){
        $entityManager = $this->getDoctrine()->getManager();
        $products = $entityManager->getRepository(Product::class)->findAllOrderedByName();

        return new Response('the first product order by name named :' . $products[0]->getName());
    }

    /**
     * @Route("/testser",name="testser")
     */
    public function testSerAction(MessageGenerator $messageGenerator,LoggerInterface $logger){
        //$message = $messageGenerator->getHappyMessage();
        //$mesSer = $this->container->get('Acme\TestBundle\Service\MessageGenerator');
        //$message = $mesSer->getHappyMessage();

        $cache = new FilesystemCache();
        if(!$cache->has('bigfat.name')){
            $cache->set('bigfat.name','chenwifi',3600);
        }
        $bigFatName = $cache->get('bigfat.name');

        $url = $this->container->get('router')->generate('testser',['name'=>$bigFatName], UrlGeneratorInterface::ABSOLUTE_URL);

        $product = $messageGenerator->getProductName();
        $logger->info('the product name is: ' . $product);
        $ext = $this->container->getParameter('acme_test.acme_bigfat');
        return new Response('the product name is: ' . $product . ' buyed by ' . $bigFatName . ' and you can check in ' . $url . ' and ext is ' . $ext);
    }
}