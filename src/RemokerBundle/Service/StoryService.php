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
class StoryService extends RemokerService
{
    /**
     * @param $parameters
     * @return Story
     */
    public function createStory($parameters)
    {
        $story = new Story();
        $story->setName($parameters->name);

        $this->managerRegistry->getManager()->persist($story);
        $this->managerRegistry->getManager()->flush();

        return $story;
    }
}
