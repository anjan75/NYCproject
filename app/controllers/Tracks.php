<?php

class Tracks extends Controller {

  public function __construct() {
    if(!isLoggedIn()) {
      redirect('users/login');
    }
    /*$this->locationTypesModel = $this->model('Tracks');*/
    $this->Tracks = $this->model('Track');
  }
  

  public function index() {
    $data = array();
    /* $data = [];*/
    $data['tracks'] = $this->Tracks->getTrackById();
    /* echo "<pre>";
    print_r($data);
    echo "<pre>";
    exit();*/
    $this->view('tracks/index', $data);
  }

  //

  // create new testing officer
  public function create_track(){
    $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
    $input_data = $_POST;
    $v = new Valitron\Validator($input_data);
    $v->rule('required', array('description', 'trackcode'))->message('{field} is required');
   
    $v->labels(array(
        'trackcode' => 'Track Code ',
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
          'trackcode' =>  $input_data['trackcode'],
          'description' => $input_data['description'],
          'business_unit_id' => $_SESSION['user_business_unit_id'],
          'status' => $input_data['status'],
          'created_by' => $_SESSION['user_id']
        ];
      $this->Tracks->CreateTrack($data);
      // success
      echo 200;
    } else {
      // Errors
      ///print_r($v->errors());
      
      echo json_encode($v->errors());
    }
  }


  // update new testing officer
  public function update_track(){
     $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
    $input_data = $_POST;
    $v = new Valitron\Validator($input_data);
    $v->rule('required', array('description', 'trackcode', 'track_id'))->message('{field} is required');
   
    $v->labels(array(
        'trackcode' => 'Track Code ',
        'description' => 'Description',
        'track_id' => 'Track ID'
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
          'track_id' => $input_data['track_id'],
          'trackcode' =>  $input_data['trackcode'],
          'description' => $input_data['description'],
          'business_unit_id' => $_SESSION['user_business_unit_id'],
          'status' => $input_data['status'],
          'created_by' => $_SESSION['user_id']
        ];
      $this->Tracks->UpdateTrack($data);
      // success
      echo 200;
    } else {
      // Errors
      ///print_r($v->errors());
      
      echo json_encode($v->errors());
    }
  }

}