<?php
/**
 * RoomController.php
 */
namespace RemokerBundle\Controller;

use Exception;
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
        parent::__construct();
        $this->roomService = new RoomService();
    }

    /**
     * @param $parameters
     * @return string
     * @throws Exception
     */
    public function createRoomAction($parameters)
    {
        $parameters = json_decode($parameters);
        if(!isset($parameters->name)) {
            throw new Exception("Please set a session name");
        }else {
            $this->nameValidator->assert($parameters->name);
        }
        $room = $this->roomService->createRoom($parameters);
        return $this->serializer->serialize($room, 'json');
    }

    /**
     * @param $parameters
     * @return string
     * @throws Exception
     */
    public function getRoomAction($parameters)
    {
        $parameters = json_decode($parameters);
        if(!isset($parameters->short_id)) {
            throw new Exception("Please set a room identifier");
        } else {
            $this->identifierValidator->assert($parameters->id);
        }
        $room = $this->roomService->getRoom($parameters);
        return $this->serializer->serialize($room, 'json');
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
