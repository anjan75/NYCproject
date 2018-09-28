<?php require APPROOT . '/views/inc/header.php'; ?>
<h3>User Data Administration</h3>
<hr />
<form  action="">
  <div class="row">
    <div class="col-md-5">
       <div class="form-group form-inline">
          <label class="col-md-4">Testing Officer</label>
          <input type="" class="col-md-8 form-control" id="" name="">
       </div>
    </div>
    <div class="col-md-4"></div>
    <div class="col-md-3 text-right">
         <button id="" name="" class="ml-auto btn btn-primary" style="width:40%;margin: 0% 2% 0% 2%;">Filter</button>  
        <button id="" name="" class="ml-auto btn btn-primary" style="width:40%;margin: 0% 2% 0% 2%;">Clear</button>
    </div>
  </div>
  <hr />
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
  
      <?php /*$users = $data['users']; ?>
      <?php if(is_array($users) && count($users)) { ?>
      <?php foreach($users as $user) { ?>
          <tr>
            <td scope="row" class="updateTestingOfficerModal">
              <a href="javascript:void(0);">
                <i class="fas fa-pen"></i>  
              </a>
            </td>
            <td><?php echo $user['BSC_EMPLID']; ?></td>
            <td><?php echo $user['FIRST_NAME']." ".$user['LAST_NAME'];?></td>
            <td><?php echo $user['BUSINESS_UNIT']; ?></td>
            
            <td><?php echo $user['DEPARTMENT_ID']; ?></td>
            <td><?php echo $user['JOBCODE']; ?></td>
            <td><?php echo $user['JOBCODE_DESCR']; ?></td>
           
            <td>-</td>
            <td>-</td>
            <td>-</td>
            <td><?php echo $user['DEPTID']; ?></td>
            <td>
                <?php
                      if (isset($user['roles'])  && count($user['roles'])) {
                        $i = 1;
                        foreach ($user['roles'] as $ses_roles) {
                          echo $i.") ".$ses_roles['ROLE_CODE']."<br>";
                          $i++;
                        }
                      }
                ?>
                
            </td>
            <td>Active</td>
          </tr>
    <?php  } ?>      
    <?php  }*/ ?>
    
  </table>

  <div class="text-center"> 
        <input type="button" class="btn btn-primary" data-toggle="modal" data-target="#newTestingOfficerModal" style="margin-top: 10px;" value="Add New Testing Officer">
    </div>

</form>



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
                  <label class="col-md-5" for="BSC ID">Status Validity</label>
                  <!--  <input class="form-control col-md-7" id="status_validity" name="status_validity" type="text" placeholder=""> -->
                  <select name="status_validity" id="status_validity" class="form-control col-md-7">
                      <option value="NEVER EXPIRE">NEVER EXPIRE</option>
                      <option value="EXPIRE">EXPIRE</option>
                  </select>

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
               <button type="button" name="newToReset" id="newToReset" class="btn btn-secondary btn-sm btn-block line_reset">Reset</button>
            </div>
            <div class="col-md-2">
               <button type="button" class="btn btn-secondary btn-sm btn-block" data-dismiss="modal">Cancel</button>
            </div>
          </div> 
        </div>
      </div>
        

      </form>


    </div>
  </div>
</div>




<?php require APPROOT . '/views/inc/footer.php'; ?>