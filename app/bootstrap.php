<?php
  // Load Config
  require_once 'config/config.php';
  //load Helpers
  require_once 'helpers/url_helper.php';
  require_once 'helpers/session_helper.php';
  require_once '../vendor/autoload.php';

  // Autoload Core Libraries
  spl_autoload_register(function($className){
    require_once 'libraries/' . $className . '.php';
  });
  /*
  $db = new Database;
  $db->Connect("lirr-bschdev.lirr.org:10100/ECRDEV", "ecr2", "45ecR.77");  //("ecr2", "45ecR.77", "lirr-bschdev.lirr.org:10100/ECRDEV");
   
  $db->SetFetchMode(OCI_ASSOC); 
  $db->SetAutoCommit(true);




  $params = array(':RAILROAD', ':DESCRIPTION', ':BUSINESS_UNIT_ID', ':CREATED_BY', ':CREATION_DATE' );
  $bind = array(':RAILROAD' => "'Lorem'", ':DESCRIPTION' => "'Lorem'", ':BUSINESS_UNIT_ID' => '2', ':CREATED_BY' => '1', ':CREATION_DATE' => '' ); 
  $status = $db->StoredProc("ECR2_PKG.Add_Railroad", $params, $bind); 



  
var_dump($status); 
exit();
*/