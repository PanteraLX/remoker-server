<?php
/**
 * EstimationController.php
 */
namespace RemokerBundle\Controller;

use Exception;
use Gos\Bundle\WebSocketBundle\Router\WampRequest;
use Ratchet\Wamp\WampConnection;
use RemokerBundle\Service\EstimationService;

/**
 * Class EstimationController
 *
 * @package RemokerBundle\Controller
 * @author  Samuel Heinzmann <samuel.heinzman@swisscom.com>
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link    https://github.com/PanteraLX/remoker-server
 */
class EstimationController extends AbstractRemokerController
{
    /**
     * @var EstimationService
     */
    private $estimationService;

    /**
     * EstimationController constructor
     */
    public function __construct()
    {
        parent::__construct();
        $this->estimationService = new EstimationService();
    }

    /**
     * @param WampConnection $connection WampConnection
     * @param WampRequest    $request    WampRequest
     * @param string         $parameters RP-Call parameters as JSON string
     * @return string
     * @throws Exception
     */
    public function createEstimationAction(WampConnection $connection, WampRequest $request, $parameters)
    {
        $parameters = json_decode($parameters[0]);
        if (!isset($parameters->estimation->value)) {
            throw new Exception("missing_estimationvalue");
        } else {
            $this->valueValidator->assert($parameters->estimation->value);
        }
        $estimation = $this->estimationService->createEstimation($parameters);
        return $this->serializer->serialize($estimation, "json");
    }

    /**
     * @param WampConnection $connection WampConnection
     * @param WampRequest    $request    WampRequest
     * @param string         $parameters RP-Call parameters as JSON string
     * @return string
     * @throws Exception
     */
    public function getEstimationAction(WampConnection $connection, WampRequest $request, $parameters)
    {
        $parameters = json_decode($parameters[0]);
        if (!isset($parameters->estimation->id)) {
            throw new Exception("missing_estimationid");
        } else {
            $this->identifierValidator->validate($parameters->estimation->id);
        }
        $estimation = $this->estimationService->getEstimation($parameters);
        return $this->serializer->serialize($estimation, "json");
    }

    /**
     * @param EstimationService $estimationService Estimation service
     * @return EstimationController
     */
    public function setEstimationService($estimationService)
    {
        $this->estimationService = $estimationService;
        return $this;
    }

    /**
     * Registers this controller as a RPC callback at the WAMP router (config/routing.yml)
     *
     * @return string
     */
    public function getName()
    {
        return "estimation.rpc";
    }
}
