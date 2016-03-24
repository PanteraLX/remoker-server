<?php
/**
 * UserControllerTest.php
 */
namespace RemokerBundle\Test\Controller;

use RemokerBundle\Controller\UserController;
use RemokerBundle\RemokerBundle;
use RemokerBundle\Test\Controller\Mock\UserControllerMock;

/**
 * Class UserControllerTest
 * @package RemokerBundle\Test\Controller
 * @author  Samuel Heinzmann <samuel.heinzman@swisscom.com>
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link    https://github.com/PanteraLX/remoker-server
 */
class UserControllerTest extends ControllerTestCase
{
    private $userController;

    /**
     * @dataProvider creationProvider
     *
     * @param $masterName
     * @param $sessionName
     * @return void
     * @throws \Exception
     */
    public function testCreateUserAction($masterName, $sessionName)
    {

        $this->userController = new UserController();

        $this->data->user->name = $masterName;
        $this->data->user->is_master = true;
        $this->data = array(json_encode($this->data));

        $result = $this->userController->createUserAction($this->wampConnection, $this->wampRequest, $this->data);

        $this->assertEquals(1, 1);
        var_dump($result);
    }

    /**
     * @return array
     */
    public function creationProvider()
    {
        return array(
            array('Samuel', false)
        );
    }
}
