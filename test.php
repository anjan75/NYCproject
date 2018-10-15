<?php	
	$qquery = "SELECT *
		FROM MDS_INFO
		INNER JOIN USER_PLANS
		ON USER_PLANS.BSC_EMPLID = MDS_INFO.BSC_EMPLID
		INNER JOIN DEPARTMENTS
		ON USER_PLANS.DEPT_ID = DEPARTMENTS.DEPARTMENT_ID
		INNER JOIN BUSINESS_UNIT
		ON BUSINESS_UNIT.BUSINESS_UNIT_ID = USER_PLANS.BUSINESS_UNIT_ID
		WHERE MDS_INFO.BSC_EMPLID LIKE '%{SEARCH_STRING}%' 
		OR  MDS_INFO.FIRST_NAME LIKE '%{SEARCH_STRING}%'  
    OR  MDS_INFO.LAST_NAME LIKE '%{SEARCH_STRING}%'  
		OR  USER_PLANS.BUSINESS_UNIT_ID LIKE '%{SEARCH_STRING}%'  
		OR  USER_PLANS.DEPT_ID LIKE '%{SEARCH_STRING}%'  
		OR  MDS_INFO.JOBCODE LIKE '%{SEARCH_STRING}%'  
		OR  MDS_INFO.JOBCODE_DESCR LIKE '%{SEARCH_STRING}%'  
		OR  MDS_INFO.POSITION_NBR LIKE '%{SEARCH_STRING}%'  
		OR  MDS_INFO.POSNUM_DESCR LIKE '%{SEARCH_STRING}%' 
		ORDER BY MDS_INFO.BSC_EMPLID DESC 
		OFFSET 0 ROWS FETCH NEXT 3 ROWS ONLY";

/*****

We need a function that accep follwing parameter 
1) SEARCH_STRING  // like id or name or department
2) ORDER_BY_COLUMN_NAME // like MDS_INFO.BSC_EMPLID, MDS_INFO.FIRST_NAME
3) ORDER_BY_TYPE // DESC or ASC
4) OFFSET  // 0
5) NO_OF_ROWS  // 10


if possible return total number of affected rows

*****/

function get_Users(SEARCH_STRING, ORDER_BY_COLUMN_NAME, ORDER_BY_TYPE, OFFSET, NO_OF_ROWS){
	"SELECT *
		FROM MDS_INFO
		INNER JOIN USER_PLANS
		ON USER_PLANS.BSC_EMPLID = MDS_INFO.BSC_EMPLID
		INNER JOIN DEPARTMENTS
		ON USER_PLANS.DEPT_ID = DEPARTMENTS.DEPARTMENT_ID
		INNER JOIN BUSINESS_UNIT
		ON BUSINESS_UNIT.BUSINESS_UNIT_ID = USER_PLANS.BUSINESS_UNIT_ID
		WHERE MDS_INFO.BSC_EMPLID LIKE '%{SEARCH_STRING}%' 
		OR  MDS_INFO.FIRST_NAME LIKE '%{SEARCH_STRING}%'  
		OR  USER_PLANS.BUSINESS_UNIT_ID LIKE '%{SEARCH_STRING}%'
		OR  USER_PLANS.DEPT_ID LIKE '%{SEARCH_STRING}%'  
		OR  MDS_INFO.JOBCODE LIKE '%{SEARCH_STRING}%'  
		OR  MDS_INFO.JOBCODE_DESCR LIKE '%{SEARCH_STRING}%'  
		OR  MDS_INFO.POSITION_NBR LIKE '%{SEARCH_STRING}%'  
		OR  MDS_INFO.POSNUM_DESCR LIKE '%{SEARCH_STRING}%' 
		ORDER BY {ORDER_BY_COLUMN_NAME} {ORDER_BY_TYPE}
		OFFSET {OFFSET} ROWS FETCH NEXT {NO_OF_ROWS} ROWS ONLY"
}



	/***** NAVBAR *****/




	


