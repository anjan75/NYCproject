<?php

class Tasks extends Controller {

  public function __construct() {
    if(!isLoggedIn()) {
      redirect('users/login');
    }
    $this->tasksModel = $this->model('task');
  }
  

  public function index() {
    //get posts
    //$id = $_SESSION['user_id'];

    //$posts = $this->postModel->getPostsByUserId($id);

    $this->view('tasks/index');
  }
  public function getTaskRules($task_id){
      $rules = $this->tasksModel->getTaskRules($task_id);

      echo json_encode($rules);
  }
}

