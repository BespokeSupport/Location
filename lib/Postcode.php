<?php
/**
 * Postcode PHP Class
 *
 * PHP Version 5
 *
 * @author   Richard Seymour <web@bespoke.support>
 * @license  MIT
 * @link     https://github.com/BespokeSupport/Location
 */

namespace BespokeSupport\Location;

use BespokeSupport\DatabaseWrapper\DatabaseWrapperInterface;

/**
 * Class Postcode
 * @package BespokeSupport\Location
 */
class Postcode
{
    const ACCURACY_POSTCODE = 'postcode';
    const ACCURACY_OUTWARD = 'outward';
    const ACCURACY_AREA = 'area';

    // Regular Expression for Postcode Area
    CONST RxArea = '([BEGLMNSW]|[A-PR-UWYZ][A-HK-Y])';
    //
    CONST RxOutward = '([BEGLMNSW]|[A-PR-UWYZ][A-HK-Y])([0-9][A-Z]|[0-9]|[0-9][0-9])';
    //
    CONST RxInward = '([0-9][ABD-HJLN-UW-Z]{2})';
    //
    CONST RxComplete = '/(^[A-Z]{1,2}$)|(^([A-Z]{1,2})\d{1,2}[A-Z]?$)|(^(([A-Z]{1,2})\d{1,2}[A-Z]?)\s*([0-9][A-Z][A-Z])$)/';
    CONST RxInString = '/(([A-Z]{1,2})\d{1,2}[A-Z]?)\s*([0-9][A-Z][A-Z])/';
    //
    /**
     * @var array
     */
    public static $postcodeAreas = array('AB', 'AL', 'B', 'BA', 'BB', 'BD', 'BH', 'BL', 'BN', 'BR', 'BS', 'BT', 'BX', 'CA', 'CB', 'CF', 'CH', 'CM', 'CO', 'CR', 'CT', 'CV', 'CW', 'DA', 'DD', 'DE', 'DG', 'DH', 'DL', 'DN', 'DT', 'DY', 'E', 'EC', 'EH', 'EN', 'EX', 'FK', 'FY', 'G', 'GL', 'GU', 'GY', 'HA', 'HD', 'HG', 'HP', 'HR', 'HS', 'HU', 'HX', 'IG', 'IM', 'IP', 'IV', 'JE', 'KA', 'KT', 'KW', 'KY', 'L', 'LA', 'LD', 'LE', 'LL', 'LN', 'LS', 'LU', 'M', 'ME', 'MK', 'ML', 'N', 'NE', 'NG', 'NN', 'NP', 'NR', 'NW', 'OL', 'OX', 'PA', 'PE', 'PH', 'PL', 'PO', 'PR', 'RG', 'RH', 'RM', 'S', 'SA', 'SE', 'SG', 'SK', 'SL', 'SM', 'SN', 'SO', 'SP', 'SR', 'SS', 'ST', 'SW', 'SY', 'TA', 'TD', 'TF', 'TN', 'TQ', 'TR', 'TS', 'TW', 'UB', 'W', 'WA', 'WC', 'WD', 'WF', 'WN', 'WR', 'WS', 'WV', 'YO', 'ZE');
    /**
     * @var DatabaseWrapperInterface|null
     */
    protected $database;
    /**
     * @var float
     */
    protected $latitude;
    /**
     * @var float
     */
    protected $longitude;
    /**
     * @var string
     */
    protected $postcode;
    /**
     * @var string
     */
    protected $postcodeArea;
    /**
     * @var string
     */
    protected $postcodeInward;
    /**
     * @var string
     */
    protected $postcodeOutward;
    /**
     * @var string
     */
    protected $schemaColumnArea = 'postcode_area';
    /**
     * @var string
     */
    protected $schemaColumnOutward = 'postcode_outward';
    /**
     * @var string
     */
    protected $schemaColumnPostcode = 'postcode';
    /**
     * @var string
     */
    protected $schemaTableArea = 'postcode_areas';
    /**
     * @var string
     */
    protected $schemaTableOutward = 'postcode_outwards';
    /**
     * @var string
     */
    protected $schemaTablePostcode = 'postcodes';
    /**
     * @var string
     */
    protected $town;
    /**
     * @param null $postcode
     * @param DatabaseWrapperInterface|null $database
     */
    public function __construct($postcode = null, DatabaseWrapperInterface $database = null)
    {
        $this->database = $database;

        if ($postcode) {
            $this->validatePostcode($postcode);
            $this->validateViaDatabase();
        }
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->getPostcodeFormatted();
    }

