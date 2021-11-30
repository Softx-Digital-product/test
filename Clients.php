<?php 

  include('Database/Dp.php');
  
  
if(isset($_POST['submit'])){

   
     $Fname= mysqli_real_escape_string($con, $_POST['fullname']);
      $Type= mysqli_real_escape_string($con, $_POST['type']);
       $Mail= mysqli_real_escape_string($con, $_POST['mail']);
        $Phone= mysqli_real_escape_string($con, $_POST['phone']);
         $Address= mysqli_real_escape_string($con, $_POST['address']);
//    echo $Fname;
//    echo $Type;
    
//    $check=mysqli_num_rows(mysqli_query($con,"SELECT * from ClientDb Where Email='$Mail'"));
//if($check>0){
//   $msgs="<br> This DATA is already present";
//  //echo $msgs;
//   
//// }
//}
//else{

  $sql ="INSERT into ClientDb (Full_Name,Type,Mobile,Email,Address) 
  VALUE('$Fname','$Type','$Phone','$Mail','$Address')";
     
if ($con->query($sql) === TRUE) {
  $msgs="Add Sucessfully";
  
 if (!file_exists("ClientData/.$Fname")) {
    mkdir("ClientData/$Fname", 0777, true);
    //echo 'Folder Created !!!';
   header("Refresh:0");
}else{
  //  echo 'Folder Present';
header("Refresh:0");
}
  
 
  //echo "Saved Sucessfully Bro";
  
  
} else {
 
  echo "Error: ----->" . $sql . "<br>" . $con->error;
}

$con->close();


    
}





 
?>


<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <title>Client-Panel</title>


<!-- Datatable -->

<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css'>
<link rel='stylesheet' href='https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css'>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
<script src='https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js'></script>


 <link rel="preconnect" href="https://fonts.gstatic.com">
        <link rel="stylesheet" href="assets12/css/sam.css">
     
                <link rel="stylesheet" href="Timeline/timeline.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha512-SfTiTlX6kk+qitfevl/7LibUOeJWlt9rbyDn92a1DqWOw9vWG2MFoays0sgObmWazO5BQPiFucnnEAjpAB+/Sw==" crossorigin="anonymous" />
          

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
 

 <style>
     
/*     .vc .btn{
        
     }*/

div.dataTables_filter, div.dataTables_length {
/* margin-top:5px;*/
/* padding-right:20px;*/
  padding-left:20px;

   text-transform: uppercase;

} 

div.dataTables_filter {
     margin-left: -10rem;
/*     margin-right: -1rem;*/
}
div.dataTables_wrapper div.dataTables_filter input {
/*    margin-left: .5em;*/
    display: inline-block;
    width: 40rem !important;

}
table {
/*  table-layout: fixed;
  border-collapse: collapse;*/
/*  width: 100%;*/
  
}
td{
    overflow:hidden;
    
}
 </style>
  </head>
  <body>
  
      <?php include'Navbars.php';?>
<!--<div class="container-fluid p-0">-->

    <div class="container-fluid p-0">
       
        <div class="container-fluid vc  ">
             <button type="button" class="btn text-center  btn-primary btn-sm mt-1 mb-1 " data-toggle="modal" data-target="#AddClient">Add Client</button>
        
        </div>
       
        
        <!-- Modal -->
<div class="modal fade" id="AddClient" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-center"  id="exampleModalLabel">Add Client</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       <form class="" method="POST" action="">
              
            <div class="form-group">
    <label >Enter Full Name</label>
    <input type="text" class="form-control"  name="fullname" aria-describedby=""placeholder="Enter Full Name">
  </div>
          <div class="form-group">
    <label for="exampleFormControlSelect1">Select Type</label><a class="" data-toggle="modal" data-target="#AddType">  
  (Add Type)
</a><a class="ml-2" data-toggle="modal" data-target="#EditType">
  (Edit Type)
</a><a class="ml-2" data-toggle="modal" data-target="#DeleteType">
    (Delete Type)
