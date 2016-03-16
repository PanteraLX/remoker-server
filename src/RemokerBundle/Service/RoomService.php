<?php
/**
 * RoomService.php
 */
namespace RemokerBundle\Service;

use Doctrine\ODM\MongoDB\DocumentNotFoundException;
use RemokerBundle\Document\Room;

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
     */
    public function createRoom($parameters)
    {
        $master = $this->userService->getUser($parameters);

        $room = new Room();
        $room->setName($parameters->room->name)
            ->setMaster($master)
            ->setSchema($parameters->room->schema)
            ->setShortId()
            ->setCreatedAt();

        $this->managerRegistry->getManager()->persist($room);
        $this->managerRegistry->getManager()->flush();

        return $room;
    }

    /**
     * @param object $parameters RP-Call parameters as Object
     * @return Room
     * @throws DocumentNotFoundException
     */
    public function getRoom($parameters)
    {
        $room = $this->managerRegistry
            ->getRepository("RemokerBundle:Room")
            ->findOneByShortId($parameters->room->short_id);

        if (!$room) {
            throw new DocumentNotFoundException(
                sprintf("The 'Room' document with identifier %s could not be found.", $parameters->room->short_id)
            );
        }

        return $room;
    }
}
