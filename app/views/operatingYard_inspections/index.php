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


<h3>Operating Yard Rules Inspection Entry</h2>
<hr />
<!-- oi-- Operating Yard Rules Inspection Entry -->
  <form name="oiform" id="oiform">
  <div class="row">
    <div class="col-lg-4 col-md-6">
      <div class="form-group form-inline formcontrol">
        <label class="col-md-5 lableforminline" for="">Testing Officer</label>
        <input type="text" class="form-control col-md-5" id="oi_bsc_id_show" name="oi_bsc_id_show" value="<?php echo $data['oi_bsc_id']; ?>" disabled>
        <input type="hidden" class="form-control col-md-5" id="oi_bsc_id" name="oi_bsc_id" value="<?php echo $data['oi_bsc_id']; ?>">
      </div>
    </div>
  </div>
     <div class="row">
       <div class="col-lg-4 col-md-6">
         <div class="form-group form-inline formcontrol">
            <label class="col-md-5 lableforminline" for="">Railroad</label>
            <select class="col-md-5 form-control select-single" name="oi_rail_road" id="oi_rail_road">
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

       </div>
       <div class="col-lg-4 col-md-6">

       </div>
       <div class="col-lg-4 col-md-6">
        <div class="form-group form-inline formcontrol">
          <label class="col-md-5 lableforminline" for="">Observed Employee</label>
          <input type="" class="form-control col-md-5 autocomplete-input" id="oi_observed_employee" name="oi_observed_employee">
        </div>
       </div>
       <div class="col-lg-4 col-md-6">
        <div class="form-group form-inline formcontrol">
          <label class="col-md-5 lableforminline" for="">Department</label>
          <input type="text" class="form-control col-md-5" id="oi_department" name="oi_department">
          <input type="hidden"  id="oi_department_id" name="oi_department_id">
        </div>
       </div>
       <div class="col-lg-4 col-md-6">
        <div class="form-group form-inline formcontrol">
  <label class="col-md-5 lableforminline" for="">Job Description</label>
    <input type="text" class="form-control col-md-5" id="oi_job_description" name="oi_job_description">
    <input type="hidden" id="oi_jobcode_id" name="oi_jobcode_id">
    </div>
       </div>
    </div>