</a>
    <br> <select class="form-control" style="width:100%"  id="" placeholder="Please Select type"onchange="document.getElementById('text_CT').value=this.options[this.selectedIndex].text">
    <option value=""disabled selected>please Choose Type</option>
    <?php 

$sql = mysqli_query($con, "SELECT * FROM Client_type");
while ($row = $sql->fetch_assoc()){
echo "<option value=".$row['Sr_no'].">".$row['Type']."</option>";
}
?>
  </select>
      <input type="hidden" name="type" id="text_CT" value="" />
  </div>
           <div class="row">
    <div class="col-lg-6 col-md-6 col-sm-12">
        <lable>Enter Email Address</lable>
        <input type="email" name="mail" required class="form-control" placeholder="Email Address" >
    </div>
   <div class="col-lg-6 col-md-6 col-sm-12">
        <lable>Enter Phone Number</lable>
        <input type="number" name="phone" required class="form-control" placeholder="Phone Number" >
    </div>
           </div>
  
      <div class="form-group">
    <label class="mt-2">Enter Address</label>
    <textarea class="form-control" name="address" placeholder="Enter Address"></textarea>
  </div>
      
              
              <button type="submit" name="submit" class="btn btn-primary mt-2">Add Client</button>
          </form>
          
          
      
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
       
      </div>
    </div>
  </div>
</div>
        
    </div>
        <div class="tables table-responsive p-0">
            
      
  <table class="table table-striped table-bordered table-responsive{-sm|-md|-lg|-xl} table-hover" id='UserList'>
  <thead class="vbg text-light p-0">
    <tr>
        <th class="text-center"scope="col">SRN</th>
      <th class="text-center" scope="col">Full Name</th>
      <th class="text-center" scope="col">Type</th>
      <th class="text-center" scope="col">Mobile</th>
      <th class="text-center" scope="col">Mail</th>
      <th class="text-center" scope="col">Address</th>
      <th scope="col" style="display:none">Address</th>
      <th class="text-center" scope="col">Edit</th>
      <th class="text-center" scope="col">Remove</th>
  
    </tr>
  </thead>
  <tbody>
    <tr>
    <?php
    $sr=1;
   include('ClientDb/Dp.php');
            $quariy = $con->query("SELECT * FROM ClientDb ORDER BY Sr_no DESC"); 
            $num = mysqli_num_rows($quariy);
            if($num>=0){
             while ( $row = mysqli_fetch_array($quariy) ) {
               ?>
      <th class="text-center" scope="row" style="width:5%;"><?php echo $sr?></th>
<?php // echo substr($row['Full_Name'],0,30);?>
      <td class=" text-nowrap pr-0" scope="row"style="max-width:8rem; overflow:hidden; "data-toggle="tooltip" title="<?php echo $row['Full_Name']?>"><?php echo $row['Full_Name']?></td>
      <td class="text-nowrap" scope="row"style="max-width:2rem; overflow:hidden;"data-toggle="tooltip" title="<?php echo $row['Type']?>"><?php echo substr($row['Type'],0,10);?></td>
      <td class=" text-nowrap" scope="row"style="max-width:2rem; overflow:hidden;"data-toggle="tooltip" title="<?php echo $row['Mobile']?>"><?php echo substr($row['Mobile'],0,30);?></td>
      <td class=" text-nowrap pr-0" scope="row"style="max-width:8rem; overflow:hidden;"data-toggle="tooltip" title="<?php echo $row['Email']?>"><?php echo $row['Email'];?></td>
      <td class=" text-nowrap pr-0" scope="row"style="max-width:15rem; overflow:hidden;"data-toggle="tooltip" title="<?php echo $row['Address']?>"><?php echo $row['Address'];?>td>
       <td scope="row"style="display:none"><?php echo $row['Address']?></td>
      <td class="text-center" scope="row"style="width:5%"><a class="nav_link" href="ClientDb/EditCD.php/?v=<?php echo $row['Sr_no']?>">Edit </a></td>
<!--      <td class="text-center"  scope="row"style=""><a id="editbtn" class="nav_link" data-toggle="modal" data-target="#EditClient" onclick="data('<?php echo $row['Full_Name']?>','<?php echo $row['Type']?>','<?php echo $row['Mobile']?>','<?php echo $row['Email']?>','<?php echo $row['Address']?>','<?php echo $row['Sr_no']?>');">Edit</a>-->
      <td class="text-center" scope="row"style="width:5%"><a class="text-danger"href="ClientDb/ClientDel.php/?v=<?php echo $row['Full_Name']?>">Delete </a></td>
    </tr>
    <?php
    $sr++;
}
     }
