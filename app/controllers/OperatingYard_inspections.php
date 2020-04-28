<?php

/*class OperatingYard_inspections extends Controller {

  public function __construct() {
    if(!isLoggedIn()) {
      redirect('users/login');

    //$this->postModel = $this->model('Post');
    //$this->userModel = $this->model('User');
    }
  }
  

  public function index() {
    //get posts
    //$id = $_SESSION['user_id'];

    //$posts = $this->postModel->getPostsByUserId($id);

    $this->view('operatingYard_inspections/index');
  }
}*/
 
class OperatingYard_inspections extends Controller {
  public function __construct() {
    if(!isLoggedIn()) {
      redirect('users/login');
    }

    $this->userModel = $this->model('User');

    $this->railRoads = $this->model('RailRoad');

    $this->Lines = $this->model('Line');
    $this->locationTypesModel = $this->model('LocationTypes');
    $this->locationsModel = $this->model('Locations');

    $this->tasksModel = $this->model('task');
    $this->milepostsModel = $this->model('Milepost');
    $this->operatingyardInspectionModel = $this->model('OperatingyardInspection');

  }
  
  public function index() {
    $arr = [];
    $data['oi_bsc_id'] = $_SESSION['user_id'];
    $data['railroads'] = $this->railRoads->getRailRoadById();
    $data['lines'] = $this->Lines->getLineById();
    $data['location_types'] = $this->locationTypesModel->getLocationTypeById();
    //$data['locations'] = $this->locationsModel->getLocationById();
    $data['tasks'] = $this->tasksModel->getTaskById();
    $data['mileposts'] = $this->milepostsModel->getMilepostById();
    $data['oif_observations'] = isset($_COOKIE['oif_data']) ? $_COOKIE['oif_data'] : '';
    $data['oif_observations'] = json_decode($data['oif_observations'], true);
    
    /*echo "<pre>";
    print_r( $data['oif_observations']);
    echo "<pre>";
    exit();*/
    $this->view('operatingYard_inspections/index', $data);
  }

  public function create_operatingyard_inspection(){

    $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
    $input_data = $_POST;
    $ins_data = null;
    $obj_data = null;
    $input_data['status'] = isset($input_data['status']) ? $input_data['status'] : 'Active';
    $user_id = $_SESSION['user_id'];
    $v = new Valitron\Validator($input_data);
    $v->rule('required', array('oi_observed_employee'))->message('{field} is required');

    $v->labels(array(
      'oi_observed_employee' => 'Observed Employee',
    ));

    if($v->validate()) {
        /*$inspection_id = $ins_data['inspection_id']/* = mt_rand(10,100000);*/
  /*      $inspection_id = $input_data['inspection_id']*/
       // $ins_data['inspection_id'] = $input_data['inspection_id'];
        $ins_data['inspection_type_id'] = 4;
        $ins_data['testing_officer'] = $input_data['oi_bsc_id']; //$_SESSION['user_id'];
        $ins_data['railroad_id'] = $input_data['oi_rail_road'];
        $ins_data['observed_employee'] = $input_data['oi_observed_employee'];
        $ins_data['crew_number'] = ''; //$input_data['oi_crew_number'];
        $ins_data['train_number'] = '';//$input_data['oi_train_number'];
        $ins_data['department_id'] = $input_data['oi_department_id']; 
        $ins_data['occupation_id'] = '';//$input_data['oi_jobcode_id'];// temporarly inserting
        $ins_data['description'] = '';
        $ins_data['plan_id'] = $_SESSION['user_plan_id'];
        $ins_data['inspection_date'] = date('m-d-Y'); //'10/10/2018'
        $ins_data['entered_by'] = $_SESSION['user_id'];
        //$inspection_save = $this->operatingyardInspectionModel->CreateInspection($ins_data);
         
       /* echo $inspection_id;
        exit();
        */
        $oif_observations = isset($_COOKIE['oif_data']) ? $_COOKIE['oif_data'] : '';
        $oif_observations = json_decode($oif_observations, true);
        if (is_array($oif_observations) && count($oif_observations) > 0) {
          //insert inspection
          $inspection_save = $this->operatingyardInspectionModel->CreateInspection($ins_data);
          foreach ($oif_observations as $oif_obj_key => $obj_input_data) {
            $non_compliant = null;
            if (isset($obj_input_data['oif_non_compliant'])) {
              if ($obj_input_data['oif_non_compliant'] == 'reviewed') {
                $non_compliant = 1;
              }else{
                $non_compliant = 2;
              }
            }else{
              $non_compliant = 2; // when compiant selected
            }
              $obj_data['inspection_id'] = ''; //$inspection_id;
              $obj_data['observation_num'] = $oif_obj_key+1;
              $obj_data['line'] = (isset($obj_input_data['oif_line']) && !empty($obj_input_data['oif_line'])) ? $obj_input_data['oif_line'] : '';//NULL
              $obj_data['location_type'] = $obj_input_data['oif_location_type'];
              $obj_data['location'] = $obj_input_data['oif_location'];
              $obj_data['milepost'] = ''; //$obj_input_data['oif_milepost'];
              $obj_data['observation_type'] = ($obj_input_data['oif_observation'] == 'observed') ? 1 : 2; 
              $obj_data['monthly_test_flag'] = isset($obj_input_data['oif_monthly_test']) ? 'Y': 'N';
              $obj_data['task'] = $obj_input_data['oif_task'];
              $obj_data['rules'] = $obj_input_data['oif_rule'];//$obj_input_data['oif_rule_code'];
              $obj_data['outcomes'] = ($obj_input_data['oif_result'] == 'compliant') ? 1 : 2; 
              $obj_data['non_compliant'] = $non_compliant;
              $obj_data['obs_speed'] = ''; //$obj_input_data[''];
              $obj_data['posted_speed'] = '';//$obj_input_data[''];
              $obj_data['obs_speed_src'] = '';//$obj_input_data[''];'Radar'
              $obj_data['observation_date'] = date('m-d-Y', strtotime($obj_input_data['oif_date']));
              $obj_data['comments'] = $obj_input_data['oif_comment'];
              $obj_data['created_by'] = $_SESSION['user_id'];
              $obj_data['track_designation_id'] = ''; //$obj_input_data['']
              $obj_data['engine_num'] = ''; // $obj_input_data['']

              $this->operatingyardInspectionModel->CreateoperatingyardInspectionObservation($obj_data);
          }
        }
        
        //clear cookie and redirect
        // if (isset($_COOKIE['oif_data'])) {
          setcookie('oif_data', '', time() - 3600, '/'); 
          echo "success";
          //redirect('dashboards/index');
        //}
        


        

    } else {
      echo json_encode($v->errors());
    }
  }
 
}