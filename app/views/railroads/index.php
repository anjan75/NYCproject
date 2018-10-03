<?php require APPROOT . '/views/inc/header.php'; ?>
<h3>Railroad Administration</h3>
<form  action="">
  <hr />
  <table class="table table-bordered table-striped table-sm railroad-administrator">
    <thead class="thead-dark">
    <tr>
      <th>Modify</th>
      <th>Railroad Short Text</th>
      <th>Railroad Description</th>
      <th>Status</th>
    </tr>
    </thead>
    <tbody>
    <?php if(isset($data['railroads']) && is_array($data['railroads']) && count($data['railroads']) > 0){ ?>
      <?php $i=0; ?>
      <?php for ($i = 0; $i < count($data['railroads']['DESCRIPTION']); $i++){ ?>
      <tr>
        <td class="updateRailRoadModal">
          <a href="#" ><i class="fas fa-pen"></i></a>
          <input type="hidden" name="railroad_id" class="hidden_railroad_id" value="<?php echo $data['railroads']['RAILROAD_ID'][$i]; ?>" />
        </td>
        <td><?php echo $data['railroads']['RAILROAD'][$i]; ?></td>
        <td><?php echo $data['railroads']['DESCRIPTION'][$i]; ?></td>
        <td><?php echo $data['railroads']['SDESCR'][$i]; ?></td>
      </tr>
      <?php  } ?>
    <?php } ?>
  </tbody>
  </table>

  <div class="text-center"> 
        <input type="button" class="btn btn-primary" data-toggle="modal" data-target="#newRailroad" value="Add New Railroad">
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
          </div>
          <div class="container">
           <div class="form-group row">
            <div class="col-md-3 label-right">
              <label  for="DisplayName">Railroad Short Text</label>
            </div>
            <div class="col-md-3">
              <input class="form-control" id="railroad" name="railroad" type="text" placeholder="">
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
              <label for="DisplayName">Railrod Description</label>
            </div>
            <div class="col-md-9">
               <input class="form-control" id="description" name="description" type="text">
            </div>
           </div> 
        </div>
      </div>
      <div class="modal-footer"> 
        <div class="container">
          <div class="form-group row">
            <div class="col-md-2 offset-md-3">
               <button type="submit" name="submit" class="btn btn-primary btn-sm btn-block">Save</button>
            </div>
            <div class="col-md-2">
               <button type="button" class="btn btn-primary btn-sm btn-block railroad_reset">Reset</button>
            </div>
            <div class="col-md-2">
               <button type="button" class="btn btn-primary btn-sm btn-block" data-dismiss="modal">Cancel</button>
            </div>
          </div> 
        </div>
      </div>
      </form>
    </div>
  </div>
</div>




<!-- Update Modal -->
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
          </div>
          <div class="container">
           <div class="form-group row">
            <div class="col-md-3 label-right">
              <label  for="DisplayName">Railroad Short Text</label>
            </div>
            <div class="col-md-3">
              <input class="form-control" id="railroad" name="railroad" type="text" placeholder="">
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
              <label for="DisplayName">Railrod Description</label>
            </div>
            <div class="col-md-9">
               <input class="form-control" id="description" name="description" type="text">
            </div>
           </div> 
        </div>   
      </div>
      <div class="modal-footer"> 
        <div class="container">
          <div class="form-group row">
            <div class="col-md-2 offset-md-3">
               <button type="submit" name="submit" class="btn btn-primary btn-sm btn-block">Save</button>
            </div>
            <div class="col-md-2">
               <button type="button" class="btn btn-primary btn-sm btn-block railroad_reset">Reset</button>
            </div>
            <div class="col-md-2">
               <button type="button" class="btn btn-primary btn-sm btn-block" data-dismiss="modal">Cancel</button>
            </div>
            <input type="hidden" class="rail_id_hidden" name="railroad_id">
          </div> 
        </div>
      </div>
      </form>
    </div>
  </div>
</div>



<?php require APPROOT . '/views/inc/footer.php'; ?>