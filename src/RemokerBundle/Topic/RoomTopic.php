<?php
/**
 * RoomTopic.php
 */
namespace RemokerBundle\Topic;

/**
 * Class RoomTopic
 *
 * @package RemokerBundle\Topic
 * @author  Samuel Heinzmann <samuel.heinzman@swisscom.com>
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link    https://github.com/PanteraLX/remoker-server
 */
class RoomTopic extends AbstractRemokerTopic
{
    /**
     * @return string
     */
    public function getName()
    {
        return "room.topic";
    }
}
