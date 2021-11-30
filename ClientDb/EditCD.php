<?php
include 'Dp.php';
$id = $_GET['v'];
//$id= 5;
 


 $FN; $TY; $MB; $EM; $AD; $SR;

	$query = "SELECT * FROM ClientDb WHERE Sr_no = {$id}";
	$result = $con->query($query);
        
    if ($result->num_rows > 0) {
		while ($row = $result->fetch_assoc()) {
                    $SR=$row['Sr_no'];
 $FN=$row['Full_Name'];
 $TY= $row['Type'];
 $MB=$row['Mobile'];
 $EM=$row['Email'];
 $AD=$row['Address'];

 
}
    }

else{
    echo "<h3> No Record</h3>";
}


if(isset($_POST['submit'])){
    $Fname=$_POST['fullname'];
    $Type=$_POST['type'];
    $Mail=$_POST['mail'];
    $Phone=$_POST['phone'];
    $Address= $_POST['address'];
//    echo $Fname;
//    echo $Type;


  $sql = "UPDATE ClientDb SET Full_Name='$Fname', Type='$Type',Mobile='$Phone',Email='$Mail',Address='$Address' WHERE Sr_no='$id'";
//echo $sql;
if ($con->query($sql) === TRUE) {
  echo "Updated!!!";
  
  $oldname = "../ClientData/$FN";
$newname = "../ClientData/$Fname";
 
if(rename($oldname, $newname)){
   echo "Directory has been renamed";
} else {
   echo "Fail to rename directory";
}

$oldname = "../ClientCaseData/$FN";
$newname = "../ClientCaseData/$Fname";


echo $oldname."<br><br>";
echo $newname."<br>";

if(rename($oldname, $newname)){
   echo "Directory has been renamed";
} else {
   echo "Fail to rename directory";
}

    $check=mysqli_num_rows(mysqli_query($con,"SELECT * from Client_CaseDb Where Client_Name='$FN'"));
if($check>0){
    echo $check;
//    $CaseName; $CP;
    $query = "SELECT * FROM Client_CaseDb WHERE Client_Name = '$FN' ";
    echo $query."<br><br>";
	$result = $con->query($query);
        
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
                    $CaseName=$row['Case_Name'];
                    $CP=$row['Case_Path'];
                    
                    echo $CaseName."<br><br>";
                    echo $CP."<br><br>";
                     $path="ClientCaseData/$Fname/$CaseName";
                     echo $path."<br>";
                     $sql = "UPDATE Client_CaseDb SET Client_Name='$Fname',Case_Path='$path' WHERE Client_Name='$FN'";
                      echo $sql;
if ($con->query($sql) === TRUE) {
  echo "Updated!!! in Client_CaseDb" ;
}else{
    echo "Can't Update"; 
}
        }
        
        
    }else{
        
    }
    
   
//    $CP="ClientCaseData/Aditya Pratap/$CaseName";
//      $oldname = "../$CP";
//$newname = "../$path";
//
//echo $oldname."<br><br>";
//echo $newname."<br>";
// 
//if(rename($oldname, $newname)){
//   echo "Directory has been renamed";
//   
//   
//
//} else {
//   echo "Fail to rename directory Client_CaseDb";
//} 
    
}else{
    
}

$check=mysqli_num_rows(mysqli_query($con,"SELECT * from UploadDocs Where Client_Name='$FN'"));
if($check>0){
        $CaseName; $CP;
    $query = "SELECT * FROM UploadDocs WHERE Client_Name = '$FN'";
    echo $query;
	$result = $con->query($query);
        
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
                    $CaseName=$row['Case_Name'];
                    $CP=$row['Case_Path'];
        }
        
        
    }else{
        
    }
    
    $sql = "UPDATE UploadDocs SET Client_Name='$Fname' WHERE Client_Name='$FN'";
  
