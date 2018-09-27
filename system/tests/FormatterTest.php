<?php

require '../../vendor/autoload.php';
require '../bootstrap.php';

use system\components\Formatter;
use PHPUnit\Framework\TestCase;

class FormatterTest extends TestCase {

    public function testFromRoute() {
        // Test*Name -> Testname
        // test-name -> TestName
        $this->assertEquals('Testname', Formatter::fromRoute('Test*Name')); // fail
        $this->assertEquals('TestName', Formatter::fromRoute('test-name')); // success
    }
}
