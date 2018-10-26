<?php require APPROOT . '/views/inc/header.php'; ?>
<h3>Speed Inspection Entry</h2>
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
<hr />
  <form name="siform" id="siform">
    <div class="row">
    <div class="col-lg-4 col-md-6">
      <div class="form-group form-inline formcontrol">
        <label class="col-md-5 lableforminline" for="">Testing Officer</label>
         <?php 
         $roles = array('Data Entry For Others Only');            
              if (hasPermission($roles)) {
        ?>
        <input type="text" class="form-control col-md-5 autocomplete-input" id="si_bsc_id" name="si_bsc_id" value="">
        <?php }else{ ?>
        <input type="text" class="form-control col-md-5" id="si_bsc_id_show" name="si_bsc_id_show" value="<?php echo $data['si_bsc_id']; ?>" disabled>
        <input type="hidden" class="form-control col-md-5" id="si_bsc_id" name="si_bsc_id" value="<?php echo $data['si_bsc_id']; ?>">
        <?php } ?>
      </div>
    </div>
  </div>
     <div class="row">
       <div class="col-lg-4 col-md-6">
         <div class="form-group form-inline formcontrol">
            <label class="col-md-5 lableforminline" for="">Railroad</label>
            <select class="col-md-5 form-control select-single " name="si_rail_road" id="si_rail_road">
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
     <input type="text" class="form-control col-md-5" id="si_crew_number" name="si_crew_number">
    </div>
       </div>
       <div class="col-lg-4 col-md-6">
         <div class="form-group form-inline formcontrol">
    <label class="col-md-5 lableforminline" for="">Train Number</label>
    <input type="text" class="form-control col-md-5" id="si_train_number" name="si_train_number">
    </div>
       </div>
       <div class="col-lg-4 col-md-6">
        <div class="form-group form-inline formcontrol">
          <label class="col-md-5 lableforminline" for="">Observed Employee</label>
          <input type="text" class="form-control col-md-5 autocomplete-input" id="si_observed_employee" name="si_observed_employee">
        </div>
       </div>
       <div class="col-lg-4 col-md-6">
         <div class="form-group form-inline formcontrol">
  <label class="col-md-5 lableforminline" for="">Department</label>
    <input type="text" class="form-control col-md-5" id="si_department" name="si_department">
    </div>
       </div>
      <div class="col-lg-4 col-md-6">
        <div class="form-group form-inline formcontrol">
          <label class="col-md-5 lableforminline" for="">Job Description</label>
          <input type="text" class="form-control col-md-5" id="si_job_description" name="si_job_description" />
          <input type="hidden" id="si_jobcode_id" name="si_jobcode_id" value="" />
        </div>
      </div>
    </div>
  </form>
 <hr />

    <table class="table table-bordered table-striped table-sm speed-inspection">
    <thead class="thead-dark" >
    <tr>
      <th scope="col">Obs#</th>
      <th scope="col">Modify</th>
      <th scope="col">Delete</th>
      <th scope="col">Date</th>
      <th scope="col">Time</th>
      <th scope="col">Rule</th>
      <th scope="col">Result</th>
    </tr>
    </thead>
    <tbody>
  
       <?php 
      if (isset($data['sif_observations']) && is_array($data['sif_observations'])) {
        foreach ($data['sif_observations'] as $gio_key => $gio) {
          $gio_key = $gio_key+1;
          if (isset($gio['sif_result_value']) && !empty($gio['sif_result_value'])) {
              $sif_result_value = $gio['sif_result_value'];
          }else{
              $sif_result_value = 'Complaint';
          }
    ?>
        <tr>
          <td scope="row" id="ob"><?php echo $gio_key; ?></td>
          <td><a href="#" data-toggle="modal" data-target="#si_modal"><i class="fas fa-pen"></i></a></td>
          <td><a href="#" class="btnDelete"><i class="far fa-trash-alt"></i></a></td>
          <td><?php echo date("m/d/y", strtotime($gio['sif_date'])); ?></td>
          <td>
              <?php 
              if ($_SESSION['user_business_unit'] == 'MNR') {
                echo date("H:i", strtotime($gio['sif_date']));; 
              }else{
                echo date("h:i A", strtotime($gio['sif_date']));; 
              }
              ?>
          </td>
          <td><?php echo @$gio['sif_rule_code']; ?></td>
          <td><?php echo $sif_result_value; ?></td>
        </tr>
    <?php 
        }
      }
     ?>
      
    </tbody>
    </table>
    <!-- Modal -->
    <div class="modal fade bd-example-modal-lg" id="si_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Observation</h5>
              </div>
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Obs-Emp Name(BSC ID)</h5>
              </div>
              <!-- Speed inspection form - sif -->
              <form class="sif" id="sif">
              <div class="modal-body">
                <div class="container-fluid">
                  <div class="form-group">
                  <div class="row">
                    <label class="col-md-3 text-right" for="">Date</label>
                    <input type="text" class="col-md-3 form-control" id="sif_date" name="sif_date" value="<?php echo date("m/d/Y"); ?>" placeholder="m/d/yyyy" required>
                    <label class="col-md-2 text-right" for="">Time</label>
                    <input type="text" class="col-md-4 form-control time12" id="sif_time" name="sif_time" required>
                  </div>
                </div>

                <div class="form-group">
                  <div class="row">
                     <?php if($_SESSION['user_business_unit'] == 'MNR'){ ?>
                        <label class="col-md-2 text-right" for="Line">Line</label>
                        <select class="col-md-4 form-control" name="sif_line" id="sif_line" required>
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
                    
                   <label class="col-md-3 text-right" for="">Location Type</label>
                    <select class="col-md-3 form-control" name="sif_location_type" id="sif_location_type" required>
                    <option value=""></option>
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
                    <label class="col-md-3 text-right" for="">Location</label>
                    <select class="col-md-3 form-control selectboxheight" name="sif_location" id="sif_location" required>
                    <option value=""></option>
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
                    <select class="col-md-4 form-control selectboxheight" name="sif_milepost" id="sif_milepost">
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
                    <label class="col-md-3 text-right" for="">Track Designation</label>
                    <select class="col-md-3 form-control selectboxheight" name="sif_track" id="sif_track">
                    <option value=""></option>
                    <?php if(isset($data['tracks']) && is_array($data['tracks']) && count($data['tracks']) > 0){
                          $i=0;
                          for ($i = 0; $i < count($data['tracks']); $i++){
                    ?>
                    <option value="<?php echo $data['tracks']['TRACK_DESIGNATION_ID'][$i]; ?>"><?php echo $data['tracks']['DESCRIPTION'][$i]; ?></option>
                    <?php 
                          }
                        }
                    ?>
                    </select>
                    
                    <label class="col-md-3 text-right" for="">Engine Number</label>
                    <input type="text" class="col-md-3 form-control" id="sif_engine" name="sif_engine" required>
                  </div>
                </div>

                 <div class="form-group">
                  <div class="row">
                    <label class="col-md-3 text-right" for="">Observed Speed</label>
                    <input type="text" class="col-md-3 form-control" id="sif_observed_speed" name="sif_observed_speed">
                    <label class="col-md-3 text-right" for="">Posted Speed</label>
                    <input type="text" class="col-md-3 form-control" id="sif_post_speed" name="sif_post_speed">
                  </div>
                </div><div class="form-group">
                  <div class="row">
                    <label class="col-md-4 text-right" for="">Observed Speed Source</label>
                    <input type="text" class="col-md-2 form-control" id="sif_observed_speed_sourse" name="sif_observed_speed_sourse">
                  </div>
                </div>

                 <div class="form-group">
                  <div class="row">
                 <label class="col-md-3 text-right" for="">Type of Observation</label>
                    <div class="form-check form-check-inline col-md-4">

                      <?php if($_SESSION['user_business_unit'] == 'MNR'){ ?>
                      <label class="form-check-label col-md-8 text-right" for="inlineRadio1">Direct</label>
                      <input class="form-check-input col-md-1" type="radio" name="sif_observation" id="sif_observation1" value="direct" checked >
                      <?php }elseif ($_SESSION['user_business_unit'] == 'LIRR'){ ?>
                      <label class="form-check-label col-md-8 text-right" for="inlineRadio1">Observed</label>
                      <input class="form-check-input col-md-1" type="radio" name="sif_observation" id="sif_observation1" value="observed" checked>
                      <?php } ?>

                      
                    </div>
                    <div class="form-check form-check-inline col-md-4">
                       <?php if($_SESSION['user_business_unit'] == 'MNR'){ ?>
                      <label class="form-check-label col-md-8" for="inlineRadio2">Indirect</label>
                      <input class="form-check-input col-md-1" type="radio" name="sif_observation" id="sif_observation2" value="indirect">
                      <?php }elseif ($_SESSION['user_business_unit'] == 'LIRR'){ ?>
                       <!--non-Observed  -->
                      <label class="form-check-label col-md-8 text-right" for="inlineRadio2">Non-Observed</label>
                      <input class="form-check-input col-md-1" type="radio" name="sif_observation" id="sif_observation2" value="non_observed">
                      <?php } ?>
                     
                    </div>

                  </div>
                </div>
                <div class="form-group">
                  <div class="row">
                    <div class="form-check">
                      <label class="form-check-label" for="defaultCheck1"  style="margin-right: 40px;float: left;">Monthly Test</label>
                      <input class="form-check-input" type="checkbox" value="" id="defaultCheck1" checked>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                    <div class="row">
                    <label class="col-md-2 text-right" for="">Task</label>
                   
                    <select class="col-md-10 form-control selectboxheight" name="sif_task" id="sif_task" required>
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
                    <!-- <label class="col-md-2 text-right" for="">Rule</label>
                    <input type="text" class="col-md-10 form-control" id="" name=""> -->
                    <label class="col-md-2 text-right" for="">Rule</label>
                    <select class="col-md-10 form-control selectboxheight" name="sif_rule" id="sif_rule" required>
                      
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
                             <input name="sif_result" class="form-check-input col-md-3" id="sif_result1" type="radio" value="compliant" required>
                          </div>
                          <div class="form-check">
                             <label class="form-check-label col-md-9" for="exampleRadios3">Non-Compliant</label>
                             <input name="sif_result" class="form-check-input col-md-3" id="sif_result2"  type="radio" value="non_compliant">
                          </div> 
                     </div>
                    <?php if ($_SESSION['user_business_unit'] == 'LIRR'){ ?>
                     <div class="col-md-6 sif_non_compliant_div" style="right: 20px; display: none;">

                         <div class="form-check">
                             <label class="form-check-label col-md-9" for="non_compliant">Reviewed/Reinstructed</label>
                             <input name="sif_non_compliant" class="form-check-input col-md-3" id="sif_non_compliant1" type="radio" value="reviewed">
                          </div>
                          <div class="form-check">
                             <label class="form-check-label col-md-9" for="exampleRadios6">Failed/Discused</label>
                             <input name="sif_non_compliant" class="form-check-input col-md-3" id="sif_non_compliant2" type="radio" value="failed">
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
                  <textarea class="form-control col-md-10" rows="3" id="sif_comment" name="sif_comment"></textarea>
                </div>
                </div>

                </div>
              </div>
              <div class="modal-footer">
                <div class="container">
                  <div class="form-group row">
                    <div class="col-md-2 offset-md-4">
                <!-- <button type="button" class="btn btn-secondary text-center" data-dismiss="modal">Close</button> -->
                    <!-- <button type="submit" class="btn btn-secondary sif_submit_button" data-dismiss="modal">Close</button> -->
                  <input type="submit" class="btn btn-primary btn-sm btn-block sif_submit_button" value="Save" />
                   </div>
                  <div class="col-md-2">
                  <!-- <input type="submit" class="btn btn-secondary sif_submit_button" value="Close" /> -->
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
    <!--             <a href="" class="btn btn-primary" role="button" data-toggle="modal" data-target="#exampleModal">Add Observation</a>
                <a href="" class="btn btn-primary" role="button">Submit</a>
                <a href="" class="btn btn-primary" role="button">Start New Inspection</a>
                <a href="" class="btn btn-primary" role="button">Replicate Inspection</a>
                <a href="mylink.php" class="btn btn-primary" role="button">Cancel</a> -->
                <a href="javascript:void(0);" class="btn btn-primary add_observation_buttion" role="button" >Add Observation</a>
                    <a href="javascript:void(0);" class="btn btn-primary submit_si_inspection">Submit</a>
                    <a href="javascript:void(0);" class="btn btn-primary submit_new_si_inspection" role="button">Start New Inspection</a>
                    <a href="javascript:void(0);" class="btn btn-primary" role="button">Replicate Inspection</a>
                    <a href="javascript:void(0);" class="btn btn-primary" role="button">Cancel</a>
                
       </div>

   <!-- <div class="row">
      <div class="col-md-2">
        <input type="button" class="add-row btn btn-primary" style="margin-top: 10px;" value="Add Observation">
      </div>
      <div class="col-md-2">
        <button id="" name="" class="btn btn-primary" style="margin-top: 10px;">Submit Inspection</button> 
      </div>
      <div class="col-md-2">
        <button id="" name="" class="btn btn-primary" style="margin-top: 10px;">Start New Inspection</button> 
      </div>
      <div class="col-md-2">
        <button id="" name="" class="btn btn-primary" style="margin-top: 10px; margin-left: 20px;">Replicate Inspection</button> 
      </div>
      <div class="col-md-2">
        <button id="" name="" class="btn btn-primary" style="margin-top: 10px; margin-left: 30px;">Cancel</button> 
      </div>
     </div>
     -->


</form>
<?php require APPROOT . '/views/inc/footer.php'; ?>