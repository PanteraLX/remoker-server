<?php
/**
 * UserController.php
 */
namespace RemokerBundle\Controller;

use Exception;
use Gos\Bundle\WebSocketBundle\Router\WampRequest;
use Ratchet\Wamp\WampConnection;
use RemokerBundle\Service\UserService;

/**
 * Class UserController
 *
 * @package RemokerBundle\Controller
 * @author  Samuel Heinzmann <samuel.heinzman@swisscom.com>
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link    https://github.com/PanteraLX/remoker-server
 */
class UserController extends AbstractRemokerController
{
    /**
     * @var UserController
     */
    private $userService;

    /**
     * EstimationController constructor
     */
    public function __construct()
    {
        parent::__construct();
        $this->userService = new UserService();
    }

    /**
     * @param WampConnection $connection WampConnection
     * @param WampRequest    $request    WampRequest
     * @param string         $parameters RP-Call parameters as JSON string
     * @return string
     * @throws Exception
     */
    public function createUserAction(WampConnection $connection, WampRequest $request, $parameters)
    {
        var_dump($parameters);
        $parameters = json_decode($parameters[0]);
        if (!isset($parameters->user->name) || !isset($parameters->user->is_master)) {
            throw new Exception("Please set a valid user name");
        } else {
            $this->nameValidator->assert($parameters->user->name);
            $this->booleanValidator->assert($parameters->user->is_master);
        }
        $user = $this->userService->createUser($parameters);
        return $this->serializer->serialize($user, "json");
    }

    /**
     * @param WampConnection $connection WampConnection
     * @param WampRequest    $request    WampRequest
     * @param string         $parameters RP-Call parameters as JSON string
     * @return string
     * @throws Exception
     */
    public function getUserAction(WampConnection $connection, WampRequest $request, $parameters)
    {
        $parameters = json_decode($parameters[0]);
        if (!isset($parameters->user->id)) {
            throw new Exception("No UserId found!");
        }
        $user = $this->userService->getUser($parameters);
        return $this->serializer->serialize($user, "json");
    }

    /**
     * @return string
     */
    public function getName()
    {
        return "user.rpc";
    }
}
