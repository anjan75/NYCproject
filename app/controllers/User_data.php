<?php
use Valitron\Validator as v;
class User_data extends Controller {

  public function __construct() {
    if(!isLoggedIn()) {
      redirect('users/login');
    }
    $this->userModel = $this->model('User');
  }
  

  public function index() {
    $data = null;
    $users = null;
    $user_admin_roles = array('User Administrator');   
    $business_unit_id = $_SESSION['user_business_unit_id'];
    if (isUserRole('IT Administrator')) {
      $business_unit_id = '';
    }

    if (isUserRole('IT Administrator')) {
      $users = $this->userModel->getUsers($business_unit_id);
    }elseif (hasPermission($user_admin_roles, "LIRR")) {
      $users = $this->userModel->nonITusers($business_unit_id); // not IT and lirr 

    }elseif (hasPermission($user_admin_roles, "MNR")) {
      $users = $this->userModel->nonITusers($business_unit_id); // non IT MNR
    }


    for ($i=0; $i < count($users['BSC_EMPLID']); $i++) {
      $u[$users['BSC_EMPLID'][$i]]['BSC_EMPLID'] = $users['BSC_EMPLID'][$i];
      $u[$users['BSC_EMPLID'][$i]]['FULL_NAME'] = $users['FULL_NAME'][$i];
      $u[$users['BSC_EMPLID'][$i]]['DEPARTMENT'] = $users['DEPARTMENT'][$i];
      $u[$users['BSC_EMPLID'][$i]]['BUSINESS_UNIT'] = $users['BUSINESS_UNIT'][$i];
      $u[$users['BSC_EMPLID'][$i]]['STATUS_VALIDITY'] = $users['STATUS_VALIDITY'][$i];
      $u[$users['BSC_EMPLID'][$i]]['STATUS'] = $users['STATUS'][$i];
      $u[$users['BSC_EMPLID'][$i]]['PLAN_ROLE_ID'] = $users['PLAN_ROLE_ID'][$i];
      //$u[$users['BSC_EMPLID'][$i]]['ROLE_ID'] = $users['ROLE_ID'][$i];
      //$u[$users['BSC_EMPLID'][$i]]['ROLE_CODE'] = $users['ROLE_CODE'][$i];
      $u[$users['BSC_EMPLID'][$i]]['PLAN_ID'] = $users['PLAN_ID'][$i];
      $u[$users['BSC_EMPLID'][$i]]['JOBCODE'] = $users['JOBCODE'][$i];
      $u[$users['BSC_EMPLID'][$i]]['JOBCODE_DESCR'] = $users['JOBCODE_DESCR'][$i];
      $u[$users['BSC_EMPLID'][$i]]['POSITION_NUMBER'] = $users['POSITION_NUMBER'][$i];
      $u[$users['BSC_EMPLID'][$i]]['POSITION_DESC'] = $users['POSITION_DESC'][$i];
      $u[$users['BSC_EMPLID'][$i]]['MGT_CTR'] = $users['MGT_CTR'][$i];
      $u[$users['BSC_EMPLID'][$i]]['DEPT_DESCR'] = $users['DEPT_DESCR'][$i];



      if (!isset($u[$users['BSC_EMPLID'][$i]]['ROLES'])) {
        $u[$users['BSC_EMPLID'][$i]]['ROLES'] = [];
      }
      if (!in_array($users['ROLE_CODE'][$i], $u[$users['BSC_EMPLID'][$i]]['ROLES'])) 
      {
        $u[$users['BSC_EMPLID'][$i]]['ROLES'][] = $users['ROLE_CODE'][$i];
      } 
    }

    /*echo "<pre>";
    print_r($users);
    echo "<pre>";
    exit();*/
    $data['users'] = $u;
    $this->view('user_data/index', $data);
  }
  public function search(){
    $data = null;
    $users = null;
    $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
    $input_data['f_bscid'] = isset($_POST['f_bscid']) ? $_POST['f_bscid'] : null;
    $input_data['f_first_name']  = isset($_POST['f_first_name']) ? $_POST['f_first_name'] : null;
    $input_data['f_last_name']  = isset($_POST['f_last_name']) ? $_POST['f_last_name'] : null;
    $input_data['f_job_code']  = isset($_POST['f_job_code']) ? $_POST['f_job_code'] : null;
    $input_data['f_mgmt_ctr_id']  = isset($_POST['f_mgmt_ctr_id']) ? $_POST['f_mgmt_ctr_id'] : null;
    $input_data['f_user_role'] = isset($_POST['f_user_role']) ? $_POST['f_user_role'] : null;
    $input_data['f_status'] = isset($_POST['f_status']) ? $_POST['f_status'] : null;
    $business_unit_id = $_SESSION['user_business_unit_id'];
    if (isUserRole('IT Administrator')) {
      $business_unit_id = '';
    }
   
    $v = new Valitron\Validator($input_data);
    $v->rule('numeric', array('f_bscid'))->message('{field} is required');
    /*$v->rule('length', 'bscid', '7')->message('{field} must be 7 digits length');*/
    $v->labels(array(
        'f_bscid' => 'BSC ID'
    ));
    
    if($v->validate()) {
    
    $users = $this->userModel->searchUsers($input_data, $business_unit_id);

      /* if (isUserRole('IT Administrator')) {
        $users = $this->userModel->searchUsers($input_data);
      }elseif (hasPermission($user_admin_roles, "LIRR")) {
        $users = $this->userModel->nonITusers(); // not IT and lirr 
      }elseif (hasPermission($user_admin_roles, "MNR")) {
        $users = $this->userModel->nonITusers(); // non IT MNR
      }*/
      for ($i=0; $i < count($users['BSC_EMPLID']); $i++) {
        $u[$users['BSC_EMPLID'][$i]]['BSC_EMPLID'] = $users['BSC_EMPLID'][$i];
        $u[$users['BSC_EMPLID'][$i]]['FULL_NAME'] = $users['FULL_NAME'][$i];
        $u[$users['BSC_EMPLID'][$i]]['DEPARTMENT'] = $users['DEPARTMENT'][$i];
        $u[$users['BSC_EMPLID'][$i]]['BUSINESS_UNIT'] = $users['BUSINESS_UNIT'][$i];
        $u[$users['BSC_EMPLID'][$i]]['STATUS_VALIDITY'] = $users['STATUS_VALIDITY'][$i];
        $u[$users['BSC_EMPLID'][$i]]['STATUS'] = $users['STATUS'][$i];
        $u[$users['BSC_EMPLID'][$i]]['PLAN_ROLE_ID'] = $users['PLAN_ROLE_ID'][$i];
        //$u[$users['BSC_EMPLID'][$i]]['ROLE_ID'] = $users['ROLE_ID'][$i];
        //$u[$users['BSC_EMPLID'][$i]]['ROLE_CODE'] = $users['ROLE_CODE'][$i];
        $u[$users['BSC_EMPLID'][$i]]['PLAN_ID'] = $users['PLAN_ID'][$i];
        $u[$users['BSC_EMPLID'][$i]]['JOBCODE'] = $users['JOBCODE'][$i];
        $u[$users['BSC_EMPLID'][$i]]['JOBCODE_DESCR'] = $users['JOBCODE_DESCR'][$i];
        $u[$users['BSC_EMPLID'][$i]]['POSITION_NUMBER'] = $users['POSITION_NUMBER'][$i];
        $u[$users['BSC_EMPLID'][$i]]['POSITION_DESC'] = $users['POSITION_DESC'][$i];
        $u[$users['BSC_EMPLID'][$i]]['MGT_CTR'] = $users['MGT_CTR'][$i];
        $u[$users['BSC_EMPLID'][$i]]['DEPT_DESCR'] = $users['DEPT_DESCR'][$i];



        if (!isset($u[$users['BSC_EMPLID'][$i]]['ROLES'])) {
          $u[$users['BSC_EMPLID'][$i]]['ROLES'] = [];
        }
        if (!in_array($users['ROLE_CODE'][$i], $u[$users['BSC_EMPLID'][$i]]['ROLES'])) 
        {
          $u[$users['BSC_EMPLID'][$i]]['ROLES'][] = $users['ROLE_CODE'][$i];
        } 
      }
    } else {
      // Errors
      ///print_r($v->errors());
      $input_data['v_errors'] = $v->errors();
    }

    if(isset($u)){
      $data['users'] = $u;
    }else{
     $data['users'] = " ";
    }

    $data['input_data'] = $input_data;
    $this->view('user_data/index', $data);
 
  }

