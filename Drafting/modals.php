<div class="modal fade" id="AddStatus" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="  modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Status</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       <div class="container-fluid">
           <div class="form-group">
                  <label for="Sadd">Status Title</label>
                  <input type="text" class="form-control" id="Sadd" placeholder="Enter Status">
            </div>
           <button class="btn-sm btn mt-1 mb-1 text-white" id="Saddbtn"> Add Status</button>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        
      </div>
    </div>
  </div>
</div>
    </div>

<!-- Edit Modal -->
<div class="modal fade" id="EditStatus" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="  modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Status</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       <div class="container-fluid">
          
           <label class="font-weight-bold">Select Status</label><br>
              <select style="width:100%" id="Sedit" onchange="document.getElementById('NewStatus').value = this.options[this.selectedIndex].text">
   <option value="" disabled selected>Please Choose Status</option>
  
<?php 
$sql = mysqli_query($con, "SELECT * FROM DStatus");
while ($row = $sql->fetch_assoc()){
echo "<option value=".$row['Sr_no'].">".$row['DStatus']."</option>";
}
?>
              </select>
             <input class="form-control mt-3" type="text"  id="NewStatus" placeholder="Edit Status">
             
              <button type="button" id="Seditbtn" class="btn btn-primary mt-2" >Edit Status</button>
          
           
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        
      </div>
    </div>
  </div>
</div>
    </div>

<!-- Del Draft Modal -->
<div class="modal fade" id="DeleteStatus" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="  modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Delete Status</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       <div class="container-fluid">
                <label class="font-weight-bold">Select Status</label><br>
              <select class=""style="width:100%" id="SDel">
   <option value="" disabled selected>Please Choose Status</option>
  
<?php 

$sql = mysqli_query($con, "SELECT * FROM DStatus");
while ($row = $sql->fetch_assoc()){
echo "<option value=".$row['Sr_no'].">".$row['DStatus']."</option>";
}
?>
              </select><br>
              <button type="button" id="SDelbtn" class="btn btn-primary mt-2" >Delete Status</button>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        
      </div>
    </div>
  </div>
</div>
    </div>



<div class="Drafts Modals">
    <!-- Modal -->
<div class="modal fade" id="AddDraftType" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="  modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Draft Type</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       <div class="container-fluid">
           <div class="form-group">
                  <label for="Dadd">Draft Title</label>
                  <input type="text" class="form-control" id="Dadd" placeholder="Enter Draft Type">
            </div>
           <button class="btn-sm btn mt-1 mb-1 text-white" id="Daddbtn"> Add Type</button>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        
      </div>
    </div>
  </div>
</div>
    </div>

<!-- Edit Modal -->
<div class="modal fade" id="EditDraftType" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="  modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Draft Type</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       <div class="container-fluid">
          
           <label class="font-weight-bold">Select Draft Type</label><br>
              <select style="width:100%" id="Dedit" onchange="document.getElementById('NewDtype').value = this.options[this.selectedIndex].text">
   <option value="" disabled selected>Please Choose Draft Type</option>
  
<?php 
$sql = mysqli_query($con, "SELECT * FROM DraftTypes");
while ($row = $sql->fetch_assoc()){
echo "<option value=".$row['Sr_no'].">".$row['DName']."</option>";
}
?>
              </select>
             <input class="form-control mt-3" type="text"  id="NewDtype" placeholder="Edit Draft Type">
             
              <button type="button" id="Deditbtn" class="btn btn-primary mt-2" >Edit Draft Type</button>
          
           
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        
      </div>
    </div>
  </div>
</div>
    </div>

<!-- Del Draft Modal -->
<div class="modal fade" id="DeleteDraftType" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="  modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Delete Draft Type</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       <div class="container-fluid">
                <label class="font-weight-bold">Select Draft Type</label><br>
              <select class=""style="width:100%" id="DDel">
   <option value="" disabled selected>Please Choose Draft Type</option>
  
<?php 

$sql = mysqli_query($con, "SELECT * FROM DraftTypes");
while ($row = $sql->fetch_assoc()){
echo "<option value=".$row['Sr_no'].">".$row['DName']."</option>";
}
?>
              </select><br>
              <button type="button" id="DDelbtn" class="btn btn-primary mt-2" >Delete Draft Type</button>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        
      </div>
    </div>
  </div>
</div>
    </div>


</div>