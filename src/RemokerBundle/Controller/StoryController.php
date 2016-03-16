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
class StoryController extends RemokerController
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
     * @return \RemokerBundle\Document\User
     */
    public function createStoryAction($parameters)
    {
        $parameters = json_decode($parameters);
        $story = $this->storyService->createUserAction($parameters);
        return $story;
    }

    /**
     * @return void
     */
    public function getStoryAction()
    {

    }
}
