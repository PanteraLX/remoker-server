<?php
/**
 * StoryController.php
 */
namespace RemokerBundle\Controller;

use Exception;
use Gos\Bundle\WebSocketBundle\Router\WampRequest;
use Ratchet\Wamp\WampConnection;
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
     * @var StoryService
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
     * @param WampConnection $connection WampConnection
     * @param WampRequest    $request    WampRequest
     * @param string         $parameters RP-Call parameters as JSON string
     * @return string
     * @throws Exception
     */
    public function createStoryAction(WampConnection $connection, WampRequest $request, $parameters)
    {
        $parameters = json_decode($parameters[0]);
        if (!isset($parameters->story->name)) {
            throw new Exception("missing_storyname");
        } else {
            $this->nameValidator->validate($parameters->story->name, 255);
        }
        $story = $this->storyService->createStory($parameters);
        return $this->serializer->serialize($story, "json");
    }

    /**
     *
     *
     * @param WampConnection $connection WampConnection
     * @param WampRequest    $request    WampRequest
     * @param string         $parameters RP-Call parameters as JSON string
     * @return string
     * @throws Exception
     */
    public function getStoryAction(WampConnection $connection, WampRequest $request, $parameters)
    {
        $parameters = json_decode($parameters[0]);
        if (!isset($parameters->story->id)) {
            throw new Exception("missing_storyid");
        } else {
            $this->identifierValidator->validate($parameters->story->id);
        }
        $story = $this->storyService->getStory($parameters);
        return $this->serializer->serialize($story, "json");
    }

    /**
     * Deletes all Estimations for a reestimation of the Story
     *
     * @param WampConnection $connection WampConnection
     * @param WampRequest    $request    WampRequest
     * @param string         $parameters RP-Call parameters as JSON string
     * @return string
     * @throws Exception
     */
    public function deleteEstimationsAction(WampConnection $connection, WampRequest $request, $parameters)
    {
        $parameters = json_decode($parameters[0]);
        if (!isset($parameters->story->id)) {
            throw new Exception('missing_storyid');
        } else {
            $this->identifierValidator->validate($parameters->story->id);
        }
        $story = $this->storyService->deleteEstimations($parameters);
        return $this->serializer->serialize($story, 'json');
    }

    /**
     * Sets the result of the Story
     *
     * @param WampConnection $connection WampConnection
     * @param WampRequest    $request    WampRequest
     * @param string         $parameters Parameters as JSON string
     * @return string
     * @throws Exception
     */
    public function setResultAction(WampConnection $connection, WampRequest $request, $parameters)
    {
        $parameters = json_decode($parameters[0]);
        if (!isset($parameters->story->result)) {
            throw new Exception('missing_result');
        } else {
        }
        $story = $this->storyService->setResult($parameters);
        return $this->serializer->serialize($story, 'json');
    }

    /**
     * @param StoryService $storyService Story Service
     * @return StoryController
     */
    public function setStoryService($storyService)
    {
        $this->storyService = $storyService;
        return $this;
    }

    /**
     * Registers this controller as a RPC callback at the WAMP router (config/routing.yml)
     *
     * @return string
     */
    public function getName()
    {
        return "story.rpc";
    }
}
