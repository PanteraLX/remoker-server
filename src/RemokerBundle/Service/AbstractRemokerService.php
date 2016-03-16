<?php
/**
 * RemokerService.php
 */
namespace RemokerBundle\Service;

use Doctrine\Bundle\MongoDBBundle\ManagerRegistry;
use RemokerBundle\RemokerBundle;

/**
 * Class RemokerService
 *
 * @package RemokerBundle\Service
 * @author  Samuel Heinzmann <samuel.heinzman@swisscom.com>
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link    https://github.com/PanteraLX/remoker-server
 */
abstract class AbstractRemokerService
{
    /**
     * @var ManagerRegistry
     */
    protected $managerRegistry;

    /**
     * RemokerService constructor.
     */
    public function __construct()
    {
        $container = RemokerBundle::getContainer();
        //$this->managerRegistry = $container->get("doctrine_mongodb");
    }
}