    /**
     * @return null|string
     */
    public function getAccuracy()
    {
        switch (true) {

            case $this->getPostcode():
               return self::ACCURACY_POSTCODE;
                break;

            case $this->getPostcodeOutward():
                return self::ACCURACY_OUTWARD;
                break;

            case $this->getPostcodeArea():
                return self::ACCURACY_AREA;
                break;

            default:
                return null;
        }
    }

    /**
     * @return null|string
     */
    public function getBestAccuracy()
    {
        if ($this->postcode) return $this->postcode;
        if ($this->postcodeOutward) return $this->postcodeOutward;
        if ($this->postcodeArea) return $this->postcodeArea;
        return null;
    }

    /**
     * @return float|null
     */
    public function getLatitude()
    {
        return $this->latitude;
    }
    /**
     * @param float|null $latitude
     * @return $this
     */
    public function setLatitude($latitude)
    {
        $this->latitude = $latitude;
        return $this;
    }
    /**
     * @return float|null
     */
    public function getLongitude()
    {
        return $this->longitude;
    }
    /**
     * @param float|null $longitude
     * @return $this
     */
    public function setLongitude($longitude)
    {
        $this->longitude = $longitude;
        return $this;
    }
    /**
     * @return string|null
     */
    public function getPostcode()
    {
        return $this->postcode;
    }
    /**
     * @param string|null $postcode
     * @return $this
     */
    public function setPostcode($postcode)
    {
        $this->postcode = $postcode;
        return $this;
    }
    /**
     * @return string|null
     */
    public function getPostcodeArea()
    {
        return $this->postcodeArea;
    }
    /**
     * @param string|null $area
     * @return $this
     */
    public function setPostcodeArea($area)
    {
        $area = strtoupper(trim($area));

        if (preg_match('/^'.self::RxArea.'$/', $area)) {
            $this->postcodeArea = $area;
        } else {
            $this->postcodeArea = null;
        }

        return $this;
    }
    /**
     * @return array
     */
    public function getPostcodeAreas()
    {
        return self::$postcodeAreas;
    }
    /**
     * @return null|string
     */
    public function getPostcodeFormatted()
    {
        $postcodeInward = $this->getPostcodeInward();
        $postcodeOutward = $this->getPostcodeOutward();

        if (!$postcodeInward || !$postcodeOutward) {
            return null;
        }

        return $postcodeOutward . ' ' . $postcodeInward;
    }
    /**
     * @return string|null
     */
    public function getPostcodeInward()
    {
        return $this->postcodeInward;
    }
    /**
     * @param string|null $part
     * @return $this
     */
    public function setPostcodeInward($part)
    {
        $part = strtoupper(trim($part));

        if (preg_match('/^'.self::RxInward.'$/', $part)) {
            $this->postcodeInward = $part;
        } else {
            $this->postcodeInward = null;
        }

        return $this;
    }
    /**
     * @return string|null
     */
    public function getPostcodeOutward()
    {
        return $this->postcodeOutward;
    }
    /**
     * @param string|null $part
     * @return $this
     */
    public function setPostcodeOutward($part)
    {
        $part = strtoupper(trim($part));

        if (preg_match('/^'.self::RxOutward.'$/', $part)) {
            $this->postcodeOutward = $part;
        } else {
            $this->postcodeOutward = null;
        }

        return $this;
    }
    /**
     * @return null|string
     */
    public function getTown()
    {
        return $this->town;
    }
    /**
     * @param null|string $town
     * @return $this
     */
    public function setTown($town)
    {
        $this->town = $town;
        return $this;
    }
    /**
     * @param $postcode
     * @return string|null
     */
    public function validatePostcode($postcode)
    {
        if (!is_string($postcode)) {
            return null;
        }

        if ($postcode) {
            $postcode = preg_replace('/[^A-Z0-9]/', '', strtoupper($postcode));
        }

        // add in space
        if (strlen($postcode) >= 5) {
            $postcode = preg_replace('/([0-9][A-Z][A-Z])$/is', " $1", $postcode, 1);
        }

        // Aware that this is not the official RegExp as the setters define whether the part is valid
        $regularExpression = self::RxComplete;

        $matches = array();
        preg_match($regularExpression, $postcode, $matches);

        if (count($matches)) {
            if (count($matches) == 2 && $matches[0]) {
                $this->setPostcodeArea($matches[0]);
            }

            if (count($matches) == 4 && $matches[2] && $matches[3]) {
                $this->setPostcodeArea($matches[3]);
                $this->setPostcodeOutward($matches[2]);
            }

            if (count($matches) == 8 && $matches[4] && $matches[5] && $matches[6] && $matches[7]) {
                $this->setPostcode(str_replace(' ', '', $matches[4]));
                $this->setPostcodeArea($matches[6]);
                $this->setPostcodeOutward($matches[5]);
                $this->setPostcodeInward($matches[7]);
            }
        }

        return $this->getPostcode();
    }

