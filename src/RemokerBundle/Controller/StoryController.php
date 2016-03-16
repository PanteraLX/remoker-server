<?php
/**
 * StoryController.php
 */
namespace RemokerBundle\Controller;

use Exception;
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
        parent::__construct();
        $this->storyService = new StoryService();
    }

    /**
     * @param $parameters
     * @return string
     * @throws Exception
     */
    public function createStoryAction($parameters)
    {
        $parameters = json_decode($parameters);
        if (!isset($parameters->name)) {
            throw new Exception("Please set a task name");
        } else {
            $this->nameValidator->assert($parameters->name);
        }
        $story = $this->storyService->createStory($parameters);
        return $this->serializer->serialize($story, 'json');
    }

    /**
     * @param $parameters
     * @return mixed|string
     * @throws Exception
     */
    public function getStoryAction($parameters)
    {
        $parameters = json_decode($parameters);
        if (!isset($parameters->id)) {
            throw new Exception('No StoryId found!');
        } else {
            $this->identifierValidator->assert($parameters->id);
        }
        $story = $this->storyService->getStory($parameters);
        return $this->serializer->serialize($story, 'json');
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
