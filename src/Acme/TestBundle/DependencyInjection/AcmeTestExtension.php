<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2019/5/17
 * Time: 14:38
 */
namespace Acme\TestBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\Config\Definition\Processor;

class AcmeTestExtension extends Extension{
    public function load(array $configs, ContainerBuilder $container)
    {
        // TODO: Implement load() method.
        $ext = $configs[0]['acme_bigfat'];
        $container->setParameter('acme_test.acme_bigfat',$ext);
    }
}