<?php
include 'UploadCase/Dp.php';



if(isset($_GET['v'])){
    $sr; $name; $surname; $mail; $pass;
    $role; $address; $phone; $username; $dob;
    $pan; $aadhar; $aid; $tid; $profile;
    $status;
    $id = $_GET['v'];
    
    $query = "SELECT * FROM TeamMembers WHERE Sr_no = {$id}";
$result = $con->query($query);

if ($result->num_rows > 0) {
while ($row = $result->fetch_assoc()) {
    
    $sr=$row['Sr_no'];
    $name=$row['Name'];
    $surname=$row['Surname'];
    $mail=$row['Mail_Id'];
    $pass=$row['Password'];
    $role=$row['Role'];
    $address=$row['Address'];
    $phone=$row['Phone'];
    $username=$row['UserName'];
    $dob=$row['DOB'];
    $pan=$row['PanCard'];
    $aadhar=$row['AadharCard'];
    $aid=$row['Advocate_Id'];
    $tid=$row['Tid'];
    $profile=$row['profile'];
    $status=$row['status'];

}
}

else{
echo "<h3> No Record</h3>";
}

    
    
    
    
    
}else{
    header("Location:http://apajuris.in/work/Team.php");
}









if(isset($_POST['EM'])){

 $Fname = mysqli_real_escape_string($con,$_POST['ufname']);
   $Lname = mysqli_real_escape_string($con,$_POST['ulname']);
   $Mail = mysqli_real_escape_string($con,$_POST['umail']);
   $Phone = mysqli_real_escape_string($con,$_POST['uphone']);
   $UserName = mysqli_real_escape_string($con,$_POST['uusername']);
  // $Password = mysqli_real_escape_string($con,$_POST['upasswords']);
  $Password = $_POST['upasswords'];
  echo "Password -->".$Password;
   $Dob = mysqli_real_escape_string($con,$_POST['udob']);
   $Role = mysqli_real_escape_string($con,$_POST['urole']);
   $Pancard = mysqli_real_escape_string($con,$_POST['upancard']);
   $Aadhar= mysqli_real_escape_string($con,$_POST['uaadharcard']);
   //Profile idphotos[]
   $Address = mysqli_real_escape_string($con,$_POST['uaddress']); 
   
  $Adocateid = mysqli_real_escape_string($con,$_POST['ubarid']);
  $Status= mysqli_real_escape_string($con,$_POST['ustatus']);
  

//echo $Fname."<br>";
//echo $Lname."<br>";
//echo $Mail."<br>";
//echo $Phone."<br>";
//echo $UserName."<br>";
//echo $Passsword."<br>";
//echo $Fname."<br>";
//
  

  
  if(isset($_FILES['uprofile'])){
     
      $file_dir ="TeamMembers/$tid/";
     $fileName = basename($_FILES['uprofile']['name']); 
      $fileSize= basename($_FILES['uprofile']['size']);
      $targetFilePaths = $file_dir . $fileName; 
      if(move_uploaded_file($_FILES["uprofile"]["tmp_name"], $targetFilePaths)){
        echo "file Uploaded Successfully Bro";
      $psql = "UPDATE TeamMembers SET profile='$targetFilePaths' WHERE Sr_no='$id'";
      if ($con->query($psql) === TRUE) {
echo "Updated Dp!!!";

}else{
      echo "Error: ----->" . $psql . "<br>" . $con->error;
}
      //echo  $psql;
              
      }
      else{
          echo "file Can't upload";
      }
     
 }




$sql = "UPDATE TeamMembers SET Name='$Fname', Surname='$Lname',Mail_Id='$Mail',Password='$Password',Role='$Role',Address='$Address',Phone='$Phone',UserName='$UserName',"
        . "DOB='$Dob',PanCard='$Pancard',AadharCard='$Aadhar',Advocate_Id='$Adocateid',status='$Status' WHERE Sr_no='$id'";
//echo $sql;

if ($con->query($sql) === TRUE) {
echo "Updated!!!";
header("Location:http://apajuris.in/work/Team.php");

}else{
      echo "Error: ----->" . $sql . "<br>" . $con->error;
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
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/themes/ui-lightness/jquery-ui.min.css" integrity="sha512-NaCOGQe8bs7/BxJpnhZ4t4f4psMHnqsCxH/o4d3GFqBS4/0Yr/8+vZ08q675lx7pNz7lvJ6fRPfoCNHKx6d/fA==" crossorigin="anonymous" />
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>


        <script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/js/standalone/selectize.min.js" integrity="sha256-+C0A5Ilqmu4QcSPxrlGpaZxJ04VjsRjKu+G82kl5UJk=" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/css/selectize.bootstrap3.min.css" integrity="sha256-ze/OEYGcFbPRmvCnrSeKbRTtjG4vGLHXgOqsyLFTRjg=" crossorigin="anonymous" />



        <style>

          .profile-pic {
    border-radius: 50%;
    height: 150px;
    width: 150px;
    background-size: cover;
    background-position: center;
    background-blend-mode: multiply;
    vertical-align: middle;
    text-align: center;
    color: transparent;
    transition: all .3s ease;
    text-decoration: none;
    cursor: pointer;
}

.profile-pic:hover {
    background-color: rgba(0,0,0,.5);
    z-index: 10000;
    color: #fff;
    transition: all .3s ease;
    text-decoration: none;
    
}

.profile-pic span {
    display: inline-block;
    padding-top: 4.5em;
    padding-bottom: 4.5em;
    margin-bottom: -4em;
    
}

form input[id="fileToUpload"] {
          display: none;
          cursor: pointer;
 }
        </style>
        <title>Update Team Data</title>
    </head>
    <body>

        <div class="container border mt-4 shadow p-3 mb-5 bg-white rounded">
            <div class="row">
                <div class="col-lg-6 col-lg-6 col-sm-12">
                    <a href="Team.php" class="btn btn-primary mt-1 md-3"><- Back</a>
                </div>
                <div class="col-lg-6 col-lg-6 col-sm-12">
                    <h3 class="mt-1 md-2 text-right text-uppercase"> Update Client DATA </h3>
                </div>

            </div>
            <div class="container text-center">
<!--                  <img src="<?php echo $profile;?>" id="vprofile" class="img-fluid border" style='border-radius:50%;height:10rem;width:10rem; vertical-align: middle;'>-->
                  <label for="fileToUpload">
  <div class="profile-pic" style="background-image: url('<?php echo $profile?>')">
      <span class="glyphicon glyphicon-camera"></span>
      <span>Change Image</span>
  </div>
  </label>
<!--                   <input type="File" name="fileToUpload" class="d-none" id="fileToUpload">-->
            </div>
             <form  class="mt-3" action="" method="POST" enctype="multipart/form-data">
                  
                  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="UName">Name</label>
      <input type="text" class="form-control" name='ufname'id="UName"  value="<?php echo $name ?>"placeholder="First name"autocomplete="off" >
    </div>
    <div class="form-group col-md-6">
      <label for="USurname">Surname</label>
      <input type="text" class="form-control" name='ulname' id="USurname" value="<?php echo $surname ?>" placeholder="Last name" autocomplete="off" >
    </div>
  </div>
        
                      <div class="form-row">
    <div class="form-group col-md-6">
      <label for="UMail">Email Id</label>
      <input type="email" class="form-control" name="umail"id="UMail" value="<?php echo $mail ?>" placeholder="Email Address"  autocomplete="off" >
    </div>
    <div class="form-group col-md-6">
      <label for="UPhone">Phone Number</label>
      <input type="Number" class="form-control" name="uphone" id="UPhone"value="<?php echo $phone ?>" placeholder="Mobile Number" autocomplete="off">
    </div>
  </div>
                  
                          <div class="form-row">
    <div class="form-group col-md-6">
      <label for="UUserName">User Name</label>
      <input type="text" class="form-control" name="uusername"id="UUserName" value="<?php echo $username; ?>" placeholder="User Name" autocomplete="off">
    </div>
    <div class="form-group col-md-6">
      <label for="UPassword">Password</label>
      <input type="text" class="form-control" name="upasswords" id="UPassword" value="<?php echo $pass;?>"placeholder=" Password" autocomplete="off">
    </div>
  </div>
                  <div class="form-row">
                      <div class="form-group col-md-6">
                           <label for="UStatus">Status</label>
                            <select class="form-control" style="width:100%;"  id="UStatus" placeholder="select status level" onchange="document.getElementById('text_status').value = this.options[this.selectedIndex].text">
                              <option value=""disabled selected><?php echo $status;?></option>
                                <option>Active</option>
                                <option>Inactive</option>
                                <option>Left</option>
        
      </select>
                           
                 <input type="hidden" id="text_status"  name="ustatus" value="<?php echo $status; ?>" />            

                      </div>
                      
                      <div class="form-group col-md-6">
      <label for="URole">Access Level</label>
      <select class="form-control" style="width:100%;" id="URole" placeholder="select Access level" onchange="document.getElementById('text_role').value = this.options[this.selectedIndex].text">
          <option value=""disabled selected><?php echo $role;?></option>
          <option>Admin</option>
          <option>Account</option>
          <option>Drafter</option>
          <option>Manager</option>
          <option>Translator</option>
          <option>Super Admin</option>
          <option>Support Staff</option>
          
 
      </select>
       <input type="hidden" name="urole" id="text_role" value="<?php echo $role; ?>" />
    </div>
                      
                  </div> 
                     <div class="form-row">
    <div class="form-group col-md-6">
      <label for="UDob">Date of Birth</label>
      <input type="text" class="form-control" name="udob"id="UDob" value="<?php echo $dob ?>" placeholder="Date of Birth" autocomplete="off" required>
    </div>
    <div class="form-group col-md-6">
      <label for="UBarid">Bar Council Registration Number</label>
      <input type="text" class="form-control" name="ubarid"id="UBarid" value="<?php echo $aid ?>" placeholder="Council Registration Number" autocomplete="off">
    </div>
    
  </div>
                    <div class="form-row">
    <div class="form-group col-md-6">
      <label for="UPancard">Pan card</label>
      <input type="text" class="form-control"  value="<?php echo $pan ?>" name="upancard"id="UPancard" placeholder="Enter pan number" autocomplete="off" required>
    </div>
    <div class="form-group col-md-6">
      <label for="UAadharcard">Aadhar Card</label>
      <input type="text" class="form-control" value="<?php echo $aadhar?>" name="uaadharcard" id="UAadharcard"placeholder="Enter Aadhaar Number" autocomplete="off" required>
      
    </div>
  </div>
<!--                           <div class="form-row">
    <div class="form-group col-md-6">
        <label >Upload profile photo</label><br>
      <input type="file" class="border p-1"style="width:100%;" name="uprofile" id="UProfile">
    </div>
    <div class="form-group col-md-6">
        <label >Upload Documents</label><br>
        <input type="file" class="border p-1"style="width:100%;" name="ufile[]" id="UIdphotos" multiple>
      
    </div>
  </div>-->
 <input type="File" name="uprofile" class="d-none" id="fileToUpload">
            <div class="form-group">
      <label for="Address">Address</label>
      <textarea id="UAddress" name="uaddress" class="form-control" placeholder="full address" rows="3"><?php echo $address ?></textarea>
    </div>      
                  
                  
               
               
                   <button type="submit" class="btn btn-sm btn-success text-white" name="EM">Edit Member</button>
                  
              </form>
           
            

           
        </div>


        <script>

            $(document).ready(function () {
                
                    $("#UDob").datepicker({ dateFormat: 'dd/mm/yy',});
                $("select").select2();

    });

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



        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>

    </body>
</html>