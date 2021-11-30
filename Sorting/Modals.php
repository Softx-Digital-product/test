<div class="modals-department">
    
    <!<!-- Edit Flag Modals -->
    <div class="modal fade" id="EditFlags"  aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Flags</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <div class="container-fluid p-0">
              <div class="form-group">
                  <label for="EditFlagId"class="font-weight-bold">Select Flag </label>
                  <select style="width:100%;" id="EditFlagId" class="form-group mt-1 mb-1" onchange="document.getElementById('EFlagText').value = this.options[this.selectedIndex].text">
   <option value="" disabled selected>Please Choose Flag</option>
  
<?php 
$sql = mysqli_query($con, "SELECT * FROM Flags");
while ($row = $sql->fetch_assoc()){
echo "<option value=".$row['Sr_no'].">".$row['FlagName']."</option>";
}
?>
              </select>
            
              </div>
          
                   <div class="form-group">
    <label for="FlagName" class="font-weight-bold">Flag Name</label>
    <input type="text" class="form-control" id="EFlagText"  placeholder="Enter Flag Name" required>
  </div>
<!--                  <button class="btn btn-sm  text-white mt-2"id="EFlagbtn">Edit Flag</button>-->
           
          </div>
          
          
      </div>
      <div class="modal-footer">
           <button class="btn   text-white mt-2"id="EFlagbtn">Edit Flag</button>
            <button class="btn   text-white mt-2"id="DFlagbtn">Delete Flag</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
       
      </div>
    </div>
  </div>
</div>
    <!-- Create Flags Modal -->
<div class="modal fade" id="CreateFlags"  aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Create Flags</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <div class="container-fluid p-0">
          
                   <div class="form-group">
    <label for="FlagName"class="font-weight-bold">Flag Name</label>
    <input type="text" class="form-control" id="FlagName"  placeholder="Enter Flag Name" required>
  </div>
                  <button class="btn btn-sm  text-white mt-2"id="CFlagbtn">Create Flag</button>
           
          </div>
          
          
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
       
      </div>
    </div>
  </div>
</div>
    
    
    
    
    
</div>