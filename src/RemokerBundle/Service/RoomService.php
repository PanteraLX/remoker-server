<?php
/**
 * RoomService.php
 */
namespace RemokerBundle\Service;

use RemokerBundle\Document\Room;

/**
 * Class RoomService
 *
 * @package RemokerBundle\Service
 * @author  Samuel Heinzmann <samuel.heinzman@swisscom.com>
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link    https://github.com/PanteraLX/remoker-server
 */
class RoomService extends RemokerService
{
    /**
     * @param $parameters
     * @return Room
     */
    public function createRoom($parameters)
    {
        $master = $this->userService->getUser($parameters);

        $user = new Room();
        $user->setName($parameters->name)
            ->setMaster($master);

        $this->managerRegistry->getManager()->persist($user);
        $this->managerRegistry->getManager()->flush();

        return $user;
    }
}
