<?php
/**
 * User.php
 */
namespace RemokerBundle\Document;

/**
 * Class User
 *
 * @package RemokerBundle\Document
 * @author  Samuel Heinzmann <samuel.heinzman@swisscom.com>
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link    https://github.com/PanteraLX/remoker-server
 */
class User
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
     * @var boolean
     */
    private $isMaster;

    /**
     * @var \DateTime
     */
    private $createdAt;
}
