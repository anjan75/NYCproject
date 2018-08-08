<?php
  class Pages extends Controller {
    public function __construct(){
     
    }
    
    public function index(){
      
      if(isLoggedIn()) {
        redirect('dashboards/index');
      }
     
      $this->view('pages/index');
    }
  }