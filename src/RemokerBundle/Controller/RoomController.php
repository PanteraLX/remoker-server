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
class RoomController extends AbstractRemokerController
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
        return $this->roomService->createRoom($parameters);
    }

    /**
     * @param $parameters
     * @return Room
     */
    public function getUserAction($parameters)
    {
        $parameters = json_decode($parameters);
        return $this->roomService->getRoom($parameters);
    }

    /**
     * Name of RPC, use for PubSub router
     *
     * @return string
     */
    public function getName()
    {
        return 'room.rpc';
    }
}
