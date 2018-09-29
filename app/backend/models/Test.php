<?php
/**
 * Created by PhpStorm.
 * User: Ruslan
 * Date: 27.09.2018
 * Time: 23:02
 */

namespace app\backend\models;

class Test
{
    public static function parseTestXml($simpleXMLElement) {
        $result = [];
        $testNum = 0;

        foreach ($simpleXMLElement as $mainTestSuite) {
            foreach ($mainTestSuite as $testSuite) {
                foreach ($testSuite as $testCase) {
                    $testNum++;
                    $testOk = true;
                    $message = $testNum . ') TestSuit - ' . $testSuite['name'] . ', TestCase - ' . $testCase['name'];
                    if (isset($testCase->failure)) {
                        $message .= '. <br>Test failed. <br>Error message: ' . $testCase->failure;
                        $testOk = false;
                    } else {
                        $message .= '. <br>Test OK';
                    }
                    array_push($result, ['testOk' => $testOk, 'message' => $message]);
                }
            }
        }

        return $result;
    }
}