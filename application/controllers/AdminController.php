<?php

namespace application\controllers;

use application\core\Controller;
use application\models\Admin;
use application\models\User;
use http\Env\Request;
use http\Env\Response;

class AdminController extends Controller
{

    protected $userModel;
    protected $adminModel;

    public function __construct($route)
    {
        parent::__construct($route);

        $this->userModel = new User();
        $this->adminModel = new Admin();
    }

    public function indexAction()
    {
        $this->view->render('index');
    }

    public function loginAction()
    {
        if (!empty($_POST['login'] && $_POST['password'])) {
            $login = htmlspecialchars(trim($_POST['login']), ENT_QUOTES);
            $pass = htmlspecialchars(trim($_POST['password']), ENT_QUOTES);
            if (($this->userModel->login($login, $pass)) == ($_POST['login'] && $_POST['password'])) {
                return $this->view->redirect('dashboard');
            }
        }
        return $this->view->redirect('index');
    }


    public function dashboardAction()
    {
        $this->view->render('Dashboard');
    }

    public function createAction()
    {
        $this->view->render('Dashboard');
    }

    public function uploadImage($image)
    {
        $name = $_FILES['image']['name']; //name image
        $tmp_name = $_FILES['image']['tmp_name']; // get tmp name
        move_uploaded_file($tmp_name, "img/uploads/" . $name);
        $new_path = "/img/uploads/" . $name;
        return $new_path;
    }

    public function saveAction()
    {
        $id = $_POST['id'];
        $title = $_POST['title'];
        $image = $this->uploadImage($_FILES['image']);
        $link = $_POST['link'];
        $status = $_POST['status'];
        $pos = $_POST['position'];
        $bool = $this->adminModel->bannerAdd($id, $title, $image, $link, $status, $pos);
        if ($bool == null) {
            return $this->view->redirect('dashboard');
        }
    }

    public function updateAction()
    {
        $bool = $this->adminModel->bannerUpd();
        if ($bool === null) {
            return $this->view->redirect('dashboard');
        }
    }

    public function deleteAction()
    {
        $id = $_POST['del'];
        $this->adminModel->bannerDelete($id);

        return $this->view->redirect('dashboard');
    }

    public function editAction()
    {
        $this->adminModel->getItembyId();
        $this->view->render('Editing');
    }
}