<div class="col-md-12" style="margin: 0px; padding:0px;">
<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-3" data-hover="dropdown" data-animations="fadeInDown fadeInLeft fadeInUp fadeInRight">

      <div class="col-md-2">
        <a class="navbar-brand" href="<?php echo URLROOT; ?>/dashboards/index" style="padding: 0px; font-size: 14px; margin-right:0px;">
        <img class="img-responsive" style="padding: 1px; width: 14%; height: auto;" src="../public/img/mta.png"><?php echo SITENAME; ?></a>
      </div>

      
   <div class="col-md-10">
      <div class="collapse navbar-collapse" id="navbarsExampleDefault">
                  <!-- float-xs-right for ul --> <!-- float-right for div -->
        <ul class="navbar-nav ml-auto">
          <?php
              $roles = array('Data Entry For Self', 'Data Entry For Others Only', 'Data Entry Administrator');            
              if (hasPermission($roles) && (isUserPlan('1') || isUserPlan('3'))) {
          ?>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#"  role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Inspection Entry
            </a>
            <div class="dropdown-menu">
            <a class="dropdown-item" href="<?php echo URLROOT; ?>/general_inspections/index">General Inspection</a>
            <a class="dropdown-item" href="<?php echo URLROOT; ?>/speed_inspections/index">Speed Inspection</a>
            <a class="dropdown-item" href="<?php echo URLROOT; ?>/trainRide_inspections/index">Train Ride Inspection</a>

           <!--  <a class="dropdown-item" href="<?php echo URLROOT; ?>/general_inspections/get_ehost_data">EHOST DATA</a> -->

            </div>
          </li>
          <?php }  ?>
          
          <?php 
              $roles = array('Data Entry For Self', 'Data Entry For Others Only', 'Data Entry Administrator');   
              if (hasPermission($roles, "LIRR")) {
          ?>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#"  role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            MofE Inspection
            </a>
            <div class="dropdown-menu">
            <a class="dropdown-item" href="<?php echo URLROOT; ?>/operatingYard_inspections/index">Operating Yard Rules Inspection</a>
            <a class="dropdown-item" href="<?php echo URLROOT; ?>/carMover_inspections/index">Car Mover Inspection</a>
            <a class="dropdown-item" href="<?php echo URLROOT; ?>/Equipment_inspections/index">Equipment Safety Observations Inspection</a>
            </div>
          </li>
          <?php }  ?>
          

          <?php 
              $roles = array('Designated Instructor', 'Qualified Personnel');            
              if (hasPermission($roles)&& (isUserPlan('2') || isUserPlan('4'))) {
          ?>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#"  role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Training Evaluation
            </a>
            <div class="dropdown-menu">
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
              if (hasPermission($roles, 'MNR') && isUserPlan('1')) {
          ?>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#"  role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Reports
            </a>
            <div class="dropdown-menu">
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
              if (hasPermission($roles, 'LIRR') && isUserPlan('3')) {
                
          ?>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#"  role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Reports
            </a>
            <div class="dropdown-menu">
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
              if (hasPermission($roles, 'LIRR') && isUserPlan('4')) {

          ?>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#"  role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Training Reports
            </a>
            <div class="dropdown-menu">
              <a class="dropdown-item" href="#">LIRR Training menu item</a>
              <a class="dropdown-item" href="#">LIRR Training menu item</a>
              <a class="dropdown-item" href="#">LIRR Training menu item</a>
              <a class="dropdown-item" href="#">LIRR Training menu item</a>
              <a class="dropdown-item" href="#">LIRR Training menu item</a>
              <a class="dropdown-item" href="#">LIRR Training menu item</a>
            </div>
          </li>
          <?php } ?>

          <?php 
              $roles = array('View Reports');            
              if (hasPermission($roles, 'MNR') && isUserPlan('2')) {

          ?>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#"  role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Training Reports
            </a>
            <div class="dropdown-menu">
              <a class="dropdown-item" href="#">MNR Training menu item</a>
              <a class="dropdown-item" href="#">MNR Training menu item</a>
              <a class="dropdown-item" href="#">MNR Training menu item</a>
              <a class="dropdown-item" href="#">MNR Training menu item</a>
              <a class="dropdown-item" href="#">MNR Training menu item</a>
              <a class="dropdown-item" href="#">MNR Training menu item</a>
            </div>
          </li>
          <?php } ?>
            <?php if (isUserRole('User Administrator') || isUserRole('User Security Levels Administrator') || isUserRole('IT Administrator')){ ?>
            <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#"  role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            User Administration
            </a>
            <div class="dropdown-menu">

         
            <?php 
              $roles = array('User Administrator', 'User Security Levels Administrator');            
              if (hasPermission($roles)) {
            ?>
            
            <a class="dropdown-item" href="<?php echo URLROOT; ?>/TenentEmp_Adminstration/index">Tenent Employee Adminstration</a>
            <a class="dropdown-item" href="<?php echo URLROOT; ?>/user_data/index">User Administrator</a>
           
            <?php } ?>

            <!-- <a class="dropdown-item" href="<?php //echo URLROOT; ?>/user_level/index">User Security Levels</a> -->
            <?php if(isUserRole('IT Administrator')){ ?>
           
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
            <a class="nav-link dropdown-toggle" href="#"  role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Rules Administration
            </a>
            <div class="dropdown-menu">
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
            <a class="nav-link dropdown-toggle" href="#"  role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Table Data Administration
            </a>
            <div class="dropdown-menu">
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
            <a class="dropdown-item" href="<?php echo URLROOT; ?>/processroles_jobcodes/index">Process Roles-Job Codes</a>
            <!-- <a class="dropdown-item" href="#">Occupation Codes-Process Roles</a> -->
            <a class="dropdown-item" href="<?php echo URLROOT; ?>/entry_restrictions/index">Observation Date Entry Restrictions</a>
            <a class="dropdown-item" href="<?php echo URLROOT; ?>/entry_restrictions/index">Process Roles-Observation Counts</a>
            <!-- <a class="dropdown-item" href="<?php echo URLROOT; ?>/timeout/index">System Idle Timedout Time</a> -->
          
            </div>
          </li>
          <?php } ?>

        </ul>
         <ul class="navbar-nav ml-auto">
          <?php if(isset($_SESSION['user_id'])) : ?>
          <?php 
              $user_profile_data = "<strong>".$_SESSION['user_name']."</strong><br>";
              $user_profile_data .= "BSC ID: <strong>".$_SESSION['user_id']."</strong><br>";
              $user_profile_data .= "BUSINESS UNIT: <strong>".$_SESSION['user_business_unit']."</strong><br>";
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

      <button class="navbar-toggler ml-auto" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span> 
      </button>
     </nav> 
 </div>
  
<!-- /** User admin styles**/ -->

<style>
.col-half-offset{
    margin-left:1.5%;
}
.form-control{
      padding: 0.175rem .75rem !important;
}
.lablestyles{
  margin-bottom: 0px !important;
}
.btnstyles{
   margin-top: 22px;    
      padding: .275rem .75rem !important;
}
.btnspecialstyles{
    margin-top: 22px;    
    padding: 3.5px 25px 3.5px 25px !important;
}
.offsetdivstyles{
  margin-left:220px;
}
/*@media only screen and (min-width:375px ) and (max-width: 667px) {

#filter {
    margin-left: 48% !important;

  }
}*/

@media only screen and (min-width:320px ) and (max-width: 812px) {

.mobilefilter{
  width:50%;

}
.formcontrol{
  margin-bottom: 0.5rem !important;

}

  }
@media only screen and (min-width:414px ) and (max-width: 736px) {

  #filter {
    margin-left: 52% !important;
}



}

@media only screen and (min-width:320px ) and (max-width: 568px) {
#filter {
    margin-left: 38% ;
}
.management_center_id {
    max-width: none !important;
    }
    #clear{
  margin-left: 4%;
  margin-top: 10px !important;
 }
 #filter{
  margin-left:37%;
  margin-top: 10px !important;
 }
 .clrfltr{
  width: 50%
 }
  }

@media only screen and (min-width:375px ) and (max-width: 667px) {
.management_center_id {
    max-width: none !important;
    }

 #clear{
  margin-left: 4%;
  margin-top: 10px !important;
 }
 #filter{
  margin-left:47%;
  margin-top: 10px !important;

 }
 .clrfltr{
  width: 50%;
 
 }
  }
@media only screen and (min-width:768px ) and (max-width: 1024px) {
   .col-half-offset{
    margin-left:5.5%;
}
.offsetdivstyles {
    margin-left: -258px;
}
.btnspecialstyles{       
    padding: 3.5px 22px 3.5px 22px !important;
}
.management_center_id {
    max-width: 33% !important;
    }
    .formcontrol{
  margin-bottom: 0.5rem !important;

}

}
/*.management_center_id{
  max-width: 15% !important;
}*/
.paddingspace{
  padding: 0px 5px 0px 5px !important;
}
.statusselect{
  height: auto !important;
}

</style>