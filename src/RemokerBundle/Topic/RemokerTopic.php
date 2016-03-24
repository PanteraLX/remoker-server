<?php
/**
 * RemokerTopic.php
 */
namespace RemokerBundle\Topic;

use Gos\Bundle\WebSocketBundle\Router\WampRequest;
use Gos\Bundle\WebSocketBundle\Topic\TopicInterface;
use Ratchet\ConnectionInterface;
use Ratchet\Wamp\Topic;

/**
 * Class RemokerTopic
 * @package RemokerBundle\Topic
 * @author  Samuel Heinzmann <samuel.heinzman@swisscom.com>
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link    https://github.com/PanteraLX/remoker-server
 */
class RemokerTopic implements TopicInterface
{
    /**
     * This will receive any Subscription requests for this topic.
     *
     * @param ConnectionInterface $connection Connection Interface
     * @param Topic               $topic      Topic
     * @param WampRequest         $request    WAMP Request
     *
     * @return void
     */
    public function onSubscribe(ConnectionInterface $connection, Topic $topic, WampRequest $request)
    {
        //  this will broadcast the message to all subscribers of this topic.
        $topic->broadcast(["msg" => $connection->resourceId . " has joined " . $topic->getId()]);
    }

    /**
     * This will receive any UnSubscription requests for this topic.
     *
     * @param ConnectionInterface $connection Connection Interface
     * @param Topic               $topic      Topic
     * @param WampRequest         $request    WAMP Request
     *
     * @return void
     */
    public function onUnSubscribe(ConnectionInterface $connection, Topic $topic, WampRequest $request)
    {
        //this will broadcast the message to all subscribers of this topic.
        $topic->broadcast(["msg" => $connection->resourceId . " has left " . $topic->getId()]);
    }


    /**
     * This will receive any Publish requests for this topic.
     *
     * @param ConnectionInterface $connection Connection Interface
     * @param Topic               $topic      Topic
     * @param WampRequest         $request    WAMP Request
     * @param string              $event      Event
     * @param array               $exclude    Array of excludes
     * @param array               $eligible   Array of eligibles
     *
     * @return mixed|void
     */
    public function onPublish(
        ConnectionInterface $connection,
        Topic $topic,
        WampRequest $request,
        $event,
        array $exclude,
        array $eligible
    ) {
        //this will broadcast the event to all subscribers of this topic.
        $topic->broadcast($event);
    }

    /**
     * Registers this topic at the WAMP router (config/routing.yml)
     *
     * @return string
     */
    public function getName()
    {
        return "remoker.topic";
    }
}
