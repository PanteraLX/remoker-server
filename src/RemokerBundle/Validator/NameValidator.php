<?php
/**
 * NameValidator.php
 */
namespace RemokerBundle\Validator;

use Respect\Validation\Exceptions\AlnumException;
use Respect\Validation\Validator;

/**
 * Class NameValidator
 *
 * @package RemokerBundle\Validator
 * @author  Samuel Heinzmann <samuel.heinzman@swisscom.com>
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link    https://github.com/PanteraLX/remoker-server
 */
class NameValidator
{
    /**
     * Validation of Story, User and Room names.
     * Throws Alpha-Numerical exception if name is longer than 20 chars and contains invalid special chars.
     *
     * @param string  $name         Name to validate
     * @param integer $length       Length of the name
     * @param string  $specialChars Valid special chars in name
     * @throws AlnumException
     * @return string
     */
    public function validate($name, $length = 20, $specialChars = '\-')
    {
        $pattern = Validator::alnum($specialChars)->length(1, $length);
        if (!$pattern->validate($name)) {
            throw new AlnumException("invalid_name");
        }
        return $name;
    }
}
