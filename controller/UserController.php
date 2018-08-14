<?php
/**
 * Created by PhpStorm.
 * User: capibari
 * Date: 02.08.2018
 * Time: 21:52
 */

namespace controller;

use core\Request;
use model\UserModel;
use core\Templater;
use core\DB\DBConnector;
use core\DB\DBDriver;
use core\Validators\Validate;
use core\Validators\PassValidate;
use core\Tools\Transform;

class UserController extends BaseController
{
    private $passValidate;

    public function __construct(Request $request)
    {
        parent::__construct($request);

        $this->passValidate = new PassValidate();
    }

    public function actionIndex()
    {
        $mUser = new UserModel(new DBDriver(DBConnector::getPDO()), new Validate());
        $users = $mUser->getAll();

        $this->title = sprintf('%s | Список пользователей', $this->title) ;
        $this->render('user\index', [
            'users' => $users,
        ]);
    }

    public function actionCreate()
    {
        $mUser = new UserModel(new DBDriver(DBConnector::getPDO()), new Validate());

        $this->title = sprintf('%s | Добавление нового пользователя', $this->title) ;

        if ($this->request->isPost()) {

            $login = $this->request->post('login');
            $password = $this->request->post('password');
            $confirm = $this->request->post('confirm');
            $name = $this->request->post('name');

            $this->passValidate->isMatch([
                'password' => $password,
                'confirm' => $confirm,
            ]);

            $mUser->create([
                'login' => $login,
                'password' => $password,
                'name' => $name,
            ]);

            $this->redirect("/user");
        }

        $this->content = Templater::buildHtmlView('user\create', [
            'login' => null,
        ]);
    }

    public function actionUpdate()
    {
        $mUser = new UserModel(new DBDriver(DBConnector::getPDO()), new Validate());
        $id = $this->request->get('id');
        $user = $mUser->getById($id);

        $this->title = sprintf('%s | Редактирование пользователя %s', $this->title,$user['login']) ;

        if ($this->request->isPost()){
            $login = $this->request->post('login');
            $name = $this->request->post('name');

            $mUser->update([
                'login' => $login,
                'name' => $name,
                'id' => $id
            ]);

            $this->redirect("\user");
        }

        $this->render('user\update', [
            'login' => $user['login'],
            'name' => $user['name'],
        ]);

    }

    public function actionUpdatePassword()
    {
        $mUser = new UserModel(new DBDriver(DBConnector::getPDO()), new Validate());
        $id = $this->request->get('id');
        $user = $mUser->getById($id);

        $this->title = sprintf('%s | Редактирование пароля пользователя %s', $this->title,$user['login']) ;

        if ($this->request->isPost()) {

            $password = $this->request->post('password');
            $confirm = $this->request->post('confirm');
            $checkOldPassword = Transform::toHash($this->request->post('oldPassword'));
            $oldPassword = $user['password'];


            $this->passValidate->isMatch([
                'password' => $password,
                'confirm' => $confirm,
            ]);

            $this->passValidate->isMatch([
                'oldPassword' => $oldPassword,
                'checkOldPass' => $checkOldPassword,
            ]);

            $mUser->update([
                    'id' => $user['id'],
                    'login' => $user['login'],
                    'password' => $password,
                ]);

            $this->redirect("\user");

        }
        $this->render('user\password',[]);
    }

    public function actionDelete()
    {
        $mUser = new UserModel(new DBDriver(DBConnector::getPDO()), new Validate());
        $id = $this->request->get('id');
        $user = $mUser->getById($id);

        $this->title = sprintf('%s | Удаление пользователя пользователя %s', $this->title,$user['login']) ;

        if ($this->request->isPost()) {

            if ($this->request->post('result') == "true") {

                $mUser->delete($id);
            }

            $this->redirect("/user");

        }

        $this->render('user\delete', [
            'user' => $user,
        ]);

    }
}