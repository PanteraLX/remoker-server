<?php
/**
 * User.php
 */
namespace RemokerBundle\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;

/**
 * Class User
 *
 * @package RemokerBundle\Document
 * @author  Samuel Heinzmann <samuel.heinzman@swisscom.com>
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link    https://github.com/PanteraLX/remoker-server
 *
 * @MongoDB\Document
 */
class User
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
     * @var boolean
     *
     * @MongoDB\Boolean
     */
    private $isMaster;

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
     * @return User
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
     * @return User
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
     * @return User
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return boolean
     */
    public function isIsMaster()
    {
        return $this->isMaster;
    }

    /**
     * @param boolean $isMaster
     * @return User
     */
    public function setIsMaster($isMaster)
    {
        $this->isMaster = $isMaster;
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
     * @return User
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
        return $this;
    }
}
