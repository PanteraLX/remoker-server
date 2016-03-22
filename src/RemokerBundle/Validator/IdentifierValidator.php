<?php
/**
 * IdentifierValidator.php
 */
namespace RemokerBundle\Validator;

use Respect\Validation\Exceptions\AlnumException;
use Respect\Validation\Validator;

/**
 * Class IdentifierValidator
 *
 * @package RemokerBundle\Validator
 * @author  Samuel Heinzmann <samuel.heinzman@swisscom.com>
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link    https://github.com/PanteraLX/remoker-server
 */
class IdentifierValidator
{
    /**
     * Throws Alpha-Numerical exception if Identifier is not valid
     *
     * @param string $id        Identifier to validate
     * @param int    $minLength Minimal length of the Identifier
     * @param int    $maxLength Maximal length of the Identifier
     * @throws AlnumException
     * @return string
     */
    public function validate($id, $minLength = 6, $maxLength = 6)
    {
        $pattern = Validator::alnum()->length($minLength, $maxLength);
        if (!$pattern->validate($id)) {
            throw new AlnumException("invalid_identifier");
        }
        return $id;
    }
}
