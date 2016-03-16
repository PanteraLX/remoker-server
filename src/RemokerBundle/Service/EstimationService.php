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
class EstimationService extends AbstractRemokerService
{
    /**
     * @var UserService
     */
    private $userService;

    /**
     * @var StoryService
     */
    private $storyService;

    /**
     * EstimationService constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->userService = new UserService();
        $this->storyService = new StoryService();
    }

    /**
     * @param $parameters
     * @return Estimation
     */
    public function createEstimation($parameters)
    {
        $developer = $this->userService->getUser($parameters);

        $estimation = new Estimation();
        $estimation->setDeveloper($developer)
            ->setValue($parameters->estimation->value)
            ->setCreatedAt();

        $task = $this->storyService->getStory($parameters);
        $task->addEstimation($estimation);

        $this->managerRegistry->getManager()->persist($estimation);
        $this->managerRegistry->getManager()->flush();

        return $estimation;
    }

    /**
     * @param $parameters
     * @return Estimation
     */
    public function getEstimation($parameters)
    {
        return $this->managerRegistry
            ->getRepository('RemokerBundle:Estimation')
            ->find($parameters->id);
    }
}
