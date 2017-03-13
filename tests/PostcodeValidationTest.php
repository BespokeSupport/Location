<?php

namespace BespokeSupport\Location\Test;

use BespokeSupport\Location\Postcode;

class PostcodeValidationTest extends \PHPUnit_Framework_TestCase
{
    public function testAreaValid()
    {
        foreach (PostcodeBasicTest::$postcodeAreaValid as $o) {
            $postcode = new Postcode($o);
            $this->assertNotNull($postcode->getPostcodeArea());
            $this->assertNull($postcode->getPostcodeOutward());
            $this->assertNull($postcode->getPostcodeInward());
            $this->assertNull($postcode->getPostcode());
            $this->assertNull($postcode->getPostcodeFormatted());
        }
    }

    public function testAreaInValid()
    {
        foreach (PostcodeBasicTest::$postcodeAreaInValid as $o) {
            $postcode = new Postcode($o);
            $this->assertNull($postcode->getPostcodeArea());
            $this->assertNull($postcode->getPostcodeOutward());
            $this->assertNull($postcode->getPostcodeInward());
            $this->assertNull($postcode->getPostcode());
            $this->assertNull($postcode->getPostcodeFormatted());
        }
    }

    public function testOutwardValid()
    {
        foreach (PostcodeBasicTest::$postcodeOutwardValid as $o) {
            $postcode = new Postcode($o);
            $this->assertNotNull($postcode->getPostcodeOutward());
            $this->assertNotNull($postcode->getPostcodeArea());
            $this->assertNull($postcode->getPostcode());
            $this->assertNull($postcode->getPostcodeFormatted());
            $this->assertNull($postcode->getPostcodeInward());
        }
    }

    public function testOutwardInValid()
    {
        foreach (PostcodeBasicTest::$postcodeOutwardInValid as $o) {
            $postcode = new Postcode($o);
            $this->assertNull($postcode->getPostcodeOutward());
            $this->assertNull($postcode->getPostcodeArea());
            $this->assertNull($postcode->getPostcode());
            $this->assertNull($postcode->getPostcodeFormatted());
            $this->assertNull($postcode->getPostcodeInward());
        }
    }

    public function testPostcodeValid()
    {
        foreach (PostcodeBasicTest::$postcodeFullValid as $o) {
            $postcode = new Postcode($o);
            $this->assertNotNull($postcode->getPostcodeOutward());
            $this->assertNotNull($postcode->getPostcodeArea());
            $this->assertNotNull($postcode->getPostcode());
            $this->assertNotNull($postcode->getPostcodeFormatted());
            $this->assertNotNull($postcode->getPostcodeInward());
        }
    }

    public function testPostcodeFull()
    {
        $postcode = new Postcode(' BB1A  1AA ');
        $this->assertEquals('BB', $postcode->getPostcodeArea());
        $this->assertEquals('BB1A', $postcode->getPostcodeOutward());
        $this->assertEquals('1AA', $postcode->getPostcodeInward());
        $this->assertEquals('BB1A1AA', $postcode->getPostcode());
        $this->assertEquals('BB1A 1AA', $postcode->getPostcodeFormatted());
    }

    public function testPostcodeInwardInvalid()
    {
        $postcode = new Postcode();
        $postcode->setPostcodeArea('B');
        $postcode->setPostcodeOutward('B1');
        $postcode->setPostcodeInward('AAA');
        $this->assertNotNull($postcode->getPostcodeArea());
        $this->assertNotNull($postcode->getPostcodeOutward());
        $this->assertNull($postcode->getPostcodeInward());
        $this->assertNull($postcode->getPostcode());
        $this->assertNull($postcode->getPostcodeFormatted());
    }

    public function testPostcodeOutwardInvalid()
    {
        $postcode = new Postcode();
        $postcode->setPostcodeArea('BB');
        $postcode->setPostcodeOutward('BB11Z');
        $postcode->setPostcodeInward('AAA');
        $this->assertNotNull($postcode->getPostcodeArea());
        $this->assertNull($postcode->getPostcodeOutward());
        $this->assertNull($postcode->getPostcodeInward());
        $this->assertNull($postcode->getPostcode());
        $this->assertNull($postcode->getPostcodeFormatted());
    }
}
