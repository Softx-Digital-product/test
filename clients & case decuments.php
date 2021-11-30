<?php 

include 'php/DbCon.php';

if(isset($_POST['submit'])){
$Fname= $_POST['fname'];
$surname= $_POST['surname'];
$type= $_POST['city'];
$mobile= $_POST['mobile'];
$mail= $_POST['mail'];
$address= $_POST['add'];
//echo $Fname, $type, $mobile, $mail, $address;



$sql = "INSERT INTO client (name,surname, type, mobile, mail, addr)
VALUES ('$Fname','$surname', '$type', '$mobile', '$mail','$address')";

if ($con->query($sql) === TRUE) {
//  echo "New record created successfully";
} else {
 // echo "Error: " . $sql . "<br>" . $con->error;
}

$con->close();

}


?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
        <!-- ===== CSS ===== -->
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link rel="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha512-SfTiTlX6kk+qitfevl/7LibUOeJWlt9rbyDn92a1DqWOw9vWG2MFoays0sgObmWazO5BQPiFucnnEAjpAB+/Sw==" crossorigin="anonymous" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
        <link rel="stylesheet" href="assets12/css1/13.css">
<link rel="stylesheet" href="assets12/css1/12.css">
<link rel="stylesheet" href="assets12/css/sam.css">
<meta name="viewport" content="width=device-width, initial-scale=1">
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        
        <title>CLIENTS</title>
    </head>
    <body>
   <div class="topnav" id="myTopnav">
                       
                    <a href="./index.php" class="nav__link ">Timelin</a></li>
                    <a href="#" class="nav__link">Client Barief</a></li>
                    <a href="#" class="nav__link">Law</a></li>
                    <a href="#" class="nav__link">Tesk Add</a></li>
                    <a href="./clients & case decuments.php" class="nav__link active">Clients </a></li>
                    <a href="#" class="nav__link ">Calendere</a>
                    <a href="#" class="nav__link">Manage Cme</a>
                    <a href="#" class="nav__link">Manage Kms</a>
                    <a href="#" class="nav__link">Mange Law</a>
                    <a href="#" class="nav__link">Manage Tms</a>
                   
                    
                       
                    <a href="#" class="btn1"><i class="fa fa-search" aria-hidden="true"></i></a> &nbsp;   &nbsp;&nbsp; 
                    <a href="#" class="btn1"><i class="fa fa-calendar" aria-hidden="true"></i></a>   &nbsp; &nbsp;&nbsp; 
                    <a href="#" class="btn1"><i class="fa fa-bell-o" aria-hidden="true"></i></a>  &nbsp;  
                    <a href="./login.php" class="btn1">   
                    <i class="fa fa-user-o" aria-hidden="true"></i></a>
                  
                <a href="javascript:void(0);" class="icon" onclick="myFunction()">
                   <i class="fa fa-bars"></i>
                  </a>
              
        </div>

        <div class="topnav1" id="myTopnav1">

      
            <a href="./clients & case decuments.php" class="nav__link active  ">CLIENTS</a></li>
            <a href="./cases.php" class="nav__link ">CASE</a></li>
            <a href="./upload case documents.php" class="nav__link">UPLOAD CASE DOCUMENTS</a></li>
            <a href="./timeline.php" class="nav__link">TIMELINE</a></li>
            <a href="./VIEW Case Documents.php"  class="nav__link ">VIEW CASE DOCUMENTS </a></li>
            <a href="../PdfsM/table.php"  class="nav__link ">PDF Manager</a>
          <a href="javascript:void(0);" class="icon1" onclick="myFunction1()">
                              <i class="fa fa-bars"></i>
                             </a>
                       
                   </div>
<br>

