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
</style>
<h3>General Inspection Entry</h3>
<hr />
<form  action="">

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
            <select class="col-md-5 form-control select-single " name="gi_rail_road" id="gi_rail_road">
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
     <input type="" class="form-control col-md-5" id="gi_crew_number" name="gi_crew_number">
    </div>
       </div>
       <div class="col-lg-4 col-md-6">
         <div class="form-group form-inline formcontrol">
    <label class="col-md-5 lableforminline" for="">Train Number</label>
    <input type="" class="form-control col-md-5" id="gi_train_number" name="gi_train_number">
    </div>
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
    <input type="" class="form-control col-md-5" id="gi_department" name="gi_department">
    </div>
       </div>
       <div class="col-lg-4 col-md-6">
        <div class="form-group form-inline formcontrol">
  <label class="col-md-5 lableforminline" for="">Job Description</label>
    <input type="" class="form-control col-md-5" id="di_job_description" name="di_job_description">
    </div>
       </div>
    </div>
    <hr />

    <table class="table table-bordered table-striped table-sm general-inspection">
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
      <td style="text-align: center;"><a href="#" data-toggle="modal" data-target="#exampleModal"><i class="fas fa-pen"></i></a>
        <!-- Modal -->
        <div class="modal fade bd-example-modal-lg" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Observation</h5>
              </div>
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Obs-Emp Name(BSC ID)</h5>
              </div>
              <div class="modal-body">
                <div class="container-fluid">
                 <div class="form-group">
                  <div class="row">
                    <label class="col-md-2" for="" style="margin-right: -20px;">Date</label>
                    <input type="" class="col-md-4 form-control" id="" name="">
                    <label class="col-md-2" for="" style="margin-right: -20px;">Time</label>
                    <input type="" class="col-md-4 form-control" id="" name="">
                  </div>
                </div>
                <div class="form-group">
                  <div class="row">
                    <label class="col-md-2" for="" style="margin-right: -20px;">Line</label>
                    <input type="" class="col-md-4 form-control" id="" name="">
                    <label class="col-md-3" for="" style="margin-right: -20px;">Location Type</label>
                    <input type="" class="col-md-3 form-control" id="" name="">
                  </div>
                </div>
                <div class="form-group">
                  <div class="row">
                    <label class="col-md-2" for="" style="margin-right: -20px;">Location</label>
                    <input type="" class="col-md-4 form-control" id="" name="">
                    <label class="col-md-2" for="" style="margin-right: -20px;">Milepost</label>
                    <input type="" class="col-md-4 form-control" id="" name="">
                  </div>
                </div>
                 <div class="form-group">
                  <div class="row">
                 <label class="col-md-3" for="">Type of Observation</label>
                    <div class="form-check form-check-inline col-md-4">
                      <label class="form-check-label col-md-11" for="inlineRadio1">Direct/Obsered</label>
                      <input class="form-check-input col-md-1" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1" checked>
                    </div>
                    <div class="form-check form-check-inline col-md-4">
                      <label class="form-check-label col-md-11" for="inlineRadio2">Indirect/Non-Observed</label>
                      <input class="form-check-input col-md-1" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2">
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <div class="row">
                    <div class="form-check">
                      <label class="form-check-label" for="defaultCheck1" style="margin-right: 40px;float: left;">Monthly Test</label>
                      <input class="form-check-input" type="checkbox" value="" id="defaultCheck1" checked>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                    <div class="row">
                    <label class="col-md-2" for="" style="margin-right: -20px;">Task</label>
                    <input type="" class="col-md-10 form-control" id="" name="">
                    </div>
                </div>
                <div class="form-group">
                  <div class="row">
                    <label class="col-md-2" for="" style="margin-right: -20px;">Rule</label>
                    <input type="" class="col-md-10 form-control" id="" name="">
                  </div>
                </div>
                <div class="form-group">
                <div class="row">
                  <div class="col-md-2">
                    <label for="">Result</label>
                  </div>
                  <div class="col-md-10">
                    <div class="col-md-12">
                       <div class="row">
                         <div class="col-md-6" style="right: 20px">
                         <div class="form-check">
                             <label class="form-check-label col-md-9" for="exampleRadios2">Compliant</label>
                             <input name="exampleRadios" class="form-check-input col-md-3" id="exampleRadios2" type="radio" checked="" value="option1">
                          </div>
                           <div class="form-check">
                             <label class="form-check-label col-md-9" for="exampleRadios3">Non-Compliant</label>
                             <input name="exampleRadios" class="form-check-input col-md-3" id="exampleRadios3"  type="radio" checked="" value="option1">
                          </div> 
                     </div>
                     <div class="col-md-6" style="right: 20px">

                         <div class="form-check">
                             <label class="form-check-label col-md-9" for="exampleRadios5">Reviewed/Reinstructed</label>
                             <input name="exampleRadios" class="form-check-input col-md-3" id="exampleRadios5" type="radio" checked="" value="option1">
                          </div>
                          <div class="form-check">
                             <label class="form-check-label col-md-9" for="exampleRadios6">Failed/Discused</label>
                             <input name="exampleRadios" class="form-check-input col-md-3" id="exampleRadios6" type="radio" checked="" value="option1">
                          </div>
                     </div>

                       </div>
                </div>
                  </div>
                </div>
                </div>
                <div class="form-group">
                  <div class="row">
                  <label for="" class="col-form-label col-md-2">Comments:</label>
                  <textarea class="form-control col-md-9" id="message-text"></textarea>
                </div>
                </div> 

                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              </div>
            </div>
          </div>
        </div>
      </td>
      <td style="text-align: center;"><a href="#" class="btnDelete"><i class="far fa-trash-alt"></i></a></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
    </tr>
    </tbody>
    </table>
     <div class="button-box col-md-12">
                <a href="" class="btn btn-primary" role="button" data-toggle="modal" data-target="#exampleModal">Add Observation</a>
                <a href="" class="btn btn-primary" role="button">Submit</a>
                <a href="" class="btn btn-primary" role="button">Start New Inspection</a>
                <a href="" class="btn btn-primary" role="button">Replicate Inspection</a>
                <a href="" class="btn btn-primary" role="button">Cancel</a>
                
       </div>
</form>



<?php require APPROOT . '/views/inc/footer.php'; ?>