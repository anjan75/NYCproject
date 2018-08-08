<?php require APPROOT . '/views/inc/header.php'; ?>
<h3>Equipment Safety Inspection Entry</h2>
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
    <label class="col-md-2" for="" style="margin-right: -25px;">Occupation</label>
    <input type="" class="col-md-2 form-control" id="" name="">
    </div>
    <hr />

    <table class="table table-bordered table-striped table-sm">
    <thead class="thead-dark" style="background-color: black; color: white;">
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
      <th scope="row" id="ob">1</th>
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

    <div class="row">
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
    


</form>
<?php require APPROOT . '/views/inc/footer.php'; ?>