<?php
/**
 * UserController.php
 */
namespace RemokerBundle\Controller;

use RemokerBundle\Document\User;

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
    public function createUserAction($parameters)
    {
        $user = new User();
        $user->setName($parameters->name)
            ->setIsMaster($parameters->isMaster);

        return $user;
    }

    public function getUserAction($parameters)
    {

    }
}
