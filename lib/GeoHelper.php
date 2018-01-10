<?php
/**
 * Postcode PHP Class.
 *
 * PHP Version 5
 *
 * @author   Richard Seymour <web@bespoke.support>
 * @license  MIT
 *
 * @link     https://github.com/BespokeSupport/Location
 */

namespace BespokeSupport\Location;

/**
 * Class GeoHelper
 */
class GeoHelper
{
    /**
     * @param $postcode
     *
     * @return string
     */
    public static function clean($postcode)
    {
        return preg_replace('/[^A-Z0-9]/', '', strtoupper($postcode));
    }
}
