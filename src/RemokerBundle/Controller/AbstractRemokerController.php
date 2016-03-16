<?php
/**
 * AbstractRemokerController.php
 */
namespace RemokerBundle\Controller;

use Gos\Bundle\WebSocketBundle\RPC\RpcInterface;
use JMS\Serializer\Serializer;
use JMS\Serializer\SerializerBuilder;
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
    /**
     * @var Serializer
     */
    protected $serializer;

    /**
     * SessionController constructor.
     */
    public function __construct()
    {
        $this->serializer = SerializerBuilder::create()->build();
    }
}
