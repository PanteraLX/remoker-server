<?php
/**
 * UserService.php
 */
namespace RemokerBundle\Service;
use Doctrine\ODM\MongoDB\DocumentNotFoundException;
use RemokerBundle\Document\User;

/**
 * Class UserService
 * @package RemokerBundle\Service
 * @author  Samuel Heinzmann <samuel.heinzman@swisscom.com>
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link    https://github.com/PanteraLX/remoker-server
 */
class UserService extends AbstractRemokerService
{
    /**
     * @param $parameters
     * @return User
     */
    public function createUser($parameters)
    {
        $user = new User();
        $user->setName($parameters->user->name)
            ->setIsMaster($parameters->user->is_master)
            ->setCreatedAt()
            ->setShortId();

        $this->managerRegistry->getManager()->persist($user);
        $this->managerRegistry->getManager()->flush();

        return $user;
    }

    /**
     * @param $parameters
     * @return User
     * @throws DocumentNotFoundException
     */
    public function getUser($parameters)
    {
        $user = $this->managerRegistry
            ->getRepository('RemokerBundle:User')
            ->find($parameters->id);

        if (!$user) {
            throw new DocumentNotFoundException(
                sprintf('The "User" document with identifier %s could not be found.', $parameters->id)
            );
        }

        return $user;
    }
}
