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
class UserController extends RemokerController
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
        $user= $this->userService->createUser($parameters);
        return $user;
    }

    /**
     * @param $parameters
     * @return void
     */
    public function getUserAction($parameters)
    {

    }
}
