<?php

namespace ActiveLAMP\Bundle\SwaggerUIBundle\DependencyInjection;

use Symfony\Component\Config\Resource\FileResource;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

/**
 * This is the class that loads and manages your bundle configuration
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
 */
class ALSwaggerUIExtension extends Extension
{
    /**
     * {@inheritDoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.yml');

        $container->setParameter('al_swagger_ui.resource_list', $config['resource_list']);
        $container->setParameter('al_swagger_ui.js_config', $config['js_config']);
        $container->setParameter('al_swagger_ui.auth_config', $config['auth_config']);

        $container->setParameter('al_swagger_ui.static_resources_dir', $config['static_resources']['resource_dir']);
        $container->setParameter('al_swagger_ui.static_resource_list_filename', $config['static_resources']['resource_list_filename']);
        $container->setParameter('al_swagger_ui.authentication_config', $config['authentication']);

    }
}
