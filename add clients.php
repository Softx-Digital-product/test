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
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- ===== CSS ===== -->

    
        <!-- ===== CSS ===== -->
        
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha512-SfTiTlX6kk+qitfevl/7LibUOeJWlt9rbyDn92a1DqWOw9vWG2MFoays0sgObmWazO5BQPiFucnnEAjpAB+/Sw==" crossorigin="anonymous" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
 
        <link rel="stylesheet" href="assets12/css1/13.css">
<link rel="stylesheet" href="assets12/css1/12.css">
<link rel="stylesheet" href="assets12/css/sam.css">
<meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Menu responsive</title>
    </head>
    <body>
 

    
        <div class="topnav" id="myTopnav">
                       
                    <a href="./index.php" class="nav__link ">Timelin</a></li>
                    <a href="#" class="nav__link">Client Barief</a></li>
                    <a href="#" class="nav__link">Law</a></li>
                    <a href="#" class="nav__link">Tesk Add</a></li>
                    <a href="./clients & case decuments.php" class="nav__link active">Clients </a></li>
                    <a href="#" class="nav__link ">Calendere</a></li>
                    <a href="#" class="nav__link">Manage Cme</a></li>
                    <a href="#" class="nav__link">Manage Kms</a></li>
                    <a href="#" class="nav__link">Mange Law</a></li>
                    <a href="#" class="nav__link">Manage Tms</a></li>
                   
                    
                        &nbsp;
                    <a href="#" class="btn1"><i class="fa fa-search" aria-hidden="true"></i></a>    
                    <a href="#" class="btn1"><i class="fa fa-calendar" aria-hidden="true"></i></a>  
                    <a href="#" class="btn1"><i class="fa fa-bell-o" aria-hidden="true"></i></a>  
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
<button class="btn" button onclick="document.location= 'clients & case decuments.php'"><i class="fa fa-chevron-left"> BLACK</i></button>
<br>

<div>

<div>
	<form action="" method="post">
		<div class="container">
<label for="firstname"><b>Name</b></label>
					<input class="form-control" id="firstname" type="text" name="fname" required>
<label for="firstname"><b> SurName</b></label>
					<input class="form-control" id=" surname" type="text" name="surname" required>
          <div class="form-group">
													<label>TYPE <span class="label-required">*</span>
                          <span id="city-info" class="info"> (NNT)</span></label>
													<select class="form-control input-md" name="city" id="city" >
														<option value="PERSON">PERSON</option>
														<option value="PATNERSHIP">PATNERSHIP</option>
														<option value="SOLE PROPRIETY">SOLE PROPRIETY</option>
														<option value="COMPANY">COMPANY</option>
														<option value="TRUST">TRUST</option>
												</select>	</div>
					<label for="phonenumber"><b>Mobile</b></label>
					<input class="form-control" id="phonenumber" name="mobile" type="NUMBER"  required>

					<label for="phonenumber"><b>Mail</b></label>
					<input class="form-control" id="email"  type="email" name="mail" required>
<td>
					<text tarea name ="comments " maxlength="1000" clos="25" rowe="6"><b>Address</b></label>
					<input class="form-control" id="password"  type="" name="add" required>
</td>
					<hr class="mb-3">
					<input class="btn btn-primary" type="submit"  name="submit" value="Sign Up">
				</div>
			</div>
		</div>
	</form>
</div>
        
        </div> <!-- ===== IONICONS ===== -->
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
   

        <!-- ===== IONICONS ===== -->
        <script src="https://unpkg.com/ionicons@5.1.2/dist/ionicons.js"></script>

        <!--===== MAIN JS =====-->

    </body>
</html>