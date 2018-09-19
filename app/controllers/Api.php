<?php
class Api extends Controller {
  var $data;
  public function __construct() {
  	
    //$this->postModel = $this->model('Post');
    $this->userModel = $this->model('User');
  }
  public function index(){
  	return null;
  }
  public function getBscIdUser(){
  	$bscid = isset($_GET['bscid']) ? $_GET['bscid'] : null;

  	if ($bscid != null) {
  		$user = $this->userModel->getUserByBSID($bscid);
  		$user['roles'] = $this->userModel->getUserRoles($bscid);
  	}
  	$this->data['status'] = true;
  	$this->data['message'] = 'success';
  	$this->data['data'] = $user;
  
  	echo json_encode($this->data);
  }
  public function getRoles(){
    
     
    $roles = $this->userModel->getRoles();

    $this->data['status'] = true;
    $this->data['message'] = 'success';
    $this->data['data'] = $roles;
    
    echo json_encode($this->data);
  }
}