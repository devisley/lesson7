<?php

require '../../vendor/autoload.php';
require '../bootstrap.php';

use system\components\App;
use app\common\models\Page;
use PHPUnit\Framework\TestCase;

class PageTest extends TestCase {

    public static function setUpBeforeClass() {
        define('ENV', 'frontend');

        $config = array_merge(
            include '../config/main.php',
            include '../config/database.php'
        );

        $app = new App($config);
        $app->start(false);
    }

    function testCreateNewPage() {
        $page = new Page([
            'title' => 'Test page from PHPUnit',
            'description' => 'key1',
            'keywords' => 'key2',
            'content' => 'myContent'
        ]);

        $page->save();

        $this->assertNotFalse(Page::findOne([
            'title' => 'Test page from PHPUnit'
        ]));

        $page->delete();
    }
}
