<?php
/**
 * RemokerExtension.php
 */
namespace RemokerBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\Extension\Extension;

/**
 * Class RemokerExtension
 *
 * @package RemokerBundle\DependencyInjection
 * @author  Samuel Heinzmann <samuel.heinzman@swisscom.com>
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link    https://github.com/PanteraLX/remoker-server
 */
class RemokerExtension extends Extension
{
    /**
     * All services and parameters (e.g. routing) related to this extension will be loaded
     *
     * @param array            $configs   Configurations
     * @param ContainerBuilder $container Container Builder
     *
     * @return void
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $loader = new YamlFileLoader($container, new FileLocator(__DIR__ . "/../Resources/config"));
        $loader->load("services.yml");
    }
}
