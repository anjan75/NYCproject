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
    //get posts
    //$id = $_SESSION['user_id'];
    $users = $this->userModel->getUsers();
    foreach ($users as $ukey => $user) {
      $users[$ukey]['roles'] = $this->userModel->getUserRoles($user['BSC_EMPLID']);
    }
    $data['users'] = $users;
    $this->view('user_data/index', $data);
  }
  // create new testing officer
  public function create_TO(){
    $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
    $input_data = $_POST;
    $v = new Valitron\Validator($input_data);
    $v->rule('required', array('bscid', 'name', ))->message('{field} is required');
    $v->rule('length', 'bscid', '7')->message('{field} must be 7 digits length');
    $v->labels(array(
        'name' => 'Employee Name',
        'bscid' => 'BSCID'
    ));
    
    if($v->validate()) {
      // to check user existed or not
        if($this->userModel->findUserByBSID($input_data['bscid']) === false) {
            $error = array();
            $error[0] = array('0' => "Enter Valid BSCID");
            echo json_encode($error);
            exit();
        }

        $name = explode(" ", $input_data['name']);
        $fname = (isset($name[0])) ? $name[0] : "";
        $lname = (isset($name[1])) ? $name[1] : "";
        $data = [
          'first_name' => $fname,
          'last_name' => $lname,
          'bscid' => $input_data['bscid'],
          'status_validity' => $input_data['status_validity'],
          'status' => $input_data['status'],
        ];
        $roles = [];
        $me_no_roles = $input_data['me_no_roles'];
        $me_yes_roles = $input_data['me_yes_roles'];
        foreach ($me_no_roles as $no_r) {
            $roles[] = $no_r;
        }
        if (is_array($me_yes_roles) && count($me_yes_roles) > 0) {
          foreach ($me_yes_roles as $yes_r) {
            $roles[] = $yes_r;
          }
        }
        
        
       // $roles =  str_repeat (':, ',  count ($roles) - 1) . ':'; //implode(",", $roles);
        $roles = $this->userModel->getMultipleRoles($roles);
        


        $this->userModel->update_TO($data);
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