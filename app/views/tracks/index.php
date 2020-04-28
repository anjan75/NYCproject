<?php require APPROOT . '/views/inc/header.php'; ?>
<h3>Track Designation Administration</h3>
<form  action="">
  <hr />
  <table class="table table-bordered table-striped table-sm Track-Designation-Administration">
    <thead class="thead-dark" >
    <tr>
      <th scope="col">Modify</th>
      <th scope="col">Description</th>
      <th scope="col">Status</th>
    </tr>
    </thead>
    <tbody>
    <?php if(isset($data['tracks']) && is_array($data['tracks']) && count($data['tracks']) > 0){ ?>
      <?php $i=0; ?>
      <?php for ($i = 0; $i < count($data['tracks']['DESCRIPTION']); $i++){ ?>
      <tr>
        <td class="updateTrackModal">
          <a href="#" ><i class="fas fa-pen"></i></a>
          <input type="hidden" name="track_id" class="hidden_track_id" value="<?php echo $data['tracks']['TRACK_DESIGNATION_ID'][$i]; ?>" />
        </td>
        <!-- <td><?php echo $data['tracks']['TRACK_DESIGNATION'][$i]; ?></td> -->
        <td><?php echo $data['tracks']['DESCRIPTION'][$i]; ?></td>
        <td><?php echo $data['tracks']['STATUS'][$i]; ?></td>
      </tr>
      <?php  } ?>
    <?php } ?>
    </tbody>
  </table>

  <div class="text-center"> 
        <input type="button" class="btn btn-primary" data-toggle="modal" data-target="#newTrack" style="margin-top: 10px;" value="Add New Track">
  </div>
</form>


<!-- Modal -->
<div class="modal fade" id="newTrack" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <form class="form" name="newTrackForm" id="newTrackForm">
      <div class="modal-header">
        <h5 class="modal-title" id="Track" style="">Track</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          
          <div class="row">
             <div class="col-md-12 status_message_div">
                
            </div>
            <div class="col-md-6">
                <div class="form-group form-inline">
                  <label class="col-md-6" for="TrackCode">Track Code</label>
                  <input class="form-control col-md-6" name="trackcode" id="trackcode" type="text" placeholder="">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group form-inline">
                  <label for="Status" class="col-md-4">Status</label>
                  <select name="status" id="status" class="form-control col-md-6">
                      <option value="Created">CREATED</option>
                      <option value="Modified">MODIFIED</option>
                      <option value="Inactive">INACTIVE</option>
                  </select>
                </div>
            </div>
          </div>
          <div class="row">
                    <div class="col-md-12">
                      <div class="form-group form-inline">
                         <label class="col-md-3" for="TrackDesignation">Track Designation</label>
                         <input class="form-control col-md-9" name="description" id="description" type="text">
                      </div>
                    </div>
          </div> 

         
            
        
      </div>
      <div class="modal-footer"> 
        <button type="submit" name="submit" class="btn btn-primary">Save</button>
        <button type="button" class="btn btn-secondary track_reset">Reset</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
      </div>
      </form>
    </div>
  </div>
</div>




<!-- Update Modal -->
<div class="modal fade" id="updateTrack" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <form class="form" name="updateTrackForm" id="updateTrackForm">
      <div class="modal-header">
        <h5 class="modal-title" id="Track" style="">Track</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
             <div class="col-md-12 status_message_div">
                
            </div>
            <div class="col-md-6">
                <div class="form-group form-inline">
                  <label class="col-md-6" for="TrackCode">Track Code</label>
                  <input class="form-control col-md-6" name="trackcode" id="trackcode" type="text" placeholder="">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group form-inline">
                  <label for="Status" class="col-md-4">Status</label>
                  <select name="status" id="status" class="form-control col-md-6">
                      <option value="Created">CREATED</option>
                      <option value="Modified">MODIFIED</option>
                      <option value="Inactive">INACTIVE</option>
                  </select>
                </div>
            </div>
          </div>
          <div class="row">
                    <div class="col-md-12">
                      <div class="form-group form-inline">
                         <label class="col-md-3" for="TrackDesignation">Track Designation</label>
                         <input class="form-control col-md-9" name="description" id="description" type="text">
                      </div>
                    </div>
          </div> 
        
      </div>
      <div class="modal-footer"> 
        <button type="submit" name="submit" class="btn btn-primary">Save</button>
        <button type="button" class="btn btn-secondary track_reset">Reset</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
      </div>
      </form>
    </div>
  </div>
</div>





<?php require APPROOT . '/views/inc/footer.php'; ?>