<?php

class Speed_source extends Controller {

  public function __construct() {
    if(!isLoggedIn()) {
      redirect('users/login');
    }
    /*$this->locationTypesModel = $this->model('LocationTypes');*/
    $this->Speed_source = $this->model('SpeedSource');
  }
  

  public function index() {
    $data = array();
    /* $data = [];*/
    $data['SpeedSource'] = $this->Speed_source->getSpeed_source();
   /* echo "<pre>";
    print_r($data);
    echo "<pre>";
    exit();*/
    $this->view('speed_source/index', $data);
  }

  //

  // create new testing officer
  public function create_track(){
    $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
    $input_data = $_POST;
    $v = new Valitron\Validator($input_data);
    $v->rule('required', array('description', 'SpeedCode'))->message('{field} is required');
   
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
      $this->Speed_source->CreateLocationType($data);
      // success
      echo 200;
    } else {
      // Errors
      ///print_r($v->errors());
      
      echo json_encode($v->errors());
    }
  }


  // update new testing officer
  public function update_location_type(){
    $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
    $input_data = $_POST;
    $v = new Valitron\Validator($input_data);
    $v->rule('required', array('description', 'name', 'location_type_id'))->message('{field} is required');
   
    $v->labels(array(
        'name' => 'Location Name',
        'description' => 'Description',
        'location_type_id' => 'Location Type'
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
          'location_type_id' => $input_data['location_type_id'],
          'created_by' => 1
        ];
      $this->Tracks->UpdateLocationType($data);
      // success
      echo 200;
    } else {
      // Errors
     // print_r($v->errors());
      
      echo json_encode($v->errors());
    }
  }

}