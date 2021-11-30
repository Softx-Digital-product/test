<?php 

include 'php/DbCon.php';

if(isset($_POST['submit'])){

$C_client= $_POST['client'];
$C_court= $_POST['court'];
$C_case= $_POST['case'];
$C_type= $_POST['city'];
$C_number= $_POST['number'];
$C_year= $_POST['year'];
$C_decription= $_POST['desc'];
echo $C_client, $C_court, $C_case, $C_type, $C_number,$C_year,$C_decription;



$sql = "INSERT INTO  casedb (C_client,C_court,C_case,C_type,C_number,C_year,C_decription)
VALUES ('$C_client', '$C_court', '$C_case', '$C_type','$C_number','$C_year','$C_decription')";

if ($con->query($sql) === TRUE) {
//  echo "New record created successfully";
} else {
 echo "Error: " . $sql . "<br>" . $con->error;
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

      
            <a href="./clients & case decuments.php" class="nav__link   ">CLIENTS</a></li>
            <a href="./cases.php" class="nav__link active ">CASE</a></li>
            <a href="./upload case documents.php" class="nav__link">UPLOAD CASE DOCUMENTS</a></li>
            <a href="./timeline.php" class="nav__link">TIMELINE</a></li>
            <a href="./VIEW Case Documents.php"  class="nav__link ">VIEW CASE DOCUMENTS </a></li>
            <a href="../PdfsM/table.php"  class="nav__link ">PDF Manager</a>
          <a href="javascript:void(0);" class="icon1" onclick="myFunction1()">
                              <i class="fa fa-bars"></i>
                             </a>
                       
                   </div>
                   <br>
<button class="btn" button onclick="document.location= 'cases.php'"><i class="fa fa-chevron-left"> BLACK</i></button>
<br>
<br>
<div>
	<form action="" method="post">
		<div class="container">
   <div class="form-group">
													<label><b>CLient Name</b><span class="label-required"></label>
                          <input class="form-control" id="phonenumber"  type="text" name="client" required>
													
												</div>

          <div class="form-group">
													<label><b>Court</b> <span class="label-required"></span><span id="city-info" class="info"> </span></label>
													<select class="form-control input-md" name="court" id="city" >
														<option value="">SC Supreme Court</option>
														<option value="Hyderabad">BHC Brmbay High Court</option>
														<option value="Delhi NCR">CCSC City Ciivils & Sessions Court</option>
														<option value="Mumbai">MAG Magistrate Court</option>
														<option value="Chennai">CONS Consumer Court</option>
														</b>
													</select>
													
												</div>
					<label for="phonenumber"><b>CASE NAME</b></label>
					<input class="form-control" id="phonenumber"  type="text" name="case" required>

                    <div class="form-group">
													<label><b>CASE TYPE</b></label>
                          <b>					<select class="form-control input-md" name="city" id="city" >
														<option value="">Criminal</option>
														<option value="Hyderabad">Civil</option>
														<option value="Delhi NCR">Domestic</option>
														<option value="Mumbai">Probate/Guardianship</option>
														<option value="Chennai">Mental Illness/Alcohol</option>
														<option value="Chennai">Juvenile Dependency</option>
														<option value="Chennai">Juvenile Offender</option>
														<option value="Chennai">Judgment</option>
</b>
													</select>
													
												</div><td>
<text tarea name ="comments " maxlength="1000" clos="25" rowe="6"><b>CASE NUMDER</b></label>
					<input class="form-control" id="password"  type="" name="number" required>
</td>
<td>
					<text tarea name ="comments " maxlength="1000" clos="25" rowe="6"><b>CASE YEAR</b></label>
					<input class="form-control" id="password"  type="" name="year" required>
</td>
<td>
					<text tarea name ="comments " maxlength="1000" clos="25" rowe="6"><b>CASE DESCRIPTION</b></label>
					<input class="form-control" id="password"  type="" name="desc" required>
</td>
					<hr class="mb-3">
					<input class="btn btn-primary" type="submit" id="register" name="submit" value="submit">
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