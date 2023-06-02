<?php

namespace App\NotificationPublisher\Configuration;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class NotificationConfiguration implements ConfigurationInterface
{
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder('notifications');

        $treeBuilder->getRootNode()
            ->useAttributeAsKey('type')
            ->arrayPrototype()
                ->arrayPrototype()
                    ->children()
                        ->scalarNode('provider')->isRequired()->end()
                        ->arrayNode('options')
                            ->children()
                                ->integerNode('retries')->end()
                            ->end()
                        ->end()
                    ->end()
                ->end()
            ->end()
        ;

        return $treeBuilder;
    }
}