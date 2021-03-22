<?php
/**
 * Created by Samir_H
 */

namespace EasyOauth\src\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use \Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;

class EasyOauthExtension extends Extension
{

    /**
     * @param array $configs
     * @param ContainerBuilder $container
     * @throws
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $loader = new YamlFileLoader(
            $container,
            new FileLocator(__DIR__ . '/../../config')
        );

        $loader->load('services.yaml');
    }
}