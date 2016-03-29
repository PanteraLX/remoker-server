<?php
/**
 * AbstractRemokerService.php
 */
namespace RemokerBundle\Service;

/**
 * Class AbstractRemokerService
 *
 * @package RemokerBundle\Service
 * @author  Samuel Heinzmann <samuel.heinzman@swisscom.com>
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link    https://github.com/PanteraLX/remoker-server
 */
abstract class AbstractRemokerService
{
    /**
     * @var DoctrineService
     */
    protected $doctrineService;

    /**
     * AbstractRemokerService constructor.
     */
    public function __construct()
    {
        $this->doctrineService = new DoctrineService();
    }

    /**
     * @return DoctrineService
     */
    public function getDoctrineService()
    {
        return $this->doctrineService;
    }

    /**
     * @param DoctrineService $doctrineService Doctrine Service
     * @return AbstractRemokerService
     */
    public function setDoctrineService($doctrineService)
    {
        $this->doctrineService = $doctrineService;
        return $this;
    }
}
