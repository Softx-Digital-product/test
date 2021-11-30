
<?php
include 'KnowledgeDb/Dp.php';
 ini_set('session.save_path', 'session');
 
session_start();
if(isset($_SESSION['username'])){
    
    $sessionV = $_SESSION['username'];
    $time=time();
    $tsr= $_SESSION['Tsr'];
    
}else{
//         
        header("Location:http://apajuris.in/work/index.php");
       die();
}
$dates= Date("d/m/Y");
$Kctext="Choose Category";$Ksctext="Sub Category";$Kttext="Choose Type";$Kdate="$dates";$Ktitle="Enter Title";$Keditor="";
if(isset($_POST['submit'])){
    
//    echo "<pre>";
//    print_r($_POST);
//    echo "</pre>";
    
    $Kcid=  mysqli_real_escape_string($con,$_POST['CC']);
    $Kscid= mysqli_real_escape_string($con,$_POST['SC']);
    $Ktid= mysqli_real_escape_string($con,$_POST['CT']);
    $Kctext= mysqli_real_escape_string($con,$_POST['CC_text']);
    $Ksctext=mysqli_real_escape_string($con,$_POST['SC_text']);
    $Kttext=mysqli_real_escape_string($con,$_POST['CT_text']);
    $Kdate=mysqli_real_escape_string($con,$_POST['Date']);
    $Ktitle=mysqli_real_escape_string($con,$_POST['title']);
    $Keditor=mysqli_real_escape_string($con,$_POST['editor']);
    
    
    $check=mysqli_num_rows(mysqli_query($con,"SELECT * from knowledge_data Where K_Title='$Ktitle'"));
if($check>0){
$update="Update knowledge_data SET K_Content= '$Keditor', K_Title= '$Ktitle'";
  if ($con->query($update) === TRUE) {
 
 
} else {
  echo "Error updating record: " . $con->error;
}


}
else{
     $sql="INSERT INTO knowledge_data(Kcid, Kscid, Ktid, K_Category, K_Sub_Category, K_Date, K_Type, K_Title, K_Content, Created_By) VALUES ('$Kcid','$Kscid','$Ktid','$Kctext','$Ksctext','$Kdate','$Kttext','$Ktitle','$Keditor','$tsr')";
    
     if ($con->query($sql) === TRUE) {
  echo "Saved Sucessfully Bro";
  // header("Refresh:0");
   header("Location:http://apajuris.in/work/TestingDS.php");
    die();
   
} else {
  
  echo "Error: ----->" . $sql . "<br>" . $con->error;
}
    
}

}

