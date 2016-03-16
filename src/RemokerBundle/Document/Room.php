<?php
/**
 * Room.php
 */
namespace RemokerBundle\Document;

/**
 * Class Room
 * @package RemokerBundle\Document
 * @author  Samuel Heinzmann <samuel.heinzman@swisscom.com>
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link    https://github.com/PanteraLX/remoker-server
 */
class Room
{
    /**
     * @var string
     */
    private $id;

    /**
     * @var string
     */
    private $shortId;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $schema;

    /**
     * @var User
     */
    private $master;

    /**
     * @var Story[]
     */
    private $stories;

    /**
     * @var \DateTime
     */
    private $createdAt;
}
