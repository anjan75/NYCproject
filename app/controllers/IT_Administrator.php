<?php
use Valitron\Validator as v;
class IT_Administrator extends Controller {

  public function __construct() {
    if(!isLoggedIn()) {
      redirect('users/login');
    }
    $this->userModel = $this->model('User');
  }
  

  public function index() {
    $data = null;
    $users = $this->userModel->getUsers();

    /*foreach ($users as $ukey => $user) {
      $users[$ukey]['roles'] = $this->userModel->getUserRoles($user['BSC_EMPLID']);
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

   /* echo "<pre>";
    print_r($u);
    echo "<pre>";
    exit();*/
    $data['users'] = $u;
    $this->view('IT_Administrator/index', $data);
  }
}