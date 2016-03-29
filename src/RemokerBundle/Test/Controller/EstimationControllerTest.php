<?php
/**
 * EstimationControllerTest.php
 */
namespace RemokerBundle\Test\Controller;

use RemokerBundle\Controller\EstimationController;
use RemokerBundle\Service\EstimationService;
use Respect\Validation\Exceptions\AlnumException;

/**
 * Class EstimationControllerTest
 * @package RemokerBundle\Test\Controller
 * @author  Samuel Heinzmann <samuel.heinzman@swisscom.com>
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link    https://github.com/PanteraLX/remoker-server
 */
class EstimationControllerTest extends ControllerTestCase
{
    /**
     * @var EstimationController
     */
    private $estimationController;

    /**
     * @var EstimationService
     */
    private $estimationService;

    /**
     * SetUp
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $this->estimationService = $this->getMockBuilder('RemokerBundle\Service\EstimationService')
            ->disableOriginalConstructor()
            ->getMock();

        $this->estimationController = new EstimationController();
        $this->estimationController->setEstimationService($this->estimationService);
    }

    /**
     * @return void
     * @throws \Exception
     * @expectExceptionMessage missing_estimationname
     */
    public function testNoEstimationValueSet()
    {
        $this->data = array(json_encode($this->data));
        try {
            $this->estimationController->createEstimationAction($this->wampConnection, $this->wampRequest, $this->data);
        } catch (\Exception $e) {
            $this->assertEquals("missing_estimationvalue", $e->getMessage());
        }
    }


    /**
     * @dataProvider invalidValueProvider
     *
     * @param int $value Estimation value
     * @return void
     */
    public function testInvalidEstimationValueSet($value)
    {

        $this->data->estimation->value = $value;
        $this->data->estimation->is_master = true;
        $this->data = array(json_encode($this->data));
        try {
            $this->estimationController->createEstimationAction($this->wampConnection, $this->wampRequest, $this->data);
        } catch (\Exception $e) {
            $this->assertEquals('All of the required rules must pass for "'. $value .'"', $e->getMessage());
        }
    }

    /**
     * invalidValueProvider
     *
     * @return array
     */
    public function invalidValueProvider()
    {
        return array(
            array('John Doe'),
            array('0.1'),
            array('1/3'),
            array('1',),
            array('-1'),
        );
    }

    /**
     * @dataProvider validValueProvider
     *
     * @param int $value Estimation value
     * @return void
     */
    public function testValidEstimationValueSet($value)
    {
        $this->estimationService->expects($this->once())
            ->method('createEstimation')
            ->will($this->returnValue($value));
        $this->estimationController->setEstimationService($this->estimationService);

        $this->data->estimation->value = $value;
        $this->data->estimation->is_master = true;
        $this->data = array(json_encode($this->data));

        $this->estimationController->createEstimationAction($this->wampConnection, $this->wampRequest, $this->data);

    }

    /**
     * validValueProvider
     *
     * @return array
     */
    public function validValueProvider()
    {
        return array(
            array(100),
            array(1),
            array(2),
            array(1)
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
        $this->data->estimation->id = $id;
        $this->data = array(json_encode($this->data));
        try {
            $this->estimationController->getEstimationAction($this->wampConnection, $this->wampRequest, $this->data);
        } catch (AlnumException $e) {
            $this->assertEquals("invalid_identifier", $e->getMessage());
        } catch (\Exception $e) {
            $this->assertEquals("missing_estimationid", $e->getMessage());
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
        $this->estimationService->expects($this->once())
            ->method('getEstimation')
            ->will($this->returnValue('id'));
        $this->estimationController->setEstimationService($this->estimationService);
        $this->data->estimation->id = "acb123";
        $this->data = array(json_encode($this->data));
        $this->estimationController->getEstimationAction($this->wampConnection, $this->wampRequest, $this->data);
    }
}
