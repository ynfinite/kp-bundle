<?php

namespace Kptec\KpBundle\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\HttpKernel\DependencyInjection\ConfigurableExtension;

class KptecKpExtension extends ConfigurableExtension {
	
	protected function loadInternal (array $mergedConfig, ContainerBuilder $container) {
		$loader = new YamlFileLoader($container, new FileLocator(__DIR__."/../Resources/config"));
		$loader->load('services.yml');
	}

}