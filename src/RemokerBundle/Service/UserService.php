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
class UserService extends RemokerService
{
    /**
     * @param $parameters
     * @return User
     */
    public function createUser($parameters)
    {
        $user = new User();
        $user->setName($parameters->name)
            ->setIsMaster($parameters->isMaster);

        $this->managerRegistry->getManager()->persist($user);
        $this->managerRegistry->getManager()->flush();

        return $user;
    }
}
