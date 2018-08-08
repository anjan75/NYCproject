<?php require APPROOT . '/views/inc/header.php'; ?>
<h3>Tasks Administration</h3>
<hr />
<form  action="">
  <div class="row">
    <div class="form-group form-inline">
    <label class="col-md-2" for="" style="margin-right: -25px;">Task Status</label>
    <input type="" class="col-md-2 form-control" id="" name="">
    <label class="col-md-3" for="" style="margin-right: -25px;">Description Search-Key Words</label>
    <input type="" class="col-md-4 form-control" id="" name="">
    </div>
  <button id="" name="" class="ml-auto btn btn-primary col-sm-1 btn-xs" style="height: 50%; margin-right:-100px;">Filter</button>
  <button id="" name="" class="ml-auto btn btn-primary col-sm-1 btn-xs" style="height: 50%;">Clear</button>
  </div>
  <hr />
  <table class="table table-bordered table-striped table-sm">
    <thead class="thead-dark" style="background-color: black; color: white; font-size: 70%">
    <tr>
      <th scope="col" style="width: 20%; text-align: center;">Modify</th>
      <th scope="col" style="text-align: center;">Description</th>
      <th scope="col" style="width: 20%; text-align: center;">Status</th>
    </tr>
    </thead>
    <tbody>
    <tr>
      <th scope="row">1</th>
      <td>Mark</td>
      <td>Otto</td>
    </tr>
    <tr>
      <th scope="row">1</th>
      <td>Mark</td>
      <td>Otto</td>
    </tr>
    </tbody>
  </table>

  <div class="text-center"> 
        <input type="button" class="btn btn-primary" style="margin-top: 10px;" value="Add New Task">
  </div>

</form>
<?php require APPROOT . '/views/inc/footer.php'; ?>