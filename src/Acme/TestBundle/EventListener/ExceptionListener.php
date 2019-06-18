<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2019/4/27
 * Time: 11:20
 */
namespace Acme\TestBundle\EventListener;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\GetResponseForExceptionEvent;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;

class ExceptionListener{
    public function onKernelException(GetResponseForExceptionEvent $event){
        print_r('bigfat!!!!');exit;
    }
}