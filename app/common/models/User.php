<?php
/**
 * Created by PhpStorm.
 * User: Ruslan
 * Date: 17.09.2018
 * Time: 19:58
 */

namespace app\common\models;

use system\components\App;
use system\components\ActiveRecord;

/**
 * Class User
 * @package app\common\models
 * @property string login
 * @property string password
 */
class User extends ActiveRecord
{

    public static function alreadyLoggedIn() {
        return App::$current->request->session('user');
    }

    public static function checkAuthWithCookie()
    {
        if (isset($_COOKIE['id_user']) && isset($_COOKIE['cookie_hash'])){
            //Получаем данные пользователя по ID
            $userData = parent::findById($_COOKIE['id_user']);

            if(($userData['password'] !== $_COOKIE['cookie_hash']) || ($userData['id'] !== $_COOKIE['id_user'])){
                setcookie('id_user', '', time() - 3600 * 24, '/');
                setcookie('cookie_hash', '', time() - 3600 * 24, '/');
            } else {
               App::$current->request->goBack(); //Все в порядке, пользователь авторизовался через cookie
            }
        }
        return false;
    }

    public function authWithLoginPassword()
    {
        $userData = parent::findOne(['login' => $this->login]);
        $isAuth = 0;

        //Проверяем соответствие логина и пароля
        if($userData){
            if($this->checkPassword($this->password, $userData->password)){
                $isAuth = 1; //Авторизован
            }
        }

        if (App::$current->request->post('remember_me')){
            setcookie('id_user', $userData['id'], time() + 3600 * 24, '/');
            setcookie('cookie_hash', $userData['password'], time() + 3600 * 24, '/');
        }

        //Сохраняем данные в сессии
        $_SESSION['user'] = $userData;
        return $isAuth;
    }

    private static function checkPassword($password, $hash)
    {
        return md5($password) === $hash;
    }

    public static function logOut() {
        $_SESSION = [];
        $_POST = [];
        $_GET = [];
        $_COOKIE = [];
    }

}