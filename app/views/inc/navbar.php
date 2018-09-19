<div class="col-md-12" style="margin: 0px; padding:0px;">
<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-3" data-hover="dropdown" data-animations="fadeInDown fadeInLeft fadeInUp fadeInRight">

      <div class="col-md-2">
        <a class="navbar-brand" href="<?php echo URLROOT; ?>/dashboards/index" style="padding: 0px; font-size: 14px; margin-right:0px;">
        <img class="img-responsive" style="padding: 1px; width: 8%; height: auto;" src="../public/img/mta.png"><?php echo SITENAME; ?></a>
      </div>

      <button class="navbar-toggler ml-auto" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span> 
      </button>
   <div class="col-md-10">
      <div class="collapse navbar-collapse" id="navbarsExampleDefault">
                  <!-- float-xs-right for ul --> <!-- float-right for div -->
        <ul class="navbar-nav ml-auto">
          <?php 
              $roles = array('Data Entry For Self', 'Data Entry For Others Only', 'Data Entry Administrator');            
              if (hasPermission($roles)) {
          ?>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Inspection Entry
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="<?php echo URLROOT; ?>/general_inspections/index">General Inspection</a>
            <a class="dropdown-item" href="<?php echo URLROOT; ?>/speed_inspections/index">Speed Inspection</a>
            <a class="dropdown-item" href="<?php echo URLROOT; ?>/trainRide_inspections/index">Train Ride Inspection</a>

            <a class="dropdown-item" href="<?php echo URLROOT; ?>/general_inspections/get_ehost_data">EHOST DATA</a>

            </div>
          </li>
          <?php }  ?>
          
          <?php 
              $roles = array('Data Entry For Self', 'Data Entry For Others Only', 'Data Entry Administrator');   
              if (hasPermission($roles, "LIRR")) {
          ?>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            MofE Inspection
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="<?php echo URLROOT; ?>/operatingYard_inspections/index">Operating Yard Rules Inspection</a>
            <a class="dropdown-item" href="<?php echo URLROOT; ?>/carMover_inspections/index">Car Mover Inspection</a>
            <a class="dropdown-item" href="<?php echo URLROOT; ?>/Equipment_inspections/index">Equipment Safety Observations Inspection</a>
            </div>
          </li>
          <?php }  ?>
          

          <?php 
              $roles = array('Designated Instructor', 'Qualified Personnel', 'Data Entry Administrator', 'Data Entry For Others Only');            
              if (hasPermission($roles)) {
          ?>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Training Evaluation
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="#">Practice Evaluation</a>
            <a class="dropdown-item" href="#">Final Evaluation</a>
            </div>
          </li>
          <?php } ?>

          <?php 
              $roles = array('Data Entry Administrator');            
              if (hasPermission($roles)) {
          ?>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo URLROOT; ?>/inspection_search/index">Inspection Search</a>
          </li>
          <?php } ?>
          
          <?php 
              $roles = array('View Reports');            
              if (hasPermission($roles, 'MNR')) {
          ?>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Reports
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
              <a class="dropdown-item" href="#">MNR menu item</a>
              <a class="dropdown-item" href="#">MNR menu item</a>
              <a class="dropdown-item" href="#">MNR menu item</a>
              <a class="dropdown-item" href="#">MNR menu item</a>
              <a class="dropdown-item" href="#">MNR menu item</a>
              <a class="dropdown-item" href="#">MNR menu item</a>
            </div>
          </li>
          <?php } ?>

          <?php 
              $roles = array('View Reports');            
              if (hasPermission($roles, 'LIRR')) {
          ?>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Reports
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
              <a class="dropdown-item" href="#">LIRR menu item</a>
              <a class="dropdown-item" href="#">LIRR menu item</a>
              <a class="dropdown-item" href="#">LIRR menu item</a>
              <a class="dropdown-item" href="#">LIRR menu item</a>
              <a class="dropdown-item" href="#">LIRR menu item</a>
              <a class="dropdown-item" href="#">LIRR menu item</a>
            </div>
          </li>
          <?php } ?>

          <?php 
              $roles = array('View Reports');            
              if (hasPermission($roles)) {
          ?>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Training Reports
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
              <a class="dropdown-item" href="#">Training menu item</a>
              <a class="dropdown-item" href="#">Training menu item</a>
              <a class="dropdown-item" href="#">Training menu item</a>
              <a class="dropdown-item" href="#">Training menu item</a>
              <a class="dropdown-item" href="#">Training menu item</a>
              <a class="dropdown-item" href="#">Training menu item</a>
            </div>
          </li>
          <?php } ?>
            <?php if (isUserRole('User Data Administrator') || isUserRole('User Security Levels Administrator') || isUserRole('System Administrator')){ ?>
            <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            User Administration
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">

         
            <?php 
              $roles = array('User Data Administrator', 'User Security Levels Administrator');            
              if (hasPermission($roles)) {
            ?>
            
            <a class="dropdown-item" href="<?php echo URLROOT; ?>/TenentEmp_Adminstration/index">Tenent Employee Adminstration</a>
            <a class="dropdown-item" href="<?php echo URLROOT; ?>/user_data/index">User Administrator</a>
           
            <?php } ?>

            <!-- <a class="dropdown-item" href="<?php //echo URLROOT; ?>/user_level/index">User Security Levels</a> -->
            <?php if(isUserRole('System Administrator')){ ?>
           
                <a class="dropdown-item" href="<?php echo URLROOT; ?>/IT_Administrator/index">IT-Administrator</a>
           
            <?php } ?>
            
            </div>
            </li>
            <?php } ?>


            <?php 
              $roles = array('Rules Administrator');            
              if (hasPermission($roles)) {
            ?>
           <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Rules Administration
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="<?php echo URLROOT; ?>/tasks/index">Tasks</a>
            <a class="dropdown-item" href="<?php echo URLROOT; ?>/rules/index">Rules</a>
            <a class="dropdown-item" href="<?php echo URLROOT; ?>/referenced_rules/index">Referenced Rules</a>
            <!-- <a class="dropdown-item" href="#">Tasks-Rules</a>
            <a class="dropdown-item" href="#">Rules-Referenced Rules</a> -->
            </div>
          </li>
            <?php } ?>

            <?php 
              $roles = array('Table Data Administrator');            
              if (hasPermission($roles)) {
            ?>
            <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Table Data Administration
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="<?php echo URLROOT; ?>/email_groups/index">E-mail Groups</a>
            <a class="dropdown-item" href="<?php echo URLROOT; ?>/railroads/index">Railroad</a>
            <a class="dropdown-item" href="<?php echo URLROOT; ?>/tracks/index">Track Designation</a>
            <a class="dropdown-item" href="<?php echo URLROOT; ?>/speed_source/index">Observed Speed Source</a>
            <a class="dropdown-item" href="<?php echo URLROOT; ?>/lines/index">Lines</a>
            <a class="dropdown-item" href="<?php echo URLROOT; ?>/location_types/index">Location Types</a>
            <a class="dropdown-item" href="<?php echo URLROOT; ?>/locations/index">Locations</a>
           <!--  <a class="dropdown-item" href="#">Lines-Location Types</a> -->
            <!-- <a class="dropdown-item" href="#">Location Types-Locations</a> -->
            <!-- <a class="dropdown-item" href="#">Job Codes-Occupation Codes</a> -->
            <a class="dropdown-item" href="#">Job Codes-Position Number</a>
            <!-- <a class="dropdown-item" href="#">Occupation Codes-Process Roles</a> -->
            <a class="dropdown-item" href="<?php echo URLROOT; ?>/entry_restrictions/index">Observation Date Entry Restrictions</a>
            <a class="dropdown-item" href="#">Process Roles-Observation Counts</a>
            <!-- <a class="dropdown-item" href="<?php echo URLROOT; ?>/timeout/index">System Idle Timedout Time</a> -->
          
            </div>
          </li>
          <?php } ?>

        </ul>
         <ul class="navbar-nav ml-auto">
          <?php if(isset($_SESSION['user_id'])) : ?>
          <?php 
              $user_profile_data = "<strong>".$_SESSION['user_name']."</strong><br>";
              $user_profile_data .= "EMPL ID: <strong>".$_SESSION['user_id']."</strong><br>";
              $user_profile_data .= "BUSINESS UNIT ID: <strong>".$_SESSION['user_business_unit']."</strong><br>";
              $user_profile_data .= "DEPARTMENT ID: <strong>".$_SESSION['user_department_id']."</strong><br>";
              $user_profile_data .= "Role(s): ";
              if (isset($_SESSION['user_roles'])) {
                foreach ($_SESSION['user_roles'] as $ses_roles) {
                  $user_profile_data .= "<strong>".$ses_roles['ROLE_CODE']."</strong><br>";
                }
              }
          ?>
            <li class="nav-item" style="margin-right: 10px;">
              <a class="text-dark nav-link btn btn-light" href="#"><i class="fa fa-bell" aria-hidden="true"></i></a>
            </li>
            <li class="nav-item">
              <a class="text-dark nav-link btn btn-light" href="<?php echo URLROOT; ?>/users/logout" data-toggle="popover" data-trigger="hover" data-content="<?php echo $user_profile_data; ?>"><i class="fas fa-sign-out-alt"></i>Logout</a>
            </li>
          <?php else : ?>
            <li class="nav-item">
              <a class="nav-link" href="<?php echo URLROOT; ?>/users/register">Register</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?php echo URLROOT; ?>/users/login">Login</a>
            </li>
          <?php endif; ?>
        </ul>
      
      </div>

       
     
       
      </div>
 </div>
  </nav>
</div>