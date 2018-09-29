<?php
/**
 * Created by PhpStorm.
 * User: Ruslan
 * Date: 27.09.2018
 * Time: 22:43
 */

namespace app\backend\controllers;

// application tests directory
define('TEST_DIR', ROOT . '\\system\\tests\\');
define('PHPUNIT_DIR', ROOT . '\\vendor\\bin\\');

use app\backend\models\Test;
use system\components\Controller;

class TestController extends Controller
{
    public function actionIndex() {
        $this->render('index', [
            'message' => 'Hello. Welcome to Admin Test Suit.',
        ]);
    }

    public function actionRun() {
        $command = 'cd ' . TEST_DIR . ' && ' . PHPUNIT_DIR . 'phpunit --log-junit test.xml';
        exec($command);
        $filename = ROOT .'\system\tests\test.xml';
        $testData = [];

        if (file_exists($filename)) {
            $testData = Test::parseTestXml(simplexml_load_file($filename));
        }

        $this->render('run', [
            'testData' => $testData,
        ]);
    }

}