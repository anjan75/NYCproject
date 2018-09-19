<?php

class General_inspections extends Controller {

  public function __construct() { 
    if(!isLoggedIn()) {
      redirect('users/login');
    }
    $this->userModel = $this->model('User');

  }
  

  public function index() {
    //get posts
    //$id = $_SESSION['user_id'];

    //$posts = $this->postModel->getPostsByUserId($id);

    $this->view('general_inspections/index');
  }
  public function get_ehost_data(){
    
    $users = $this->userModel->getEHOSTDATA();

    
    $data = [
      'users' => $users
    ];

   
    $this->view('general_inspections/ehost_data', $data);
  }
}