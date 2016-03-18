<?php
/**
 * AbstractRemokerController.php
 */
namespace RemokerBundle\Controller;

use Gos\Bundle\WebSocketBundle\RPC\RpcInterface;
use JMS\Serializer\Serializer;
use JMS\Serializer\SerializerBuilder;
use RemokerBundle\Validator\IdentifierValidator;
use RemokerBundle\Validator\NameValidator;
use RemokerBundle\Validator\SchemaValidator;
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
     * @var NameValidator
     */
    protected $nameValidator;

    /**
     * @var IdentifierValidator
     */
    protected $identifierValidator;

    /**
     * @var SchemaValidator
     */
    protected $schemaValidator;

    /**
     * @var Validator
     */
    protected $booleanValidator;

    /**
     * @var Validator
     */
    protected $valueValidator;

    /**
     * AbstractRemokerController constructor.
     */
    public function __construct()
    {
        $this->serializer = SerializerBuilder::create()->build();
        $this->nameValidator = new NameValidator();
        $this->identifierValidator = new IdentifierValidator();
        $this->schemaValidator = new SchemaValidator();
        $this->booleanValidator = Validator::boolType();
        $this->valueValidator = Validator::intType();
    }
}
