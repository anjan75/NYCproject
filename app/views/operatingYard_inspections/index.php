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
  <form name="giform" id="giform">
  <div class="row">
    <div class="col-lg-4 col-md-6">
      <div class="form-group form-inline formcontrol">
        <label class="col-md-5 lableforminline" for="">Testing Officer</label>
        <input type="text" class="form-control col-md-5" id="gi_bsc_id_show" name="gi_bsc_id_show" value="<?php echo $data['gi_bsc_id']; ?>" disabled>
        <input type="hidden" class="form-control col-md-5" id="gi_bsc_id" name="gi_bsc_id" value="<?php echo $data['gi_bsc_id']; ?>">
      </div>
    </div>
  </div>
     <div class="row">
       <div class="col-lg-4 col-md-6">
         <div class="form-group form-inline formcontrol">
            <label class="col-md-5 lableforminline" for="">Railroad</label>
            <select class="col-md-5 form-control select-single" name="gi_rail_road" id="gi_rail_road">
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
          <input type="" class="form-control col-md-5 autocomplete-input" id="gi_observed_employee" name="gi_observed_employee">
        </div>
       </div>
       <div class="col-lg-4 col-md-6">
        <div class="form-group form-inline formcontrol">
          <label class="col-md-5 lableforminline" for="">Department</label>
          <input type="text" class="form-control col-md-5" id="gi_department" name="gi_department">
          <input type="hidden"  id="gi_department_id" name="gi_department_id">
        </div>
       </div>
       <div class="col-lg-4 col-md-6">
        <div class="form-group form-inline formcontrol">
  <label class="col-md-5 lableforminline" for="">Job Description</label>
    <input type="text" class="form-control col-md-5" id="gi_job_description" name="gi_job_description">
    <input type="hidden" id="gi_jobcode_id" name="gi_jobcode_id">
    </div>
       </div>
    </div>
