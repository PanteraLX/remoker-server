<?php
/**
 * EstimationController.php
 */
namespace RemokerBundle\Controller;

use RemokerBundle\Document\Estimation;
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
        $this->estimationService = new EstimationService();
    }

    /**
     * @param $parameters
     * @return Estimation
     */
    public function createEstimationAction($parameters)
    {
        $parameters = json_decode($parameters);
        return $this->estimationService->createEstimation($parameters);
    }

    /**
     * @param $parameters
     * @return Estimation
     */
    public function getEstimationAction($parameters)
    {
        $parameters = json_decode($parameters);
        return $this->estimationService->getEstimation($parameters);
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
