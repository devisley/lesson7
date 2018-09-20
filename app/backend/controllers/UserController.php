<?php
/**
 * Created by PhpStorm.
 * User: Ruslan
 * Date: 16.09.2018
 * Time: 23:09
 */

namespace app\backend\controllers;

use system\components\App;
use app\common\models\User;
use system\components\Controller;

class UserController extends Controller
{
    /**
     * 'site/index' action handler
     */
    public function actionIndex() {

        if(User::alreadyLoggedIn()){
            App::$current->request->redirect('admin');
        }

        //Если установлены куки, авторизуем через них
        if(User::checkAuthWithCookie()){
            App::$current->request->redirect('admin');
        }

        $user = new User();

        if ($user->load(App::$current->request->post())) {

            //Авторизуем по логину и паролю
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                if(!$user->authWithLoginPassword()){
                    $user->addError('auth_error', 'Неправильный логин/пароль');
                } else {
                    App::$current->request->redirect('admin/page');
                }
            }
        }

        return $this->render(
            'index', [
                'user' => $user,
            ]
        );
    }

    public function actionLogout() {
        User::logOut();
        header('Location: /admin/user');
    }

}