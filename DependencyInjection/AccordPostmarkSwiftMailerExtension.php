<?php

namespace Accord\PostmarkSwiftMailerBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

/**
 * This is the class that loads and manages your bundle configuration
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
 */
class AccordPostmarkSwiftMailerExtension extends Extension
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

        $apiServiceDefinition = new Definition('Openbuildings\Postmark\Api', array($config['api_key']) );

        if($config['use_ssl']){
            $apiServiceDefinition->addMethodCall('setSecure', array(true));
        }
        else{
            $apiServiceDefinition->addMethodCall('setSecure', array(false));
        }

        $container->addDefinitions(array(
            'accord.swift_transport.postmark.api' => $apiServiceDefinition
        ));

		$container->setAlias('accord_postmark', 'accord.swift_transport.postmark');
    }
}
