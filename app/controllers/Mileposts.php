<?php

class Mileposts extends Controller {

  public function __construct() {
    if(!isLoggedIn()) {
      redirect('users/login');
    }

    $this->milepostsModel = $this->model('Milepost');
  }
  

  public function index() {
    $data = [];
   // $data['mileposts'] = $this->milepostsModel->getMileposts();
    $data['mileposts'] = $this->milepostsModel->getMilepostById();

  /*  
    echo "<pre>";
    print_r($data);
    echo "<pre>";
    exit();*/
    $this->view('Mileposts/index', $data);
  }

  // create new Milepost
  public function create_milepost(){
    $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
    $input_data = $_POST;
    $input_data['status'] = isset($input_data['status']) ? $input_data['status'] : 'Active';
    $user_id = $_SESSION['user_id'];
    $v = new Valitron\Validator($input_data);
    $v->rule('required', array('description', 'milepostcode'))->message('{field} is required');
   
    $v->labels(array(
        'milepostcode' => 'Milepost Short Text',
        'description' => 'Milepost Description'
    ));
    
    if($v->validate()) {
        $data = [
          'milepostcode' => $input_data['milepostcode'],
          'description' => $input_data['description'],
          'business_unit_id' => $_SESSION['user_business_unit_id'],
          'status' => $input_data['status'],
          'created_by' => $user_id,
        ];
        
        if ($this->milepostsModel->isMilepostExists($data['milepostcode'], $data['description'])) {
          echo "Milepost Already Existed";
        }else if($this->milepostsModel->CreateMilepost($data)){
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

  // Update milepost
  public function update_milepost(){
    
    $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
    $input_data = $_POST;
    $input_data['status'] = isset($input_data['status']) ? $input_data['status'] : 'Active';
    $user_id = $_SESSION['user_id'];
    $rid = $input_data['milepost_id'];
    $v = new Valitron\Validator($input_data);
    $v->rule('required', array('description', 'milepost_id', 'milepostcode'))->message('{field} is required');

    $v->labels(array(
        'milepostcode' => 'Milepost Short Text',
        'description' => 'Milepost Description',
        /*'milepost_id' => 'Rail Road ID'*/
    ));
    
    if($v->validate()) {
        $data = [
          'milepostcode' => $input_data['milepostcode'],
          'description' => $input_data['description'],
          'status' => $input_data['status'],
          'updated_by' => $user_id,
          'milepost_id' => $rid,
        ];
      $this->milepostsModel->UpdateMilepost($data);
      // success
      echo 200;
    } else {
      // Errors
      ///print_r($v->errors());
      
      echo json_encode($v->errors());
    }
  }

}