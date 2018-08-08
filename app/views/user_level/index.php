<?php require APPROOT . '/views/inc/header.php'; ?>
<h3>User Security Levels Administration</h3>
<hr />
<form  action="">
  <div class="row">
    <div class="form-group form-inline">
  <label class="col-md-5" for="" >Testing Officer</label>
    <input type="" class="col-md-6 form-control" id="" name="">
  </div>
  <button id="" name="" class="ml-auto btn btn-primary col-sm-2 btn-xs" style="height: 50%; margin-right: -300px;">Filter</button>
  <button id="" name="" class="ml-auto btn btn-primary col-sm-2 btn-xs" style="height: 50%;">Clear</button>
  </div>
  <hr />
  <table class="table table-bordered table-striped table-sm">
    <thead class="thead-dark" style="background-color: black; color: white; font-size: 70%">
    <tr>
      <th scope="col" style="width: 10%; text-align: center;">Modify</th>
      <th scope="col" style="text-align: center;">name</th>
      <th scope="col" style="width: 10%; text-align: center;">Employee Status</th>
      <th scope="col" style="width: 10%; text-align: center;">Department</th>
      <th scope="col" style="width: 10%; text-align: center;">Occupation</th>
      <th scope="col" style="width: 10%; text-align: center;">Sub Department</th>
      <th scope="col" style="width: 15%; text-align: center;">User Permission(s)</th>
      <th scope="col" style="width: 15%; text-align: center;">Notes</th>
    </tr>
    </thead>
    <tbody>
    <tr>
      <th scope="row">1</th>
      <td>Mark</td>
      <td>Otto</td>
      <td>Otto</td>
      <td>@mdo</td>
      <td>@mdo</td>
      <td>@mdo</td>
      <td>Mark</td>
    </tr>
    </tbody>
  </table>

</form>
<?php require APPROOT . '/views/inc/footer.php'; ?>