<!-- Modal -->
<div class="modal fade" id="clients" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">ADD CLIENTS</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        <form action="" method="POST">
            
      <div class="modal-body">

  <div class="form-group">
    <label>First Name</label>
     <input type="text" class="form-control"  name="fname" required>
   </div>
    <div class="form-group">
    <label>LAST Name</label>
     <input class="form-control" type="text" name="surname" required>
   </div>          
  <div class="form-group">
        <label>TYPE <span class="label-required">*</span>
   <span id="city-info" class="info"> (NNT)</span></label>
     <select class="form-control input-md" name="city">
    <option value="PERSON">PERSON</option>
    <option value="PATNERSHIP">PATNERSHIP</option>
     <option value="SOLE PROPRIETY">SOLE PROPRIETY</option>
     <option value="COMPANY">COMPANY</option>
     <option value="TRUST">TRUST</option>
    </select>
  </div>
   <div class="Mobile">
    <label>Mobile</label>
    <input class="form-control" name="mobile" type="number"  required>
   </div>
   <div class="form-group">
    <label>Mail</label>
       <input class="form-control" type="email" name="mail" required>
   </div>
    <div class="form-group">
    <td>  
        <label>Address</label>  
       <input class="form-control"  type="text" name="add" required>
     </td>   
   </div>          

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
     
         <input class="btn btn-primary" type="submit"  name="submit" value="Sign Up">
      </div>
     </form>
    </div>
  </div>
</div>
<!--1111111111111111111111111111111111111111111111111 EDIT FROM 1111111111111111111111111111111111111111111111111111111111111111-->
<div class="modal fade" id="editmodel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">EDIT CLIENTS DATA</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        <form action="" method="POST">
            
      <div class="modal-body">
<input type="hidden" name="update_id" id="update_id">


  <div class="form-group">
    <label>First Name</label>
     <input type="text" class="form-control" id="fname"  name="fname" required>
   </div>
    <div class="form-group">
    <label>LAST Name</label>
     <input class="form-control" type="text" id="surname" name="surname" required>
   </div>          
  <div class="form-group">
        <label>TYPE <span class="label-required">*</span>
   <span id="city-info" class="info"> (NNT)</span></label>
     <select class="form-control input-md" id="city" name="city">
    <option value="PERSON">PERSON</option>
    <option value="PATNERSHIP">PATNERSHIP</option>
     <option value="SOLE PROPRIETY">SOLE PROPRIETY</option>
     <option value="COMPANY">COMPANY</option>
     <option value="TRUST">TRUST</option>
    </select>
  </div>
   <div class="Mobile">
    <label>Mobile</label>
    <input class="form-control" name="mobile" id="mobile" type="number"  required>
   </div>
   <div class="form-group">
    <label>Mail</label>
       <input class="form-control" type="email" id="mail" name="mail" required>
   </div>
    <div class="form-group">
    <td>  
        <label>Address</label>  
       <input class="form-control"  type="text" id="addr" name="add" required>
     </td>   
   </div>          

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
     
         <input class="btn btn-primary" type="submit"  name="updatedata" value="Sign Up">
      </div>
     </form>
    </div>
  </div>
</div>
<!--11111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111-->           
          <button type="button" class="btn" data-toggle="modal" data-target="#clients"><i class="fa fa-bars"> ADD</i></button>
          <br>
              <br>    
              
