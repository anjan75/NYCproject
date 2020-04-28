<?php require APPROOT . '/views/inc/header.php'; ?>
<h3>Location Types Administration</h3>

  <hr />
  <table class="table table-bordered table-striped table-sm location-types-administration">
    <thead class="thead-dark" >
    <tr>
      <th scope="col">Modify</th>
      <th scope="col">Location Type Short Text</th>
      <th scope="col">Location Type Description</th>
      <th scope="col">Status</th>
    </tr>
    </thead>
    <tbody>
    <?php if(isset($data['location_types']) && is_array($data['location_types']) && count($data['location_types']) > 0){ ?>
      <?php foreach($data['location_types'] as $loc){ ?>
      <tr>
        <td scope="row" class="updateLocationTypeLink">
          <a href="javascript:void(0);" >
            <i class="fas fa-pen"></i>
          </a>
          <input type="hidden" name="hidden_location_type_id" class="hidden_location_type_id" value="<?php echo $loc['LOCATION_TYPE_ID']; ?>">
        </td>
        <td><?php echo $loc['LOCATION_TYPE']; ?></td>
        <td><?php echo $loc['DESCRIPTION']; ?></td>
        <td>#todo</td>
      </tr>
      <?php } ?>
    <?php } ?>
    </tbody>
  </table>

  <div class="text-center"> 
        <input type="button" class="btn btn-primary" data-toggle="modal" data-target="#newLocationTypeModal" style="margin-top: 10px;" value="Add New Location Type">
  </div>


<!-- Modal -->
<div class="modal fade" id="newLocationTypeModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
    <div class="modal-content">
      <form class="form" name="newLocationTypeForm" id="newLocationTypeForm">
      <div class="modal-header">
        <h5 class="modal-title text-center" id="Railroad" style="">Create New Location Type</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <div class="row">
            <div class="col-md-12 status_message_div">
            </div>
          </div>
          <div class="container">
           <div class="form-group row">
            <div class="col-md-3 label-right">
              <label for="">Short Text</label>
            </div>
            <div class="col-md-3">
               <input class="form-control" name="name" id="name" type="text" placeholder="">
            </div>
            <div class="col-md-2 label-right">
              
               <label for="Status">Status</label>
                 
            </div>
            <div class="col-md-3">
              
               <select name="status" id="status" class="form-control">
                      <option value="Created">CREATED</option>
                      <option value="Modified">MODIFIED</option>
                      <option value="Inactive">INACTIVE</option>
                  </select>
            </div>
          </div>
          <div class="form-group row">
            <div class="col-md-3 label-right">
              <label for="Description">Description</label>
            </div>
            <div class="col-md-9">
               <input class="form-control" id="description" name="description" type="text">
            </div>
           </div> 
        </div>        
      </div>
      <div class="modal-footer" style="">
        <div class="container">
          <div class="form-group row">
            <div class="col-md-2 offset-md-3">
               <button type="submit" name="submit" class="btn btn-primary btn-sm btn-block">Save</button>
            </div>
            <div class="col-md-2">
               <button type="button" class="btn btn-secondary btn-sm btn-block location_type_reset">Reset</button>
            </div>
            <div class="col-md-2">
               <button type="button" class="btn btn-secondary btn-sm btn-block" data-dismiss="modal">Cancel</button>
            </div>
          </div> 
        </div>
    </div>
      </form>
    </div>
    
  </div>
</div>



<!-- UPDATE Modal -->
<div class="modal fade" id="updateLocationTypeModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <form class="form" name="updateLocationTypeForm" id="updateLocationTypeForm">
      <div class="modal-header">
        <h5 class="modal-title" id="LocationType" style="">Create New Location Type</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <div class="row">
            <div class="col-md-12 status_message_div">
            </div>
          </div>
          <div class="container">
           <div class="form-group row">
            <div class="col-md-3 label-right">
              <label for="">Short Text</label>
            </div>
            <div class="col-md-3">
               <input class="form-control" name="name" id="name" type="text" placeholder="">
            </div>
            <div class="col-md-2 label-right">
              
               <label for="Status">Status</label>
                 
            </div>
            <div class="col-md-4">
              
               <select name="status" id="status" class="form-control">
                      <option value="Created">CREATED</option>
                      <option value="Modified">MODIFIED</option>
                      <option value="Inactive">INACTIVE</option>
                  </select>
            </div>
          </div>
          <div class="form-group row">
            <div class="col-md-3 label-right">
              <label for="Description">Description</label>
            </div>
            <div class="col-md-9">
               <input class="form-control" id="description" name="description" type="text">
            </div>
           </div> 
        </div>        
      </div>
      <div class="modal-footer" style="">
        <div class="container">
          <div class="form-group row">
            <div class="col-md-2 offset-md-3">
               <button type="submit" name="submit" class="btn btn-primary btn-sm btn-block">Save</button>
            </div>
            <div class="col-md-2">
               <button type="button" class="btn btn-secondary btn-sm btn-block location_type_reset">Reset</button>
            </div>
            <div class="col-md-2">
               <button type="button" class="btn btn-secondary btn-sm btn-block" data-dismiss="modal">Cancel</button>
            </div>
          </div> 
        </div>
    </div>
      </form>
    </div>
    
  </div>
</div>


<?php require APPROOT . '/views/inc/footer.php'; ?>