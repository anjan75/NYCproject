<?php require APPROOT . '/views/inc/header.php'; ?>
<h3>Speed Inspection Entry</h2>
<hr />
<form  action="">
	<div class="form-group form-inline">
	<label class="col-md-2" for="">Testing Officer</label>
    <input type="" class="col-md-2 form-control" id="" name="">
    </div>

    <div class="form-group form-inline">
	<label class="col-md-2" for="">Railroad</label>
    <input type="" class="col-md-2 form-control" id="" name="">
    <label class="col-md-2" for="">Crew Number</label>
    <input type="" class="col-md-2 form-control" id="" name="">
    <label class="col-md-2" for="">Train Number</label>
    <input type="" class="col-md-2 form-control" id="" name="">
    </div>

    <div class="form-group form-inline">
	<label class="col-md-2" for="">Observed Employee</label>
    <input type="" class="col-md-2 form-control" id="" name="">
    <label class="col-md-2" for="">Department</label>
    <input type="" class="col-md-2 form-control" id="" name="">
    <!-- <label class="col-md-2" for="" style="margin-right: -25px;">Occupation</label> -->
    <label class="col-md-2" for="">Job Description</label>
    <input type="" class="col-md-2 form-control" id="" name="">
    </div>
    <hr />

    <table class="table table-bordered table-striped table-sm">
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
    <tr>
      <td scope="row" id="ob">1</td>
      <td><a href="#" data-toggle="modal" data-target="#exampleModal"><i class="fas fa-pen"></i></a></td>
      <td><a href="#" class="btnDelete"><i class="far fa-trash-alt"></i></a></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
    </tr>
    
    </tbody>
    </table>
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
                    <label class="col-md-2" for="">Date</label>
                    <input type="" class="col-md-4 form-control" id="" name="">
                    <label class="col-md-2" for="">Time</label>
                    <input type="" class="col-md-4 form-control" id="" name="">
                  </div>
                </div>
                <div class="form-group">
                  <div class="row">
                    <label class="col-md-2" for="">Line</label>
                    <input type="" class="col-md-4 form-control" id="" name="">
                    <label class="col-md-3" for="">Location Type</label>
                    <input type="" class="col-md-3 form-control" id="" name="">
                  </div>
                </div>
                <div class="form-group">
                  <div class="row">
                    <label class="col-md-2" for="">Location</label>
                    <input type="" class="col-md-4 form-control" id="" name="">
                    <label class="col-md-2" for="">Milepost</label>
                    <input type="" class="col-md-4 form-control" id="" name="">
                  </div>
                </div>
                 <div class="form-group">
                  <div class="row">
                    <label class="col-md-3" for="">Observed Speed</label>
                    <input type="" class="col-md-3 form-control" id="" name="">
                    <label class="col-md-3" for="">Posted Speed</label>
                    <input type="" class="col-md-3 form-control" id="" name="">
                  </div>
                </div><div class="form-group">
                  <div class="row">
                    <label class="col-md-4" for="">Observed Speed Source</label>
                    <input type="" class="col-md-2 form-control" id="" name="">
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
                      <label class="form-check-label" for="defaultCheck1" style="margin-right: 40px;">Monthly Test</label>
                      <input class="form-check-input" type="checkbox" value="" id="defaultCheck1" checked>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                    <div class="row">
                    <label class="col-md-2" for="">Task</label>
                    <input type="" class="col-md-10 form-control" id="" name="">
                    </div>
                </div>
                <div class="form-group">
                  <div class="row">
                    <label class="col-md-2" for="">Rule</label>
                    <input type="" class="col-md-10 form-control" id="" name="">
                  </div>
                </div>
                <div class="form-group">
                <!-- <div class="row">
                  <div class="col">
                    <label class="" for="">Result</label>
                  </div>
                  <div class="col">
                    <div class="form-check">
                      <label class="form-check-label" for="exampleRadios1">Compliant</label>
                      <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1" value="option1" style="margin-left: 20px;" checked>
                    </div>
                    <div class="form-check">
                      <label class="form-check-label" for="exampleRadios2">Non-Compliant</label>
                      <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios2" value="option2" style="margin-left: 20px;">
                    </div>
                  </div>
                </div> -->
                <div class="row">
                  <div class="col-md-2">
                    <label for="">Result</label>
                  </div>
                  <div class="col-md-10">
                    <div class="col-md-12">
                      <div class="col-md-6" style="float:left; margin-left: -14%;">
                         <div class="form-check">
                             <label class="form-check-label col-md-9" for="exampleRadios1">Compliant</label>
                             <input name="exampleRadios" class="form-check-input col-md-3" id="exampleRadios1" type="radio" checked="" value="option1">
                          </div>
                           <div class="form-check">
                             <label class="form-check-label col-md-9" for="exampleRadios1">Non-Compliant</label>
                             <input name="exampleRadios" class="form-check-input col-md-3" id="exampleRadios1"  type="radio" checked="" value="option1">
                          </div> 
                          <div class="form-check">
                             <label class="form-check-label col-md-9" for="exampleRadios1">Observed</label>
                             <input name="exampleRadios" class="form-check-input col-md-3" id="exampleRadios1" type="radio" checked="" value="option1">
                          </div>
                          
                        <!-- <p>Compliant<input type="radio" name="exampleRadios" class="form-check-input" id="exampleRadios1" </p> -->
                        <!--  <div class="form-check">
                             <label class="form-check-label" for="exampleRadios1">Compliant</label>
                             <input name="exampleRadios" class="form-check-input" id="exampleRadios1" style="margin-left: 38px;" type="radio" checked="" value="option1">
                          </div> -->
                     </div>
                     <div class="col-md-6" style="float:left;margin-left: -14%">

                         <div class="form-check">
                             <label class="form-check-label col-md-9" for="exampleRadios1">Reviewed/Reinstructed</label>
                             <input name="exampleRadios" class="form-check-input col-md-3" id="exampleRadios1" type="radio" checked="" value="option1">
                          </div>
                          <div class="form-check">
                             <label class="form-check-label col-md-9" for="exampleRadios1">Failed/Discused</label>
                             <input name="exampleRadios" class="form-check-input col-md-3" id="exampleRadios1" type="radio" checked="" value="option1">
                          </div>
                     </div>
                  <!-- <div class="col-md-12">
                    <div class="form-check">
                      <label class="form-check-label" for="exampleRadios2">Non-Compliant</label>
                      <input name="exampleRadios" class="form-check-input" id="exampleRadios2" style="margin-left: 20px;" type="radio" value="option2">
                    </div>
                  </div> -->
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
                <button type="button" class="btn btn-secondary text-center" data-dismiss="modal">Close</button>
              </div>
            </div>
          </div>
        </div>
     <div class="button-box col-md-12">
                <a href="" class="btn btn-primary" role="button" data-toggle="modal" data-target="#exampleModal">Add Observation</a>
                <a href="" class="btn btn-primary" role="button">Submit</a>
                <a href="" class="btn btn-primary" role="button">Start New Inspection</a>
                <a href="" class="btn btn-primary" role="button">Replicate Inspection</a>
                <a href="mylink.php" class="btn btn-primary" role="button">Cancel</a>
                
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