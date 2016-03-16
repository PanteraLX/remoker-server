<?php
/**
 * RemokerBundle.php
 */
namespace RemokerBundle;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpKernel\Bundle\Bundle;

/**
 * Class RemokerBundle
 *
 * @package RemokerBundle
 * @author  Samuel Heinzmann <samuel.heinzman@swisscom.com>
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link    https://github.com/PanteraLX/remoker-server
 */
class RemokerBundle extends Bundle
{
    /**
     * @var ContainerInterface
     */
    private static $containerInstance = null;

    /**
     * @param ContainerInterface|null $container Container
     * @return void
     */
    public function setContainer(ContainerInterface $container = null)
    {
        parent::setContainer($container);
        self::$containerInstance = $container;
    }

    /**
     * @return ContainerInterface
     */
    public static function getContainer()
    {
        return self::$containerInstance;
    }
}
