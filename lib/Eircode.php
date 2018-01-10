<?php
/**
 * Eircode PHP Class.
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
 * Class Eircode.
 */
class Eircode
{
    const RxInString = '/(([AC-FHKNPRTV-Y]{1}[0-9]{1}[0-9W]{1})[ \-]?([0-9AC-FHKNPRTV-Y]{4}))/';
    public static $country = 'IE';
    public static $areas = ['A', 'C', 'D', 'E', 'F', 'H', 'K', 'N', 'P', 'R', 'T', 'V', 'W', 'X', 'Y'];
    public static $dbOutwardTable = 'eir_out_code';
    public static $dbAreaTable = 'eir_area_code';
    public $area;
    public $outward;
    public $postcode;
}
