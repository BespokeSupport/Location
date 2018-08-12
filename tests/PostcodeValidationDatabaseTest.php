<?php

namespace BespokeSupport\Location\Test;

use BespokeSupport\DatabaseWrapper\DatabaseWrapperPdo;
use BespokeSupport\Location\Postcode;
use PHPUnit\Framework\TestCase;

class PostcodeValidationDatabaseTest extends TestCase
{
    public function testOutwardNull()
    {
        $pdo = getPdo();
        $databaseConnection = new DatabaseWrapperPdo($pdo);
        $postcodeObject = new Postcode('AB10', $databaseConnection);

        $this->assertEquals('AB10', $postcodeObject->getPostcodeOutward());
        $this->assertEquals(57.1, round($postcodeObject->getLatitude(), 1));
        $this->assertEquals(-2.1, round($postcodeObject->getLongitude(), 1));
    }

    public function testOutward()
    {
        $pdo = getPdo();
        $databaseConnection = new DatabaseWrapperPdo($pdo);
        $postcodeObject = new Postcode('AB10 1AA', $databaseConnection);

        $this->assertEquals('AB10', $postcodeObject->getPostcodeOutward());
        $this->assertEquals(57.1, round($postcodeObject->getLatitude(), 1));
        $this->assertEquals(-2.1, round($postcodeObject->getLongitude(), 1));
    }

    public function testOutwardDirect()
    {
        $pdo = getPdo();
        $databaseConnection = new DatabaseWrapperPdo($pdo);
        $postcodeObject = new Postcode();
        $postcodeObject->setDatabase($databaseConnection);
        $postcodeObject->validatePostcodeOutwardViaDatabase('AB10');

        $this->assertEquals('AB10', $postcodeObject->getPostcodeOutward());
        $this->assertEquals(57.1, round($postcodeObject->getLatitude(), 1));
        $this->assertEquals(-2.1, round($postcodeObject->getLongitude(), 1));
    }
}