  public function getUsers() {
    $input_data['draw'] = $_POST["draw"];;
    $input_data['orderByColumnIndex']  = $_POST['order'][0]['column'];
    $input_data['orderBy'] = $_POST['columns'][$input_data['orderByColumnIndex']]['data'];
    $input_data['orderType'] = $_POST['order'][0]['dir']; // ASC or DESC
    $input_data['start']  = $_POST["start"];//Paging first record indicator.
    $input_data['length'] = $_POST['length'];
    $input_data['columns'] = isset($_POST['columns']) ? $_POST['columns'] : null;
    $input_data['search']  = isset($_POST['search']) ? $_POST['search'] : null;

    $return_data = $this->userModel->getUsers($input_data);
    $users = $return_data['rows'];
    foreach ($users as $ukey => $user) {
      $roles = $this->userModel->getUserRoles($user['BSC_EMPLID']);
      $role_str = "";
      if (isset($roles)  && count($roles)) {
        $i = 1;
        foreach ($roles as $ses_roles) {
          $role_str .=  $i.") ".$ses_roles['ROLE_CODE']."<br>";
          $i++;
        }
      }
      $users[$ukey]['MODIFY'] = "update";
      $users[$ukey]['POSITION_NUMBER'] = "-";
      $users[$ukey]['POSITION_DESCRIPTION'] = "-";
      $users[$ukey]['POSITION_ROLE'] = "-";
      $users[$ukey]['ROLES'] = $role_str;
    }

    $recordsTotal = $return_data['total_rows'];
    $recordsFiltered = $return_data['total_rows'];
    $response = array(
        "draw" => intval($input_data['draw']),
        "recordsTotal" => $recordsTotal,
        "recordsFiltered" => $recordsFiltered,
        "data" => $users
    );
    echo json_encode($response);
  }
  // create new testing officer
  public function create_TO(){
    $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
    $input_data = $_POST;
    $v = new Valitron\Validator($input_data);
    $v->rule('required', array('bscid', 'name', ))->message('{field} is required');
    /*$v->rule('length', 'bscid', '7')->message('{field} must be 7 digits length');*/
    $v->labels(array(
        /*'name' => 'Employee Name',*/
        'bscid' => 'BSC ID'
    ));
    
    if($v->validate()) {
      // to check user existed or not from both lirr and mnr
        if($this->userModel->findUserByBSID($input_data['bscid']) === false) {
            $error = array();
            $error[0] = array('0' => "Enter Valid BSCID");
            echo json_encode($error);
            exit();
        }

        $name = explode(" ", $input_data['name']);
        $fname = (isset($name[0])) ? $name[0] : "";
        $lname = (isset($name[1])) ? $name[1] : "";
        $input_data['end_date'] = isset($input_data['end_date']) ? $input_data['end_date'] : null;
        $data = [
          'first_name' => $fname,
          'last_name' => $lname,
          'bscid' => $input_data['bscid'],
          'status_validity' => $input_data['status_validity'],
          'status' => $input_data['status'],
          'end_date' => $input_data['end_date'],
        ];
        $roles = [];
        $me_no_roles = isset($input_data['me_no_roles']) ? $input_data['me_no_roles'] : '';
        $me_yes_roles = isset($input_data['me_yes_roles']) ? $input_data['me_yes_roles'] : '';

        if (is_array($me_no_roles) && count($me_no_roles) > 0) {
          foreach ($me_no_roles as $no_r) {
              $roles[] = $no_r;
          }
        }
        if (is_array($me_yes_roles) && count($me_yes_roles) > 0) {
          foreach ($me_yes_roles as $yes_r) {
            $roles[] = $yes_r;
          }
        }
        
        
       // $roles =  str_repeat (':, ',  count ($roles) - 1) . ':'; //implode(",", $roles);
        $roles = $this->userModel->getMultipleRoles($roles);
        


        //$this->userModel->update_TO($data); // updates user name 
        $this->userModel->update_TO_User_Plans($data);
        //step 1 delete all roles for bscid
        $this->userModel->delete_user_roles($input_data['bscid']);
        //step 2 insert new role for bscid
        if (is_array($roles) && count($roles) > 0) {
            $i=1;
            foreach ($roles as $role) {
                $role_data = array(
                  'plan_role_id' => $i,
                  'bscid'=> $input_data['bscid'],
                  'role_id' => $role['ROLE_ID'],
                  'role_code' => $role['ROLE_CODE'],
                  'user_id' => $_SESSION['user_id'],
                );
                $this->userModel->add_user_roles($role_data); 
                $i++;       
            }
        }
        



      // success
      echo 200;
    } else {
      // Errors
      ///print_r($v->errors());
      
      echo json_encode($v->errors());
    }
  }

}