?>
  </tbody>
</table>
        
          </div>
          <!-- ADD TypeModal -->
<div class="modal fade" id="AddType" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header bg-dark text-light">
        <h2 class="modal-title font-weight-bold" id="exampleModalLabel">Add Type</h2>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <div class="continer border">
              <input class="form-control" id="Tname" type="text" placeholder="Enter Type">
              
              <button type="button" id="addT" class="btn btn-primary mt-2" >Add Type</button>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        
      </div>
    </div>
  </div>
</div>
          
          
                      <!-- Edit Type Modal -->
<div class="modal fade" id="EditType" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header bg-dark text-light">
        <h2 class="modal-title font-weight-bold" id="exampleModalLabel">Edit Type</h2>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <div class="continer border">
            <label class="font-weight-bold">Select Type</label>
              <select class="form-control" id="editTC" placeholder="Choose Type..">
   <option value="" disabled selected>Please Choose Type</option>
  
<?php 
$sql = mysqli_query($con, "SELECT * FROM Client_type");
while ($row = $sql->fetch_assoc()){
echo "<option value=".$row['Sr_no'].">".$row['Type']."</option>";
}
?>
</select>
             <input class="form-control mt-2" type="text"  id="RenameT" placeholder=" Edit Type">
             
              <button type="button" id="EditT" class="btn btn-primary mt-2" >Edit Type</button>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        
      </div>
    </div>
  </div>
</div>
        
                      
                       <!-- Delete Type Modal -->
<div class="modal fade" id="DeleteType" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header bg-dark text-light">
        <h2 class="modal-title font-weight-bold" id="exampleModalLabel">Delete Type</h2>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <div class="continer border">
              <label class="font-weight-bold">Select Type</label><br>
            
              <select  class="form-control mt-1" id="DeleteT" placeholder="Choose Type..">
   <option value="" disabled selected>Please Choose Type</option>
  
<?php 
include 'KnowledgeDb/Dp.php';
$sql = mysqli_query($con, "SELECT * FROM Client_type");
while ($row = $sql->fetch_assoc()){
echo "<option value=".$row['Sr_no'].">".$row['Type']."</option>";
}
?>
</select>
              <button type="button" id="DelT" class="btn btn-primary mt-1 ml-1" >Delete Type</button>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        
      </div>
    </div>
  </div>
</div>

        

         <!-- USELESS Modal -->
<div class="modal fade" id="EditClient" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-center"  id="exampleModalLabel">Edit Client</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       <form class="" method="POST" action="">
              
            <div class="form-group">
    <label >Enter Full Name</label>
    <input type="text" class="form-control" id="Fullname" name="fullname" aria-describedby=""placeholder="Enter Full Name">
  </div>
          <div class="form-group">
    <label for="exampleFormControlSelect1">Select Type</label>
    <select class="form-control" name="type" id="Type" placeholder="Please Select type">
