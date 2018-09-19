<?php

class Location_types extends Controller {

  public function __construct() {
    if(!isLoggedIn()) {
      redirect('users/login');
    }
    $this->locationTypesModel = $this->model('LocationTypes');
  }
  

  public function index() {
    $data = array();
    $data['location_types'] = $this->locationTypesModel->getLocationTypes();
    $this->view('location_types/index', $data);
  }

  //

  // create new testing officer
  public function create_location_type(){
    $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
    $input_data = $_POST;
    $v = new Valitron\Validator($input_data);
    $v->rule('required', array('description', 'name'))->message('{field} is required');
   
    $v->labels(array(
        'name' => 'Location Name',
        'description' => 'Description'
    ));
    
    if($v->validate()) {
      // to check user existed or not
      // un comment after adding name in db table
      /*  if($this->userModel->findUserByName($input_data['name']) === false) {
            $error = array();
            $error[0] = array('0' => "Enter Valid BSCID");
            echo json_encode($error);
            exit();
        }*/

       
        $data = [
          'name' =>  $input_data['name'],
          'description' => $input_data['description'],
          'status' => $input_data['status'],
          'created_by' => 1
        ];
      $this->locationTypesModel->CreateLocationType($data);
      // success
      echo 200;
    } else {
      // Errors
      ///print_r($v->errors());
      
      echo json_encode($v->errors());
    }
  }
}