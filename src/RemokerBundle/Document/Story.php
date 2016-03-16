<?php
/**
 * Story.php
 */
namespace RemokerBundle\Document;

/**
 * Class Story
 *
 * @package RemokerBundle\Document
 * @author  Samuel Heinzmann <samuel.heinzman@swisscom.com>
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link    https://github.com/PanteraLX/remoker-server
 */
class Story
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
     * @var integer
     */
    private $result;

    /**
     * @var Estimation[]
     */
    private $estimations;

    /**
     * @var \DateTime
     */
    private $createdAt;
}
