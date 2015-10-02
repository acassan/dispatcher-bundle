<?php
namespace DispatcherBundle;

use DispatcherBundle\DependencyInjection\Compiler\RegisterDispatcherPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

/**
 * Class DispatcherBundle
 * @package DispatcherBundle
 */
Class DispatcherBundle extends Bundle
{
	public function build(ContainerBuilder $container)
	{
		$container->addCompilerPass(new RegisterDispatcherPass());
	}
}
