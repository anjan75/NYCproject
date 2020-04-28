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

  //User filter 
  public function userFilter(){

    $fieldValue = $_GET['fieldValue'];
    $name = !empty($_GET['name']) ? trim($_GET['name']) : '';
    if ($name != null) {
      $users = $this->userModel->getUserByFilter($name, $fieldValue);
    }  
    $data = array();  
    foreach ($users as $key => $value) {
     /* $userIdWithName = $value['BSC_EMPLID'] .str_repeat(' ',8).$value['FIRST_NAME'].' '.$value['LAST_NAME'];
      $row = $userIdWithName. '|' .$value['FIRST_NAME']. '|' .$value['LAST_NAME']. '|' .$value['JOBCODE']. '|' .$value['DEPTID'];
      array_push($data, $row, $value);*/
      $users[$key]['bscid'] = $value['BSC_EMPLID'].' '.$value['FIRST_NAME'].' '.$value['LAST_NAME'];
    }
    //print_r($data);exit();  
    
    echo json_encode($users);
    //print_r($users);
  }

}