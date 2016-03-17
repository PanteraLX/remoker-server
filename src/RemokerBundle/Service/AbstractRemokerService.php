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
class AbstractRemokerService
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
}
