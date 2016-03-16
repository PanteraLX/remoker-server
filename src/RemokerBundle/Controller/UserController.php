<?php
/**
 * UserController.php
 */
namespace RemokerBundle\Controller;

use Exception;
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
     * @param $parameters
     * @return string
     * @throws Exception
     */
    public function createUserAction($parameters)
    {
        $parameters = json_decode($parameters);
        if (!isset($parameters->name) && isset($parameters->is_master)) {
            throw new Exception("Please set a valid user name");
        }
        $user = $this->userService->createUser($parameters);
        return $this->serializer->serialize($user, 'json');
    }

    /**
     * @param $parameters
     * @return string
     * @throws Exception
     */
    public function getUserAction($parameters)
    {
        $parameters = json_decode($parameters);
        if (!isset($parameters->id)) {
            throw new Exception("No UserId found!");
        }
        $user = $this->userService->getUser($parameters);
        return $this->serializer->serialize($user, 'json');    }

    /**
     * Name of RPC, use for PubSub router
     *
     * @return string
     */
    public function getName()
    {
        return 'user.rpc';
    }
}
