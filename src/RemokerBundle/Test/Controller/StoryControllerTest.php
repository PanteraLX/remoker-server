<?php
/**
 * StoryControllerTest.php
 */
namespace RemokerBundle\Test\Controller;

use RemokerBundle\Controller\StoryController;
use RemokerBundle\Service\StoryService;
use Respect\Validation\Exceptions\AlnumException;

/**
 * Class StoryControllerTest
 * @package RemokerBundle\Test\Controller
 * @author  Samuel Heinzmann <samuel.heinzman@swisscom.com>
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link    https://github.com/PanteraLX/remoker-server
 */
class StoryControllerTest extends ControllerTestCase
{
    /**
     * @var StoryController
     */
    private $storyController;

    /**
     * @var StoryService
     */
    private $storyService;

    /**
     * SetUp
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $this->storyService = $this->getMockBuilder('RemokerBundle\Service\StoryService')
            ->disableOriginalConstructor()
            ->getMock();

        $this->storyController = new StoryController();
        $this->storyController->setStoryService($this->storyService);
    }

    /**
     * @dataProvider invalidNameProvider
     *
     * @param string $storyName Story name
     * @return void
     */
    public function testInvalidStorynameSet($storyName)
    {

        $this->data->story->name = $storyName;
        $this->data = array(json_encode($this->data));
        try {
            $this->storyController->createStoryAction($this->wampConnection, $this->wampRequest, $this->data);
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
            array('Story½'),
            array('Story$'),
            array('Story Story Story Story Story Story'),
        );
    }

    /**
     * @return void
     * @throws \Exception
     */
    public function testNoStorynameSet()
    {
        $this->data = array(json_encode($this->data));
        try {
            $this->storyController->createStoryAction($this->wampConnection, $this->wampRequest, $this->data);
        } catch (\Exception $e) {
            $this->assertEquals("missing_storyname", $e->getMessage());
        }
    }


    /**
     * @dataProvider validNameProvider
     *
     * @param string $storyName Story name
     * @return void
     */
    public function testValidStorynameSet($storyName)
    {
        $this->storyService->expects($this->once())
            ->method('createStory')
            ->will($this->returnValue($storyName));
        $this->storyController->setStoryService($this->storyService);
        $this->data->story->name = $storyName;
        $this->data = array(json_encode($this->data));
        $this->storyController->createStoryAction($this->wampConnection, $this->wampRequest, $this->data);
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
            array('John-John Doe')
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
        $this->data->story->id = $id;
        $this->data = array(json_encode($this->data));
        try {
            $this->storyController->getStoryAction($this->wampConnection, $this->wampRequest, $this->data);
        } catch (AlnumException $e) {
            $this->assertEquals("invalid_identifier", $e->getMessage());
        } catch (\Exception $e) {
            $this->assertEquals("missing_storyid", $e->getMessage());
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
        $this->storyService->expects($this->once())
            ->method('getStory')
            ->will($this->returnValue('id'));
        $this->storyController->setStoryService($this->storyService);
        $this->data->story->id = "acb123";
        $this->data = array(json_encode($this->data));
        $this->storyController->getStoryAction($this->wampConnection, $this->wampRequest, $this->data);
    }
}
