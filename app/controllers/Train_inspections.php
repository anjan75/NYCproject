<?php 
class Train_inspections extends Controller {
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
    $this->trainInspectionModel = $this->model('TrainInspection');
  }
  
  public function index() {
    $arr = [];
    $data['ti_bsc_id'] = $_SESSION['user_id'];
    $data['railroads'] = $this->railRoads->getRailRoadById();
    $data['lines'] = $this->Lines->getLineById();
    $data['location_types'] = $this->locationTypesModel->getLocationTypeById(45);
    //$data['locations'] = $this->locationsModel->getLocationById();
    $data['tasks'] = $this->tasksModel->getTaskById();
    $data['mileposts'] = $this->milepostsModel->getMilepostById();
    $data['tif_observations'] = isset($_COOKIE['tif_data']) ? $_COOKIE['tif_data'] : '';
    $data['tif_observations'] = json_decode($data['tif_observations'], true);
    
    /*echo "<pre>";
    print_r( $data['tif_observations']);
    echo "<pre>";
    exit();*/
    $this->view('trainRide_inspections/index', $data);
  }

  public function create_ti(){

    $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
    $input_data = $_POST;
    $ins_data = null;
    $obj_data = null;
    $input_data['status'] = isset($input_data['status']) ? $input_data['status'] : 'Active';
    $user_id = $_SESSION['user_id'];
    $v = new Valitron\Validator($input_data);
    $v->rule('required', array('ti_observed_employee'))->message('{field} is required');

    $v->labels(array(
      'ti_observed_employee' => 'Observed Employee',
    ));

    if($v->validate()) {
        /*$inspection_id = $ins_data['inspection_id']/* = mt_rand(10,100000);*/
  /*      $inspection_id = $input_data['inspection_id']*/
       // $ins_data['inspection_id'] = $input_data['inspection_id'];
        $ins_data['inspection_type_id'] = 3;
        $ins_data['testing_officer'] = $input_data['ti_bsc_id']; //$_SESSION['user_id'];
        $ins_data['railroad_id'] = $input_data['ti_rail_road'];
        $ins_data['observed_employee'] = $input_data['ti_observed_employee'];
        $ins_data['crew_number'] = $input_data['ti_crew_number'];
        $ins_data['train_number'] = $input_data['ti_train_number'];
        $ins_data['department_id'] = $input_data['ti_department_id']; 
        $ins_data['occupation_id'] = '';//$input_data['ti_jobcode_id'];// temporarly inserting
        $ins_data['description'] = '';
        $ins_data['plan_id'] = $_SESSION['user_plan_id'];
        $ins_data['inspection_date'] = date('m-d-Y'); //'10/10/2018'
        $ins_data['entered_by'] = $_SESSION['user_id'];
       
        //$inspection_id = $this->trainInspectionModel->CreateInspection($ins_data);
/*print_r($_POST);
exit();*/
         
       /* echo $inspection_id;
        exit();
        */
        $tif_observations = isset($_COOKIE['tif_data']) ? $_COOKIE['tif_data'] : '';
        $tif_observations = json_decode($tif_observations, true);
        if (is_array($tif_observations) && count($tif_observations) > 0) {
           $inspection_save = $this->trainInspectionModel->CreateInspection($ins_data);
          foreach ($tif_observations as $tif_obj_key => $obj_input_data) {
            $non_compliant = null;
            if (isset($obj_input_data['tif_non_compliant'])) {
              if ($obj_input_data['tif_non_compliant'] == 'reviewed') {
                $non_compliant = 1;
              }else{
                $non_compliant = 2;
              }
            }else{
              $non_compliant = 2; // when compiant selected
            }
              $obj_data['inspection_id'] = ''; //$inspection_id;
              $obj_data['observation_num'] = $tif_obj_key+1;
              $obj_data['line'] = (isset($obj_input_data['tif_line']) && !empty($obj_input_data['tif_line'])) ? $obj_input_data['tif_line'] : 1;
              $obj_data['location_type'] = $obj_input_data['tif_location_type'];
              $obj_data['location'] = $obj_input_data['tif_location'];
              $obj_data['milepost'] = $obj_input_data['tif_milepost'];
              $obj_data['observation_type'] = ($obj_input_data['tif_observation'] == 'observed') ? 1 : 2; 
              $obj_data['monthly_test_flag'] = isset($obj_input_data['tif_monthly_test']) ? 'Y': 'N';
              $obj_data['task'] = $obj_input_data['tif_task'];
              $obj_data['rules'] = $obj_input_data['tif_rule'];
              $obj_data['outcomes'] = ($obj_input_data['tif_result'] == 'compliant') ? 1 : 2; 
              $obj_data['non_compliant'] = $non_compliant;
              $obj_data['obs_speed'] = ''; //$obj_input_data[''];
              $obj_data['posted_speed'] = '';//$obj_input_data[''];
              $obj_data['obs_speed_src'] = '';//$obj_input_data[''];'Radar'
              $obj_data['observation_date'] = date('m-d-Y', strtotime($obj_input_data['tif_date']));
              $obj_data['comments'] = $obj_input_data['tif_comment'];
              $obj_data['created_by'] = $_SESSION['user_id'];

              $this->trainInspectionModel->CreateTrainInspectionObservation($obj_data);
          }
        }
        
        //clear cookie and redirect
        // if (isset($_COOKIE['tif_data'])) {
          setcookie('tif_data', '', time() - 3600, '/'); 
          echo "success";
          //redirect('dashboards/index');
        //}
        


        

    } else {
      echo json_encode($v->errors());
    }
  }
 
}