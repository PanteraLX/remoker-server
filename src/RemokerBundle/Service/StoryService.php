<?php
/**
 * StoryService.php
 */
namespace RemokerBundle\Service;

use Doctrine\ODM\MongoDB\DocumentNotFoundException;
use RemokerBundle\Document\Story;

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
     */
    public function createStory($parameters)
    {
        $story = new Story();
        $story->setName($parameters->story->name)
            ->setShortId()
            ->setCreatedAt();

        $room = $this->roomService->getRoom($parameters);
        $room->addStory($story);

        $this->managerRegistry->getManager()->persist($story);
        $this->managerRegistry->getManager()->flush();

        return $story;
    }

    /**
     * @param object $parameters RP-Call parameters as Object
     * @return Story
     * @throws DocumentNotFoundException
     */
    public function getStory($parameters)
    {
        $story = $this->managerRegistry
            ->getRepository("RemokerBundle:Story")
            ->find($parameters->story->id);

        if (!$story) {
            throw new DocumentNotFoundException(
                sprintf("The 'Story' document with identifier %s could not be found.", $parameters->story->id)
            );
        }

        return $story;
    }
}