</form>
    <hr />

    <table class="table table-bordered table-striped table-sm">
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
    <tr>
      <td scope="row" id="ob">1</td>
      <td style="text-align: center;">
        <i class="fas fa-pen"></i>
      </td>
      <td style="text-align: center;">
        <i class="far fa-trash-alt"></i>
      </td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
    </tr>
    </tbody>
    </table>

    <!-- Modal -->
        <div class="modal fade bd-example-modal-lg" id="gi_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Observation</h5>
              </div>
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Obs-Emp Name(BSC ID)</h5>
              </div>
              <!-- General inspection form - gif -->
              <form class="gif" id="gif">
              <div class="modal-body">
                <div class="container-fluid">
                 <div class="form-group">
                  <div class="row">
                    <label class="col-md-2 text-right" for="">Date</label>
                    <input type="text" class="col-md-4 form-control" id="gif_date" name="gif_date" value="<?php echo date("m/d/Y h:i A"); ?>" placeholder="m/d/yyyy h:s" required>
                  <!--   <label class="col-md-2 text-right" for="">Time</label>
                    <input type="text" class="col-md-4 form-control time12" id="gif_time" name="gif_time" required> -->
                  </div>
                  </div>
                <!-- </div> -->
                <div class="form-group">
                  <div class="row">
                    <label class="col-md-2 text-right" for="">Location</label>
                    <select class="col-md-4 form-control selectboxheight" name="gif_location" id="gif_location" required>
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
                     <label class="col-md-2 text-right" for="">Location Type</label>
                    <select class="col-md-4 form-control" name="gif_location_type" id="gif_location_type" required>
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
                 <label class="col-md-3" for="">Type of Observation</label>
                    <div class="form-check form-check-inline col-md-4">

                      <?php if($_SESSION['user_business_unit'] == 'MNR'){ ?>
                      <label class="form-check-label col-md-8 text-right" for="inlineRadio1">Direct</label>
                      <input class="form-check-input col-md-1" type="radio" name="gif_observation" id="gif_observation1" value="direct" checked >
                      <?php }elseif ($_SESSION['user_business_unit'] == 'LIRR'){ ?>
                      <label class="form-check-label col-md-8 text-right" for="inlineRadio1">Observed</label>
                      <input class="form-check-input col-md-1" type="radio" name="gif_observation" id="gif_observation1" value="observed" checked>
                      <?php } ?>

                      
                    </div>
                    <div class="form-check form-check-inline col-md-4">
                       <?php if($_SESSION['user_business_unit'] == 'MNR'){ ?>
                      <label class="form-check-label col-md-8" for="inlineRadio2">Indirect</label>
                      <input class="form-check-input col-md-1" type="radio" name="gif_observation" id="gif_observation2" value="indirect">
                      <?php }elseif ($_SESSION['user_business_unit'] == 'LIRR'){ ?>
                       <!--non-Observed  -->
                      <label class="form-check-label col-md-8 text-right" for="inlineRadio2">Non-Observed</label>
                      <input class="form-check-input col-md-1" type="radio" name="gif_observation" id="gif_observation2" value="non_observed">
                      <?php } ?>
                     
                    </div>

                  </div>
                </div>
                <?php if ($_SESSION['user_business_unit'] == 'LIRR'){ ?>
                <div class="form-group">
                  <div class="row">
                    <div class="form-check">
                      <label class="form-check-label text-right" for="Monthlytest" style="margin-right: 40px;float: left;">Monthly Test</label>
                      <input class="form-check-input" type="checkbox" value="gif_monthly_test" id="gif_monthly_test" name="gif_monthly_test" >
                    </div>
                  </div>
                </div>
                <?php } ?>
                <div class="form-group">
                    <div class="row">
                    <label class="col-md-2 text-right" for="">Task</label>
                   
                    <select class="col-md-10 form-control selectboxheight" name="gif_task" id="gif_task" required>
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
                    <select class="col-md-10 form-control selectboxheight" name="gif_rule" id="gif_rule" required>
                      
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
                             <input name="gif_result" class="form-check-input col-md-3" id="gif_result1" type="radio" value="compliant" required>
                          </div>
                          <div class="form-check">
                             <label class="form-check-label col-md-9" for="exampleRadios3">Non-Compliant</label>
                             <input name="gif_result" class="form-check-input col-md-3" id="gif_result2"  type="radio" value="non_compliant">
                          </div> 
                     </div>
                    <?php if ($_SESSION['user_business_unit'] == 'LIRR'){ ?>
                     <div class="col-md-6 gif_non_compliant_div" style="right: 20px; display: none;">

                         <div class="form-check">
                             <label class="form-check-label col-md-9" for="non_compliant">Reviewed/Reinstructed</label>
                             <input name="gif_non_compliant" class="form-check-input col-md-3" id="gif_non_compliant1" type="radio" value="reviewed">
                          </div>
                          <div class="form-check">
                             <label class="form-check-label col-md-9" for="exampleRadios6">Failed/Discused</label>
                             <input name="gif_non_compliant" class="form-check-input col-md-3" id="gif_non_compliant2" type="radio" value="failed">
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
                  <textarea class="form-control col-md-10" rows="3" id="gif_comment" name="gif_comment"> </textarea>
                </div>
                </div> 

                </div>
              </div>
              <div class="modal-footer">
                <!-- <button type="submit" class="btn btn-secondary gif_submit_button" data-dismiss="modal">Close</button> -->
                  <input type="submit" class="btn btn-secondary gif_submit_button" value="Close" />
              </div>
            </form>

            </div>
          </div>
        </div>


        <div class="button-box col-md-12">
                    <a href="" class="btn btn-primary" role="button" data-toggle="modal" data-target="#gi_modal">Add Observation</a>
                    <a href="javascript:void(0);" class="btn btn-primary submit_inspection">Submit</a>
                    <a href="" class="btn btn-primary" role="button">Start New Inspection</a>
                    <a href="" class="btn btn-primary" role="button">Replicate Inspection</a>
                    <a href="" class="btn btn-primary" role="button">Cancel</a>
         </div>


</form>
<?php require APPROOT . '/views/inc/footer.php'; ?>