if(isset($_GET['v'])){
    $sr= $_GET['v'];
    $q="SELECT * FROM knowledge_data WHERE Sr_no = '$sr'";
    $sql = mysqli_query($con, $q);
while ($row = $sql->fetch_assoc()){
//echo "<pre>";
//print_r($row);
//echo "</pre>";

    $Kcid= $row['Kcid'];
    $Kscid= $row['Kscid'];
    $Ktid= $row['Ktid'];
    $Kctext= $row['K_Category'];
    $Ksctext=$row['K_Sub_Category'];
    $Kttext=$row['K_Type'];
    $Kdate=$row['K_Date'];
    $Ktitle=$row['K_Title'];
    $Keditor=$row['K_Content'];
    
}
    
    
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
    
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/js/standalone/selectize.min.js" integrity="sha256-+C0A5Ilqmu4QcSPxrlGpaZxJ04VjsRjKu+G82kl5UJk=" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/css/selectize.bootstrap3.min.css" integrity="sha256-ze/OEYGcFbPRmvCnrSeKbRTtjG4vGLHXgOqsyLFTRjg=" crossorigin="anonymous" />

  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/themes/ui-lightness/jquery-ui.min.css" integrity="sha512-NaCOGQe8bs7/BxJpnhZ4t4f4psMHnqsCxH/o4d3GFqBS4/0Yr/8+vZ08q675lx7pNz7lvJ6fRPfoCNHKx6d/fA==" crossorigin="anonymous" />
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
 
     <link rel="preconnect" href="https://fonts.gstatic.com">
        <link rel="stylesheet" href="assets12/css/sam.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha512-SfTiTlX6kk+qitfevl/7LibUOeJWlt9rbyDn92a1DqWOw9vWG2MFoays0sgObmWazO5BQPiFucnnEAjpAB+/Sw==" crossorigin="anonymous" />
          <script src="ckeditor/ckeditor.js"></script>
    <title>Knowledge</title>
   
    <script>
        
//         $(document).ready(function () {
//            
// $("#Category").on("change",function(){
//     var category = $("#Category").val();
//     
//     //console.log(category);
//     
//     
//     
//     var cid= JSON.stringify(category);
//     
//     $.ajax({
//         url :"KnowledgeDb/loadData.php",
//         type :"POST",
//         data :{id:cid},
//         success :function(datas){
//             console.log(datas);
////             $("#SubCategory").append(datas);
//            data = JSON.parse(datas);
//            $('#SubCategory').empty();
//           // console.log(data);
//            data.forEach(function(data){
//                
//                $("#SubCategory").append('<option></option>');
//               
//           
//            });
//
//         }
//     });
// });
//        });
        </script>
  </head>
  <body>
      
    
    
<div class="topnav" id="myTopnav">


        <a href="Cms.php" class="nav__link" id="ds">DashBoard</a>
        <a href="Team.php" class="nav__link" id="TM">Team</a>
        <a href="Task.php" class="nav_link">Task Management</a>
        <a href="calendar.php" class="nav_link " id="cl">Calendar</a>
        <a href="library.php" class="nav__link">Library</a>
        <a href="knowledge.php" class="nav__link active "id="kn">Knowledge</a>
        <a href="Clients.php" id="CM"class="nav__link ">Clients </a>
        
        <a href="Drafting.php"class="nav_link" id='df'>Drafting</a>
               <a href="Pleadings.php"class="nav_link"id="pl">Pleading</a>
               <a href="Training.php" class="nav_link"id="tr">Training</a>
<!--        <a href="#" class="nav__link">Manage Kms</a>
        <a href="#" class="nav__link">Mange Law</a>-->
        <a href="#" class="nav__link">Control panel</a>




        <a href="#" class="btn1"><i class="fa fa-search" aria-hidden="true"></i></a>  
        <a href="#" class="btn1"><i class="fa fa-calendar" aria-hidden="true"></i></a>  
        <a href="#" class="btn1"><i class="fa fa-bell-o" aria-hidden="true"></i></a>   &nbsp;
           <a href="logout.php"class="btn1"><i class="fa fa-sign-out" aria-hidden="true"></i></a>

         <p class="mt-2 mr-4 p-0 text-white float-right">login as : <?php echo  $sessionV ?></p>

        <a href="javascript:void(0);" class="icon" onclick="myFunction()">
            <i class="fa fa-bars"></i>
        </a>

    </div>
        </div> <!-- ===== IONICONS ===== -->
        <script src="https://unpkg.com/ionicons@5.1.2/dist/ionicons.js"></script>
        
         <div class="topnav1" id="myTopnav">
             <a href="knowledge.php" class="nav__link active" >Add Knowledge</a></li>
         <a href="TestingDS.php" class="nav__link">View Knowledge</a></li>
         </div>
        
        <div class="container-fluid shadow border">
            <h2 class="mt-3">Add Knowledge</h2>
<!--            <form action="KnowledgeDb/KnowledgeData.php" method="POST">-->
<form action="" method="POST">
              <div class="row">
    <div class="col-lg-6  col-md-6 col-sm-12">
        <label class="font-weight-bold mt-1">Select Category</label><a class="ml-1" data-toggle="modal" data-target="#AddCategory">
  (Add Category)
</a><a class="ml-2" data-toggle="modal" data-target="#EditCategory">
    (Edit Category)
</a><a class="ml-2" data-toggle="modal" data-target="#DeleteCategory">
    (Delete Category)
</a>
        <!-- Modal -->
<div class="modal fade" id="AddCategory" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h2 class="modal-title font-weight-bold" id="exampleModalLabel">Add Category</h2>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <div class="continer border">
              <input class="form-control" id="Cname" type="text" placeholder="Enter Category">
              
              <button type="button" id="addC" class="btn btn-primary mt-2" >Add Category</button>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        
      </div>
    </div>
  </div>
</div>
       <select  class="form-control lg-6 md-6 sm-12"name="CC" required id="Category" placeholder="Choose Category..." onchange="document.getElementById('text_content').value=this.options[this.selectedIndex].text">
   <option value="" disabled selected><?php echo $Kctext; ?></option>

       <?php 

$sql = mysqli_query($con, "SELECT * FROM knowledge_categ");
while ($row = $sql->fetch_assoc()){
echo "<option value=".$row['Sr_no'].">".$row['Category']."</option>";
}
?>
</select>
          <input type="hidden" name="CC_text" id="text_content" value="" />

        
        
                <!-- Delete Modal -->
<div class="modal fade" id="DeleteCategory" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h2 class="modal-title font-weight-bold" id="exampleModalLabel">Delete Category</h2>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <div class="continer border">
              <label class="font-weight-bold">Select Category</label><br>
              <select class="form-control " style="width:100%;" id="DeleteC" placeholder="Choose Category..">
   <option value="" disabled selected>Choose Category</option>
  
<?php 

$sql = mysqli_query($con, "SELECT * FROM knowledge_categ");
while ($row = $sql->fetch_assoc()){
echo "<option value=".$row['Sr_no'].">".$row['Category']."</option>";
}
?>
              </select> <br>
              <button type="button" id="DelC" class="btn btn-primary mt-2" >Delete Category</button>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        
      </div>
    </div>
  </div>
</div>
                
                
                <!-- Edit Modal -->
<div class="modal fade" id="EditCategory" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h2 class="modal-title font-weight-bold" id="exampleModalLabel">Edit Category</h2>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <div class="continer border">
              <label class="font-weight-bold">Select Category</label><br>
              <select  class="form-control" style="width:100%;" id="editsC" placeholder="Choose Category..">
   <option value="" disabled selected>Choose Category</option>
  
<?php 
include 'KnowledgeDb/Dp.php';
$sql = mysqli_query($con, "SELECT * FROM knowledge_categ");
while ($row = $sql->fetch_assoc()){
echo "<option value=".$row['Sr_no'].">".$row['Category']."</option>";
}
?>
              </select><br>
             <input class="form-control mt-2" type="text"  id="Rename" placeholder=" Edit Category">
             
              <button type="button" id="EditC" class="btn btn-primary mt-2" >Edit Category</button>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        
      </div>
    </div>
  </div>
</div>
    </div>
                  
                  <!--Sub Category-->
    <div class="col-lg-6 col-md-6 col-sm-12">
      <label class="font-weight-bold mt-1">Select Sub Category</label><a class="" data-toggle="modal" data-target="#AddSubCategory">
  (Add Sub-Category)
</a><a class="ml-2" data-toggle="modal" data-target="#EditSubCategory">
  (Edit Sub-Category)
</a><a class="ml-2" data-toggle="modal" data-target="#DeleteSubCategory">
    (Delete Sub-Category)
</a> 
      <!--Add SubCategory-->
      
      <div class="modal fade" id="AddSubCategory" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h2 class="modal-title font-weight-bold" id="exampleModalLabel">Add Sub Category</h2>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <div class="continer">
              <label class="font-weight-bold">Select Category</label><br>
              <select class="form-control" style="width:100%;" id="selects" placeholder="Choose Category..">
   <option value="" disabled selected>Choose Category</option>
  
<?php 
include 'KnowledgeDb/Dp.php';
$sql = mysqli_query($con, "SELECT * FROM knowledge_categ");
while ($row = $sql->fetch_assoc()){
echo "<option value=".$row['Sr_no'].">".$row['Category']."</option>";
}
?>
</select>
              <br><br>
              <input class="form-control" type="text"  id="Subc" placeholder="Enter Sub Category">
              
              <button type="button" class="btn btn-primary mt-2"  id="AddSubC" >Add Sub Category</button>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        
      </div>
    </div>
  </div>
</div>
        <!-- Edit Sub Modal -->
<div class="modal fade" id="EditSubCategory" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h2 class="modal-title font-weight-bold" id="exampleModalLabel">Edit Sub-Category</h2>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <div class="continer border">
              <label class="font-weight-bold">Select Sub-Category</label><br>
              <select class="form-control" style="width:100%" id="editSC" placeholder="Choose Sub-Category..">
   <option value="" disabled selected>Choose Sub-Category</option>
  
<?php 

$sql = mysqli_query($con, "SELECT * FROM knowledge_subcateg");
while ($row = $sql->fetch_assoc()){
echo "<option value=".$row['Sr_no'].">".$row['Sub_Category']."</option>";
}
?>
              </select><br>
             <input class="form-control mt-2" type="text"  id="RenameSC" placeholder=" Edit Sub-Category">
             
              <button type="button" id="EditSC" class="btn btn-primary mt-2" >Edit Sub-Category</button>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        
      </div>
    </div>
  </div>
</div>
        
                  <!-- Delete Sub-Category Modal -->
<div class="modal fade" id="DeleteSubCategory" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h2 class="modal-title font-weight-bold" id="exampleModalLabel">Delete Sub-Category</h2>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <div class="continer border">
              <label class="font-weight-bold">Select Sub-Category</label><br>
              <select class="form-control" style="width:100%" id="DeleteSC" placeholder="Choose Sub-Category..">
   <option value="" disabled selected>Choose Category</option>
  
<?php 
$sql = mysqli_query($con, "SELECT * FROM knowledge_subcateg");
while ($row = $sql->fetch_assoc()){
echo "<option value=".$row['Sr_no'].">".$row['Sub_Category']."</option>";
}
?>
</select>
              <button type="button" id="DelSC" class="btn btn-primary mt-2" >Delete Sub-Category</button>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        
      </div>
    </div>
  </div>
</div>
        
 
                  <select class="form-control" required id="SubCategory" name="SC" placeholder="Choose Sub Category..." onchange="document.getElementById('text_SC').value=this.options[this.selectedIndex].text">
    <option value="" disabled selected><?php echo $Ksctext; ?></option>
      
    <?php 
    
    $id = "<script>document.writeln(Category);</script>";



$sql = mysqli_query($con, "SELECT * FROM knowledge_subcateg"); 
while ($row = $sql->fetch_assoc()){
echo "<option value=".$row['Sr_no'].">".$row['Sub_Category']."</option>";
}
?>
  </select>
                   <input type="hidden" name="SC_text" id="text_SC" value="" />
    </div>
  </div>
            <!--Date Section-->
            <div class="row">
    <div class="col-lg-6  col-md-6 col-sm-12">
        <label class="font-weight-bold mt-2">Select Date</label>
        <input type="text" class="form-control" required id="date"name="Date" value="<?php echo $Kdate; ?>" placeholder="Select Date">
        
    </div>
    <div class="col-lg-6  col-md-6 col-sm-12">
        <div class="lg-4 md-6 sm-12">
        <label class="font-weight-bold mt-2">Select Type</label><a class="" data-toggle="modal" data-target="#AddType">  
  (Add Type)
</a><a class="ml-2" data-toggle="modal" data-target="#EditType">
  (Edit Type)
</a><a class="ml-2" data-toggle="modal" data-target="#DeleteType">
    (Delete Type)
</a>
        
         <!-- ADD TypeModal -->
<div class="modal fade" id="AddType" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
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
      <div class="modal-header">
        <h2 class="modal-title font-weight-bold" id="exampleModalLabel">Edit Type</h2>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <div class="continer border">
              <label class="font-weight-bold">Select Type</label><br>
              <select class="form-control" style='Width:100%;' id="editTC" placeholder="Choose Type..">
   <option value="" disabled selected>Choose Category</option>
  
<?php 

$sql = mysqli_query($con, "SELECT * FROM knowledge_type");
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
      <div class="modal-header">
        <h2 class="modal-title font-weight-bold" id="exampleModalLabel">Delete Type</h2>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <div class="continer border">
              <label class="font-weight-bold">Select Type</label><br>
              <select  class="form-control"  style='width:100%;'id="DeleteT" placeholder="Choose Type..">
   <option value="" disabled selected>Choose Category</option>
  
<?php 
$sql = mysqli_query($con, "SELECT * FROM knowledge_type");
while ($row = $sql->fetch_assoc()){
echo "<option value=".$row['Sr_no'].">".$row['Type']."</option>";
}
?>
              </select><br>
              <button type="button" id="DelT" class="btn btn-primary mt-2" >Delete Type</button>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        
      </div>
    </div>
  </div>
</div>

            <!-- Type -->
            <select  class="form-control" required name="CT" id="type" placeholder="Choose Type."onchange="document.getElementById('text_CT').value=this.options[this.selectedIndex].text">
    <option value=""disabled selected><?php echo $Kttext; ?></option>
    <?php 

$sql = mysqli_query($con, "SELECT * FROM knowledge_type");
while ($row = $sql->fetch_assoc()){
echo "<option value=".$row['Sr_no'].">".$row['Type']."</option>";
}
?>
  </select>
             <input type="hidden" name="CT_text" id="text_CT" value="" />
    </div>
    </div>
  </div>
            
            <div class="title" lg-12 md-12 sm-12>
                <label class="font-weight-bold mt-1">Enter Title</label>
                    
                <textarea class="form-control" required placeholder="Title" name="title" aria-label="With textarea"></textarea>
                
            </div>
            
            
          <div class="Editor">
                <label class="font-weight-bold mt-2">Knowledge Content</label>
                    
                <textarea class="form-control"id="editor"  name="editor"  aria-label="With textarea"><?php echo $Keditor; ?></textarea>
                
            </div> 
            <button class="btn btn-primary mt-2 " name="submit" type="submit" id="submit">Save</button>
            <button class='btn btn-primary mt-2 ' data-toggle="modal" data-target="#uploadDocs">Upload Doc</button>
            
            </form>
        </div>
       
        <div class='modals'>
            
            <!-- Modal -->
<div class="modal fade" id="uploadDocs" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Upload Documents</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <div class="card">
              <div class="card-body">
                  <form id="uploadKdata">
                      <label class="font-weight-bold mt-1">Select knowledge</label>
                 <select  class="form-control" name="knowledgeT" style='width:100%;'id="knowledgeT" placeholder="Choose Type..">
   <option value="" disabled selected>Select Knowledge </option>
  
<?php 
$sql = mysqli_query($con, "SELECT * FROM knowledge_data");
while ($row = $sql->fetch_assoc()){
echo "<option value=".$row['Sr_no'].">".$row['K_Title']."</option>";
}
?>
              </select><br>
              <label class="font-weight-bold mt-1">Upload Document</label>
              <input  type='file' class="form-control" name="file" id="file" />
              <br>
              <div class="container-fluid">
                   <button class="btn btn-primary" name="filesumbit" id="filesumbit">Upload</button>
                   
                  <label class="alertTxt ml-2"></label>
              </div>
             
              
                  </form>
                  
              
              
              </div>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
            
        </div>

        <script>
    $(document).ready(function () {
//      $('select').selectize({
//          sortField: 'text'
 $('select').select2();
     // });
      
      function loadData(){
          $.ajax({
              url :"KnowledgeDb/loadData.php",
              type : "POST",
              success : function(data){
                 // console.log(data);
                 // $("#Category").append(data);
              }
          });
      }
 //loadData();
 $("#date").datepicker().datepicker("setDate", new Date('dd/mm/yyyy'));
 $("#date").datepicker({ dateFormat: 'dd/mm/yy',});
 $("#Category").on("change",function(){
     var category = $("#Category").val();
     
     console.log(category);
     
     var cid= JSON.stringify(category);
      $.ajax({
        url :"KnowledgeDb/TestingData.php",
        type:"POST",
        cache:false,
        data:{countryId:cid},
        success:function(data){

          $("#SubCategory").html(data);
        }
      });
 });
  });
    
   // CKEDITOR.replace('editor');
    
    
    
    document.getElementById("addC").addEventListener("click", myADD);
function myADD(){
  var Cname= document.getElementById("Cname").value;
console.log(Cname);
var cname= JSON.stringify(Cname);

$.ajax({ 
     type: "POST", 
      url: "KnowledgeDb/function.php", 
       data: {ACname:cname},
      success: function(res) { 
        console.log(res);
//        location.reload();
        $('#Category').html(res);
        $('#editsC').html(res);
        $('#DeleteC').html(res);
        $('#selects').html(res);
    
          $('#AddCategory').modal('toggle');
          $('#Cname').val('');
  } 
        
});

};


 document.getElementById("DelC").addEventListener("click", DelC);
function DelC(){
      var Cid=document.getElementById('DeleteC').value;
      console.log(Cid);
      var cid= JSON.stringify(Cid);
      $.ajax({ 
     type: "POST", 
      url: "KnowledgeDb/function.php", 
       data: {DelCid:cid},
      success: function(res) { 
        console.log(res);
   $('#Category').html(res);
        $('#editsC').html(res);
        $('#DeleteC').html(res);
        $('#selects').html(res);
        
     $('#DeleteCategory').modal('toggle');
 } 
       
});     
};
    
    
    
    document.getElementById("EditSC").addEventListener("click", editSC);
function editSC(){
      var Cid=document.getElementById('editSC').value;
      var Rename=document.getElementById('RenameSC').value;
      console.log(Cid);
      console.log(Rename);
      var cid= JSON.stringify(Cid);
      var renames=JSON.stringify(Rename);
      $.ajax({ 
     type: "POST", 
      url: "KnowledgeDb/function.php", 
       data: {ESid:cid,rename:renames},
      success: function(res) { 
        console.log(res);
         $('#editSC').html(res);
        $('#DeleteSC').html(res);
        $('#SubCategory').html(res);
       $('#EditSubCategory').modal('toggle');
      
      $('#RenameSC').val('');
        
        
   
 } 
       
});
};
    
   document.getElementById("DelSC").addEventListener("click", DelSC);
function DelSC(){
      var Cid=document.getElementById('DeleteSC').value;
      console.log(Cid);
      var cid= JSON.stringify(Cid);
      $.ajax({ 
     type: "POST", 
      url: "KnowledgeDb/function.php", 
       data: {DelScid:cid},
      success: function(res) { 
        console.log(res);
       $('#editSC').html(res);
        $('#DeleteSC').html(res);
        $('#SubCategory').html(res);
       $('#DeleteSubCategory').modal('toggle');
 } 
       
});     
};  
    

   document.getElementById("AddSubC").addEventListener("click", myFunction);
function myFunction(){
    
    var Cid=document.getElementById('selects').value;
    var SubC = document.getElementById('Subc').value;
console.log(Cid);
console.log(SubC);

var cid= JSON.stringify(Cid);
var subc=JSON.stringify(SubC);
$.ajax({ 
     type: "POST", 
      url: "KnowledgeDb/function.php", 
       data: {Acid:cid,SubcName:subc},
      success: function(res) { 
        console.log(res);
          $('#editSC').html(res);
        $('#DeleteSC').html(res);
        $('#SubCategory').html(res);
       $('#AddSubCategory').modal('toggle');
      
      $('#Subc').val('');
 } 
       
});
};

  document.getElementById("EditC").addEventListener("click", editC);
function editC(){
      var Cid=document.getElementById('editsC').value;
      var Rename=document.getElementById('Rename').value;
      console.log(Cid);
      console.log(Rename);
      var cid= JSON.stringify(Cid);
      var renames=JSON.stringify(Rename);
      $.ajax({ 
     type: "POST", 
      url: "KnowledgeDb/function.php", 
       data: {EditCid:cid,ECrename:renames},
      success: function(res) { 
        console.log(res);
      $('#Category').html(res);
        $('#editsC').html(res);
        $('#DeleteC').html(res);
        $('#selects').html(res);
        
     $('#EditCategory').modal('toggle');
      $('#Rename').val('');
 } 
       
});
};


    document.getElementById("addT").addEventListener("click", ADDType);
function ADDType(){
  var tname= document.getElementById("Tname").value;
console.log(tname);
var Tname= JSON.stringify(tname);

$.ajax({ 
     type: "POST", 
      url: "KnowledgeDb/function.php", 
       data: {Tname:Tname},
      success: function(res) { 
        console.log(res);
      $('#editTC').html(res);
      $('#DeleteT').html(res);
      $('#type').html(res);
      $('#AddType').modal('toggle');
      $('#Tname').val('');
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
      url: "KnowledgeDb/function.php", 
       cache:false,
       data: {ETid:cid,rename:renames},
      success: function(res) { 
        console.log(res);
      $('#editTC').html(res);
      $('#DeleteT').html(res);
      $('#type').html(res);
      $('#EditType').modal('toggle');
      $('#RenameT').val('');
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
      url: "KnowledgeDb/function.php", 
       data: {DelTid:cid},
      success: function(res) { 
        console.log(res);
      $('#editTC').html(res);
      $('#DeleteT').html(res);
      $('#type').html(res);
      $('#DeleteType').modal('toggle');
 } 
       
});  
};



$("#uploadKdata").on("submit",function(e){
         e.preventDefault();
                 var formData= new FormData(this);
                  
                  $.ajax({
                     url: "KnowledgeDb/function.php", 
                     type:"POST",
                     data:formData,
                     contentType :false,
                     processData: false,
                     beforeSend: function () {
                        
          $('.alertTxt').html("<strong style='color:#ff7f50;'>Upload Final Draft..</strong>");
        },
                
                     success : function(data){
                         console.log(data);
                         
                    $('.alertTxt').html(data);
                    $("#uploadKdata").trigger('reset');
                    $('#uploadDocs').modal('toggle');
    }
                  });
                         
    });
</script>
 <script>
          
          CKEDITOR.replace('editor',{
                          
                        contentsCss: [ 'https://cdn.ckeditor.com/4.8.0/full-all/contents.css', 'css/Ckeditor.css' ],
                        
                        bodyClass: 'document-editor',
      height: 500,
     
      
      font_names:'Arial;Times New Roman; Verdana',
      
      
      toolbar: [
			{ name: 'document', items: [  'zoom' ] },
			{ name: 'clipboard', items: [ 'Undo', 'Redo'  ] },
			{ name: 'styles', items: [ 'Format', 'Font', 'FontSize' ] },
			{ name: 'basicstyles', items: [ 'Bold', 'Italic', 'Underline', 'Strike', 'RemoveFormat', 'CopyFormatting' ] },
			{ name: 'colors', items: [ 'TextColor', 'BGColor' ] },
			{ name: 'align', items: [ 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock' ] },
//			{ name: 'links', items: [ 'Link', 'Unlink' ] },
//			{ name: 'paragraph', items: [ 'NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote' ] },
			{ name: 'insert', items: [  'Table','lineheight' ] },
			{ name: 'tools', items: [ 'Maximize','find'] },
			//{ name: 'editing', items: [ '','find','selection' ] },
                        { name: 'editing', items: [ 'find', 'selection', 'spellchecker', 'editing' ] }
		],
                
                
                
                
                          toolbarGroups: [{
          "name": "basicstyles",
          "groups": ["basicstyles"]
        },
//       

        {
          "name": "links",
          "groups": ["links"]
        },
        {
          "name": "paragraph",
          "groups": ["list", "blocks"]
        },
//      {
//            name: 'document', 
//            groups: [ 'Source', '-', 'Save', 'NewPage', 'ExportPdf', 'Preview', 'Print', '-', 'Templates' ] ,
//        },
        { name: 'clipboard', groups: [ 'clipboard', 'undo' ] },
		{ name: 'editing', groups: [ 'find', 'selection', 'spellchecker', 'editing' ] },
//		{ name: 'forms', groups: [ 'forms' ] },
//        {
//          "name": "insert",
//          "groups": ["insert"]
//        },
        {
          "name": "styles",
          "groups": ["styles"]
        },
        {
        name: 'styles',
        groups: [ 'styles' ] 
    },
    
		{ name: 'colors', groups: [ 'colors' ] },
		{ name: 'tools', groups: [ 'tools' ] },
		{ name: 'others', groups: [ 'others' ] }
		
        
      ],
      extraPlugins:'zoom',
      extraPlugins:'lineheight',
//     readOnly:true,
     line_height:"1;1.5;2;2.5;3;4",
    
    });
   
          $(".document-editor").css({"width": "18.2cm"});
          
          </script>
          <script>
                            CKEDITOR.instances['editor'].on('contentDom', function() {
    CKEDITOR.instances['editor'].document.on('keyup', function(event) {
//        alert(CKEDITOR.instances.editor.getData());
        console.log(CKEDITOR.instances.editor.getData());
        
          $.ajax({
    type:'post',
    url:'Status/updateStatus.php',
    data: {status:1},
    success:function(){

    }
  });
  
  var matches = CKEDITOR.instances.editor.getData().replace(/<[^<|>]+?>|&nbsp;/gi,' ').match(/\b/g);
           //var count = 0;
    if(matches) {
        count = matches.length/2;
    }
        console.log(count);
        $.ajax({
    type:'post',
    url:'Status/updateStatus.php',
    //data: {TWords:count},
    data: {TWords:1},
     success: function(result) { 
        console.log("====> "+result);
        $('.wcount').val(result);
    }
  });
        
        
    });
});
          
                </script>
    
     <script>
       function updateUserStatused(){
  $.ajax({
    url:'Status/updateStatus.php',
    success:function(){
    }
  });

}
setInterval(function(){
updateUserStatused();
},3000);
    </script>
                
     <script>
        function updateActivity(){
            var activeon = 'Knowledge';
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

<script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.13.3/js/selectize.min.js" integrity="sha512-JiDSvppkBtWM1f9nPRajthdgTCZV3wtyngKUqVHlAs0d5q72n5zpM3QMOLmuNws2vkYmmLn4r1KfnPzgC/73Mw==" crossorigin="anonymous"></script>
  </body>
</html>

