<?php
/**
 * RemokerController.php
 */
namespace RemokerBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Class RemokerController
 * @package RemokerBundle\Controller
 * @author  Samuel Heinzmann <samuel.heinzman@swisscom.com>
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link    https://github.com/PanteraLX/remoker-server
 */
class RemokerController extends Controller
{
    protected $documentManager;

    public function __construct() {
        $this->documentManager = $this->get('doctrine_mongodb')->getManager();
    }

}