<?php require APPROOT . '/views/inc/header.php'; ?>
<style type="text/css">
.lableforminline{
    text-align: center;
    justify-content: flex-end !important; 
    }
.form-control{
      padding: 0.175rem .75rem !important;

    }
.formcontrol{
  margin-bottom: 0.5rem !important;
}
.selectboxheight{
  height:auto !important;
}
</style>

<h3>Train Ride Inspection Entry</h3>
<hr />
<form name="tiform" id="tiform">
  <div class="row">
    <div class="col-lg-4 col-md-6">
      <div class="form-group form-inline formcontrol">
        <label class="col-md-5 lableforminline" for="">Testing Officer</label>

        <?php 
         $roles = array('Data Entry For Others Only');            
              if (hasPermission($roles)) {
        ?>
        <input type="text" class="form-control col-md-5 autocomplete-input" id="ti_bsc_id" name="ti_bsc_id" value="">
        <?php }else{ ?>
        <input type="text" class="form-control col-md-5" id="ti_bsc_id_show" name="ti_bsc_id_show" value="<?php echo $data['ti_bsc_id']; ?>" disabled>
        <input type="hidden" class="form-control col-md-5" id="ti_bsc_id" name="ti_bsc_id" value="<?php echo $data['ti_bsc_id']; ?>">
        <?php } ?>
      </div>
    </div>
  </div>
     <div class="row">
       <div class="col-lg-4 col-md-6">
         <div class="form-group form-inline formcontrol">
            <label class="col-md-5 lableforminline" for="">Railroad</label>
            <select class="col-md-5 form-control select-single" name="ti_rail_road" id="ti_rail_road">
            <option value=""></option>
            <?php if(isset($data['railroads']) && is_array($data['railroads']) && count($data['railroads']) > 0){ 
                  $i=0;
                  for ($i = 0; $i < count($data['railroads']['DESCRIPTION']); $i++){ 
            ?>
            <option value="<?php echo $data['railroads']['RAILROAD_ID'][$i]; ?>"><?php echo $data['railroads']['DESCRIPTION'][$i]; ?></option>
            <?php 
                  } 
                } 
            ?>
            </select>
            </div>
       </div>
       <div class="col-lg-4 col-md-6">
         <div class="form-group form-inline formcontrol">
     <label class="col-md-5 lableforminline" for="">Crew Number</label>
     <input type="text" class="form-control col-md-5" id="ti_crew_number" name="ti_crew_number">
    </div>
       </div>
       <div class="col-lg-4 col-md-6">
         <div class="form-group form-inline formcontrol">
    <label class="col-md-5 lableforminline" for="">Train Number</label>
    <input type="text" class="form-control col-md-5" id="ti_train_number" name="ti_train_number">
    </div>
       </div>
       <div class="col-lg-4 col-md-6">
        <div class="form-group form-inline formcontrol">
          <label class="col-md-5 lableforminline" for="">Observed Employee</label>
          <input type="text" class="form-control col-md-5 autocomplete-input" id="ti_observed_employee" name="ti_observed_employee">
        </div>
       </div>
       <div class="col-lg-4 col-md-6">
        <div class="form-group form-inline formcontrol">
          <label class="col-md-5 lableforminline" for="">Department</label>
          <input type="text" class="form-control col-md-5" id="ti_department" name="ti_department">
          <input type="hidden"  id="ti_department_id" name="ti_department_id">
        </div>
       </div>
       <div class="col-lg-4 col-md-6">
        <div class="form-group form-inline formcontrol">
  <label class="col-md-5 lableforminline" for="">Job Description</label>
    <input type="text" class="form-control col-md-5" id="ti_job_description" name="ti_job_description">
    <input type="hidden" id="ti_jobcode_id" name="ti_jobcode_id" value="">
    </div>
       </div>
    </div>
