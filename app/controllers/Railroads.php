<?php

class Railroads extends Controller {

  public function __construct() {
    if(!isLoggedIn()) {
      redirect('users/login');
    }

    $this->railRoads = $this->model('RailRoad');
  }
  

  public function index() {
    $data = [];
   // $data['railroads'] = $this->railRoads->getRailRoads();
    $data['railroads'] = $this->railRoads->getRailRoadById();

    
    /*echo "<pre>";
    print_r($data);
    echo "<pre>";
    exit();*/
    $this->view('railroads/index', $data);
  }

  // create new Rail Road
  public function create_rail_road(){
    $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
    $input_data = $_POST;
    $user_id = $_SESSION['user_id'];
    $v = new Valitron\Validator($input_data);
    $v->rule('required', array('description', 'railroad'))->message('{field} is required');
   
    $v->labels(array(
        'description' => 'Description',
        'railroad' => 'RailRoad'
    ));
    
    if($v->validate()) {
        $data = [
          'railroad' => $input_data['railroad'],
          'description' => $input_data['description'],
          'status' => $input_data['status'],
          'business_unit_id' => $_SESSION['user_business_unit_id'],
          'created_by' => $user_id,

        ];
      
          if($this->railRoads->CreateRailRoad($data)){
            // success
            echo 200;
          }else{
            echo "Failed! FALSE";
          }
      
      
      
    } else {
      // Errors
      ///print_r($v->errors());
      
      echo json_encode($v->errors());
    }
  }

  // create new Rail Road
  public function update_rail_road(){
    
    $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
    $input_data = $_POST;
    $user_id = $_SESSION['user_id'];
    $rid = $input_data['railroad_id'];
    $v = new Valitron\Validator($input_data);
    $v->rule('required', array('description', 'railroad_id', 'railroad'))->message('{field} is required');

    $v->labels(array(
        'description' => 'Description',
        'railroad_id' => 'Rail Road ID',
        'railroad' => 'Rail Road'
    ));
    
    if($v->validate()) {
        $data = [
          'railroad' => $input_data['railroad'],
          'description' => $input_data['description'],
          'status' => $input_data['status'],
          'business_unit_id' => $_SESSION['user_business_unit_id'],
          'updated_by' => $user_id,
          'railroad_id' => $rid,
        ];
      $this->railRoads->UpdateRailRoad($data);
      // success
      echo 200;
    } else {
      // Errors
      ///print_r($v->errors());
      
      echo json_encode($v->errors());
    }
  }

}