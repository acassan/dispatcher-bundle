<?php

namespace DispatcherBundle\DependencyInjection\Compiler;

use DispatcherBundle\Dispatcher\DispatcherInterface;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

/**
 * Class RegisterDispatcherPass
 * @package DispatcherBundle\DependencyInjection\Compiler
 */
Class RegisterDispatcherPass implements CompilerPassInterface
{
	/**
	 * @param ContainerBuilder $container
	 */
    public function process(ContainerBuilder $container)
    {
        if (!$container->hasDefinition('dispatcher.manager')) {
            return;
        }

        $definition = $container->getDefinition('dispatcher.manager');
        $methodCalls = $definition->getMethodCalls();
        $definition->setMethodCalls([]);

        foreach ($container->findTaggedServiceIds('dispatcher.instance') as $id => $tags) {
            $alias 		= $tags[0]['alias'];
            $loader 	= $container->findDefinition($id);
            $class 		= $loader->getClass();
            $interface 	= DispatcherInterface::class;
            $reflection = new \ReflectionClass($class);

            if (!$reflection->implementsInterface($interface)) {
                throw new \RuntimeException(sprintf(
                    'Service "%s" of type "%s" must implement interface "%s".',
                    $id,
                    $class,
                    $interface
                ));
            }

            $definition->addMethodCall('addDispatcher', [ $alias, new Reference($id) ]);
        }

        foreach ($methodCalls as $methodCall) {
            $definition->addMethodCall($methodCall[0], $methodCall[1]);
        }
    }
}