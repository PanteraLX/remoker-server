<?php
/**
 * IdGenerator.php
 */
namespace RemokerBundle\Generator;

/**
 * Class IdGenerator
 * @package RemokerBundle\Generator
 * @author  Samuel Heinzmann <samuel.heinzman@swisscom.com>
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link    https://github.com/PanteraLX/remoker-server
 */
class IdGenerator
{
    /**
     * Generates a random hash. Length is 6 chars
     *
     * @param int  $length      Desired length of the Id
     * @param bool $moreEntropy Add more Entropy to the uniqid
     * @return string
     */
    public static function generate($length = 6, $moreEntropy = true)
    {
        $prefix = mt_rand();
        $uniqId = uniqid($prefix, $moreEntropy);
        $hash = md5($uniqId);

        return substr($hash, $start = 0, $length);
    }
}
