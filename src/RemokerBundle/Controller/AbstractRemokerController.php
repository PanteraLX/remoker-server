<?php
/**
 * AbstractRemokerController.php
 */
namespace RemokerBundle\Controller;

use Gos\Bundle\WebSocketBundle\RPC\RpcInterface;
use JMS\Serializer\Serializer;
use JMS\Serializer\SerializerBuilder;
use Respect\Validation\Validator;
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
     * @var Validator
     */
    protected $nameValidator;

    /**
     * @var Validator
     */
    protected $valueValidator;

    /**
     * @var Validator
     */
    protected $identifierValidator;

    /**
     * @var Validator
     */
    protected $booleanValidator;

    /**
     * AbstractRemokerController constructor.
     */
    public function __construct()
    {
        $this->serializer = SerializerBuilder::create()->build();
        $this->nameValidator = Validator::alnum()->length(1, 20);
        $this->valueValidator = Validator::intType();
        $this->identifierValidator = Validator::alnum()->length(6, 6);
        $this->booleanValidator = Validator::boolType();
    }
}
