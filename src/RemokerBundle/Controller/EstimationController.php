<?php
/**
 * EstimationController.php
 */
namespace RemokerBundle\Controller;

use RemokerBundle\Document\User;
use RemokerBundle\Document\Estimation;

/**
 * Class EstimationController
 *
 * @package RemokerBundle\Controller
 * @author  Samuel Heinzmann <samuel.heinzman@swisscom.com>
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link    https://github.com/PanteraLX/remoker-server
 */
class EstimationController extends RemokerController
{

    public function createEstimationAction($parameters)
    {
        $developer = new User();
        $estimation = new Estimation();
        $estimation->setValue($parameters->value)->setDeveloper($developer);

        return $estimation;
    }

    public function getEstimationAction()
    {

    }
}
