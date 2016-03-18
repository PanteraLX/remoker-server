<?php
/**
 * SchemaValidator.php
 */
namespace RemokerBundle\Validator;

/**
 * Class SchemaValidator
 * @package RemokerBundle\Validator
 * @author  Samuel Heinzmann <samuel.heinzman@swisscom.com>
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link    https://github.com/PanteraLX/remoker-server
 */
class SchemaValidator
{
    /**
     * Validates the schema. Returns 'Fibonacci' if an invalid schema is set
     *
     * @param string $schema Chosen estimation schema
     * @return string
     */
    public function validate($schema)
    {
        switch ($schema) {
            case 'shirt':
                return $schema;
            case 'cup':
                return $schema;
            default:
                return 'fibonacci';
        }
    }
}