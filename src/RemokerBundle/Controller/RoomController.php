<?php
/**
 * RoomController.php
 */
namespace RemokerBundle\Controller;

use Exception;
use Gos\Bundle\WebSocketBundle\Router\WampRequest;
use Ratchet\Wamp\WampConnection;
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
     * @var RoomService
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
     * @param WampConnection $connection WampConnection
     * @param WampRequest    $request    WampRequest
     * @param string         $parameters RP-Call parameters as JSON string
     * @return string
     * @throws Exception
     */
    public function createRoomAction(WampConnection $connection, WampRequest $request, $parameters)
    {
        $parameters = json_decode($parameters[0]);
        if (!isset($parameters->room->name)) {
            throw new Exception("missing_roomname");
        } elseif (!isset($parameters->room->schema)) {
            throw new Exception("missing_schema");
        } else {
            $this->nameValidator->validate($parameters->room->name);
            $this->schemaValidator->validate($parameters->room->schema);
        }
        $room = $this->roomService->createRoom($parameters);
        return $this->serializer->serialize($room, "json");
    }

    /**
     * @param WampConnection $connection WampConnection
     * @param WampRequest    $request    WampRequest
     * @param string         $parameters RP-Call parameters as JSON string
     * @return string
     * @throws Exception
     */
    public function getRoomAction(WampConnection $connection, WampRequest $request, $parameters)
    {
        $parameters = json_decode($parameters[0]);
        if (!isset($parameters->room->short_id)) {
            throw new Exception("missing_roomid");
        } else {
            $this->identifierValidator->validate($parameters->room->short_id);
        }
        $room = $this->roomService->getRoom($parameters);
        return $this->serializer->serialize($room, "json");
    }

    /**
     * @return string
     */
    public function getName()
    {
        return "room.rpc";
    }
}
