<?php

class Lines extends Controller {

  public function __construct() {
    if(!isLoggedIn()) {
      redirect('users/login');
    }

    $this->Lines = $this->model('Line');
  }
  

  public function index() {
    $data = [];
   // $data['lines'] = $this->Lines->getLines();
    $data['lines'] = $this->Lines->getLineById();

  /*  
    echo "<pre>";
    print_r($data);
    echo "<pre>";
    exit();*/
    $this->view('Lines/index', $data);
  }

  // create new Line
  public function create_line(){
    $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
    $input_data = $_POST;
    $input_data['status'] = isset($input_data['status']) ? $input_data['status'] : 'Active';
    $user_id = $_SESSION['user_id'];
    $v = new Valitron\Validator($input_data);
    $v->rule('required', array('description', 'linecode'))->message('{field} is required');
   
    $v->labels(array(
        'linecode' => 'Line Short Text',
        'description' => 'Line Description'
    ));
    
    if($v->validate()) {
        $data = [
          'linecode' => $input_data['linecode'],
          'description' => $input_data['description'],
          'business_unit_id' => $_SESSION['user_business_unit_id'],
          'status' => $input_data['status'],
          'created_by' => $user_id,
        ];
        
        if ($this->Lines->isLineExists($data['linecode'], $data['description'])) {
          echo "Line Already Existed";
        }else if($this->Lines->CreateLine($data)){
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

  // Update line
  public function update_line(){
    
    $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
    $input_data = $_POST;
    $input_data['status'] = isset($input_data['status']) ? $input_data['status'] : 'Active';
    $user_id = $_SESSION['user_id'];
    $rid = $input_data['line_id'];
    $v = new Valitron\Validator($input_data);
    $v->rule('required', array('description', 'line_id', 'linecode'))->message('{field} is required');

    $v->labels(array(
        'linecode' => 'Line Short Text',
        'description' => 'Line Description',
        /*'line_id' => 'Rail Road ID'*/
    ));
    
    if($v->validate()) {
        $data = [
          'linecode' => $input_data['linecode'],
          'description' => $input_data['description'],
          'status' => $input_data['status'],
          'updated_by' => $user_id,
          'line_id' => $rid,
        ];
      $this->Lines->UpdateLine($data);
      // success
      echo 200;
    } else {
      // Errors
      ///print_r($v->errors());
      
      echo json_encode($v->errors());
    }
  }

}