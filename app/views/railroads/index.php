<?php require APPROOT . '/views/inc/header.php'; ?>
<h3>Railroad Administration</h3>
<form  action="">
  <hr />
  <table class="table table-bordered table-striped table-sm railroad-administrator">
    <thead class="thead-dark">
    <tr>
      <th>Modify</th>
      <th>Description</th>
      <th>Status</th>
      <th>Delete</th>
    </tr>
    </thead>
    <tbody>
    <?php if(isset($data['railroads']) && is_array($data['railroads']) && count($data['railroads']) > 0){ ?>
      <?php foreach($data['railroads'] as $loc){ ?>
      <tr>
        <td class="updateRailRoadModal">
          <a href="#" ><i class="fas fa-pen"></i></a>
          <input type="hidden" name="railroad_id" class="hidden_railroad_id" value="<?php echo $loc['RAILROAD_ID']; ?>" />
        </td>
        <td><?php echo $loc['DESCRIPTION']; ?></td>
        <td>#todo</td>
        <td><a href="#" class="btnDelete"><i class="far fa-trash-alt"></i></a></td>
      </tr>
      <?php } ?>
    <?php } ?>
  </tbody>
  </table>

  <div class="text-center"> 
        <input type="button" class="btn btn-primary" data-toggle="modal" data-target="#newRailroad" style="margin-top: 10px;" value="Add New Railroad">
  </div>

</form>

<!-- Modal -->
<div class="modal fade" id="newRailroad" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <form class="form" name="newRailroadForm" id="newRailroadForm">
      <div class="modal-header">
        <h5 class="modal-title" id="Railroad" style="">Railroad</h5>
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
                  <label class="col-md-6" for="DisplayName">Description</label>
                  <input class="form-control col-md-6" id="description" name="description" type="text" placeholder="">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group form-inline">
                  <label for="Status" class="col-md-4">Status</label>
                  <select name="status" id="status" class="form-control col-md-6">
                      <option value="CREATED">CREATED</option>
                      <option value="MODIFIED">MODIFIED</option>
                      <option value="INACTIVE">INACTIVE</option>
                  </select>
                </div>
            </div>
          </div>
            
        
      </div>
      <div class="modal-footer"> 
        <button type="submit" name="submit" class="btn btn-primary">Save</button>
        <button type="button" class="btn btn-secondary">Reset</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
      </div>
      </form>
    </div>
  </div>
</div>




<!-- Modal -->
<div class="modal fade" id="updateRailroad" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <form class="form" name="updateRailroadForm" id="updateRailroadForm">
      <div class="modal-header">
        <h5 class="modal-title" id="Railroad" style="">Railroad</h5>
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
                  <label class="col-md-6" for="DisplayName">Description</label>
                  <input class="form-control col-md-6" id="description" name="description" type="text" placeholder="">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group form-inline">
                  <label for="Status" class="col-md-4">Status</label>
                  <select name="status" id="status" class="form-control col-md-6">
                      <option value="CREATED">CREATED</option>
                      <option value="MODIFIED">MODIFIED</option>
                      <option value="INACTIVE">INACTIVE</option>
                  </select>
                </div>
            </div>
          </div>
            
        
      </div>
      <div class="modal-footer"> 
        <button type="submit" name="submit" class="btn btn-primary">Save</button>
        <button type="button" class="btn btn-secondary">Reset</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
      </div>
      </form>
    </div>
  </div>
</div>



<?php require APPROOT . '/views/inc/footer.php'; ?>