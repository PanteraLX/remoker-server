<?php
/**
 * Room.php
 */
namespace RemokerBundle\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;

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
     *
     * @MongoDB\Id
     */
    private $id;

    /**
     * @var string
     *
     * @MongoDB\String
     */
    private $shortId;

    /**
     * @var string
     *
     * @MongoDB\String
     */
    private $name;

    /**
     * @var string
     *
     * @MongoDB\String
     */
    private $schema;

    /**
     * @var User
     *
     * @MongoDB\String
     */
    private $master;

    /**
     * @var Story[]
     *
     * @MongoDB\String
     */
    private $stories;

    /**
     * @var \DateTime
     *
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
     * @param string $id
     * @return Room
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getShortId()
    {
        return $this->shortId;
    }

    /**
     * @param string $shortId
     * @return Room
     */
    public function setShortId($shortId)
    {
        $this->shortId = $shortId;
        return $this;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return Room
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getSchema()
    {
        return $this->schema;
    }

    /**
     * @param string $schema
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
     * @param User $master
     * @return Room
     */
    public function setMaster($master)
    {
        $this->master = $master;
        return $this;
    }

    /**
     * @return Story[]
     */
    public function getStories()
    {
        return $this->stories;
    }

    /**
     * @param Story[] $stories
     * @return Room
     */
    public function setStories($stories)
    {
        $this->stories = $stories;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @param \DateTime $createdAt
     * @return Room
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
        return $this;
    }
}
