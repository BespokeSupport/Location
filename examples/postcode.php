<?php

require_once dirname(__FILE__).'/../lib/Postcode.php';

$postcodeString = 'PR1 1AA';
$postcodeString = 'C';

$postcode = new \BespokeSupport\Location\Postcode($postcodeString);

echo "Postcode Stripped:\t".$postcode->getPostcode().PHP_EOL;
echo "Postcode Formatted:\t".$postcode->getPostcodeFormatted().PHP_EOL;
echo "Postcode Postal Area:\t".$postcode->getPostcodeArea().PHP_EOL;
echo "Postcode Outward:\t".$postcode->getPostcodeOutward().PHP_EOL;
echo "Postcode Inward:\t".$postcode->getPostcodeInward().PHP_EOL;
