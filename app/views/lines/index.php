<?php require APPROOT . '/views/inc/header.php'; ?>
<h3>Lines Administration</h3>
<form  action="">
  <hr />
  <table class="table table-bordered table-striped table-sm line-administration">
    <thead class="thead-dark" >
    <tr>
      <th scope="col" style="width: 10%; text-align: center;">Modify</th>
      <th scope="col" style="width: 25%; text-align: center;">Line Short Text</th>
      <th scope="col" style="text-align: center;">Line Description</th>
      <th scope="col" style="width: 10%; text-align: center;">Status</th>
      <!-- <th scope="col" style="text-align: center;">Modify</th>
      <th scope="col" style="text-align: center;">Line Short Text</th>
      <th scope="col" style="text-align: center;">Line Description</th>
      <th scope="col" style="text-align: center;">Status</th> -->
    </tr>
    </thead>
    <tbody>
      <tr>
         <?php if(isset($data['lines']) && is_array($data['lines']) && count($data['lines']) > 0){ ?>
        <?php $i=0; ?>
        <?php for ($i = 0; $i < count($data['lines']['DESCRIPTION']); $i++){ ?>
        <tr>
          <td class="updatelineModal">
            <a href="#" ><i class="fas fa-pen"></i></a>
            <input type="hidden" name="line_id" class="hidden_line_id" value="<?php echo $data['lines']['LINE_ID'][$i]; ?>" />
          </td>
          <td><?php echo $data['lines']['LINE_CODE'][$i]; ?></td>
          <td><?php echo $data['lines']['DESCRIPTION'][$i]; ?></td>
          <td><?php echo $data['lines']['STATUS'][$i]; ?></td>
        </tr>
        <?php  } ?>
      <?php } ?>
      </tr>
    </tbody>
  </table>

  <div class="text-center"> 
        <input type="button"  data-toggle="modal" data-target="#newLineModal" class="btn btn-primary" style="margin-top: 10px;" value="Add New Line">
  </div>

</form>
<!-- Modal -->
<div class="modal fade" id="newLineModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <form class="form" name="newLineForm" id="newLineForm">
      <div class="modal-header">
        <h5 class="modal-title" id="Line" style="">Line</h5>
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
              <label for="LineCode">Line Short Text</label>
            </div>
            <div class="col-md-3">
              <input class="form-control" name="linecode" id="linecode" type="text" placeholder="">
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
              <label for="LineDescription">Line Description</label>
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
               <button type="button" class="btn btn-secondary btn-sm btn-block line_reset">Reset</button>
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
<!-- UPDATE MODAL -->
<div class="modal fade" id="updatelineModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <form class="form" name="updateLineForm" id="updateLineForm">
      <div class="modal-header">
        <h5 class="modal-title" id="Line" style="">Line</h5>
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
              <label for="LineCode">Line Code</label>
            </div>
            <div class="col-md-3">
              <input class="form-control" name="linecode" id="linecode" type="text" placeholder="">
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
               <label for="LineDescription">Line Description</label>
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
               <button type="button" class="btn btn-secondary btn-sm btn-block line_reset">Reset</button>
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