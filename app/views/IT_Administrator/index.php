<?php require APPROOT . '/views/inc/header.php'; ?>
<h3>IT Administrator - User Administration</h3>
<hr />
<form  action="">
<div class="row">
    <div class="col-md-5">
       <div class="form-group form-inline">
          <label class="col-md-4" for="" style="">Testing Officer</label>
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
  <!-- <table class="table table-bordered table-striped table-sm">
    <thead class="thead-dark" >
    <tr>
      <th scope="col" style="width: 10%; text-align: center;">Modify</th>
      <th scope="col" style="text-align: center;">name</th>
      <th scope="col" style="width: 10%; text-align: center;">Employee Status</th>
      <th scope="col" style="width: 10%; text-align: center;">Department</th>
      <th scope="col" style="width: 10%; text-align: center;">Occupation</th>
      <th scope="col" style="width: 10%; text-align: center;">Sub Department</th>
      <th scope="col" style="width: 15%; text-align: center;">User Permission(s)</th>
      <th scope="col" style="width: 15%; text-align: center;">Notes</th>
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
    </tr>
    </tbody>
  </table> -->
  <table class="table table-bordered table-striped table-sm users-data-users">
    <thead class="thead-dark" >
    <tr>
      <th scope="col" style="" text-align: center;">Modify</th>
      <th scope="col" style=""text-align: center;">BSC ID</th>
      <th scope="col" style="width: 10%; text-align: center;">Name</th>
      <th scope="col" style="text-align: center;">Business Unit</th>
      <th scope="col" style="width: 10%; text-align: center;">Deparment</th>
      <th scope="col" style="width: 10%; text-align: center;">Job Code</th>
      <th scope="col" style="width: 10%; text-align: center;">Job Description</th>
      <th scope="col" style="width: 10%; text-align: center;">Position Number</th>
      <th scope="col" style="width: 10%; text-align: center;">Position Description</th>
      <th scope="col" style="width: 10%; text-align: center;">Process Role</th>
      <th scope="col" style="text-align: center;">Management Center ID</th>
      <th scope="col" style="width: 10%; text-align: center;">User Permision(s)</th>
      <th scope="col" style="width: 10%; text-align: center;">Delete Record</th>

    </tr>
    </thead>
    <tbody>
    <tr>
      <td scope="row"><a href="#" data-toggle="modal" data-target="#newTestingOfficerModal"><i class="fas fa-pen"></i></td>
      <td>12345678912346165498456</td>
      <td>anjaneyulu gorige</td>
      <td>dfdsafaisofhdslkfjdoai</td>
      <td>@mdo</td>
      <td>@mdo</td>
      <td>@mdo</td>
      <td>Mark</td>
      <td>Otto</td>
      <td>Otto</td>
      <td>Otto</td>
      <td>Otto</td>
      <td><a href="#" class="btnDelete"><i class="far fa-trash-alt"></i></a></td>
    </tr>
    </tbody>
  </table>
</form>
<div class="text-center"> 
        <input type="button" class="btn btn-primary" data-toggle="modal" data-target="#newTestingOfficerModal" style="margin-top: 10px;" value="Add New Testing Officer">
    </div>

    <style type="text/css">
  label{
    justify-content: flex-end;
  }
  .form-check-input {
    
    margin-top: 0.4rem;
    
  }
/*  .modal-footer{
    display: inline !important;
  }*/

</style>

