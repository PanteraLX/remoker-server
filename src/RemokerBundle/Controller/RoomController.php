<?php
/**
 * RoomController.php
 */
namespace RemokerBundle\Controller;

use RemokerBundle\Document\Room;
use RemokerBundle\Document\User;

/**
 * Class RoomController
 *
 * @package RemokerBundle\Controller
 * @author  Samuel Heinzmann <samuel.heinzman@swisscom.com>
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link    https://github.com/PanteraLX/remoker-server
 */
class RoomController extends RemokerController
{

    public function createRoomAction($parameters)
    {
        $user = new Room();
        $user->setName($parameters->name)
            ->setMaster(new User());

        return $user;
    }

    public function getUserAction($parameters)
    {

    }
}
