

<div class="modals">
    <!-- Modal -->
<div class="modal fade" id="viewcontent" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class=" modal-xl modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">View Content</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <div class="card">
              <div class="card-body">
                  <div class="container-fluid" id="dycontent">
                      
                  </div>
              </div>
          </div>
          
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

      </div>
    </div>
  </div>
</div>
    
    
    

<div class="modal fade" id="AddDocTy"  tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"> Add Type</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          
          <div class="container-fluid">
              
               <div class="form-group">
                <label class="font-weight-bold">Enter Type</label>
               <input class="form-control" name="Type" id="Docty" placeholder="Enter DocumentType">
               
               <button id="addty" class="btn btn-primary mt-2"> Add Doc Type</button>
               
                </div>  
              
           
          </div>
            
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
       
      </div>
    </div>
  </div>
</div>
                
                              <!-- Edit Modal -->
<div class="modal fade" id="EditDocTy" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"> Edit Type</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          
          <label class="font-weight-bold">Select Document Type</label><br>
          <select  class="form-control" style="width:100%;" id="editty" placeholder="Choose Docuement Type..">
   <option value="" disabled selected>Choose Document Type</option>
  
<?php 

$sql = mysqli_query($con, "SELECT * FROM Document_type");
while ($row = $sql->fetch_assoc()){
echo "<option value=".$row['Sr_no'].">".$row['Document_name']."</option>";
}
?>
</select>
             <input class="form-control mt-3" type="text"  id="Renamety" placeholder=" Edit Document ">
             
              <button type="button" id="EditTy" class="btn btn-primary mt-2" >Edit Document</button>
          
 
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
       
      </div>
    </div>
  </div>
</div>
                                              <!--Delete Modal -->
<div class="modal fade" id="DelDocTy" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Delete Type</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          
          <label class="font-weight-bold">Select Document Type</label><br>
              <select  class="form-control" style="width:100%;" id="DeleteTy" placeholder="Choose Document Type..">
   <option value="" disabled selected>Choose Document Category</option>
  
<?php 

$sql = mysqli_query($con, "SELECT * FROM Document_type");
while ($row = $sql->fetch_assoc()){
echo "<option value=".$row['Sr_no'].">".$row['Document_name']."</option>";
}
?>
</select>
              <button type="button" id="DelTy" class="btn btn-primary mt-2" >Delete Type</button>
        
 
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
       
      </div>
    </div>
  </div>
</div>

                                              
                              
                                              
</div>
      
<script>
                  
document.getElementById("addty").addEventListener("click", AddDocTy);
function AddDocTy(){
  var Cname= document.getElementById("Docty").value;
console.log(Cname);
var cname= JSON.stringify(Cname);

$.ajax({ 
     type: "POST", 
     // url: "Timeline/AddDocTy.php", 
      url: "Timeline/Docfunction.php", 
       data: {AddDocTy:cname},
      success: function(res) { 
        console.log(res);
//        location.reload(); 
$('#editty').html(res);
$('#DeleteTy').html(res);
$('#Ctdy').html(res);
$('#AddDocTy').modal('toggle');
$('#Docty').val("");



  } 
        
});

};

 document.getElementById("EditTy").addEventListener("click", editSC);
function editSC(){
      var Cid=document.getElementById('editty').value;
      var Rename=document.getElementById('Renamety').value;
      console.log(Cid);
      console.log(Rename);
      var cid= JSON.stringify(Cid);
      var renames=JSON.stringify(Rename);
      $.ajax({ 
     type: "POST", 
//      url: "Timeline/EditDocTy.php", 
    url: "Timeline/Docfunction.php",
       data: {EditDocTy:cid,rename:renames},
      success: function(res) { 
        console.log(res);
     
 $('#editty').html(res);
$('#DeleteTy').html(res);
$('#Ctdy').html(res);
$('#EditDocTy').modal('toggle');
   $('#renamety').val("");
    
 } 
       
});
};

 document.getElementById("DelTy").addEventListener("click", DelT);
function DelT(){
      var Cid=document.getElementById('DeleteTy').value;
      console.log(Cid);
      var cid= JSON.stringify(Cid);
      $.ajax({ 
     type: "POST", 
//      url: "Timeline/DelDocTy.php", 
url: "Timeline/Docfunction.php",
       data: {DelDocTy:cid},
      success: function(res) { 
        console.log(res);
  $('#editty').html(res);
$('#DeleteTy').html(res);
$('#Ctdy').html(res);
$('#DelDocTy').modal('toggle');
 
 } 
       
});  
};


    
    </script>