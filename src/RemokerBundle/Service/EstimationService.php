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
     * Creates and persists a new Estimation object.
     *
     * In the new Estimation object is an reference to creating developer. This object itself will be referenced in the
     * corresponding Story object
     *
     * @param object $parameters RP-Call parameters as Object
     * @return Estimation
     */
    public function createEstimation($parameters)
    {
        $developer = $this->userService->getUser($parameters);

        $estimation = new Estimation();
        $estimation->setDeveloper($developer)
            ->setValue($parameters->estimation->value)
            ->setCreatedAt();

        $story = $this->storyService->getStory($parameters);
        $story->addEstimation($estimation);

        $this->doctrineService->persist($estimation);

        return $estimation;
    }

    /**
     * @param object $parameters RP-Call parameters as Object
     * @return Estimation
     */
    public function getEstimation($parameters)
    {
        return $this->doctrineService->find($parameters->estimation->short_id, "Estimation");
    }
}
