<?php
/**
 * User.php
 */
namespace RemokerBundle\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;
use RemokerBundle\Generator\IdGenerator;

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
     * @MongoDB\Id(strategy="NONE")
     */
    private $id;

    /**
     * @var string
     * @MongoDB\String
     */
    private $name;

    /**
     * @var boolean
     * @MongoDB\Boolean
     */
    private $isMaster;

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
     * @return bool
     */
    public function isMaster()
    {
        return $this->isMaster;
    }

    /**
     * @return User
     */
    public function setId()
    {
        $this->id = IdGenerator::generate();
        return $this;
    }

    /**
     * @param string $name Name of the user
     * @return User
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @param boolean $isMaster Boolean
     * @return User
     */
    public function setIsMaster($isMaster)
    {
        $this->isMaster = $isMaster;
        return $this;
    }

    /**
     * @return User
     */
    public function setCreatedAt()
    {
        $this->createdAt = new \MongoDate();
        return $this;
    }
}
