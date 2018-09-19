<?php require APPROOT . '/views/inc/header.php'; ?>
<h3>Location Types Administration</h3>

  <hr />
  <table class="table table-bordered table-striped table-sm location-types-administration">
    <thead class="thead-dark" >
    <tr>
      <th scope="col">Modify</th>
      <th scope="col">Display Name</th>
      <th scope="col">Description</th>
      <th scope="col">Status</th>
      <th scope="col">Delete</th>
    </tr>
    </thead>
    <tbody>
    <?php if(isset($data['location_types']) && is_array($data['location_types']) && count($data['location_types']) > 0){ ?>
      <?php foreach($data['location_types'] as $loc){ ?>
      <tr>
        <td scope="row"><a href="#" data-toggle="modal" data-target="#newLocationTypeModal"><i class="fas fa-pen"></i></td>
        <td>#todo</td>
        <td><?php echo $loc['DESCRIPTION']; ?></td>
        <td>#todo</td>
        <td><a href="#" class="btnDelete"><i class="far fa-trash-alt"></i></a></td>
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
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <form class="form" name="newLocationTypeForm" id="newLocationTypeForm">
      <div class="modal-header">
        <h5 class="modal-title" id="Railroad" style="">Create New Location Type</h5>
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
                  <label class="col-md-6" for="Name">Name</label>
                  <input class="form-control col-md-6" name="name" id="name" type="text" placeholder="">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group form-inline">
                  <label for="Status" class="col-md-6">Status</label>
                  <select name="status" id="status" class="form-control col-md-6">
                      <option value="NEVER EXPIRE">NEVER EXPIRE</option>
                      <option value="EXPIRE">EXPIRE</option>
                  </select>
                </div>
            </div>

          </div>
          <div class="row">
                    <div class="col-md-12">
                      <div class="form-group form-inline">
                         <label class="col-md-2" for="Description">Description</label>
                         <input class="form-control col-md-10" id="description" name="description" type="text">
                      </div>
                    </div>
          </div>   
      </div>
      <div class="modal-footer" style=""> 
       <div class="row">
           <div class="col-md-4 text-center">
              <button type="submit" name="submit" id="submit" class="btn btn-primary">Save</button>
           </div>
           <div class="col-md-4 text-center">
              <button type="button" class="btn btn-secondary" >Reset</button>
           </div>
          <div class="col-md-4 text-center">
             <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
          </div>
      </div>
    </div>
      </form>
    </div>
    
  </div>
</div>


<?php require APPROOT . '/views/inc/footer.php'; ?>