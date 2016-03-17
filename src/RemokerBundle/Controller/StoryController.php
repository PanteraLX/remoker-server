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
            throw new Exception("Please set a story name");
        } else {
            $this->nameValidator->assert($parameters->story->name);
        }
        $story = $this->storyService->createStory($parameters);
        return $this->serializer->serialize($story, "json");
    }

    /**
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
            throw new Exception("No StoryId found!");
        } else {
            $this->identifierValidator->assert($parameters->story->id);
        }
        $story = $this->storyService->getStory($parameters);
        return $this->serializer->serialize($story, "json");
    }

    /**
     * @return string
     */
    public function getName()
    {
        return "story.rpc";
    }
}
