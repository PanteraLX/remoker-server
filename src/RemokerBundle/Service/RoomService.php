<?php
/**
 * RoomService.php
 */
namespace RemokerBundle\Service;

use RemokerBundle\Document\Room;
use \Exception;

/**
 * Class RoomService
 *
 * @package RemokerBundle\Service
 * @author  Samuel Heinzmann <samuel.heinzman@swisscom.com>
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link    https://github.com/PanteraLX/remoker-server
 */
class RoomService extends AbstractRemokerService
{
    /**
     * @var UserService
     */
    private $userService;

    /**
     * RoomService constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->userService = new UserService();
    }

    /**
     * Creates and persists a new Story.
     * The user, who creates a room is automatically the master user
     *
     * @param object $parameters RP-Call parameters as Object
     * @return Room
     * @throws Exception
     */
    public function createRoom($parameters)
    {
        if (isset($parameters->user->short_id)) {
            $master = $this->userService->getUser($parameters)
                ->setIsMaster(true);
        } else {
            throw new Exception("missing_userid");
        }

        $room = new Room();
        $room->setName($parameters->room->name)
            ->setMaster($master)
            ->setSchema($parameters->room->schema)
            ->setShortId()
            ->setCreatedAt();

        $this->doctrineService->persist($room);

        return $room;
    }

    /**
     * @param object $parameters RP-Call parameters as Object
     * @return Room
     */
    public function addDeveloper($parameters)
    {
        $developer = $this->userService->getUser($parameters);
        $room = $this->doctrineService->find($parameters->room->short_id, "Room");
        if (!$developer->isMaster()) {
            $room->addDeveloper($developer);
        }
        return $room;
    }


    /**
     * @param object $parameters RP-Call parameters as Object
     * @return Room
     * @throws Exception
     */
    public function getRoom($parameters)
    {
        return $this->doctrineService->find($parameters->room->short_id, "Room");
    }
}
