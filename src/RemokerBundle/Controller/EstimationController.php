<?php
/**
 * EstimationController.php
 */
namespace RemokerBundle\Controller;

use Exception;
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
     * @var UserController
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
     * @param $parameters
     * @return string
     * @throws Exception
     */
    public function createEstimationAction($parameters)
    {
        $parameters = json_decode($parameters);
        if (!isset($parameters->value)) {
            throw new Exception("Please set a value for this estimation");
        }

        $estimation = $this->estimationService->createEstimation($parameters);
        return $this->serializer->serialize($estimation, 'json');
    }

    /**
     * @param $parameters
     * @return string
     * @throws Exception
     */
    public function getEstimationAction($parameters)
    {
        $parameters = json_decode($parameters);
        if (!isset($parameters->id)) {
            throw new Exception("No EstimationId found");
        }
        $estimation = $this->estimationService->getEstimation($parameters);
        return $this->serializer->serialize($estimation, 'json');
    }

    /**
     * Name of RPC, use for PubSub router
     *
     * @return string
     */
    public function getName()
    {
        return 'estimation.rpc';
    }
}
