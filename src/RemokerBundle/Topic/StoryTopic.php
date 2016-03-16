<?php
/**
 * StoryTopic.php
 */
namespace RemokerBundle\Topic;

/**
 * Class StoryTopic
 *
 * @package RemokerBundle\Topic
 * @author  Samuel Heinzmann <samuel.heinzman@swisscom.com>
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link    https://github.com/PanteraLX/remoker-server
 */
class StoryTopic extends AbstractRemokerTopic
{
    /**
     * @return string
     */
    public function getName()
    {
        return "story.topic";
    }
}
