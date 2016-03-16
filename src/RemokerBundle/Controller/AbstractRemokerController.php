<?php
/**
 * AbstractRemokerController.php
 */
namespace RemokerBundle\Controller;

use Gos\Bundle\WebSocketBundle\RPC\RpcInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Class AbstractRemokerController
 *
 * @package RemokerBundle\Controller
 * @author  Samuel Heinzmann <samuel.heinzman@swisscom.com>
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link    https://github.com/PanteraLX/remoker-server
 */
abstract class AbstractRemokerController extends Controller implements RpcInterface
{
}
