<?php
/**
 * Room.php
 */
namespace RemokerBundle\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;
use RemokerBundle\Generator\IdGenerator;

/**
 * Class Room
 * @package RemokerBundle\Document
 * @author  Samuel Heinzmann <samuel.heinzman@swisscom.com>
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link    https://github.com/PanteraLX/remoker-server
 *
 * @MongoDB\Document
 */
class Room
{
    /**
     * @var string
     * @MongoDB\Id(strategy="NONE")
     */
    private $id;

    /**
     * @var string
     * @MongoDB\String
     */
    private $name;

    /**
     * @var string
     * @MongoDB\String
     */
    private $schema;

    /**
     * @var User
     * @MongoDB\ReferenceOne(targetDocument="RemokerBundle\Document\User")
     */
    private $master;

    /**
     * @var Story[]
     * @MongoDB\ReferenceMany(targetDocument="RemokerBundle\Document\Story")
     */
    private $stories = array();

    /**
     * @var User[]
     * @MongoDB\ReferenceMany(targetDocument="RemokerBundle\Document\User")
     */
    private $developers = array();

    /**
     * @var \MongoDate
     * @MongoDB\Date
     */
    private $createdAt;

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return Room
     */
    public function setId()
    {
        $this->id = IdGenerator::generate();
        return $this;
    }

    /**
     * @param string $name Name of the room
     * @return Room
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @param string $schema Estimation Schema
     * @return Room
     */
    public function setSchema($schema)
    {
        $this->schema = $schema;
        return $this;
    }

    /**
     * @return User
     */
    public function getMaster()
    {
        return $this->master;
    }

    /**
     * @param User $master Scrum-Master of the Room
     * @return Room
     */
    public function setMaster(User $master)
    {
        $this->master = $master;
        return $this;
    }

    /**
     * @param Story[] $stories Array of Story objects
     * @return Room
     */
    public function setStories($stories)
    {
        $this->stories = $stories;
        return $this;
    }

    /**
     * @param Story $story Story object
     * @return Room
     */
    public function addStory(Story $story)
    {
        $this->stories[] = $story;
        return $this;
    }

    /**
     * @param User[] $developers Array of User objects
     * @return Room
     */
    public function setDevelopers($developers)
    {
        $this->developers = $developers;
        return $this;
    }

    /**
     * @param User $developer User object
     * @return Room
     */
    public function addDeveloper(User $developer)
    {
        $this->developers[] = $developer;
        return $this;
    }

    /**
     * @return Room
     */
    public function setCreatedAt()
    {
        $this->createdAt = new \MongoDate();
        return $this;
    }
}
