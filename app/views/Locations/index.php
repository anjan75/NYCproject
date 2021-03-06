<?php require APPROOT . '/views/inc/header.php'; ?>
<h3>Locations Administration</h3>
<form  action="">
  <hr />
  <table class="table table-bordered table-striped table-sm">
    <thead class="thead-dark" >
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
     <td scope="row"><a href="#" data-toggle="modal" data-target="#AddNewLocation"><i class="fas fa-pen"></i></td>
      <td>Mark</td>
      <td>Otto</td>
      <td>Otto</td>
      <td><a href="#" class="btnDelete"><i class="far fa-trash-alt"></i></a></td>
    </tr>
    </tbody>
  </table>

  <div class="text-center"> 
        <input type="button" class="btn btn-primary" data-toggle="modal" data-target="#AddNewLocation" style="margin-top: 10px;" value="Add New Location">
  </div>

</form>
<!-- Modal -->
<div class="modal fade" id="AddNewLocation" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="Location" style="">Location</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form class="form">
          <div class="row">
            <div class="col-md-6">
                <div class="form-group form-inline">
                  <label class="col-md-6" for="LocationCode">Location Code</label>
                  <input class="form-control col-md-6" id="Name" type="text" placeholder="">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group form-inline">
                  <label for="Status" class="col-md-4">Status</label>
                  <input type="text" class="form-control col-md-5" id="Status" placeholder="">
                </div>
            </div>
          </div>
          <div class="row">
                    <div class="col-md-12">
                      <div class="form-group form-inline">
                         <label class="col-md-3" for="Description">Description</label>
                         <input class="form-control col-md-9" id="Description" type="text">
                      </div>
                    </div>
          </div>
          <div class="row">
                    <div class="col-md-12">
                      <div class="form-group form-inline">
                         <label class="col-md-3" for="LocationType">Location Type</label>
                         <input class="form-control col-md-5" id="LocationType" type="text">
                      </div>
                    </div>
          </div>    
        </form>
      </div>
      <div class="modal-footer" style=""> 
        <button type="button" class="btn btn-primary">Save</button>
        <button type="button" class="btn btn-secondary" >Reset</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
      </div>
    </div>
  </div>
</div>



<?php require APPROOT . '/views/inc/footer.php'; ?>