<?php require APPROOT . '/views/inc/header.php'; ?>
<h3>Rules Administration</h3>
<hr />
<form  action="">
  <!-- <div class="row">
    <div class="form-group form-inline">
    <label class="col-md-2" for="">Rule Status</label>
    <input type="" class="col-md-2 form-control" id="" name="">
    <label class="col-md-3" for="" style="">Description Search-Key Words</label>
    <input type="" class="col-md-4 form-control" id="" name="">
    </div>
  <button id="" name="" class="ml-auto btn btn-primary col-sm-1 btn-xs" style="height: 50%;">Filter</button>
  <button id="" name="" class="ml-auto btn btn-primary col-sm-1 btn-xs" style="height: 50%;">Clear</button>
  </div> -->
 
<!-- latest -->
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
  <table class="table table-bordered table-striped table-sm rules-administrator">
    <thead class="thead-dark" >
    <tr>
      <th scope="col">Modify</th>
      <th scope="col">Observation Code</th>
      <th scope="col">Rule Number</th>
      <th scope="col">Display Description</th>
      <th scope="col">Category</th>
      <th scope="col">Referenced Rule</th>
      <th scope="col">FRA Reportable</th>
      <th scope="col">Disposition Code</th>
      <th scope="col">Status</th>
    </tr>
    </thead>
    <tbody>
    <tr>
      <td scope="row"><a href="#" data-toggle="modal" data-target="#RuleModal"><i class="fas fa-pen"></i></td>
      <td>Mark</td>
      <td>Otto</td>
      <td>Otto</td>
      <td>@mdo</td>
      <td>@mdo</td>
      <td>@mdo</td>
      <td>Mark</td>
      <td>Otto</td>
    </tr>
    <tr>
      <td scope="row"><a href="#" data-toggle="modal" data-target="#RuleModal"><i class="fas fa-pen"></i></td>
      <td>Mark</td>
      <td>Otto</td>
      <td>Otto</td>
      <td>@mdo</td>
      <td>@mdo</td>
      <td>@mdo</td>
      <td>Mark</td>
      <td>Otto</td>
    </tr>
    </tbody>
  </table>

  <div class="text-center"> 
<!--         <input type="button" class="btn btn-primary" style="margin-top: 10px;" value="Add New Rule"> -->
        <input type="button" class="btn btn-primary" data-toggle="modal" data-target="#RuleModal" style="margin-top: 10px;" value="Add New Rule">
    </div>

</form>
<!-- Modal -->
<div class="modal fade" id="RuleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel" style="">Rule</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form class="form">
          <div class="row">
            <div class="col-md-6">

                <div class="form-group form-inline">
                  <label class="col-md-6" for="ObservationCode">Observation Code</label>
                  <input class="form-control col-md-6" id="ObservationCode" type="text" placeholder="">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group form-inline">
                  <label for="RuleNumber" class="col-md-6">Rule Number</label>
                  <input type="text" class="form-control col-md-6" id="RuleNumber" placeholder="">
                </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">

                <div class="form-group form-inline">
                  <label class="col-md-3" for="DisplayDescription">Display Description</label>
                  <input class="form-control col-md-9" id="DisplayDescription" type="text">
                </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">

                <div class="form-group form-inline">
                  <label class="col-md-3" for="FullDescription">Full Description</label>
                  <!-- <input class="form-control col-md-9" id="FullDescription" type="text"> -->
                  <textarea class="form-control col-md-9" rows="4" id="FullDescription"></textarea>
                </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">

                <div class="form-group form-inline">
                  <label class="col-md-6" for="FRAReportable">FRA Reportable</label>
                  <input class="form-control col-md-6" id="FRAReportable" type="text" placeholder="">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group form-inline">
                  <label for="Category" class="col-md-6">Category</label>
                  <input type="text" class="form-control col-md-6" id="Category" placeholder="">
                </div>
            </div>
          </div>    
           <div class="row">
            <div class="col-md-6">

                <div class="form-group form-inline">
                  <label class="col-md-6" for="DispositionCode">Disposition Code</label>
                  <input class="form-control col-md-6" id="DispositionCode" type="text" placeholder="">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group form-inline">
                  <label for="Status" class="col-md-6">Status</label>
                  <input type="text" class="form-control col-md-6" id="Status" placeholder="">
                </div>
            </div>
          </div> 
          <div class="row">
            <div class="col-md-12">
              <div class="form-group form-inline">
                <label class="col-md-3" for="ReferencedRule">Referenced Rule</label>    
                <input type="text" class="form-control col-md-6" id="ReferencedRule">           
              </div>
              
            </div>
            

          </div>      
        </form>
      </div>
      <div class="modal-footer" style=""> 
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