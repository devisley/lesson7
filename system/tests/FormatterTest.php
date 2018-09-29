<?php

//require ROOT . '/vendor/autoload.php';
//require ROOT . '/system/bootstrap.php';

require '../../vendor/autoload.php';
require '../bootstrap.php';

use system\components\Formatter;
use PHPUnit\Framework\TestCase;

class FormatterTest extends TestCase {

    public function testFromRoute() {
        $this->assertEquals('TestName', Formatter::fromRoute('test-name')); // success
    }

    public function testOneMore() {
        $this->assertEquals('Testname', Formatter::fromRoute('Test*Name')); // fail
    }
}
