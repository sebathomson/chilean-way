<?php

namespace SebaThomson\ChileanWayBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files.
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/configuration.html}
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('chilean_way');

        $suppertedRutFormats = ['xxxxxxxxx', 'xxxxxxxx-x', 'xx.xxx.xxx-x'];

        $rootNode
        ->children()
                ->scalarNode('rut_format')
                    ->defaultValue('xxxxxxxx-x')
                    ->cannotBeEmpty()
                    ->validate()
                        ->ifNotInArray($supportedDrivers)
                        ->thenInvalid('The format %s is not supported. Please choose one of '.json_encode($suppertedRutFormats))
                    ->end()
                ->end()
                ->scalarNode('date_format')
                    ->defaultValue('d-m-Y')
                    ->cannotBeEmpty()
                    ->end()
                ->scalarNode('datetime_format')
                    ->defaultValue('d-m-Y H:i')
                    ->cannotBeEmpty()
                    ->end()
                ->scalarNode('time_format')
                    ->defaultValue('H:i')
                    ->cannotBeEmpty()
                    ->end();

        return $treeBuilder;
    }
}
