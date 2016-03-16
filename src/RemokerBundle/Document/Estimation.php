<?php
/**
 * Estimation.php
 */
namespace RemokerBundle\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;

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
     *
     * @MongoDB\Id
     */
    private $id;

    /**
     * @var User
     */
    private $developer;

    /**
     * @var integer
     */
    private $value;

    /**
     * @var \DateTime
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
     * @return Estimation
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return User
     */
    public function getDeveloper()
    {
        return $this->developer;
    }

    /**
     * @param User $developer
     * @return Estimation
     */
    public function setDeveloper($developer)
    {
        $this->developer = $developer;
        return $this;
    }

    /**
     * @return int
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param int $value
     * @return Estimation
     */
    public function setValue($value)
    {
        $this->value = $value;
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
     * @return Estimation
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
        return $this;
    }
}
