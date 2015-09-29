<?php

namespace ActiveLAMP\Bundle\SwaggerUIBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html#cookbook-bundles-extension-config-class}
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritDoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('al_swagger_ui');

        // Here you should define the parameters that are allowed to
        // configure your bundle. See the documentation linked above for
        // more information on that topic.

        $rootNode->addDefaultsIfNotSet()
                 ->children()
                    ->scalarNode('resource_list')->cannotBeEmpty()->isRequired()->end()
                    ->arrayNode('static_resources')
                        ->addDefaultsIfNotSet()
                        ->children()
                            ->scalarNode('resource_dir')->defaultValue(null)->end()
                            ->scalarNode('resource_list_filename')->defaultValue('api-docs.json')->end()
                        ->end()
                    ->end()
                    ->arrayNode('js_config')
                        ->addDefaultsIfNotSet()
                        ->children()
                            ->scalarNode('expansion')->defaultValue('list')->end()
                            ->arrayNode('supported_submit_methods')
                                ->prototype('scalar')->end()
                                ->defaultValue(array('get', 'post', 'put', 'delete'))
                            ->end()
                            ->scalarNode('sorter')->defaultValue(null)->end()
                            ->scalarNode('highlight_size_threshold')->defaultValue(null)->end()
                            ->arrayNode('boolean_values')
                                ->prototype('scalar')->end()
                                ->defaultValue(array('true', 'false'))
                            ->end()
                        ->end()
                    ->end()
                    ->arrayNode('auth_config')
                        ->addDefaultsIfNotSet()
                        ->children()
                            ->arrayNode('oauth')
                                ->addDefaultsIfNotSet()
                                ->children()
                                    ->booleanNode('enable')->defaultFalse()->end()
                                    ->scalarNode('client_id')->defaultValue(null)->end()
                                    ->scalarNode('realm')->defaultValue(null)->end()
                                    ->scalarNode('app_name')->defaultValue(null)->end()
                                ->end()
                            ->end()
                            ->arrayNode('http')
                                ->addDefaultsIfNotSet()
                                ->children()
                                    ->booleanNode('enable')->defaultFalse()->end()
                                    ->scalarNode('key_name')->defaultValue(null)->end()
                                    ->scalarNode('delivery')->defaultValue(null)->end()
                                ->end()
                            ->end()
                        ->end()
                    ->end()
                 ->end();

        return $treeBuilder;
    }
}
