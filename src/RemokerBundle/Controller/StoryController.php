<?php
/**
 * StoryController.php
 */
namespace RemokerBundle\Controller;

use RemokerBundle\Document\Story;
use RemokerBundle\Service\StoryService;

/**
 * Class StoryController
 *
 * @package RemokerBundle\Controller
 * @author  Samuel Heinzmann <samuel.heinzman@swisscom.com>
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link    https://github.com/PanteraLX/remoker-server
 */
class StoryController extends AbstractRemokerController
{
    /**
     * @var UserController
     */
    private $storyService;

    /**
     * EstimationController constructor
     */
    public function __construct()
    {
        $this->storyService = new StoryService();
    }

    /**
     * @param $parameters
     * @return Story
     */
    public function createStoryAction($parameters)
    {
        $parameters = json_decode($parameters);
        return $this->storyService->createUserAction($parameters);
    }

    /**
     * @param $parameters
     * @return Story
     */
    public function getStoryAction($parameters)
    {
        $parameters = json_decode($parameters);
        return $this->storyService->createStory($parameters);
    }

    /**
     * Name of RPC, use for PubSub router
     *
     * @return string
     */
    public function getName()
    {
        return 'story.rpc';
    }
}
