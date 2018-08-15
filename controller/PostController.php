<?php

namespace controller;

use model\PostModel;
use core\DB\DBConnector;
use core\DB\DBDriver;
use core\Validators\Validate;


class PostController extends BaseController
{
    public function actionIndex()
    {
        $mPost = new PostModel(new DBDriver(DBConnector::getPDO()), new Validate());
        $posts = $mPost->getAll();

        $this->title = sprintf('%s | Список новостей', $this->title) ;
        $this->render('post\index', [
            'articles' => $posts,
        ]);
    }

    public function actionPost()
    {
        $mPost = new PostModel(new DBDriver(DBConnector::getPDO()), new Validate());
        $id = $this->request->get('id');
        $post = $mPost->getById($id);

        $this->title = sprintf('%s | %s', $this->title, $post['title']);

        $this->render('post\post', [
            'title' => $post['title'],
            'content' => $post['content'],
            'date' => $post['date'],
            'id' => $post['id']
        ]);
    }

    public function actionUpdate()
    {
        $mPost = new PostModel(new DBDriver(DBConnector::getPDO()), new Validate());
        $id = $this->request->get('id');
        $post = $mPost->getById($id);
        $this->title = sprintf('%s | Редактирование %s', $this->title, $post['title']);

        if ($this->request->isPost()){
            $title = trim($this->request->post('title'));
            $content = trim($this->request->post('content'));

            $mPost->update([
                'title' => $title,
                'content' => $content,
                'date' => time(),
                'id' => $id
            ]);

            $this->redirect("\post", $id);

        }

        $this->render('post\update', [
            'title' => $post['title'],
            'content' => $post['content'],
            'id' => $post['id']
        ]);

    }

    public function actionCreate()
    {
        $mPost = new PostModel(new DBDriver(DBConnector::getPDO()), new Validate());

        $this->title = sprintf('%s | Добавление записи', $this->title);

        if($this->request->isPost()) {
            $title = trim($this->request->post('title'));
            $content = trim($this->request->post('content'));

            $id = $mPost->create([
                'title' => $title,
                'content' => $content,
                'date' => time()
            ]);

            $this->redirect("\post", $id);
        }

        $this->render('post\create', [
            'title' => null,
            'content' => null,
        ]);

    }

    public function actionDelete()
    {

        $mPost = new PostModel(new DBDriver(DBConnector::getPDO()), new Validate());
        $id = $this->request->get('id');
        $post = $mPost->getById($id);

        $this->title = sprintf('%s | Удаление записи', $this->title);

        if($this->request->isPost()) {

            if($this->request->post('result') == "true"){

                $mPost->delete($id);
                $this->redirect('/post');

            } else {
                $this->redirect('/post', $id);
                exit;
            }

        }

        $this->render('post\delete', [
            'post' => $post,
        ]);

    }
}