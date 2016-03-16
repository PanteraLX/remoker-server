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
    private $roomService;

    public function __construct()
    {
        parent::__construct();
        $this->roomService = new RoomService();
    }
    /**
     * @param $parameters
     * @return Story
     */
    public function createStory($parameters)
    {
        $story = new Story();
        $story->setName($parameters->name)
            ->setShortId()
            ->setCreatedAt();

        $room = $this->roomService->getRoom($parameters);
        $room->addStory($story);

        $this->managerRegistry->getManager()->persist($story);
        $this->managerRegistry->getManager()->flush();

        return $story;
    }

    /**
     * @param $parameters
     * @return Story
     * @throws DocumentNotFoundException
     */
    public function getStory($parameters)
    {
        $story = $this->managerRegistry
            ->getRepository('RemokerBundle:Story')
            ->find($parameters->id);

        if (!$story) {
            throw new DocumentNotFoundException(
                sprintf('The "Story" document with identifier %s could not be found.', $parameters->id)
            );
        }

        return $story;
    }
}