<!--        <option disabled selected>PLEASE SELECT TYPE</option>-->
      <option>PERSON</option>
      <option>PARTNERSHIP</option>
      <option>SOLE PROPERTY</option>
      <option>COMPANY</option>
      <option>TRUST</option>
    </select>
  </div>
           <div class="row">
    <div class="col-lg-6 col-md-6 col-sm-12">
        <lable>Enter Email Address</lable>
        <input type="email" name="mail" id="Mail" required class="form-control" placeholder="Email Address" >
    </div>
   <div class="col-lg-6 col-md-6 col-sm-12">
        <lable>Enter Phone Number</lable>
        <input type="number" name="phone" id="Phone" required class="form-control" placeholder="Phone Number" >
    </div>
           </div>
  
      <div class="form-group">
    <label class="mt-2">Enter Address</label>
    <textarea class="form-control" id="Address" name="address" placeholder="Enter Address"></textarea>
  </div>
      
              
              <button type="submit" name="Edit" class="btn btn-primary mt-2">Add Client</button>
          </form>
          
          
      
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
       
      </div>
    </div>
  </div>
</div>
        
    </div>

</div>

<script>

                   $(function () {
  $('[data-toggle="tooltip"]').tooltip()
})

  $("#ClientNav").addClass("active");
  document.getElementById("addT").addEventListener("click", ADDType);
function ADDType(){
  var tname= document.getElementById("Tname").value;
console.log(tname);
var Tname= JSON.stringify(tname);

$.ajax({ 
     type: "POST", 
      url: "ClientDb/ADDType.php", 
       data: {name:Tname},
      success: function(res) { 
        console.log(res);
        location.reload();
  } 
        
});

};


document.getElementById("EditT").addEventListener("click", editT);
function editT(){
      var Cid=document.getElementById('editTC').value;
      var Rename=document.getElementById('RenameT').value;
      console.log(Cid);
      console.log(Rename);
      var cid= JSON.stringify(Cid);
      var renames=JSON.stringify(Rename);
      $.ajax({ 
     type: "POST", 
      url: "ClientDb/EditType.php", 
       data: {id:cid,rename:renames},
      success: function(res) { 
        console.log(res);
      location.reload();
 } 
       
});
};


 document.getElementById("DelT").addEventListener("click", DelT);
function DelT(){
      var Cid=document.getElementById('DeleteT').value;
      console.log(Cid);
      var cid= JSON.stringify(Cid);
      $.ajax({ 
     type: "POST", 
      url: "ClientDb/DelType.php", 
       data: {id:cid},
      success: function(res) { 
        console.log(res);
      location.reload();
 } 
       
});  
};
    
 function data(Fn,Ty,MB,EM,AD,SR){
       
        console.log(SR);
         console.log(Fn);
          console.log(Ty);
           console.log(MB);
            console.log(EM);
             console.log(AD);
            

  $('#Fullname').val(Fn);



      $('#Phone').val(MB);
        $('#Mail').val(EM);
        $("#Address").val(AD);
  
 }
 
$(document).ready(function() {
    
       
//      $('select').selectize({
//          sortField: 'text'
 $('select').select2();
//      });
    
    
    
   // $('#UserList').DataTable();

    $('#UserList').DataTable({
//        "pagingType":"full_numbers",
        "bFilter": true,
        "bInfo": true,
        "lengthMenu":[
            [15,25,50,-1],
            [15,25,50,"All"]
        ],
        responsive:true,
        language:{
          //"search": "_INPUT_",
           searchPlaceholder:"Search Client",
    
        }
    });
    
} );
function myFunction() {
  var x = document.getElementById("myTopnav");
  if (x.className === "topnav") {
    x.className += " responsive";
  } else {
    x.className = "topnav";
  }
}

function myFunction1() {
  var x = document.getElementById("myTopnav1");
  if (x.className === "topnav1") {
    x.className += " responsive1";
  } else {
    x.className = "topnav1";
  }
}



</script>
<script>
        function updateUserStatus(){
  $.ajax({
    url:'Status/updateStatus.php',
    success:function(){

    }
  });

}
setInterval(function(){
updateUserStatus();
},3000);
                         
                    
 </script> 
 <script>
        function updateActivity(){
            var activeon = 'Clients';
  $.ajax({
    type:'post',
    url:'Status/updateStatus.php',
    data: {activity:activeon},
    success:function(){
    }
  });
}
setInterval(function(){
updateActivity();
},3000);
        </script>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>

    
  </body>
</html>