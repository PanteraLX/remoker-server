<?php
/**
 * UserService.php
 */
namespace RemokerBundle\Service;

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
     * Creates and persists a new User object
     *
     * @param object $parameters RP-Call parameters as Object
     * @return User
     */
    public function createUser($parameters)
    {
        $user = new User();
        $user->setName($parameters->user->name)
            ->setCreatedAt()
            ->setId();

        $this->doctrineService->persist($user);

        return $user;
    }

    /**
     *
     *
     * @param object $parameters RP-Call parameters as Object
     * @return User
     */
    public function getUser($parameters)
    {
        return $this->doctrineService->find($parameters->user->id, "User");
    }
}
