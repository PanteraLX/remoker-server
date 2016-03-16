<?php
/**
 * EstimationService.php
 */
namespace RemokerBundle\Service;

use RemokerBundle\Document\Estimation;

/**
 * Class EstimationService
 *
 * @package RemokerBundle\Service
 * @author  Samuel Heinzmann <samuel.heinzman@swisscom.com>
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link    https://github.com/PanteraLX/remoker-server
 */
class EstimationService extends RemokerService
{
    /**
     * @param $parameters
     * @return Estimation
     */
    public function createEstimation($parameters)
    {
        $developer = $this->userService->getUser($parameters);

        $estimation = new Estimation();
        $estimation->setDeveloper($developer)
            ->setValue($parameters->estimation->value);

        $this->managerRegistry->getManager()->persist($estimation);
        $this->managerRegistry->getManager()->flush();

        return $estimation;
    }
}
