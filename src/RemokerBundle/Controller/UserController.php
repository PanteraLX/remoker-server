<?php
/**
 * UserController.php
 */
namespace RemokerBundle\Controller;

use RemokerBundle\Document\User;
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
        $this->userService = new UserService();
    }

    /**
     * @param $parameters
     * @return User
     */
    public function createUserAction($parameters)
    {
        $parameters = json_decode($parameters);
        return $this->userService->createUser($parameters);
    }

    /**
     * @param $parameters
     * @return mixed|User
     */
    public function getUserAction($parameters)
    {
        $parameters = json_decode($parameters);
        return $this->userService->getUser($parameters);
    }

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
