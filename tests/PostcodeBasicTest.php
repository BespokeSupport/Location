<?php

namespace BespokeSupport\Location\Test;

use BespokeSupport\Location\Postcode;

class PostcodeBasicTest extends \PHPUnit_Framework_TestCase
{
    public static $postcodeAreaValid = [
        'B',
        'N',
        'BA',
        'ZE',
        'GY',
    ];

    public static $postcodeAreaInValid = [
        '1',
        '11',
        '111',
        '1111',
        '11111',
        '111111',
        '1111111',
        '11111111',
        '111111111',
        'C',
        'Z',
    ];

    public static $postcodeOutwardValid = [
        'SW1A',
        'B9A',
        'B9',
        'B99',
        'B99',
        'BB99',

        ' SW1A ',
        ' B9A ',
        ' B9 ',
        ' B99 ',
        ' B99 ',
        ' BB99 ',
    ];

    public static $postcodeOutwardInValid = [
        'ALZ',
        'AL999',
        'A1A9',
//        'A',  // these are valid areas - the test include outward
//        'AA', // these are valid areas - the test include outward
        'AAA',
        'AAAA',
        'AAAAA',
        'AAAAAA',
        'AAAAAAA',
        'AAAAAAAA',
        'AAAAAAAAA',
        '1',
        '11',
        '111',
        '1111',
        '11111',
        '111111',
        '1111111',
        '11111111',
        '111111111',
    ];

    public static $postcodeFullInValid = [
        'C058BL',
        'BI60EP',
    ];

    public static $postcodeFullValid = [
        'B1 1AA',
        'B11 1AA',
        'BB1 1AA',
        'BB11 1AA',
        'B1A 1AA',
        'BB1A 1AA',

        'B11AA',
        'B111AA',
        'BB11AA',
        'BB111AA',
        'B1A1AA',
        'BB1A1AA',

        ' B1  1AA ',
        ' B11  1AA ',
        ' BB1  1AA ',
        ' BB11  1AA',
        ' B1A  1AA',
        ' BB1A  1AA',

    ];

    public function testPostcodeGetters()
    {
        $postcodeObject = new Postcode();

        $this->assertNull($postcodeObject->getLatitude());
        $this->assertNull($postcodeObject->getLongitude());
        $this->assertNull($postcodeObject->getPostcode());
        $this->assertNull($postcodeObject->getPostcodeOutward());
        $this->assertNull($postcodeObject->getPostcodeArea());
        $this->assertNull($postcodeObject->getPostcodeFormatted());
        $this->assertNull($postcodeObject->getPostcodeInward());

        $this->assertTrue(is_array($postcodeObject->getPostcodeAreas()));
    }

    public function testPostcodeSetters()
    {
        $postcodeObject = new Postcode();

        $postcodeObject->setPostcodeArea(self::$postcodeAreaValid[0]);
        $this->assertNotNull($postcodeObject->getPostcodeArea());

        $postcodeObject->setPostcodeOutward(self::$postcodeOutwardValid[0]);
        $this->assertNotNull($postcodeObject->getPostcodeOutward());

        $postcodeObject->setLatitude(53);
        $this->assertNotNull($postcodeObject->getLatitude());

        $postcodeObject->setLatitude(-2);
        $this->assertNotNull($postcodeObject->getLatitude());

        $postcodeObject->setLongitude(53);
        $this->assertNotNull($postcodeObject->getLongitude());

        $postcodeObject->setLongitude(-2);
        $this->assertNotNull($postcodeObject->getLongitude());
    }

    public function testPostcodeInvalid()
    {
        $postcodeObject = new Postcode(new \StdClass());
        $this->assertNull($postcodeObject->getPostcodeArea());
    }
}
