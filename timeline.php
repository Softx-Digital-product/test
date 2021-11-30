
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- ===== CSS ===== -->

        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfobject/2.2.5/pdfobject.js" integrity="sha512-eCQjXTTg9blbos6LwHpAHSEZode2HEduXmentxjV8+9pv3q1UwDU1bNu0qc2WpZZhltRMT9zgGl7EzuqnQY5yQ==" crossorigin="anonymous"></script>
        <!-- ===== CSS ===== -->
                
        <link rel="stylesheet" href="assets12/css1/13.css">

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
     
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<link rel="stylesheet" href="assets12/css/sam.css">
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>



/* Clear floats after the columns */
body {
  font-family: Arial;
  background-color: #f2f2f2;
}




.button {
  background-color: #ddd;
  border: none;
  color: black;
  padding: 14px 20px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  margin: 4px 2px;
  cursor: pointer;
  border-radius: 16px;
}



.pdfView{
  height : 600px;
  
}

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
            <a href="./cases.php" class="nav__link ">CASE</a></li>
            <a href="./upload case documents.php" class="nav__link">UPLOAD CASE DOCUMENTS</a></li>
            <a href="./timeline.php" class="nav__link active">TIMELINE</a></li>
            <a href="./VIEW Case Documents.php"  class="nav__link ">VIEW CASE DOCUMENTS </a></li>
            <a href="../PdfsM/table.php"  class="nav__link ">PDF Manager</a>
          <a href="javascript:void(0);" class="icon1" onclick="myFunction1()">
                              <i class="fa fa-bars"></i>
                             </a>
                       
                   </div>
<br>

<div class="coupon">

  <div class="container">
  <div class="ox">
    <select>&nbsp;&nbsp;&nbsp;
      <option>CLIENT NAME </option>
      <option>...</option> </select>&nbsp;&nbsp;
      <select>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      <option>CLIENT NAME </option>
      <option>...</option>
    

    </select>  
    <button class="button">VIEW DOCUMENTS</button>
      
</div>
  </div>
</div>


<br>


<div class="container-fluid">
  <div class="row">
    <div class="col">
    <div class="topnav">

<a class="active"  href="./timeline.php">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;View Documents&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</a> 
<a  href="./Add Document Entry.php">&nbsp;&nbsp;&nbsp; &nbsp;Add Document Entry&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>


<a href="./View Timeline.php">&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;View Timeline &nbsp;&nbsp;&nbsp; &nbsp; &nbsp;  
</a>
</div>
</from>

<br>
<div class="col">



<mat-tab-body class="mat-tab-body ng-tns-c23-19 ng-star-inserted mat-tab-body-active" role="tabpanel" ng-reflect-_content="[object Object]" ng-reflect-animation-duration="500ms" ng-reflect-position="0" id="mat-tab-content-1-0" aria-labelledby="mat-tab-label-1-0" ng-reflect-origin="-1">

<table _ngcontent-fqx-c12="" id="users">
<tr _ngcontent-fqx-c12="">
<th _ngcontent-fqx-c12="" class="doc_head"> Client Name </th>
<th _ngcontent-fqx-c12="" class="doc_head">Case Name</th>
<th _ngcontent-fqx-c12="" class="doc_head">File Name</th>
<th _ngcontent-fqx-c12="" class="doc_head">File Size</th>
<th _ngcontent-fqx-c12="" class="doc_head">Date of Upload</th>
<th _ngcontent-fqx-c12="" class="doc_head">Add</th></tr>
<!----></table>

</mat-tab-body>

        </div>
    </div>

    <div class="col">
    <div id="PdfView" class="pdfView">
    </div>
    </div>

  </div>
</div>








</div>
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
   

<script src="ckeditor/ckeditor.js"></script>
<script>PDFObject.embed("pdfs/Testing.pdf", "#PdfView");</script>

<script>

CKEDITOR.replace('content');

</script>
        <!-- ===== IONICONS ===== -->
        <script src="https://unpkg.com/ionicons@5.1.2/dist/ionicons.js"></script>

        <!--===== MAIN JS =====-->

    </body>
</html>