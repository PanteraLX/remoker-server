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
class EstimationService
{
    private $documentManager;

    public function createEstimation($parameters) {

        $developer = $this->userService->getUser($parameters);

        $estimation = new Estimation();
        $estimation->setDeveloper($developer)
            ->setValue($parameters->estimation->value);

        $this->documentManager->persist($estimation);
        $this->documentManager->flush();

        return $estimation;
    }


}
