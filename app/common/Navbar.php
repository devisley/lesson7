<?php
/**
 * Created by PhpStorm.
 * User: Ruslan
 * Date: 19.09.2018
 * Time: 22:04
 */

namespace app\common;


trait Navbar
{
    public $navBackend = [
        ["name" => "Frontend", "href" => "/"],
        ["name" => "Pages", "href" => "/page"],
        ["name" => "Add page", "href" => "/admin/page/create"],
    ];

    public $navUser = [
        ["name" => "Login", "href" => "/admin/user"],
    ];
}