<?php require APPROOT . '/views/inc/header.php'; ?>
<h3>Car Mover Inspection Entry</h2>
<hr />
<form  action="">
	<div class="form-group form-inline">
	<label class="col-md-2" for="" style="margin-right: -25px;">Testing Officer</label>
    <input type="" class="col-md-2 form-control" id="" name="">
    </div>

    <div class="form-group form-inline">
	<label class="col-md-2" for="" style="margin-right: -25px;">Railroad</label>
    <input type="" class="col-md-2 form-control" id="" name="">
    </div>

    <div class="form-group form-inline">
	<label class="col-md-2" for="" style="margin-right: -20px;">Observed Employee</label>
    <input type="" class="col-md-2 form-control" id="" name="">
    <label class="col-md-2" for="" style="margin-right: -25px;">Department</label>
    <input type="" class="col-md-2 form-control" id="" name="">
    <label class="col-md-2" for="" style="margin-right: -25px;">Job Description</label>
    <input type="" class="col-md-2 form-control" id="" name="">
    </div>
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
           <div class="button-box col-md-12">
                    <a href="" class="btn btn-primary" role="button" data-toggle="modal" data-target="#gi_modal">Add Observation</a>
                    <a href="javascript:void(0);" class="btn btn-primary submit_inspection">Submit</a>
                    <a href="" class="btn btn-primary" role="button">Start New Inspection</a>
                    <a href="" class="btn btn-primary" role="button">Replicate Inspection</a>
                    <a href="" class="btn btn-primary" role="button">Cancel</a>
           </div>
    


</form>
<?php require APPROOT . '/views/inc/footer.php'; ?>