<?php
/**
 * StoryService.php
 */
namespace RemokerBundle\Service;
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
     */
    public function getStory($parameters)
    {
        return $this->managerRegistry
            ->getRepository('RemokerBundle:Story')
            ->find($parameters->id);
    }
}
