<?php

class Inspection_search extends Controller {

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

    $this->view('inspection_search/index');
  }
}