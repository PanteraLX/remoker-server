<?php
/**
 * DoctrineService.php
 *
 * This service is responsible for all writing and fetching to and from the Mongo database
 */
namespace RemokerBundle\Service;

use Doctrine\Bundle\MongoDBBundle\ManagerRegistry;
use Doctrine\ODM\MongoDB\DocumentNotFoundException;
use RemokerBundle\RemokerBundle;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class DoctrineService
 *
 * @package RemokerBundle\Service
 * @author  Samuel Heinzmann <samuel.heinzman@swisscom.com>
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link    https://github.com/PanteraLX/remoker-server
 */
class DoctrineService
{
    /**
     * Symfony Dependency Injection Container
     *
     * @var ContainerInterface
     */
    private $container;

    /**
     * Doctrine ODM ManagerRegistry
     *
     * @var ManagerRegistry
     */
    private $managerRegistry;

    /**
     * RemokerService constructor.
     */
    public function __construct()
    {
        $this->container = RemokerBundle::getContainer();
    }

    /**
     * Gets the Doctrine ODM Manager out of the Symfony DI container and persists the given object
     *
     * @param object $object Object to persist
     * @return void
     */
    public function persist($object)
    {
        $this->managerRegistry = $this->container->get("doctrine_mongodb");
        $this->managerRegistry->getManager()->persist($object);
        $this->managerRegistry->getManager()->flush();
    }

    /**
     * All objects are identified by a MongoDB ID and a custom, 6 chars long short ID.
     * Since its much more convenient to communicate the short ID (e.g the room ID),
     * only one findObject method id implemented.
     *
     * @param string $id         ID of the object to find
     * @param string $repository Repository name of the object
     * @return mixed
     * @throws DocumentNotFoundException
     */
    public function find($id, $repository)
    {
        $this->managerRegistry = $this->container->get("doctrine_mongodb");
        $object = $this->managerRegistry
            ->getRepository("RemokerBundle:" . $repository)
            ->find($id);

        if (!$object) {
            throw new DocumentNotFoundException(
                sprintf("The %s document with identifier %s could not be found.", $repository, $id)
            );
        }
        return $object;
    }
}
