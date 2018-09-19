<?php require APPROOT . '/views/inc/header.php'; ?>
<h3>E-mail Groups Administration</h3>
<form  action="">
  <hr />
  <table class="table table-bordered table-striped table-sm">
    <thead class="thead-dark" >
    <tr>
      <th scope="col" style="width: 15%; text-align: center;">Modify</th>
      <th scope="col" style="text-align: center;">Name</th>
      <th scope="col" style="width: 15%; text-align: center;">Status</th>
      <th scope="col" style="width: 15%; text-align: center;">Delete Group</th>
    </tr>
    </thead>
    <tbody>
    <tr>
      <td scope="row"><a href="#" data-toggle="modal" data-target="#"><i class="fas fa-pen"></i></td>
      <td>Mark</td>
      <td>Otto</td>
      <td><a href="#" class="btnDelete"><i class="far fa-trash-alt"></i></a></td>
    </tr>
    </tbody>
  </table>

 <!--  <div class="text-center"> 
        <input type="button" class="btn btn-primary" style="margin-top: 10px;" value="Add New Group">
  </div> -->

</form>

<div class="text-center"> 
        <input type="button" class="btn btn-primary" data-toggle="modal" data-target="#AddNewGroupModal" style="margin-top: 10px;" value="Add New Group">
</div>
<div class="modal fade" id="AddNewGroupModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel" style="">&lt;&lt;E-mail Group Name&gt;&gt;</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form class="form">
          <div class="row">
                <div class="col-md-12">
                    <div class="form-group form-inline">
                      <label class="col-md-4 text-right" for="EmailGroupName">E-mail Group name</label>
                      <input class="form-control col-md-7" id="TaskDescription" type="text" placeholder="">
                   </div>
                 </div>
          </div>
          <div class="row">
            <div class="col-md-12">
                <div class="form-group form-inline">
                  <label class="col-md-6 text-center" for="Status">Reciepts Of &lt;E-mail Group Name&gt;</label>
                  <label class="col-md-6 text-center" for="Status">Employee List</label>
                  <!-- <input class="form-control col-md-3" id="FirstName" type="text"> -->
                </div>
             </div>
            </div>
              <div class="row">
                 <div class="col-md-12">
                 <div class="form-group form-inline">
                 <!--  <label class="col-md-4 text-right" for="RuleInTask">Rule In Task</label> -->
                  <textarea class="form-control col-md-5" style="border-radius: 20px;" rows="8" id="RuleInTask"></textarea>
                  <div class="col-md-2  text-center">
                    <div class="row">
                      <i class="fa fa-angle-double-right" style="margin-left:35%;font-size:25px;"></i>
                    </div>
                    <div class="row">
                      <i class="fa fa-angle-double-left" style="margin-left:35%;font-size:25px;padding:20% 0% 0% 0%;"></i>
                    </div>
                  </div>
                  <textarea class="form-control col-md-5" style="border-radius: 20px;" rows="8" id="RuleInTask"></textarea>
                </div>
            </div>
          </div>
          <!-- forward and moving glyficons -->
          </form>
        </div>
      <div class="modal-footer"> 
        
       <button type="button" class="btn btn-primary">Save</button>
        <button type="button" class="btn btn-secondary" >Reset</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>

        <!-- latest -->
          
      <!--   <div class="col-md-4 text-center">
          <button type="button" class="btn btn-primary" style="width: 50%">Save</button>
        </div>
         <div class="col-md-4 text-center">
            <button type="button" class="btn btn-secondary" style="width: 50%">Reset</button>
         </div>
          <div class="col-md-4 text-center">
            <button type="button" class="btn btn-secondary" data-dismiss="modal" style="width: 50%">Cancel</button>
          </div> -->

      </div>
    </div>
  </div>
</div>

<?php require APPROOT . '/views/inc/footer.php'; ?>