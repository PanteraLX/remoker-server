<?php
/**
 * RoomControllerTest.php
 */
namespace RemokerBundle\Test\Controller;

use RemokerBundle\Controller\RoomController;
use RemokerBundle\Service\RoomService;
use Respect\Validation\Exceptions\AlnumException;

/**
 * Class RoomControllerTest
 * @package RemokerBundle\Test\Controller
 * @author  Samuel Heinzmann <samuel.heinzman@swisscom.com>
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link    https://github.com/PanteraLX/remoker-server
 */
class RoomControllerTest extends ControllerTestCase
{
    /**
     * @var RoomController
     */
    private $roomController;

    /**
     * @var RoomService
     */
    private $roomService;

    /**
     * SetUp
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $this->roomService = $this->getMockBuilder('RemokerBundle\Service\RoomService')
            ->disableOriginalConstructor()
            ->getMock();

        $this->roomController = new RoomController();
        $this->roomController->setRoomService($this->roomService);
    }

    /**
     * @return void
     * @throws \Exception
     */
    public function testNoRoomnameSet()
    {
        $this->data = array(json_encode($this->data));
        try {
            $this->roomController->createRoomAction($this->wampConnection, $this->wampRequest, $this->data);
        } catch (\Exception $e) {
            $this->assertEquals("missing_roomname", $e->getMessage());
        }
    }

    /**
     * @return void
     * @throws \Exception
     */
    public function testNoSchemaSet()
    {
        $this->data->room->name = 'test';
        $this->data = array(json_encode($this->data));
        try {
            $this->roomController->createRoomAction($this->wampConnection, $this->wampRequest, $this->data);
        } catch (\Exception $e) {
            $this->assertEquals("missing_schema", $e->getMessage());
        }
    }

    /**
     * @dataProvider invalidNameProvider
     *
     * @param string $roomName Room name
     * @param string $schema   Schema
     * @return void
     */
    public function testInvalidRoomnameSet($roomName, $schema)
    {

        $this->data->room->name = $roomName;
        $this->data->room->schema = $schema;
        $this->data = array(json_encode($this->data));
        try {
            $this->roomController->createRoomAction($this->wampConnection, $this->wampRequest, $this->data);
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
            array('Room1', 'fibonacci'),
            array('Room$', 'shirt'),
            array('Room Room Room Room Room Room', 'cup'),
            array('', 'fibonacci')
        );
    }

    /**
     * @dataProvider validNameProvider
     *
     * @param string $roomName Room name
     * @param string $schema   Schema
     * @return void
     */
    public function testValidRoomnameSet($roomName, $schema)
    {
        $this->roomService->expects($this->once())
            ->method('createRoom')
            ->will($this->returnValue($roomName));
        $this->roomController->setRoomService($this->roomService);
        $this->data->room->name = $roomName;
        $this->data->room->schema = $schema;
        $this->data = array(json_encode($this->data));
        $this->roomController->createRoomAction($this->wampConnection, $this->wampRequest, $this->data);
    }

    /**
     * validNameProvider
     *
     * @return array
     */
    public function validNameProvider()
    {
        return array(
            array('Room', 'fibonacci'),
            array('Room-1234', 'cup'),
            array('Room\123', 'test')
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
        $this->data->room->id = $id;
        $this->data = array(json_encode($this->data));
        try {
            $this->roomController->getRoomAction($this->wampConnection, $this->wampRequest, $this->data);
        } catch (AlnumException $e) {
            $this->assertEquals("invalid_identifier", $e->getMessage());
        } catch (\Exception $e) {
            $this->assertEquals("missing_roomid", $e->getMessage());
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
        $this->roomService->expects($this->once())
            ->method('getRoom')
            ->will($this->returnValue('id'));
        $this->roomController->setRoomService($this->roomService);
        $this->data->room->id = "acb123";
        $this->data = array(json_encode($this->data));
        $this->roomController->getRoomAction($this->wampConnection, $this->wampRequest, $this->data);
    }
}
