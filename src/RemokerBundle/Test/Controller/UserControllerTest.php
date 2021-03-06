<?php
/**
 * UserControllerTest.php
 */
namespace RemokerBundle\Test\Controller;

use RemokerBundle\Controller\UserController;
use RemokerBundle\Service\UserService;
use Respect\Validation\Exceptions\AlnumException;

/**
 * Class UserControllerTest
 * @package RemokerBundle\Test\Controller
 * @author  Samuel Heinzmann <samuel.heinzman@swisscom.com>
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link    https://github.com/PanteraLX/remoker-server
 */
class UserControllerTest extends ControllerTestCase
{
    /**
     * @var UserController
     */
    private $userController;

    /**
     * @var UserService
     */
    private $userService;

    /**
     * SetUp
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $this->userService = $this->getMockBuilder('RemokerBundle\Service\UserService')
            ->disableOriginalConstructor()
            ->getMock();

        $this->userController = new UserController();
        $this->userController->setUserService($this->userService);
    }

    /**
     * @dataProvider invalidNameProvider
     *
     * @param string $masterName Master name
     * @return void
     */
    public function testInvalidUsernameSet($masterName)
    {

        $this->data->user->name = $masterName;
        $this->data->user->is_master = true;
        $this->data = array(json_encode($this->data));
        try {
            $this->userController->createUserAction($this->wampConnection, $this->wampRequest, $this->data);
        } catch (\Exception $e) {
            $this->assertEquals("invalid_name", $e->getMessage());
        }
    }

    /**
     * invalidNameProvider
     *
     * @return array
     */
    public function invalidNameProvider()
    {
        return array(
            array('John Doe½'),
            array('john doe$'),
            array('J&ohn Doe'),
            array('John Doe John Doe John Doe John Doe'),
            array('',)
        );
    }

    /**
     * @return void
     * @throws \Exception
     */
    public function testNoUsernameSet()
    {
        $this->data = array(json_encode($this->data));
        try {
            $this->userController->createUserAction($this->wampConnection, $this->wampRequest, $this->data);
        } catch (\Exception $e) {
            $this->assertEquals("missing_username", $e->getMessage());
        }
    }


    /**
     * @dataProvider validNameProvider
     *
     * @param string $masterName Master name
     * @return void
     */
    public function testValidUsernameSet($masterName)
    {
        $this->userService->expects($this->once())
            ->method('createUser')
            ->will($this->returnValue($masterName));
        $this->userController->setUserService($this->userService);
        $this->data->user->name = $masterName;
        $this->data->user->is_master = true;
        $this->data = array(json_encode($this->data));
        $this->userController->createUserAction($this->wampConnection, $this->wampRequest, $this->data);
    }

    /**
     * validNameProvider
     *
     * @return array
     */
    public function validNameProvider()
    {
        return array(
            array('John Doe'),
            array('john doe'),
            array('John-John Doe',)
        );
    }

    /**
     * @dataProvider invalidIdProvider
     *
     * @param string $id id
     * @return void
     */
    public function testInvalidIdSet($id)
    {
        $this->data->user->id = $id;
        $this->data = array(json_encode($this->data));
        try {
            $this->userController->getUserAction($this->wampConnection, $this->wampRequest, $this->data);
        } catch (AlnumException $e) {
            $this->assertEquals("invalid_identifier", $e->getMessage());
        } catch (\Exception $e) {
            $this->assertEquals("missing_userid", $e->getMessage());
        }
    }

    /**
     * invalidIdProvider
     *
     * @return array
     */
    public function invalidIdProvider()
    {
        return array(
            array(null),
            array('abcd123'),
            array('ab123'),
            array('ab123?'),
        );
    }

    /**
     * @return void
     */
    public function testValidIdSet()
    {
        $this->userService->expects($this->once())
            ->method('getUser')
            ->will($this->returnValue('id'));
        $this->userController->setUserService($this->userService);
        $this->data->user->id = "acb123";
        $this->data = array(json_encode($this->data));
        $this->userController->getUserAction($this->wampConnection, $this->wampRequest, $this->data);
    }
}
