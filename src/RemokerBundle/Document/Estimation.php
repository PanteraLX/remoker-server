<?php
/**
 * Estimation.php
 */
namespace RemokerBundle\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;
use RemokerBundle\Generator\IdGenerator;

/**
 * Class Estimation
 *
 * @package RemokerBundle\Document
 * @author  Samuel Heinzmann <samuel.heinzman@swisscom.com>
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link    https://github.com/PanteraLX/remoker-server
 *
 * @MongoDB\Document
 */
class Estimation
{
    /**
     * @var string
     * @MongoDB\Id(strategy="NONE")
     */
    private $id;

    /**
     * @var User
     * @MongoDB\ReferenceOne(targetDocument="RemokerBundle\Document\User")
     */
    private $developer;

    /**
     * @var integer
     * @MongoDB\Integer
     */
    private $value;

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
     * @return Estimation
     */
    public function setId()
    {
        $this->id = IdGenerator::generate();
        return $this;
    }

    /**
     * @param User $developer User Object
     * @return Estimation
     */
    public function setDeveloper(User $developer)
    {
        $this->developer = $developer;
        return $this;
    }

    /**
     * @param integer $value Estimation value
     * @return Estimation
     */
    public function setValue($value)
    {
        $this->value = $value;
        return $this;
    }

    /**
     * @return Estimation
     */
    public function setCreatedAt()
    {
        $this->createdAt = new \MongoDate();
        return $this;
    }
}
