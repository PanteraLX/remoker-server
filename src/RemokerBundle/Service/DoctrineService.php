<?php
/**
 * RemokerService.php
 */
namespace RemokerBundle\Service;

use Doctrine\Bundle\MongoDBBundle\ManagerRegistry;
use Doctrine\ODM\MongoDB\DocumentNotFoundException;
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
class DoctrineService
{
    /**
     * @var ContainerInterface
     */
    private $container;

    /**
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
     * @param string $id         ID of the object to find
     * @param string $repository Repository name of the object
     * @return mixed
     * @throws DocumentNotFoundException
     */
    public function find($id, $repository)
    {
        $object = $this->managerRegistry
            ->getRepository("RemokerBundle:" . $repository)
            ->findOneByShortId($id);

        if (!$object) {
            throw new DocumentNotFoundException(
                sprintf("The %s document with identifier %s could not be found.", $repository, $id)
            );
        }
        return $object;
    }
}
