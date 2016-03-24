<?php
/**
 * ControllerTestCase.php
 */
namespace RemokerBundle\Test\Controller;

/**
 * Trait ControllerTestCase
 *
 * @package RemokerBundle\Test\Controller
 * @author  Samuel Heinzmann <samuel.heinzman@swisscom.com>
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link    https://github.com/PanteraLX/remoker-server
 */
class ControllerTestCase extends \PHPUnit_Framework_TestCase
{
    protected $abstractRemokerController;

    protected $data;

    protected $documentManager;

    protected $wampConnection;

    protected $wampRequest;

    protected $managerRegistry;

    protected $doctrineService;

    public function setUp()
    {
        $this->doctrineService = $this->getMockBuilder('RemokerBundle\Service\DoctrineService')
//            ->disableOriginalConstructor()
            ->setMethods(array('persist'))
            ->getMock();
        $this->doctrineService->expects($this->once())
            ->method('persist');

//        $this->doctrineService->method('persist')->willReturn('foo');

//        $this->managerRegistry = $this->getMockBuilder('Doctrine\Bundle\MongoDBBundle\ManagerRegistry')
//            ->disableOriginalConstructor()
//            ->getMock();

//        $this->abstractRemokerController = $this->getMockForAbstractClass(
//            'RemokerBundle\Controller\AbstractRemokerController'
//        );

//        $this->abstractRemokerController = $this->getMockBuilder('RemokerBundle\Controller\AbstractRemokerController')
//            ->setMethods(array('persist'))
//            ->getMockForAbstractClass();
//        $this->abstractRemokerController->expects($this->once())
//            ->method('persist');

//        $this->remokerController->setManagerRegistry($this->managerRegistry);

//        $this->documentManager = $this->getMockBuilder('DocumentManager')
//            ->setMethods(array('persist', 'flush'))
//            ->disableOriginalConstructor()
//            ->getMock();
//        $this->documentManager->expects($this->once())
//            ->method('persist')
//            ->with($this->equalTo(null));
//        $this->documentManager->expects($this->once())
//            ->method('flush');

        $this->wampConnection = $this->getMockBuilder('Ratchet\Wamp\WampConnection')
            ->disableOriginalConstructor()
            ->getMock();

        $this->wampRequest = $this->getMockBuilder('Gos\Bundle\WebSocketBundle\Router\WampRequest')
            ->disableOriginalConstructor()
            ->getMock();

        $this->data = new \stdClass();
        $this->data->user = new \stdClass();
    }
}
