<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2018/12/19
 * Time: 10:33
 */
namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
//use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class LuckyController extends Controller {
    /**
     * @Route("/lucky/number/{max}",name="luckynum")
     */
    public function numberAction(Request $request,$max=666){

        $number = random_int(0,100);
        $host = $request->headers->get('host');
        $string = $host . $max;

        $url = $this->container->get('router')->generate('luckynum',['num'=>$number], UrlGeneratorInterface::ABSOLUTE_URL);
        //print_r($url);exit;
        return new Response('the luckynum url is ' . $url . '---' . $string);

        //$html = $this->container->get('templating')->render('lucky/number.html.twig',
            //array('luckyNumberList' => $number));
        //print_r($number);exit;
        /*return $this->render('lucky/number.html.twig', [
            'number' => $number,]);*/
        /*$html = $this->container->get('templating')->render(
            'lucky/number.html.twig',
            array('number' => $number)
        );*/

        //return new Response($html);
    }

    /**
     * @Route("/lucky/num",name="nornum")
     */
    public function numAction(){

        $number = random_int(0,200);

        $url = $this->container->get('router')->generate('luckynum',['num'=>$number], UrlGeneratorInterface::ABSOLUTE_URL);
        //print_r($url);exit;
        return new Response('the luckynum url is ' . $url);

        //$html = $this->container->get('templating')->render('lucky/number.html.twig',
        //array('luckyNumberList' => $number));
        //print_r($number);exit;
        /*return $this->render('lucky/number.html.twig', [
            'number' => $number,]);*/
        /*$html = $this->container->get('templating')->render(
            'lucky/number.html.twig',
            array('number' => $number)
        );*/

        //return new Response($html);
    }

    public function luckySer(){
        return 'hello lucky service';
    }
}