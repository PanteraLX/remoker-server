<?php
/**
 * Story.php
 */
namespace RemokerBundle\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;

/**
 * Class Story
 *
 * @package RemokerBundle\Document
 * @author  Samuel Heinzmann <samuel.heinzman@swisscom.com>
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link    https://github.com/PanteraLX/remoker-server
 *
 * @MongoDB\Document
 */
class Story
{
    /**
     * @var string
     * @MongoDB\Id
     */
    private $id;

    /**
     * @var string
     * @MongoDB\String
     */
    private $shortId;

    /**
     * @var string
     * @MongoDB\String
     */
    private $name;

    /**
     * @var integer
     * @MongoDB\Integer
     */
    private $result;

    /**
     * @var Estimation[]
     * @MongoDB\ReferenceMany(targetDocument="RemokerBundle\Document\Estimation")
     */
    private $estimations = array();

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
     * @return Story
     */
    public function setShortId()
    {
        $this->shortId = substr(md5(uniqid(mt_rand(), true)), 0, 6);
        return $this;
    }

    /**
     * @param string $name Name of the Story
     * @return Story
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @param int $result Median integer of all Estimations in this story
     * @return Story
     */
    public function setResult($result)
    {
        $this->result = $result;
        return $this;
    }

    /**
     * @param Estimation[] $estimations Array of Estimation objects
     * @return Story
     */
    public function setEstimations($estimations)
    {
        $this->estimations = $estimations;
        return $this;
    }

    /**
     * @param Estimation $estimation Estimation object
     * @return Story
     */
    public function addEstimation(Estimation $estimation)
    {
        $this->estimations[] = $estimation;
        return $this;
    }

    /**
     * @return Story
     */
    public function setCreatedAt()
    {
        $this->createdAt = new \MongoDate();
        return $this;
    }
}
