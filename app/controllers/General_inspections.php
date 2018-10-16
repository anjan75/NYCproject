<?php

class General_inspections extends Controller {

  public function __construct() {
    if(!isLoggedIn()) {
      redirect('users/login');
    }
    $this->userModel = $this->model('User');
    $this->railRoads = $this->model('RailRoad');
  }
  
  public function index() {
    $data['gi_bsc_id'] = $_SESSION['user_id'];
    $data['railroads'] = $this->railRoads->getRailRoadById();
   
    $this->view('general_inspections/index', $data);
  }
 
}