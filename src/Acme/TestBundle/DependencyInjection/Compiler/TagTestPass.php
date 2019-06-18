<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2019/5/7
 * Time: 14:04
 */
namespace Acme\TestBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Acme\TestBundle\Service\MessageGenerator;
use Symfony\Component\DependencyInjection\Reference;

class TagTestPass implements CompilerPassInterface{
    public function process(ContainerBuilder $container)
    {
        // TODO: Implement process() method.
        if(!$container->has(MessageGenerator::class)){
            return ;
        }

        $definition = $container->findDefinition(MessageGenerator::class);

        $taggedServices = $container->findTaggedServiceIds('acme.tagtest');

        foreach ($taggedServices as $id=>$tags){
            $definition->addMethodCall('addGetNumSer',[new Reference($id)]);
        }
    }
}