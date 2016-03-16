<?php
/**
 * EstimationController.php
 */
namespace RemokerBundle\Controller;

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
    /**
     * @var UserController
     */
    private $userController;

    /**
     * @var StoryController
     */
    private $storyController;

    /**
     * EstimationController constructor
     */
    public function __construct() {
        parent::__construct();
        $this->userController = new UserController();
        $this->storyController = new StoryController();
    }

    /**
     * @param $parameters
     * @return Estimation
     */
    public function createEstimationAction($parameters)
    {
        $developer = $this->userController->getUserAction($parameters);

        $estimation = new Estimation();
        $estimation->setValue($parameters->value)->setDeveloper($developer);

        $this->storyController->addEstimation($estimation);

        $this->documentManager->persist($estimation);
        $this->documentManager->flush();

        return $estimation;
    }
}
