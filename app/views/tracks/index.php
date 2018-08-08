<?php require APPROOT . '/views/inc/header.php'; ?>
<h3>Track Designation Administration</h3>
<form  action="">
  <hr />
  <table class="table table-bordered table-striped table-sm">
    <thead class="thead-dark" style="background-color: black; color: white; font-size: 70%">
    <tr>
      <th scope="col" style="width: 15%; text-align: center;">Modify</th>
      <th scope="col" style="width: 20%; text-align: center;">Display Name</th>
      <th scope="col" style="text-align: center;">Description</th>
      <th scope="col" style="width: 15%; text-align: center;">Status</th>
      <th scope="col" style="width: 15%; text-align: center;">Delete</th>
    </tr>
    </thead>
    <tbody>
    <tr>
      <th scope="row">1</th>
      <td>Mark</td>
      <td>Otto</td>
      <td>Otto</td>
      <td>Otto</td>
    </tr>
    </tbody>
  </table>

  <div class="text-center"> 
        <input type="button" class="btn btn-primary" style="margin-top: 10px;" value="Add New Track">
  </div>

</form>
<?php require APPROOT . '/views/inc/footer.php'; ?>