    /**
     * @param null $postcode
     * @return null
     */
    public function validateViaDatabase($postcode = null)
    {
        if ($postcode) {
            $this->validatePostcode($postcode);
        }

        if (!$this->getDatabase()) {
            return null;
        }

        // fetch postcode from database to geo-locate
        if ($this->getPostcode()) {
            $this->validatePostcodeViaDatabase();
        }

        // get additional information
        if ($this->getPostcodeOutward()) {
            $this->validatePostcodeOutwardViaDatabase();
        }
    }

    /**
     * @param null $postcode
     * @return null
     */
    public function validatePostcodeViaDatabase($postcode = null)
    {
        if (!$postcode) {
            $postcode = $this->getPostcode();
        }

        $row = $this->getDatabase()->find(
            $this->schemaTablePostcode,
            $postcode,
            $this->schemaColumnPostcode
        );

        if ($row) {
            $this->setLatitude($row->latitude);
            $this->setLongitude($row->longitude);
        } else {
            $this->setPostcode(null);
            $this->setPostcodeArea(null);
            $this->setPostcodeInward(null);
            $this->setPostcodeOutward(null);
            $this->setLatitude(null);
            $this->setLongitude(null);
            return null;
        }
    }

    /**
     * @param null $postcodeOutward
     * @return null
     */
    public function validatePostcodeOutwardViaDatabase($postcodeOutward = null)
    {
        if (!$postcodeOutward) {
            $postcodeOutward = $this->getPostcodeOutward();
        }

        $row = $this->getDatabase()->find(
            $this->schemaTableOutward,
            $postcodeOutward,
            $this->schemaColumnOutward
        );

        if ($row) {
            $this->setPostcodeOutward($row->postcode_outward);
            $this->setPostcodeArea($row->postcode_area);
            $this->setLatitude($row->latitude);
            $this->setLongitude($row->longitude);
        } else {
            $this->setPostcode(null);
            $this->setPostcodeArea(null);
            $this->setPostcodeInward(null);
            $this->setPostcodeOutward(null);
            $this->setLatitude(null);
            $this->setLongitude(null);
            return null;
        }
    }


    /**
     * @return null|DatabaseWrapperInterface
     */
    protected function getDatabase()
    {
        return $this->database;
    }
    /**
     * @param $database null|DatabaseWrapperInterface
     * @return $this
     */
    public function setDatabase(DatabaseWrapperInterface $database = null) {
        $this->database = $database;
        return $this;
    }
}