<mat-ink-bar class="mat-ink-bar" style="visibility: visible; left: 0px; width: 542px;">
</mat-ink-bar>
</div>
</div><div aria-hidden="true" class="mat-tab-header-pagination mat-tab-header-pagination-after mat-elevation-z4 mat-ripple mat-tab-header-pagination-disabled" mat-ripple="" ng-reflect-disabled="true">
<div class="mat-tab-header-pagination-chevron">
</div></div></mat-tab-header><div class="mat-tab-body-wrapper"><!--bindings={
  "ng-reflect-ng-for-of": "[object Object],[object Object"
}--><mat-tab-body class="mat-tab-body ng-tns-c23-19 ng-star-inserted mat-tab-body-active" role="tabpanel" ng-reflect-_content="[object Object]" ng-reflect-animation-duration="500ms" ng-reflect-position="0" id="mat-tab-content-1-0" aria-labelledby="mat-tab-label-1-0" ng-reflect-origin="-1">
<div class="mat-tab-body-content ng-trigger ng-trigger-translateTab" style="transform: none;">
<div _ngcontent-fqx-c12="" class="ng-star-inserted"><b>
<!--     ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------->
<table id="users" class="table" style="width:100% ">
        <thead>
   <tr>
      <th _ngcontent-fqx-c12="" class="doc_head"> CLient Id</th>
      <th _ngcontent-fqx-c12="" class="doc_head"> CLient Name </th>
           <th _ngcontent-fqx-c12="" class="doc_head"> CLient SurName </th>
      <th _ngcontent-fqx-c12="" class="doc_head"> Type</th>
      <th _ngcontent-fqx-c12="" class="doc_head"> Mobile Number</th>
      <th _ngcontent-fqx-c12="" class="doc_head">Mail</th>
       <th _ngcontent-fqx-c12="" class="doc_head">Address</th>
          <th _ngcontent-fqx-c12="" class="doc_head">Edit</th>
               <th _ngcontent-fqx-c12="" class="doc_head">Delete</th>
               
  
      </tr>
   
      
        <tbody>
       <?php 
include 'php/DbCon.php';

$sql = "select * from client";


$result = mysqli_query($con,$sql);


while($row = mysqli_fetch_assoc($result))
{
  ?>
       <td><?php echo $row["id"];?></td>
        <td><?php echo $row["name"];?></td>     
       <td><?php echo $row["surname"];?></td>
       <td><?php echo $row["type"];?></td>
        <td><?php echo $row["mobile"];?></td>
        <td><?php echo $row["mail"];?></td>
       <td><?php echo $row["addr"];?></td>
       <td> <button type="button" class="btn editbtn" data-toggle="modal" data-target="#editmodel">EDIT</button></td>
              <td>  <a class="btn btn-danger">DELETE</a></td>
            </tr>
      <?php } ?>
 </tbody> </thead> </table>   </div></div>
</mat-tab-body>   </div>         
        
          
          
          
          
          
          
          
          
          
          
          
          
          
          
          
          
          
          
     
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js" integrity="sha512-+NqPlbbtM1QqiK8ZAo4Yrj2c4lNQoGv8P79DPtKzj++l5jnN39rHA/xsqn8zE9l0uSoxaCdrOgFs6yjyfbBxSg==" crossorigin="anonymous"></script>      
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
         <script src="https://unpkg.com/ionicons@5.1.2/dist/ionicons.js"></script>

        <script>
function myFunction() {
  var x = document.getElementById("myTopnav");
  if (x.className === "topnav") {
    x.className += " responsive";
  } else {
    x.className = "topnav";
  }
}
</script>
<script>
function myFunction1() {
  var x = document.getElementById("myTopnav1");
  if (x.className === "topnav1") {
    x.className += " responsive1";
  } else {
    x.className = "topnav1";
  }
}


</script>
 <script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>  
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
        <!-- ===== IONICONS ===== -->
        <script src="https://unpkg.com/ionicons@5.1.2/dist/ionicons.js"></script>
        <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
        <script>
           $(document).ready(function() {
          $('#users').DataTable();
            } );
    </script>
     
     <script>

       $(document).ready(function(){

$('.editbtn').on('click',function(){

 $('#editmodel').modal('show');

 $tr = $(this).closest('tr');
 var data = $tr.children("td").map(function(){
   return $(this).text();

 }).get();

 console.log(data);

 $('#update_id').val(data[0]);
  $('#name').val(data[1]);
 $('#surname').val(data[2]);
 $('#type').val(data[3]);
 $('#mobile').val(data[4]);
 $('#mail').val(data[5]);
 $('#addr').val(data[6]);

});
       });
     </script>



    </body>
</html>