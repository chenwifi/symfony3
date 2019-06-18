<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2019/4/27
 * Time: 14:05
 */
namespace Acme\TestBundle\EventSubscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\GetResponseForExceptionEvent;
use Symfony\Component\HttpKernel\KernelEvents;

class ExceptionSubscriber implements EventSubscriberInterface{
    public static function getSubscribedEvents(){
        return [
            KernelEvents::EXCEPTION => [
                ['processException',10],
                ['logException',0],
                ['notifyException',-10],
            ]
        ];
    }

    public function processException(GetResponseForExceptionEvent $event){

    }

    public function logException(GetResponseForExceptionEvent $event){

    }

    public function notifyException(GetResponseForExceptionEvent $event){

    }
}