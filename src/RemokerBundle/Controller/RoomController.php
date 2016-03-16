<?php
/**
 * RoomController.php
 */
namespace RemokerBundle\Controller;

use RemokerBundle\Document\Room;
use RemokerBundle\Document\User;
use RemokerBundle\Service\RoomService;

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
    /**
     * @var UserController
     */
    private $roomService;

    /**
     * EstimationController constructor
     */
    public function __construct()
    {
        $this->roomService = new RoomService();
    }

    /**
     * @param $parameters
     * @return Room
     */
    public function createRoomAction($parameters)
    {
        $parameters = json_decode($parameters);
        $room = $this->roomService->createRoom($parameters);
        return $room;
    }

    /**
     * @param $parameters
     * @return void
     */
    public function getUserAction($parameters)
    {

    }
}