</form>

    <hr />

    <table class="table table-bordered table-striped table-sm train-inspection">
    <thead class="thead-dark" >
    <tr>
      <th scope="col" style="width: 5%">Obs#</th>
      <th scope="col" style="width: 5%">Modify</th>
      <th scope="col" style="width: 5%">Delete</th>
      <th scope="col" style="width: 10%; text-align: center;">Date</th>
      <th scope="col" style="width: 10%; text-align: center;">Time</th>
      <th scope="col" style="text-align: center;">Rule</th>
      <th scope="col" style="width: 10%; text-align: center;">Result</th>
    </tr>
    </thead>
    <tbody>
    <?php 
      if (isset($data['tif_observations']) && is_array($data['tif_observations'])) {
        foreach ($data['tif_observations'] as $gio_key => $gio) {
          $gio_key = $gio_key+1;
          if (isset($gio['tif_result_value']) && !empty($gio['tif_result_value'])) {
              $tif_result_value = $gio['tif_result_value'];
          }else{
              $tif_result_value = 'Complaint';
          }
    ?>
        <tr>
          <td scope="row" id="ob"><?php echo $gio_key; ?></td>
          <td><a href="#" data-toggle="modal" data-target="#ti_modal"><i class="fas fa-pen"></i></a></td>
          <td><a href="#" class="btnDelete"><i class="far fa-trash-alt"></i></a></td>
          <td><?php echo date("m/d/y", strtotime($gio['tif_date'])); ?></td>
          <td>
              <?php 
              if ($_SESSION['user_business_unit'] == 'MNR') {
                echo date("H:i", strtotime($gio['tif_date']));; 
              }else{
                echo date("h:i A", strtotime($gio['tif_date']));; 
              }
              ?>
          </td>
          <td><?php echo @$gio['tif_rule_code']; ?></td>
          <td><?php echo $tif_result_value; ?></td>
        </tr>
    <?php 
        }
      }
     ?>
    </tbody>
    </table>

      <!-- Modal -->
        <div class="modal fade bd-example-modal-lg" id="ti_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Observation</h5>
              </div>
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Obs-Emp Name(BSC ID)</h5>
              </div>
              <!-- Train inspection form - tif -->
              <form class="tif" id="tif">
              <div class="modal-body">
                <div class="container-fluid">
                 <div class="form-group">
                  <div class="row">
                    <label class="col-md-2 text-right" for="">Date</label>
                    <input type="text" class="col-md-4 form-control" id="tif_date" name="tif_date" value="<?php echo date("m/d/Y"); ?>" placeholder="m/d/yyyy" required>
                    <label class="col-md-2 text-right" for="">Time</label>
                    <input type="text" class="col-md-4 form-control time12" id="tif_time" name="tif_time" required>
                  </div>
                  </div>
                <!-- </div> -->
                <div class="form-group">
                  <div class="row">

                    <?php if($_SESSION['user_business_unit'] == 'MNR'){ ?>
                        <label class="col-md-2 text-right" for="Line">Line</label>
                        <select class="col-md-4 form-control" name="tif_line" id="tif_line" required>
                        <option value=""></option>
                        <?php if(isset($data['lines']) && is_array($data['lines']) && count($data['lines']) > 0){
                              $i=0;
                              for ($i = 0; $i < count($data['lines']['DESCRIPTION']); $i++){ 
                        ?>
                        <option value="<?php echo $data['lines']['LINE_ID'][$i]; ?>"><?php echo $data['lines']['DESCRIPTION'][$i]; ?></option>
                        <?php 
                              } 
                            } 
                        ?>
                        </select>
                    <?php } ?>




                    <label class="col-md-2 text-right" for="">Location Type</label>
                    <select class="col-md-4 form-control" name="tif_location_type" id="tif_location_type" required>
                    
                    <?php if(isset($data['location_types']) && is_array($data['location_types']) && count($data['location_types']) > 0){
                          $i=0;
                          for ($i = 0; $i < count($data['location_types']['DESCRIPTION']); $i++){ 
                    ?>
                    <option value="<?php echo $data['location_types']['LOCATION_TYPE_ID'][$i]; ?>"><?php echo $data['location_types']['DESCRIPTION'][$i]; ?></option>
                    <?php 
                          }
                        }
                    ?>
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <div class="row">
                    <label class="col-md-2 text-right" for="">Location</label>
                    <select class="col-md-4 form-control selectboxheight" name="tif_location" id="tif_location" required>
                    
                    <?php if(isset($data['locations']) && is_array($data['locations']) && count($data['locations']) > 0){
                          $i=0;
                          for ($i = 0; $i < count($data['locations']['DESCRIPTION']); $i++){ 
                    ?>
                    <option value="<?php echo $data['locations']['LOCATION_ID'][$i]; ?>"><?php echo $data['locations']['DESCRIPTION'][$i]; ?></option>
                    <?php 
                          } 
                        }
                    ?>
                    </select>
                    <label class="col-md-2 text-right" for="">Milepost</label>
                    <select class="col-md-4 form-control selectboxheight" name="tif_milepost" id="tif_milepost">
                    <option value=""></option>
                    <?php if(isset($data['mileposts']) && is_array($data['mileposts']) && count($data['mileposts']) > 0){
                          $i=0;
                          for ($i = 0; $i < count($data['mileposts']); $i++){ 
                    ?>
                    <option value="<?php echo $data['mileposts'][$i]['MILEPOST_ID']; ?>"><?php echo $data['mileposts'][$i]['DESCRIPTION']; ?></option>
                    <?php 
                          } 
                        }
                    ?>
                    </select>
                  </div>
                </div>
                 <div class="form-group">
                  <div class="row">
                 <label class="col-md-3" for="">Type of Observation</label>
                    <div class="form-check form-check-inline col-md-4">

                      <?php if($_SESSION['user_business_unit'] == 'MNR'){ ?>
                      <label class="form-check-label col-md-8 text-right" for="inlineRadio1">Direct</label>
                      <input class="form-check-input col-md-1" type="radio" name="tif_observation" id="tif_observation1" value="direct" checked >
                      <?php }elseif ($_SESSION['user_business_unit'] == 'LIRR'){ ?>
                      <label class="form-check-label col-md-8 text-right" for="inlineRadio1">Observed</label>
                      <input class="form-check-input col-md-1" type="radio" name="tif_observation" id="tif_observation1" value="observed" checked>
                      <?php } ?>

                      
                    </div>
                    <div class="form-check form-check-inline col-md-4">
                       <?php if($_SESSION['user_business_unit'] == 'MNR'){ ?>
                      <label class="form-check-label col-md-8" for="inlineRadio2">Indirect</label>
                      <input class="form-check-input col-md-1" type="radio" name="tif_observation" id="tif_observation2" value="indirect">
                      <?php }elseif ($_SESSION['user_business_unit'] == 'LIRR'){ ?>
                       <!--non-Observed  -->
                      <label class="form-check-label col-md-8 text-right" for="inlineRadio2">Non-Observed</label>
                      <input class="form-check-input col-md-1" type="radio" name="tif_observation" id="tif_observation2" value="non_observed">
                      <?php } ?>
                     
                    </div>

                  </div>
                </div>
                <?php if ($_SESSION['user_business_unit'] == 'LIRR'){ ?>
                <div class="form-group">
                  <div class="row">
                    <div class="form-check">
                      <label class="form-check-label text-right" for="Monthlytest" style="margin-right: 40px;float: left;">Monthly Test</label>
                      <input class="form-check-input" type="checkbox" value="tif_monthly_test" id="tif_monthly_test" name="tif_monthly_test" >
                    </div>
                  </div>
                </div>
                <?php } ?>
                <div class="form-group">
                    <div class="row">
                    <label class="col-md-2 text-right" for="">Task</label>
                   
                    <select class="col-md-10 form-control selectboxheight" name="tif_task" id="tif_task" required>
                    <option value=""></option>
                    <?php if(isset($data['tasks']) && is_array($data['tasks']) && count($data['tasks']) > 0){
                          $i=0;
                          for ($i = 0; $i < count($data['tasks']); $i++){
                    ?>
                    <option value="<?php echo $data['tasks'][$i]['TASK_ID']; ?>"><?php echo $data['tasks'][$i]['DESCRIPTION']; ?></option>
                    <?php 
                          } 
                        }
                    ?>
                    </select>
                    </div>
                </div>
                <div class="form-group">
                  <div class="row">
                    <label class="col-md-2 text-right" for="">Rule</label>
                    <select class="col-md-10 form-control selectboxheight" name="tif_rule" id="tif_rule" required>
                      
                    </select>
                  </div>
                </div>
                <div class="form-group">
                <div class="row">
                  <div class="col-md-2 text-right">
                    <label for="">Result</label>
                  </div>
                  <div class="col-md-10">
                    <div class="col-md-12">
                       <div class="row">
                         <div class="col-md-6" style="right: 20px">
                         <div class="form-check">
                             <label class="form-check-label col-md-9" for="exampleRadios2">Compliant</label>
                             <input name="tif_result" class="form-check-input col-md-3" id="tif_result1" type="radio" value="compliant" required>
                          </div>
                          <div class="form-check">
                             <label class="form-check-label col-md-9" for="exampleRadios3">Non-Compliant</label>
                             <input name="tif_result" class="form-check-input col-md-3" id="tif_result2"  type="radio" value="non_compliant">
                          </div> 
                     </div>
                    <?php if ($_SESSION['user_business_unit'] == 'LIRR'){ ?>
                     <div class="col-md-6 tif_non_compliant_div" style="right: 20px; display: none;">

                         <div class="form-check">
                             <label class="form-check-label col-md-9" for="non_compliant">Reviewed/Reinstructed</label>
                             <input name="tif_non_compliant" class="form-check-input col-md-3" id="tif_non_compliant1" type="radio" value="reviewed">
                          </div>
                          <div class="form-check">
                             <label class="form-check-label col-md-9" for="exampleRadios6">Failed/Discused</label>
                             <input name="tif_non_compliant" class="form-check-input col-md-3" id="tif_non_compliant2" type="radio" value="failed">
                          </div>
                     </div>
                    <?php } ?>

                       </div>
                </div>
                  </div>
                </div>
                </div>
                <div class="form-group">
                  <div class="row">
                  <label for="" class="col-form-label col-md-2 text-right">Comments:</label>
                  <textarea class="form-control col-md-10" rows="3" id="tif_comment" name="tif_comment"> </textarea>
                </div>
                </div> 

                </div>
              </div>
              <div class="modal-footer">
                 <div class="container">
                  <div class="form-group row">
                    <div class="col-md-2 offset-md-4">
                <!-- <button type="submit" class="btn btn-secondary tif_submit_button" data-dismiss="modal">Close</button> -->
                  <input type="submit" class="btn btn-primary btn-sm btn-block tif_submit_button" value="Save" />
                  <!-- <input type="submit" class="btn btn-secondary tif_submit_button" value="Close" /> -->
                  </div>
                  <div class="col-md-2">
                  <button type="button" class="btn btn-secondary btn-sm btn-block" data-dismiss="modal">Close</button>
                   </div>
                  </div>
                </div>
              </div>
            </form>

            </div>
          </div>
        </div>
        <div class="button-box col-md-12">
                    <a href="javascript:void(0);" class="btn btn-primary add_observation_button" role="button" >Add Observation</a>
                    <a href="javascript:void(0);" class="btn btn-primary submit_ti_inspection">Submit</a>
                    <a href="javascript:void(0);" class="btn btn-primary submit_new_ti_inspection" role="button">Start New Inspection</a>
                    <a href="javascript:void(0);" class="btn btn-primary" role="button">Replicate Inspection</a>
                    <a href="javascript:void(0);" class="btn btn-primary" role="button">Cancel</a>
        </div>



<?php require APPROOT . '/views/inc/footer.php'; ?>