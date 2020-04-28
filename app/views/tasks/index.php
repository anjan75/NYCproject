<?php require APPROOT . '/views/inc/header.php'; ?>
<h3>Tasks Administration</h3>
<hr />
<form  action="">
 <!--  <div class="row">
    <div class="form-group form-inline">
    <label class="col-md-2" for="" style="">Task Status</label>
    <input type="" class="col-md-2 form-control" id="" name="">
    <label class="col-md-3" for="" style="">Description Search-Key Words</label>
    <input type="" class="col-md-4 form-control" id="" name="">
    </div>
  <button id="" name="" class="ml-auto btn btn-primary col-sm-1 btn-xs" style="height: 50%;">Filter</button>
  <button id="" name="" class="ml-auto btn btn-primary col-sm-1 btn-xs" style="height: 50%;">Clear</button>
  </div> -->
  <div class="row">
    <div class="col-md-3">
       <div class="form-group form-inline">
          <label class="col-md-6" for="" style="">Task Status</label>
          <input type="" class="col-md-6 form-control" id="" name="">
       </div>
    </div>
    <div class="col-md-6">
      <div class="form-group form-inline">
          <label class="col-md-5" for="" style="">Description Search-Key Words</label>
          <input type="" class="col-md-7 form-control" id="" name="">
       </div>
    </div>
    <div class="col-md-3 text-right">
     <!--  <div class="col-md-6"> -->
         <button id="" name="" class="ml-auto btn btn-primary" style="width:40%;margin: 0% 2% 0% 2%;">Filter</button>  
     <!--  </div> -->
      <!-- <div class="col-md-6"> -->
        <button id="" name="" class="ml-auto btn btn-primary" style="width:40%;margin: 0% 2% 0% 2%;">Clear</button>
     <!--  </div> -->
    </div>
  </div>
  <hr />
  <table class="table table-bordered table-striped table-sm task-administrator">
    <thead class="thead-dark" >
    <tr>
      <th scope="col" style="text-align: center;">Modify</th>
      <th scope="col" style="text-align: center;">Description</th>
      <th scope="col" style="width: 20%; text-align: center;">Status</th>
    </tr>
    </thead>
    <tbody>
    <tr>
      <td scope="row"><a href="#" data-toggle="modal" data-target="#AddNewTaskModal"><i class="fas fa-pen"></i></td>
      <td>Mark</td>
      <td>Otto</td>
    </tr>
    <tr>
      <td scope="row"><a href="#" data-toggle="modal" data-target="#AddNewTaskModal"><i class="fas fa-pen"></i></td>
      <td>Mark</td>
      <td>Otto</td>
    </tr>
    </tbody>
  </table>

 <!--  <div class="text-center"> 
        <input type="button" class="btn btn-primary" style="margin-top: 10px;" value="Add New Task">
  </div> -->

</form>
<div class="text-center"> 
        <input type="button" class="btn btn-primary" data-toggle="modal" data-target="#AddNewTaskModal" style="margin-top: 10px;" value="Add New Task">
</div>
<div class="modal fade" id="AddNewTaskModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel" style="">Add New Task</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!-- <form class="form">
            <div class="row">
              <div class="col-md-4 text-right">
              <label class="" for="" style="">Task Description</label>
              </div>
              <div class="col-md-7">
                 <input type="" class="form-control" id="" name="">
              </div>
              <div class="col-md-1">   </div>
            </div>
             <div class="row">
               <div class="col-md-4 text-right">
              <label class="" for="" style="">Status</label>
              </div>
              <div class="col-md-3">
                 <input type="" class="form-control" id="" name="">
              </div>
              <div class="col-md-5">   </div>
            </div>
             <div class="row">
              <div class="col-md-4">
              </div>
              <div class="col-md-8">
              </div>
            </div>
             <div class="row">
              <div class="col-md-4">
              </div>
              <div class="col-md-8">
              </div>
            </div>
             <div class="row">
              <div class="col-md-4">
              </div>
              <div class="col-md-8">
              </div>
            </div>
        </form> -->
        <form class="form">
          <div class="row">
                <div class="col-md-12">
                    <div class="form-group form-inline">
                      <label class="col-md-4 text-right" for="TaskDescription">Task Description</label>
                      <input class="form-control col-md-7" id="TaskDescription" type="text" placeholder="">
                   </div>
                 </div>
          </div>
          <div class="row">
            <div class="col-md-12">
                <div class="form-group form-inline">
                  <label class="col-md-4 text-right" for="Status">Status</label>
                  <input class="form-control col-md-3" id="FirstName" type="text">
                </div>
             </div>
            </div>
              <div class="row">
                 <div class="col-md-12">
                 <div class="form-group form-inline">
                  <label class="col-md-4 text-right" for="RuleInTask">Rule In Task</label>
                  <textarea class="form-control col-md-7" rows="4" id="RuleInTask"></textarea>
                </div>
            </div>
          </div>
          <!-- forward and moving glyficons -->
          <div class="col-md-12">
            <div class="form-group form-inline">
              <div class="col-md-4">
                
              </div>
              <div class="col-md-4 text-right">
                <i class="fa fa-angle-double-up" style="padding:0% 8% 0% 5%; font-size:25px;"></i>
                <i class="fa fa-angle-double-down" style="padding:0% 8% 0% 5%; font-size:25px;"></i>
              </div>
              <div class="col-md-4">
                
              </div>
              
            </div>
          </div> 
          <div class="row">
                 <div class="col-md-12">
                 <div class="form-group form-inline">
                  <label class="col-md-4 text-right" for="RulesNotInTask">Rules Not In Task</label>
                  <textarea class="form-control col-md-7" rows="4" id="RulesInTask"></textarea>
                </div>
            </div>
          </div>                   

      </div>
      <div class="modal-footer"> 
        <!-- 
       <button type="button" class="btn btn-primary">Save</button>
        <button type="button" class="btn btn-secondary" >Reset</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button> -->

        <!-- latest -->
          
        <div class="col-md-4 text-center">
          <button type="button" class="btn btn-primary" style="width: 50%">Save</button>
        </div>
         <div class="col-md-4 text-center">
            <button type="button" class="btn btn-secondary" style="width: 50%">Reset</button>
         </div>
          <div class="col-md-4 text-center">
            <button type="button" class="btn btn-secondary" data-dismiss="modal" style="width: 50%">Cancel</button>
          </div>

      </div>
    </div>
  </div>
</div>

<?php require APPROOT . '/views/inc/footer.php'; ?>