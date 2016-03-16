<?php
/**
 * RemokerService.php
 */
namespace RemokerBundle\Service;

use Doctrine\Bundle\MongoDBBundle\ManagerRegistry;
use RemokerBundle\RemokerBundle;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class RemokerService
 *
 * @package RemokerBundle\Service
 * @author  Samuel Heinzmann <samuel.heinzman@swisscom.com>
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link    https://github.com/PanteraLX/remoker-server
 */
class RemokerService
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
        $this->managerRegistry = $this->get('doctrine_mongodb');
    }
}