<!-- Modal -->
<div class="modal fade" id="newTestingOfficerModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel" style="">Add New Testing Officer</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form class="form">
          <div class="row">
            <div class="col-md-6">

                <div class="form-group form-inline">
                  <label class="col-md-5" for="BSC ID">BSC ID</label>
                  <input class="form-control col-md-7" id="bscid" type="text" placeholder="Enter BSC ID">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group form-inline">
                  <label for="Name" class="col-md-5">Name</label>
                  <input type="text" class="form-control col-md-7" id="name" placeholder="Name">
                </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">

                <div class="form-group form-inline">
                  <label class="col-md-5" for="Department">Department</label>
                  <input class="form-control col-md-7" id="bscid" type="text" placeholder="" disabled="disabled">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group form-inline">
                  <label for="Name" class="col-md-5">Business Unit</label>
                  <input type="text" class="form-control col-md-7" id="name" placeholder="" disabled="disabled">
                </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">

                <div class="form-group form-inline">
                  <label class="col-md-5" for="BSC ID">Status Validity</label>
                  <input class="form-control col-md-7" id="bscid" type="text" placeholder="">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group form-inline">
                  <label for="Name" class="col-md-5">Status</label>
                  <input type="text" class="form-control col-md-7" id="name" placeholder="">
                </div>
            </div>
          </div>
          <!-- <div class="row">
            <div class="col-md-6">                  
                  <div class="form-check" style="float: right;">
                    <label class="form-check-label" for="exampleRadios2" style="margin-right: 30px;">
                      Data Entry for Self
                    </label>
                    <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios2" value="option2">
                  </div>
                  <div class="form-check" style="float: right;">
                    <label class="form-check-label" for="exampleRadios2" style="margin-right: 30px;">
                      Data Entry for Others
                    </label>
                    <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios2" value="option2">
                  </div>
                  <div class="form-check" style="float: right;">
                    <label class="form-check-label" for="exampleRadios2" style="margin-right: 30px;">
                      Designated Instructor
                    </label>
                    <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios2" value="option2">
                  </div>
                  <div class="form-check" style="float: right;">
                    <label class="form-check-label" for="exampleRadios2" style="margin-right: 30px;">
                      Qualified Personnel
                    </label>
                    <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios2" value="option2">
                  </div>
                
            </div>
            <div class="col-md-6">
                <div class="checkbox" style="float: right;">
                  <label>Data Entry Administrator<input style="margin-right: 30px; margin-left: 7px;" type="checkbox" value=""></label>
                </div>

                <div class="checkbox" style="float: right;">
                  <label>&nbsp&nbsp&nbsp&nbsp View Reports<input style="margin-right: 30px; margin-left: 7px;" type="checkbox" value=""></label>
                </div>

                <div class="checkbox" style="float: right;">
                  <label>User Data Administrator<input style="margin-right: 30px; margin-left: 7px;" type="checkbox" value=""></label>
                </div>

                <div class="checkbox" style="float: right;">
                  <label>UserSecurity Level Administrator<input style="margin-right: 30px; margin-left: 7px;" type="checkbox" value=""></label>
                </div>

                <div class="checkbox" style="float: right;">
                  <label>Task/Rules Administrator<input style="margin-right: 30px; margin-left: 7px;" type="checkbox" value=""></label>
                </div>

                <div class="checkbox" style="float: right;">
                  <label>Table data Administrator<input style="margin-right: 30px; margin-left: 7px;" type="checkbox" value=""></label>
                </div>
            </div>
          </div>
          
          
          
        </form> -->


<div class="row">
            <div class="col-md-6 user-roles-left me-yes">                  
            </div>
            <div class="col-md-6 user-roles-right me-no">
            </div>
          </div>
        
      </div>
      <div class="modal-footer"> 
        <!-- <div class="form-inline">
          <div class="row" style="float:left;">
            <div class="col-md-4">
              <button type="button" class="btn btn-primary">Save</button>

            </div>
            <div class="col-md-4">
               <button type="button" class="btn btn-secondary" >Reset</button>
            </div>
            <div class="col-md-4"><button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button></div>
          </div>
        </div> -->
      <!-- <div class="row">
        <div class="col-md-4 text-center">
          <button type="button" class="btn btn-primary">Save</button>
        </div>
        <div class="col-md-4 text-center">
          <button type="button" class="btn btn-secondary" >Reset</button>
        </div>
        <div class="col-md-4 text-center">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        </div>
        
       </div>  -->
       <button type="button" class="btn btn-primary">Save</button>
        <button type="button" class="btn btn-secondary" >Reset</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        
      </div>
    </form>  
    </div>
  </div>
</div>
<?php require APPROOT . '/views/inc/footer.php'; ?>