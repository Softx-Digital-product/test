<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!-- ===== CSS ===== -->
        <link rel="preconnect" href="https://fonts.gstatic.com">

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha512-SfTiTlX6kk+qitfevl/7LibUOeJWlt9rbyDn92a1DqWOw9vWG2MFoays0sgObmWazO5BQPiFucnnEAjpAB+/Sw==" crossorigin="anonymous" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
 
        <link rel="stylesheet" href="assets12/css1/13.css">
<link rel="stylesheet" href="assets12/css1/12.css">
<link rel="stylesheet" href="assets12/css/sam.css">
<meta name="viewport" content="width=device-width, initial-scale=1">
        <style>

</style>
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

      
            <a href="Clients.php" class="nav__link  ">CLIENTS</a>
            <a href="./cases.php" class="nav__link active">CASE</a>
            <a href="./upload case documents.php" class="nav__link">UPLOAD CASE DOCUMENTS</a></li>
            <a href="./timeline.php" class="nav__link">TIMELINE</a></li>
            <a href="./VIEW Case Documents.php"  class="nav__link ">VIEW CASE DOCUMENTS </a></li>
            <a href="PdfsM/table.php"  class="nav__link ">PDF Manager</a>
          <a href="javascript:void(0);" class="icon1" onclick="myFunction1()">
                              <i class="fa fa-bars"></i>
                             </a>
                       
                   </div>
<br>
                   <button class="btn" button onclick="document.location= 'cases add.php'"><i class="fa fa-bars"> ADD</i></button>
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
<div _ngcontent-fqx-c12="" class="ng-star-inserted" style="">
<table _ngcontent-fqx-c12="" id="users">
<tr _ngcontent-fqx-c12="">
<th _ngcontent-fqx-c12="" class="doc_head"> Case Id </th>    
<th _ngcontent-fqx-c12="" class="doc_head"> Clients Name </th>
<th _ngcontent-fqx-c12="" class="doc_head">Court</th>
<th _ngcontent-fqx-c12="" class="doc_head">Case Name</th>
<th _ngcontent-fqx-c12="" class="doc_head">Case Type</th>
<th _ngcontent-fqx-c12="" class="doc_head"> Case Number</th>
<th _ngcontent-fqx-c12="" class="doc_head">Case Year</th>
<th _ngcontent-fqx-c12="" class="doc_head">Case Description</th></tr>
 <?php 
include 'php/DbCon.php';

$sql = "select * from casedb";


$result = mysqli_query($con,$sql);


while($row = mysqli_fetch_assoc($result))
{
  echo '<tr>';
  echo '<td>'. $row['Cid'];'</td>';
  echo '<td>'. $row['C_client'];'</td>';
  echo '<td>'. $row['C_court'];'</td>';
  echo '<td>'. $row['C_case'];'</td>';
  echo '<td>'. $row['C_type'];'</td>';
  echo '<td>'. $row['C_number'];'</td>';
  echo '<td>'. $row['C_year'];'</td>';
  echo '<td>'. $row['C_decription'];'</td>';
  echo'</tr>';
}
?>
</table></div></div>
</mat-tab-body></div>
</mat-tab-group>

        
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