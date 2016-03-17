<?php
/**
 * StoryService.php
 */
namespace RemokerBundle\Service;

use RemokerBundle\Document\Story;
use \Exception;

/**
 * Class StoryService
 *
 * @package RemokerBundle\Service
 * @author  Samuel Heinzmann <samuel.heinzman@swisscom.com>
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link    https://github.com/PanteraLX/remoker-server
 */
class StoryService extends AbstractRemokerService
{
    /**
     * @var RoomService
     */
    private $roomService;

    /**
     * StoryService constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->roomService = new RoomService();
    }

    /**
     * Creates and persists a new Story.
     * The new Story object will be referenced in the corresponding Room object
     *
     * @param object $parameters RP-Call parameters as Object
     * @return Story
     * @throws Exception
     */
    public function createStory($parameters)
    {
        $story = new Story();
        $story->setName($parameters->story->name)
            ->setShortId()
            ->setCreatedAt();

        if (isset($parameters->room->short_id)) {
            $room = $this->roomService->getRoom($parameters);
            $room->addStory($story);
        } else {
            throw new Exception("There is no roomID");
        }

        $this->doctrineService->persist($story);

        return $story;
    }

    /**
     * @param object $parameters RP-Call parameters as Object
     * @return Story
     */
    public function getStory($parameters)
    {
        return $this->doctrineService->find($parameters->story->short_id, "Story");
    }
}