if ($con->query($sql) === TRUE) {
  echo "Updated!!! in uploadDocs" ;
}else{
    echo "Can't Update in uploadDocs "; 
}

    
}

  
  header("Location:http://apajuris.in/work/Clients.php");
    die();
} else {
  $msgs =  "Error: ----->" . $sql . "<br>" . $con->error;
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
    
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/themes/ui-lightness/jquery-ui.min.css" integrity="sha512-NaCOGQe8bs7/BxJpnhZ4t4f4psMHnqsCxH/o4d3GFqBS4/0Yr/8+vZ08q675lx7pNz7lvJ6fRPfoCNHKx6d/fA==" crossorigin="anonymous" />
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>


<script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/js/standalone/selectize.min.js" integrity="sha256-+C0A5Ilqmu4QcSPxrlGpaZxJ04VjsRjKu+G82kl5UJk=" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/css/selectize.bootstrap3.min.css" integrity="sha256-ze/OEYGcFbPRmvCnrSeKbRTtjG4vGLHXgOqsyLFTRjg=" crossorigin="anonymous" />

 
    
<style>
   
/*    textarea{
       font-family: verdana; 
    }*/
    
</style>
    <title>Update Client Data</title>
  </head>
  <body>
      
      <div class="container border mt-4 shadow p-3 mb-5 bg-white rounded">
          <div class="row">
              <div class="col-lg-6 col-lg-6 col-sm-12">
                  <a href="../../Clients.php" class="btn btn-primary mt-1 md-3"><- Back</a>
              </div>
              <div class="col-lg-6 col-lg-6 col-sm-12">
          <h3 class="mt-1 md-2 text-right text-uppercase"> Update Client DATA </h3>
              </div>
               
          </div>
          
          <form class="mt-2" method="POST" action="">
              
            <div class="form-group">
    <label >Enter Full Name</label>
    <input type="text" class="form-control" id="Fullname" name="fullname"  value="<?php echo $FN?>" placeholder="Enter Full Name">
  </div>
<!--          <div class="form-group">
    <label for="exampleFormControlSelect1">Select Type</label>
   
      <select class="form-control"  id="exampleFormControlSelect1" placeholder="Please Select type"onchange="document.getElementById('text_CT').value=this.options[this.selectedIndex].text">
    <option Selected value="<?php echo $TY?>"><?php echo $TY?></option>
    <?php 

$sql = mysqli_query($con, "SELECT * FROM Client_type");
while ($row = $sql->fetch_assoc()){
echo "<option value=".$row['Sr_no'].">".$row['Type']."</option>";
}
?>
  </select>
      <input type="hidden" name="type" id="text_CT" value="" />
  </div>-->


<div class="form-group">
    <label for="exampleFormControlSelect1">Select Type</label>
   
    <select class="form-control" name="type" id="exampleFormControlSelect1" placeholder="Please Select type" onchange="document.getElementById('text_CT').value=this.options[this.selectedIndex].text">
    <option Selected value="<?php echo $TY?>"><?php echo $TY?></option>
    <?php 

$sql = mysqli_query($con, "SELECT * FROM Client_type");
while ($row = $sql->fetch_assoc()){
echo "<option value=".$row['Sr_no'].">".$row['Type']."</option>";
}
?>
  </select>
 <input type="hidden" name="type" id="text_CT" value="<?php echo $TY?>" />
  </div>

           <div class="row">
    <div class="col-lg-6 col-md-6 col-sm-12">
        <lable>Enter Email Address</lable>
        <input type="email" name="mail" id="Mail" class="form-control" value="<?php echo $EM?>" placeholder="Email Address" >
    </div>
   <div class="col-lg-6 col-md-6 col-sm-12">
        <lable>Enter Phone Number</lable>
        <input type="number" name="phone" id="Phone" class="form-control" value="<?php echo $MB?>" placeholder="Phone Number" >
    </div>
           </div>
  
      <div class="form-group">
    <label class="mt-2">Enter Address</label>
    <textarea class="form-control"  id="Address" name="address"  placeholder="Enter Address"><?php echo $AD?></textarea>
  </div>
          
          
             
            <button class="btn btn-primary mt-2 "type="submit" name="submit">Submit</button>
            <a href="../../Clients.php" class="btn btn-primary mt-2">Back</a>
            
            </form>
          
          
      </div>
      
     
      <script>
      
      $(document).ready(function() {
    
       
      $('select').selectize({
          sortField: 'text'
// $('select').select2();
      });
      
    });
      
      </script>
      

    
    
    
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>

  </body>
</html>