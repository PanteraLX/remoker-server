<?php
/**
 * StoryController.php
 */
namespace RemokerBundle\Controller;
use RemokerBundle\Document\Story;

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

    public function createStoryAction($parameters) {
        $story = new Story();
        $story->setName($parameters->name);

        return $story;
    }

    public function getStoryAction() {

    }
}
