<?php
/**
 * ControllerTestCase.php
 */
namespace RemokerBundle\Test\Controller;

use Gos\Bundle\WebSocketBundle\Router\WampRequest;
use Ratchet\Wamp\WampConnection;

/**
 * Class ControllerTestCase
 *
 * @package RemokerBundle\Test\Controller
 * @author  Samuel Heinzmann <samuel.heinzman@swisscom.com>
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link    https://github.com/PanteraLX/remoker-server
 */
class ControllerTestCase extends \PHPUnit_Framework_TestCase
{

    /**
     * @var \stdClass
     */
    protected $data;

    /**
     * @var WampConnection
     */
    protected $wampConnection;

    /**
     * @var WampRequest
     */
    protected $wampRequest;

    /**
     * SetUp for all Controller tests
     *
     * @return void
     */
    public function setUp()
    {
        $this->wampConnection = $this->getMockBuilder('Ratchet\Wamp\WampConnection')
            ->disableOriginalConstructor()
            ->getMock();

        $this->wampRequest = $this->getMockBuilder('Gos\Bundle\WebSocketBundle\Router\WampRequest')
            ->disableOriginalConstructor()
            ->getMock();

        $this->data = new \stdClass();
        $this->data->user = new \stdClass();
        $this->data->estimation = new \stdClass();
        $this->data->story = new \stdClass();
        $this->data->room = new \stdClass();
    }
}
