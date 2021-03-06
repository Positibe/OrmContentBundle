<?php

namespace Positibe\Bundle\CmsBundle;

use Doctrine\Bundle\DoctrineBundle\DependencyInjection\Compiler\DoctrineOrmMappingsPass;
use Positibe\Bundle\CmsBundle\DependencyInjection\Compiler\ResourceServicesCompilerPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class PositibeCmsBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        $container->addCompilerPass(new ResourceServicesCompilerPass());
        $container->addCompilerPass(
            DoctrineOrmMappingsPass::createXmlMappingDriver(
                array(
                    realpath(__DIR__ . '/Resources/config/doctrine-model') => 'Symfony\Cmf\Bundle\SeoBundle\Model',
                ),
                array('cmf_seo.dynamic.persistence.orm.manager_name'),
                'cmf_seo.backend_type_orm',
                array('CmfSeoBundle' => 'Symfony\Cmf\Bundle\SeoBundle\Model')
            )
        );

        $container->addCompilerPass(
            DoctrineOrmMappingsPass::createAnnotationMappingDriver(
                [realpath(__DIR__.'/Entity') => 'Positibe\Bundle\MenuBundle\Doctrine\Orm'],
                [realpath(__DIR__.'/Entity')]
            )
        );
    }
}
