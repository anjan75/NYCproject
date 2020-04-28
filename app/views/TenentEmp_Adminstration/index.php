<?php require APPROOT . '/views/inc/header.php'; ?>
<h3>Tenent Employee Adminstration</h3>
<hr />
<form  action="">
  <!-- <div class="row">
    <div class="form-group form-inline">
       <label class="col-md-5" for="" >Tenent Employee</label>
    <input type="" class="col-md-7 form-control" id="" name="">
  </div>
  <button id="" name="" class="ml-auto btn btn-primary col-sm-2 btn-xs" style="height: 50%;">Filter</button>
  <button id="" name="" class="ml-auto btn btn-primary col-sm-2 btn-xs" style="height: 50%;">Clear</button>
  </div> -->

  <div class="row">
    <div class="col-md-5">
       <div class="form-group form-inline">
          <label class="col-md-4" for="" style="">Tenent Employee</label>
          <input type="" class="col-md-8 form-control" id="" name="">
       </div>
    </div>
    <div class="col-md-4"></div>
    <div class="col-md-3 text-right">
         <button id="" name="" class="ml-auto btn btn-primary" style="width:40%;margin: 0% 2% 0% 2%;">Filter</button>  
        <button id="" name="" class="ml-auto btn btn-primary" style="width:40%;margin: 0% 2% 0% 2%;">Clear</button>
    </div>
  </div>
  <hr />
  <table class="table table-bordered table-striped table-sm tenentemp-administration">
    <thead class="thead-dark" >
    <tr>
      <th scope="col" style="width: 10%; text-align: center;">Modify</th>
      <th scope="col" style="width: 10%; text-align: center;">Start Date</th>
      <th scope="col" style="width: 10%; text-align: center;">End Date</th>
      <th scope="col" style="text-align: center;">Name</th>
      <th scope="col" style="width: 10%; text-align: center;">Emp ID</th>
      <th scope="col" style="width: 10%; text-align: center;">Employee Status</th>
      <th scope="col" style="width: 10%; text-align: center;">Railroad</th>
      <th scope="col" style="width: 10%; text-align: center;">Occupation</th>
      <th scope="col" style="width: 10%; text-align: center;">Delete Record</th>
    </tr>
    </thead>
    <tbody>
    <tr>
      <td scope="row"><a href="#" data-toggle="modal" data-target="#newTestingOfficerModal"><i class="fas fa-pen"></i></td>
      <td>Mark</td>
      <td>Otto</td>
      <td>Otto</td>
      <td>@mdo</td>
      <td>@mdo</td>
      <td>@mdo</td>
      <td>Mark</td>
      <td><a href="#" class="btnDelete"><i class="far fa-trash-alt"></i></a></td>
    </tr>
    </tbody>
  </table>

  <div class="text-center"> 
        <input type="button" class="btn btn-primary" data-toggle="modal" data-target="#newTestingOfficerModal" style="margin-top: 10px;" value="Add New Testing Officer">
    </div>

</form>


<style type="text/css">
  label{
    justify-content: flex-end;
  }
  .form-check-input {
    
    margin-top: 0.4rem;
    
  }

</style>

<!-- Modal -->
<div class="modal fade" id="newTestingOfficerModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel" style="">Tenent Employee Administration</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form class="form">
          <div class="row">
                <div class="col-md-6">

                    <div class="form-group form-inline">
                      <label class="col-md-5" for="Railroad">Railroad</label>
                      <input class="form-control col-md-7" id="Railroad" type="text" placeholder="">
                   </div>
                 </div>
              <div class="col-md-6">
                <div class="form-group form-inline">
                  <label for="EmplyoeeID" class="col-md-5">Emplyoee ID</label>
                  <input type="text" class="form-control col-md-7" id="EmplyoeeID" placeholder="">
                </div>
              </div>
          </div>
          <div class="row">
            <div class="col-md-6">

                <div class="form-group form-inline">
                  <label class="col-md-5" for="FirstName">First Name</label>
                  <input class="form-control col-md-7" id="FirstName" type="text">
                </div>
             </div>
              <div class="col-md-6">
                <div class="form-group form-inline">
                  <label for="LastName" class="col-md-5">Last Name</label>
                  <input type="text" class="form-control col-md-7" id="LastName">
                </div>
              </div>
            </div>
              <div class="row">
                 <div class="col-md-6">

                <div class="form-group form-inline">
                  <label class="col-md-5" for="JobDescription">Job Description</label>
                  <input class="form-control col-md-7" id="JobDescription" type="text" placeholder="">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group form-inline">
                  <label for="Status" class="col-md-5">Status</label>
                  <input type="text" class="form-control col-md-7" id="Status" placeholder="">
                </div>
            </div>
          </div>          
        </form>
      </div>
      <div class="modal-footer"> 
        <!-- <div class="form-inline">
          <div class="row" style="">
            <div class="col-md-4">
              <button type="button" class="btn btn-primary">Save</button>
            </div>
            <div class="col-md-4">
               <button type="button" class="btn btn-secondary" >Reset</button>
            </div>
            <div class="col-md-4"><button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button></div>
              </div>
        </div> -->
        <button type="button" class="btn btn-primary">Save</button>
        <button type="button" class="btn btn-secondary" >Reset</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
      </div>
    </div>
  </div>
</div>








<?php require APPROOT . '/views/inc/footer.php'; ?>