</form>
    <hr />

    <table class="table table-bordered table-striped table-sm operating-inspection">
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
      if (isset($data['oif_observations']) && is_array($data['oif_observations'])) {
        foreach ($data['oif_observations'] as $gio_key => $gio) {
          $gio_key = $gio_key+1;
          if (isset($gio['oif_result_value']) && !empty($gio['oif_result_value'])) {
              $oif_result_value = $gio['oif_result_value'];
          }else{
              $oif_result_value = 'Complaint';
          }
    ?>
        <tr>
          <td scope="row" id="ob"><?php echo $gio_key; ?></td>
          <td><a href="#" data-toggle="modal" data-target="#oi_modal"><i class="fas fa-pen"></i></a></td>
          <td><a href="#" class="btnDelete"><i class="far fa-trash-alt"></i></a></td>
          <td><?php echo date("m/d/y", strtotime($gio['oif_date'])); ?></td>
          <td>
              <?php 
              if ($_SESSION['user_business_unit'] == 'MNR') {
                echo date("H:i", strtotime($gio['oif_time']));; 
              }else{
                echo date("h:i A", strtotime($gio['oif_time']));; 
              }
              ?>
          </td>
          <td><?php echo @$gio['oif_rule_code']; ?></td>
          <td><?php echo $oif_result_value; ?></td>
        </tr>
    <?php 
        }
      }
     ?>
    </tbody>
    </table>

    <!-- Modal -->
        <div class="modal fade bd-example-modal-lg" id="oi_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Observation</h5>
              </div>
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Obs-Emp Name(BSC ID)</h5>
              </div>
              <!--   Operating Yard Rules Inspection Entry form - oif -->
              <form class="oif" id="oif">
              <div class="modal-body">
                <div class="container-fluid">
                 <div class="form-group">
                  <div class="row">
                    <label class="col-md-2 text-right" for="">Date</label>
                    <input type="text" class="col-md-4 form-control" id="oif_date" name="oif_date" value="<?php echo date("m/d/Y"); ?>" placeholder="m/d/yyyy" required>
                    <label class="col-md-2 text-right" for="">Time</label>
                    <input type="text" class="col-md-4 form-control time12" id="oif_time" name="oif_time" required>
                  </div>
                  </div>
                <!-- </div> -->
                <div class="form-group">
                  <div class="row">
                     <label class="col-md-2 text-right" for="">Location Type</label>
                    <select class="col-md-4 form-control" name="oif_location_type" id="oif_location_type" required>
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
                    <label class="col-md-2 text-right" for="">Location</label>
                    <select class="col-md-4 form-control selectboxheight" name="oif_location" id="oif_location" required>
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
                  </div>
                </div>
                 <div class="form-group">
                  <div class="row">
                 <label class="col-md-3" for="">Type of Observation</label>
                    <div class="form-check form-check-inline col-md-4">

                      <?php if($_SESSION['user_business_unit'] == 'MNR'){ ?>
                      <label class="form-check-label col-md-8 text-right" for="inlineRadio1">Direct</label>
                      <input class="form-check-input col-md-1" type="radio" name="oif_observation" id="oif_observation1" value="direct" checked >
                      <?php }elseif ($_SESSION['user_business_unit'] == 'LIRR'){ ?>
                      <label class="form-check-label col-md-8 text-right" for="inlineRadio1">Observed</label>
                      <input class="form-check-input col-md-1" type="radio" name="oif_observation" id="oif_observation1" value="observed" checked>
                      <?php } ?>

                      
                    </div>
                    <div class="form-check form-check-inline col-md-4">
                       <?php if($_SESSION['user_business_unit'] == 'MNR'){ ?>
                      <label class="form-check-label col-md-8" for="inlineRadio2">Indirect</label>
                      <input class="form-check-input col-md-1" type="radio" name="oif_observation" id="oif_observation2" value="indirect">
                      <?php }elseif ($_SESSION['user_business_unit'] == 'LIRR'){ ?>
                       <!--non-Observed  -->
                      <label class="form-check-label col-md-8 text-right" for="inlineRadio2">Non-Observed</label>
                      <input class="form-check-input col-md-1" type="radio" name="oif_observation" id="oif_observation2" value="non_observed">
                      <?php } ?>
                     
                    </div>

                  </div>
                </div>
                <?php if ($_SESSION['user_business_unit'] == 'LIRR'){ ?>
                <div class="form-group">
                  <div class="row">
                    <div class="form-check">
                      <label class="form-check-label text-right" for="Monthlytest" style="margin-right: 40px;float: left;">Monthly Test</label>
                      <input class="form-check-input" type="checkbox" value="oif_monthly_test" id="oif_monthly_test" name="oif_monthly_test" >
                    </div>
                  </div>
                </div>
                <?php } ?>
                <div class="form-group">
                    <div class="row">
                    <label class="col-md-2 text-right" for="">Task</label>
                   
                    <select class="col-md-10 form-control selectboxheight" name="oif_task" id="oif_task" required>
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
                    <select class="col-md-10 form-control selectboxheight" name="oif_rule" id="oif_rule" required>
                      
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
                             <input name="oif_result" class="form-check-input col-md-3" id="oif_result1" type="radio" value="compliant" required>
                          </div>
                          <div class="form-check">
                             <label class="form-check-label col-md-9" for="exampleRadios3">Non-Compliant</label>
                             <input name="oif_result" class="form-check-input col-md-3" id="oif_result2"  type="radio" value="non_compliant">
                          </div> 
                     </div>
                    <?php if ($_SESSION['user_business_unit'] == 'LIRR'){ ?>
                     <div class="col-md-6 oif_non_compliant_div" style="right: 20px; display: none;">

                         <div class="form-check">
                             <label class="form-check-label col-md-9" for="non_compliant">Reviewed/Reinstructed</label>
                             <input name="oif_non_compliant" class="form-check-input col-md-3" id="oif_non_compliant1" type="radio" value="reviewed">
                          </div>
                          <div class="form-check">
                             <label class="form-check-label col-md-9" for="exampleRadios6">Failed/Discused</label>
                             <input name="oif_non_compliant" class="form-check-input col-md-3" id="oif_non_compliant2" type="radio" value="failed">
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
                  <textarea class="form-control col-md-10" rows="3" id="oif_comment" name="oif_comment"> </textarea>
                </div>
                </div> 

                </div>
              </div>
              <div class="modal-footer">
                    <div class="container">
                  <div class="form-group row">
                    <div class="col-md-2 offset-md-4">
                  <input type="submit" class="btn btn-primary btn-sm btn-block oif_submit_button" value="Save" />
                  </div>
                  <div class="col-md-2">
                  <button type="button" class="btn btn-secondary btn-sm btn-block" data-dismiss="modal">Close</button>
                  </div>
                  </div>
                </div>
              </div>
              </div>
            </form>

            </div>
          </div>
        </div>


        <div class="button-box col-md-12">
                    <a href="javascript:void(0);" class="btn btn-primary add_observation_button" role="button" data-toggle="modal" data-target="#oi_modal">Add Observation</a>
                    <a href="javascript:void(0);" class="btn btn-primary submit_oi_inspection">Submit</a>
                    <a href="javascript:void(0);" class="btn btn-primary" role="button">Start New Inspection</a>
                    <a href="javascript:void(0);" class="btn btn-primary" role="button">Replicate Inspection</a>
                    <a href="javascript:void(0);" class="btn btn-primary" role="button">Cancel</a>
         </div>


</form>
<?php require APPROOT . '/views/inc/footer.php'; ?>