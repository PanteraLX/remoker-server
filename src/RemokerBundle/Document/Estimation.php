<?php
/**
 * Estimation.php
 */
namespace RemokerBundle\Document;

/**
 * Class Estimation
 *
 * @package RemokerBundle\Document
 * @author  Samuel Heinzmann <samuel.heinzman@swisscom.com>
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link    https://github.com/PanteraLX/remoker-server
 */
class Estimation
{
    /**
     * @var string
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
}
