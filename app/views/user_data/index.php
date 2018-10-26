<?php require APPROOT . '/views/inc/header.php'; ?>
<h3>User Administration</h3>
<hr />
<style>
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
</style>
<form method="POST" action="../user_data/search" id="filterForm">
            <div class="row">
            <!-- <div class="usersearch"> -->
              <div class="col-xs-6 col-md-4 col-lg-2 bscid paddingspace">
                <div class="form-group formcontrol">
                  <label  for="BSC ID" class="lablestyles">BSC ID</label>
                  <input class="form-control autocomplete-input" id="f_bscid" name="f_bscid" type="text" autocomplete="off" placeholder="Enter BSC ID" value="<?php echo isset($data['input_data']['f_bscid']) ? $data['input_data']['f_bscid'] : ''; ?>">
                </div>
              </div>
              <div class="col-xs-6 col-md-4 col-lg-2 firstname paddingspace mobilefilter">
                 <div class="form-group formcontrol">
                  <label for="First Name"  class="lablestyles">First Name</label>
                  <input type="text" class="form-control autocomplete-input" id="f_first_name" name="f_first_name" placeholder="First Name" value="<?php echo isset($data['input_data']['f_first_name']) ? $data['input_data']['f_first_name'] : ''; ?>">
                </div>
              </div>
              <div class="col-xs-6 col-md-4 col-lg-2 lastname paddingspace mobilefilter">
                <div class="form-group formcontrol">
                  <label for="Last Name"  class="lablestyles">Last Name</label>
                  <input type="text" class="form-control autocomplete-input" id="f_last_name" name="f_last_name" placeholder="Last Name" value="<?php echo isset($data['input_data']['f_last_name']) ? $data['input_data']['f_last_name'] : ''; ?>">
                </div>
              </div>
              <div class="col-lg-1 col-md-4 col-sm-12  jobcode paddingspace mobilefilter">
                <div class="form-group formcontrol">
                  <label for="Job Code"  class="lablestyles">Job Code</label>
                  <input type="text" class="form-control autocomplete-input" id="f_job_code" name="f_job_code" placeholder="Job Code" value="<?php echo isset($data['input_data']['f_job_code']) ? $data['input_data']['f_job_code'] : ''; ?>">
                </div>
                <!-- </div> -->
              </div>
              <div class="col-lg-2 col-md-4 col-xs-12 management_center_id paddingspace mobilefilter" style="max-width: 15%">
                <div class="form-group formcontrol">
                  <label for="MGMT CTR ID"  class="lablestyles">Management Center ID</label>
                  <input class="form-control autocomplete-input" id="f_mgmt_ctr_id" name="f_mgmt_ctr_id" type="text" autocomplete="off" placeholder="Management Center ID" value="<?php echo isset($data['input_data']['f_mgmt_ctr_id']) ? $data['input_data']['f_mgmt_ctr_id'] : ''; ?>">
                </div>
              </div>
              <!-- <div class="col-lg-2 col-md-4 col-xs-12 Permissions paddingspace mobilefilter">
                  <div class="form-group formcontrol">
                  <label for="Permissions" class="lablestyles">Permissions</label>
                  <-- <input type="text" class="form-control autocomplete-input" id="f_permissions" name="f_permissions" placeholder="Permissions"> 
                #TODO Dynamic roles 
                  --

                  <select name="f_user_role" id="f_user_role" class="form-control statusselect">
                    <option value="">Select</option>
                    <option value="">Data Entry For Self</option>
                    <option value="">Data Entry For Others Only</option>
                    <option value="">Designated Instructor</option>
                    <option value="">Qualified Personnel</option>
                    <option value="">Rules Administrator</option>
                    <option value="">View Reports</option>
                    <option value="">Data Entry Administrator</option>
                    <option value="">Table Data Administrator</option> 
                    <option value="">User Administrator</option> 
                  </select>                   
                </div>
              </div> -->
              <!--
                #TODO dynamic status
                --->
              <div class="col-lg-1 col-md-4 col-xs-12 status paddingspace mobilefilter">
                 <div class="form-group formcontrol">
                  <label for="status" class="lablestyles">status</label>
                  <select name="f_status" id="f_status" class="form-control statusselect">
                    <option value="">Select</option>
                    <option value="ACTIVE">ACTIVE</option>
                    <option value="INACTIVE">INACTIVE</option> 
                    </select>                
                </div>
              </div>
            </div>
            <div class="row">

                <div class="offset-lg-8 col-lg-2 offset-md-2 col-md-4 col-xs-12 text-center">
                    <input name="newTestingOfficerButton" id="newTestingOfficerButton" type="button" class="btn btn-primary btnstyles" data-toggle="modal" data-target="#newTestingOfficerModal" value="Add New Testing Officer">
                </div>
                <div class="col-lg-1 col-md-2 col-sm-6 col-xs-6 paddingspace clrfltr">
                    <input name="filter" id="filter" type="submit" class="btn btn-primary btnspecialstyles"  value="Filter">
                </div>
                <div class="col-lg-1 col-md-3 col-sm-6 col-xs-6 paddingspace clrfltr">
                    <input name="clear" id="clear" type="button" class="btn btn-primary btnspecialstyles f_reset" style="background-color: #31b0d5" value="Clear">
                </div>


            </div>
