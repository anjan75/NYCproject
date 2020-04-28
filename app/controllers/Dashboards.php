<?php

class Dashboards extends Controller {

  public function __construct() {
    if(!isLoggedIn()) {
      redirect('users/login');

    //$this->postModel = $this->model('Post');
    //$this->userModel = $this->model('User');
    }
  }
  

  public function index() {
    //get posts
    //$id = $_SESSION['user_id'];

    //$posts = $this->postModel->getPostsByUserId($id);

    $data = [
      'title' => 'Dashboard'
    ];

    $this->view('dashboards/index', $data);
  }

  public function test() {
    //get posts
    //$id = $_SESSION['user_id'];

    //$posts = $this->postModel->getPostsByUserId($id);

    $data = [
    ];

    $this->view('dashboards/test', $data);
  }
}