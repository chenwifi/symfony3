<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2019/4/24
 * Time: 14:40
 */
namespace Acme\TestBundle;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;
use Acme\TestBundle\DependencyInjection\Compiler\TagTestPass;

class AcmeTestBundle extends Bundle{
    public function build(ContainerBuilder $container)
    {
        parent::build($container); // TODO: Change the autogenerated stub
        $container->addCompilerPass(new TagTestPass());
    }
}