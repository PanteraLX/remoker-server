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
     * @param $parameters
     * @return Room
     */
    public function createRoom($parameters)
    {
        $master = $this->userService->getUser($parameters);

        $room = new Room();
        $room->setName($parameters->name)
            ->setMaster($master)
            ->setSchema($parameters->schema)
            ->setShortId()
            ->setCreatedAt();

        $this->managerRegistry->getManager()->persist($room);
        $this->managerRegistry->getManager()->flush();

        return $room;
    }

    /**
     * @param $parameters
     * @return Room
     * @throws DocumentNotFoundException
     */
    public function getRoom($parameters)
    {
        $room = $this->managerRegistry
            ->getRepository('RemokerBundle:Room')
            ->findOneByShortId($parameters->shortId);

        if (!$room) {
            throw new DocumentNotFoundException(
                sprintf('The "Room" document with identifier %s could not be found.', $parameters->shortId)
            );
        }

        return $room;
    }
}