</form> 
<hr />

<div class="row">
  <div class="col-md-12">
      <table class="table table-bordered table-responsive table-striped table-sm users-data-users">
        <thead class="thead-dark" >
          <tr>
            <th scope="col">Modify</th>
            <th scope="col">BSC ID</th>
            <th scope="col">Name</th>
            <th scope="col">Business Unit</th>
            <th scope="col">Deparment</th>
            <th scope="col">Job Code</th>
            <th scope="col">Job Description</th>
            <th scope="col">Position Number</th>
            <th scope="col">Position Description</th>
            <th scope="col">Process Role</th>
            <th scope="col">Management Center ID</th>
            <th scope="col">User Permision(s)</th>
            <th scope="col">Status</th>
          </tr>
        </thead>
        <tbody>
          <?php $users = $data['users']; ?>
          <?php if(is_array($users) && count($users)) { ?>
            <?php foreach($users as $user) { ?>
              <?php //for ($i=0; $i < count($users['BSC_EMPLID']) ; $i++) {  ?>
                <tr>
                  <td class="updateTestingOfficerModal">
                    <a href="javascript:void(0);">
                      <i class="fas fa-pen"></i>  
                    </a>
                  </td>
                  <td><?php echo $user['BSC_EMPLID']; ?></td>
                  <td><?php echo $user['FULL_NAME']; ?></td>
                  <td><?php echo $user['BUSINESS_UNIT']; ?></td>
                  <td><?php echo $user['DEPT_DESCR']; ?></td>
                  <td><?php echo $user['JOBCODE']; ?></td>
                  <td><?php echo $user['JOBCODE_DESCR']; ?></td>

                  <td><?php echo !empty($user['POSITION_NBR']) ? $user['POSITION_NBR'] : '-'; ?></td>
                  <td><?php echo !empty($user['POSITION_DESC']) ? $user['POSITION_DESC'] : '-'; ?></td>

                  <td><?php //echo $user['JOBCODE_DESCR']; ?> - </td>
                  <td><?php echo !empty($user['MGT_CTR']) ? $user['MGT_CTR'] : '-'; ?></td>
                  <td>
                    <?php
                    if (isset($user['ROLES'])  && count($user['ROLES'])) {
                      $i = 1;
                      foreach ($user['ROLES'] as $ses_roles) {
                        echo $i.") ".$ses_roles."<br>";
                        $i++;
                      }
                    }
                    ?>

                  </td>
                  <td><?php echo $user['STATUS']; ?></td>
                </tr>
              <?php  } ?>      
            <?php  } ?>
          </tbody>
        </table>
     <!--  <div class="col-md-12">
        <div class="text-center"> 
          <input name="newTestingOfficerButton" id="newTestingOfficerButton" type="button" class="btn btn-primary" data-toggle="modal" data-target="#newTestingOfficerModal" style="margin-top: 10px;" value="Add New Testing Officer">
        </div>
      </div> -->
    </div>
  </div>




  <!-- Modal -->
  <div class="modal fade" id="newTestingOfficerModal" tabindex="-1" role="dialog" aria-labelledby="newTestingOfficerLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="newTestingOfficerLabel" style="">Add New Testing Officer</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form class="form" name="newTestingOfficerForm" id="newTestingOfficerForm">
          <div class="modal-body">

            <div class="row">
              <div class="col-md-12 status_message_div">

              </div>
              <div class="col-md-6">
                <div class="form-group form-inline">
                  <label class="col-md-5" for="BSC ID">BSC ID</label>
                  <input class="form-control col-md-7" id="bscid" name="bscid" type="text" autocomplete="off" placeholder="Enter BSC ID">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group form-inline">
                  <label for="Name" class="col-md-5">Name</label>
                  <input type="text" class="form-control col-md-7" id="name" name="name" placeholder="Name">
                  <span id="updateToHiddenSpan">

                  </span>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">

                <div class="form-group form-inline">
                  <label class="col-md-5" for="BSC ID">Department</label>
                  <input class="form-control col-md-7" id="department" name="department" type="text" placeholder="" disabled="disabled">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group form-inline">
                  <label for="Name" class="col-md-5">Business Unit</label>
                  <input type="text" class="form-control col-md-7" id="business_unit" name="business_unit" placeholder="" disabled="disabled">
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-6">

                <div class="form-group form-inline">
                  <label class="col-md-5" for="BSC ID">Management Center ID</label>
                  <input class="form-control col-md-7" id="management_center_id" name="management_center_id" type="text" placeholder="" disabled="disabled">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group form-inline">
                  <label for="Name" class="col-md-5">Job Code</label>
                  <input type="text" class="form-control col-md-7" id="jobcode" name="jobcode" placeholder="" disabled="disabled">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">

                <div class="form-group form-inline">
                  <label class="col-md-5" for="BSC ID">Position Number</label>
                  <input class="form-control col-md-7" id="position_number" name="position_number" type="text" placeholder="" disabled="disabled">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group form-inline">
                  <label for="Name" class="col-md-5">Status</label>
                  <!-- <input type="text" class="form-control col-md-7" id="status" name="status" placeholder=""> -->
                  <select name="status" id="status" class="form-control col-md-7">
                    <option value="ACTIVE">ACTIVE</option>
                    <option value="INACTIVE">INACTIVE</option>
                  </select>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">

                <div class="form-group form-inline">
                  <label class="col-md-5" for="BSC ID">Status Validity</label>
                  <!--  <input class="form-control col-md-7" id="status_validity" name="status_validity" type="text" placeholder=""> -->
                  <select name="status_validity" id="status_validity" class="form-control col-md-7">
                    <option value="MDS">MDS</option>
                    <option value="NEVER EXPIRE">NEVER EXPIRE</option>
                    <option value="EFFECTIVE UNTILL">EFFECTIVE UNTILL</option>
                  </select>

                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group form-inline">
                  <label class="col-md-5 status_validity_end_date" for="status validity end date">End Date</label>
                  <input name="end_date" class="form-control col-md-7 status_validity_end_date date" data-date-container='#end_date' id="end_date" type="text" placeholder="MM/DD/YY">
                  <div class="date_container"></div>

                  
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6 user-roles-left me-yes">                  
              </div>
              <div class="col-md-6 user-roles-right me-no">
              </div>
            </div>




          </div>
          <div class="modal-footer"> 
            <div class="container">
              <div class="form-group row">
                <div class="col-md-2 offset-md-3">
                  <button type="submit" name="newToSubmit" id="newToSubmit" class="btn btn-primary btn-sm btn-block">Save</button>
                </div>
                <div class="col-md-2">
                 <button type="button" name="newToReset" id="newToReset" class="btn btn-primary btn-sm btn-block line_reset">Reset</button>
               </div>
               <div class="col-md-2">
                 <button type="button" class="btn btn-primary btn-sm btn-block" data-dismiss="modal">Cancel</button>
               </div>
             </div> 
           </div>
         </div>


       </form>


     </div>
   </div>
 </div>


 <?php require APPROOT . '/views/inc/footer.php'; ?>