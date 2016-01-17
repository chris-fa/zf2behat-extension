<?php

namespace MvLabs\Zf2Extension;

use Behat\Testwork\ServiceContainer\Extension as ExtensionInterface,
	Behat\Testwork\ServiceContainer\ExtensionManager;

use MvLabs\Zf2Extension\Compiler\Zf2ApplicationCompilerPasses;

use Symfony\Component\DependencyInjection\ContainerBuilder,
    Symfony\Component\DependencyInjection\Loader\XmlFileLoader,
    Symfony\Component\Config\FileLocator;

/**
 * Description of Zf2Extensions
 *
 * @author David Contavalli <mauipipe@gmail.com>
 */
class Zf2Extension implements ExtensionInterface
{
    public function load(ContainerBuilder $container, array $config)
    {
         $loader = new XmlFileLoader( $container, new FileLocator(__DIR__.'/services'));
         $loader->load('zf2.xml');

         if (isset($config['module'])) {

             $container->setParameter('behat.zf2_extension.module', $config['module']);

         }

         if (isset($config['config'])) {

             $container->setParameter('behat.zf2_extension.config_path', $config['config']);

         }

    }

    public function getCompilerPasses()
    {
        return array(

            new Zf2ApplicationCompilerPasses()

        );

    }

	public function initialize(ExtensionManager $extensionManager) 
	{
	}

	public function configure(ArrayNodeDefinition $builder)
    {
	}

	public function getConfigKey()
    {
        return 'zf2';
    }
}

return new Zf2Extension();
