<?php
include 'Database/Dp.php';

if(isset($_POST['pid'])){
    
   $cid=$_POST['pid'];
  
    $quariy = $con->query("SELECT * FROM UploadDocs WHERE Sr_no = $cid");
//     echo $quariy;
                    $num = mysqli_num_rows($quariy);
                    if ($num >= 0) {
                        while ($row = mysqli_fetch_array($quariy)) {
                          
                           $clientName= $row['Client_Name'];
                           $caseName=$row['Case_Name'];
                           $pdfName= $row['Pdf_Name'];
                        }
                        }
                        
$path="ClientCaseData/$clientName/$caseName/$pdfName";
//echo  $path;

}
 if($clientName === NULL){
                            $clientName = "Please Choose Client Name";
                        }
                        if($caseName === NULL){
                            $caseName = "Please Choose Case Name";
                        }
                        if($pdfName === NULL){
                            $pdfName = "Choose pdf Document";
                        }
?>



<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        
        
<meta http-equiv='cache-control' content='no-cache'>
<meta http-equiv='expires' content='0'>
<meta http-equiv='pragma' content='no-cache'>

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
        
        <!-- Datatable -->

        <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css'>
        <link rel='stylesheet' href='https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css'>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

      
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/themes/ui-lightness/jquery-ui.min.css" integrity="sha512-NaCOGQe8bs7/BxJpnhZ4t4f4psMHnqsCxH/o4d3GFqBS4/0Yr/8+vZ08q675lx7pNz7lvJ6fRPfoCNHKx6d/fA==" crossorigin="anonymous" />
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link rel="stylesheet" href="assets12/css/sam.css">
        <link rel="stylesheet" href="Timeline/timeline.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha512-SfTiTlX6kk+qitfevl/7LibUOeJWlt9rbyDn92a1DqWOw9vWG2MFoays0sgObmWazO5BQPiFucnnEAjpAB+/Sw==" crossorigin="anonymous" />


        <script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/js/standalone/selectize.min.js" integrity="sha256-+C0A5Ilqmu4QcSPxrlGpaZxJ04VjsRjKu+G82kl5UJk=" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/css/selectize.bootstrap3.min.css" integrity="sha256-ze/OEYGcFbPRmvCnrSeKbRTtjG4vGLHXgOqsyLFTRjg=" crossorigin="anonymous" />

      <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
        <script src='https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js'></script>

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfobject/2.2.5/pdfobject.min.js"></script>
    
        
         <script src="https://mozilla.github.io/pdf.js/build/pdf.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.0.943/pdf.min.js"></script>

    </head>
    <title>View Case Document</title>
    <style>
        
        
                 #canvas_container_m {
        width: 99.9%;
        height: 750px;
        overflow: auto;
    }
	#pdf_renderer_m{ width:99.9%; cursor:pointer;}
  
  .couponcode:hover .coupontooltip {
    display: block;
}
        #canvas_container {
        width: 99.9%;
        height: 850px;
        overflow: auto;
    }
	#pdf_renderer{ width:99.9%; cursor:pointer;}
  
  .couponcode:hover .coupontooltip {
    display: block;
}

          .cc .btn{
    margin-top: 5px;
    background: #008080;
/*    padding:6px;*/
    margin-bottom:5px;
}
         .cc input{
             padding:0px;
             height:-1px;
    margin-top: 5px;
    margin-bottom: 5px;
    width:10%;
    text-align: center;
}

        
/*         div.dataTables_filter, div.dataTables_length {
            margin-top:2px;
             padding-right:20px;
            padding-left:20px;

            text-transform: uppercase;

        } 
*/
/*        div.dataTables_filter {
            margin-left: -40rem;
                 margin-right: -5rem;
        }*/
        div.dataTables_wrapper div.dataTables_filter input {
/*              margin-left: 100px;*/
            display:inline-block;
/*           width:  !important;*/
         
           

        }
        #pdf_view { height:850px;};
    </style>
  </head>
  <body>
      
    <div class="topnav" id="myTopnav">


        <a href="Cms.php" class="nav__link">Timeline</a>
        <a href="#" class="nav__link">Team</a>
        <a href="#" class="nav__link">Law</a>
        <a href="knowledge.php" class="nav__link ">Knowledge</a>
        <a href="Clients.php" class="nav__link active">Clients </a>
        <a href="" class="nav_link">Task Management</a>
        <a href="#" class="nav__link">Manage Cme</a>
        <a href="#" class="nav__link">Manage Kms</a>
        <a href="#" class="nav__link">Mange Law</a>
        <a href="#" class="nav__link">Control panel</a>




        <a href="#" class="btn1"><i class="fa fa-search" aria-hidden="true"></i></a>  
        <a href="#" class="btn1"><i class="fa fa-calendar" aria-hidden="true"></i></a>  
        <a href="#" class="btn1"><i class="fa fa-bell-o" aria-hidden="true"></i></a>   &nbsp;
        <a href="login"class="btn1"><i class="fa fa-user-o" aria-hidden="true"></i></a>



        <a href="javascript:void(0);" class="icon" onclick="myFunction()">
            <i class="fa fa-bars"></i>
        </a>

    </div>
</div> <!-- ===== IONICONS ===== -->
<script src="https://unpkg.com/ionicons@5.1.2/dist/ionicons.js"></script>

<div class="topnav1" id="myTopnav">
    <a href="Clients.php" class="nav__link" >Client</a>
    <a href="ClientCase.php" class="nav__link ">Case</a>
    <a href="uploadcasedoc.php" class="nav__link">Upload Case Documents</a>
    <a href="Timelines.php" class="nav__link">TimeLine</a>
    <a href="" class="nav__link active">View Case Documents</a>
 <a href="ClientBrief.php" class="nav__link">Upload Client Brief</a>
             <a href="viewBrief.php"id="cb" class="nav__link">Client Brief</a>
    <a href="" class="nav__link">PDF Manager</a>
    <!--         <a href="javascript:void(0);" class="icon1" onclick="myFunction1()">
                                  <i class="fa fa-bars"></i>
                                 </a>-->

</div>


<div class="container-fulid vc p-0">
    
<!--    <form method="POST" action="" enctype="multipart/form-data">-->
    <div class="container">
        
        <div class="row">
            
    <div class="col-lg-6 col-md-6 col-sm-12">
     <div class="form-group mt-1 mb-1">
<!--                                <label class="font-weight-bolder" for="exampleFormControlSelect1">Select Client Name</label>-->
                               
                                <select class="CN" id="ClientN" style="width:100%;" placeholder="Please Select Client Name"onchange="document.getElementById('text_CT').value = this.options[this.selectedIndex].text">
                                    <option value=""disabled selected><?php echo $clientName?></option>
                                    <?php
                                    $sql = mysqli_query($con, "SELECT * FROM ClientDb");
                                    while ($row = $sql->fetch_assoc()) {
                                        echo "<option value=" . $row['Sr_no'] . ">" . $row['Full_Name'] . "</option>";
                                    }
//                                    
//                                    $sql = mysqli_query($con, "SELECT * FROM Client_CaseDb");
//                                    while ($row = $sql->fetch_assoc()) {
//                                        echo "<option value=" . $row['Sr_no'] . ">" . $row['Client_Name'] . "</option>";
//                                    }
//                                    ?>
                                </select>
                                <input type="hidden" name="ClientName" id="text_CT" value="<?php echo $clientName?>" />
                            </div>
    </div>
 <div class="col-lg-6 col-md-6 col-sm-12">
     
         <div class="form-group mt-1 mb-1">
<!--                            <label class="font-weight-bolder" for="exampleFormControlSelect1">Select Case Name</label>-->
                                <select class="CN"  style="width:100%;" id="CaseName" placeholder="Please Select Client Name"onchange="document.getElementById('text_CN').value = this.options[this.selectedIndex].text">
                                    <option value=""disabled selected><?php echo $caseName?></option>
                                    <?php
                                    $sql = mysqli_query($con, "SELECT * FROM Client_CaseDb");
                                    while ($row = $sql->fetch_assoc()) {
                                        echo "<option value=" . $row['Sr_no'] . ">" . $row['Case_Name'] . "</option>";
                                    }
                                    ?>
                                </select>
<input type="hidden" name="CaseN" id="text_CN" value="<?php echo $caseName?>" />
                            </div>
    </div>
     
           
               
    </div>
               
    </div>
   
  </div>
  
    </div>

<!--<hr class="mt-1 bg-dark">-->
    

<div class="container-fluid p-0">
    <div class="row">
    <div class="tables p-0 col-lg-6 col-md-6 col-sm-12 p-0 table-responsive">

        <table class="table table-striped table-bordered  table-hover " id='UserList'>
            <thead class="vbg text-light">
                <tr>
                    <th class="text-center"scope="col">SRN</th>
                    <th class="text-center" scope="col">DOC</th>
                    <th class="text-center" scope="col">PDF Name</th>
                    <th class="text-center" scope="col">EXT</th>
                    <th class="text-center" scope="col">PGS</th>
<!--                    <th class="text-center" scope="col">Upload Date</th>-->
                    <th class="text-center" scope="col">View</th>
                  

                </tr>
            </thead>
            <tbody id="dytable">
                
                    <?php
                    $sr = 1;
                    include('ClientDb/Dp.php');
                    $quariy = $con->query("SELECT * FROM UploadDocs");
                    $num = mysqli_num_rows($quariy);
                    if ($num >= 0) {
                        while ($row = mysqli_fetch_array($quariy)) {
                            ?>
                <tr>
                            <th class="text-center" scope="row" style=""><?php echo $sr ?></th>
                            <td class="" scope="row"style=""><?php echo $row['DOE'] ?></td>
                             <td class=" text-center text-nowrap" scope="row"style="" data-toggle="tooltip" title="<?php echo $row['Pdf_Name']?>"><?php echo substr($row['Pdf_Name'],0,30);?></td>
<!--                            <td class="text-center" scope="row"style=""><?php echo $row['Pdf_Name'] ?></td>-->
                            <td class="text-center" scope="row"style=""><a id="extbtn" type="button"  class="nav_link"   data-toggle="modal" data-target="#extModal" value="<?php echo $row['Pdf_Path']?>"onclick="ext('<?php echo $row['Pdf_Name']?>','ClientCaseData/<?php echo $row['Client_Name']?>/<?php echo $row['Case_Name']?>/<?php echo $row['Pdf_Name']?>','<?php echo $row['Client_Name']?>','<?php echo $row['Case_Name']?>','<?php echo $row['Sr_no']?>')">Extract</a></td>
                            <td class="text-center" scope="row"style=""><?php echo $row['Pdf_Pages'] ?></td>
<!--                            <td class="text-center" scope="row"style=""><?php echo $row['DOU'] ?></td>-->
<!--                            <td class="text-center" scope="row"style=""><a  id="viewbtn" type="button"  class="nav_link"   data-toggle="modal" data-target="#exampleModals" value="<?php echo $row['Pdf_Path']?>"onclick="view('<?php echo $row['Pdf_Path']?>')">View</a></td>-->
<!--                         <td class="text-center" scope="row"style=""><a  id="viewbtn" type="button"  class="nav_link"   data-toggle="modal" data-target="#exampleModals" value="<?php echo $row['Pdf_Path']?>"onclick="view('ClientCaseData/<?php echo $row['Client_Name']?>/<?php echo $row['Case_Name']?>/<?php echo $row['Pdf_Name']?>')">View</a>-->
<!--                           <td class="text-center" scope="row"style=""><a id="viewbtn" type="button"  class="nav_link"   data-toggle="modal" data-target="#exampleModals" value="<?php echo $row['Pdf_Path']?>"onclick="view('<?php echo $row['Pdf_Name']?>','ClientCaseData/<?php echo $row['Client_Name']?>/<?php echo $row['Case_Name']?>/<?php echo $row['Pdf_Name']?>','<?php echo $row['Client_Name']?>','<?php echo $row['Case_Name']?>','<?php echo $row['Sr_no']?>')">View</a>-->
                            <td class="text-center" scope="row"style=""><a class="nav_link" onclick="phpviewer('<?php echo $row['Sr_no']?>')">View</a><br>
                         <a  id="viewmodalbtn" type="button"  class="nav_link text-danger"   data-toggle="modal" data-target="#viewerpopup" value="<?php echo $row['Pdf_Path']?>"onclick="viewmodal('<?php echo $row['Pdf_Name']?>','ClientCaseData/<?php echo $row['Client_Name']?>/<?php echo $row['Case_Name']?>/<?php echo $row['Pdf_Name']?>','<?php echo $row['Client_Name']?>','<?php echo $row['Case_Name']?>','<?php echo $row['Sr_no']?>')">Pop up</a>
                         </td>
                         
                        </tr>
                        <?php
                        $sr++;
                    }
                }
                ?>
            </tbody>
        </table>


    </div>
        <div class="continer col-lg-6 col-md-6 col-sm-12 p-0">
            
           <div id="my_pdf_viewer" class="">
                    	<div id="navigation_controls" class="text-center cc">
                              <button class="btn btn-primary btn-sm" id="Firstpg">First page</button>
                              <button class="btn btn-primary btn-sm" id="Lastpg">Last page</button>
                            <button class="btn btn-primary btn-sm" id="go_previous">Previous</button>
                             <button class="btn btn-primary btn-sm" id="go_next">Next</button>
                            <input id="current_page" class="from-conrol-sm"value="1" type="number"/>
                           
                            <button class="btn btn-primary btn-sm" id="zoom_in">+</button>
                            <button class="btn btn-primary btn-sm" id="zoom_out">-</button>
                            <button class="btn btn-primary btn-sm" id="rotate_page">R</button>
                            <button class="btn btn-primary btn-sm" id="reload">Refresh</button>
                        </div> 
                    	<div id="canvas_container" class="mt-1 mb-1">
                            <canvas id="pdf_renderer"></canvas> 
                        </div>
    <div id="navigation_controls" class="text-center cc">
                             <button class="btn btn-primary btn-sm" id="Firstpg1">First page</button>
                              <button class="btn btn-primary btn-sm" id="Lastpg1">Last page</button>
                            <button class="btn btn-primary btn-sm" id="go_previous1">Previous</button>
                            <button class="btn btn-primary btn-sm" id="go_next1">Next</button>
                            <input id="current_page1" value="1" type="number"/>
                            
                            <button class="btn btn-primary btn-sm" id="zoom_in1">+</button>
                            <button class="btn btn-primary btn-sm" id="zoom_out1">-</button>
                            <button class="btn btn-primary btn-sm" id="rotate_page1">R</button>
                               <button class="btn btn-primary btn-sm" id="reload1">Refresh</button>
                        </div>
     
					</div>
            
        </div>
    </div>
</div>
    

<div class="modals">
   
    
    
    
           <!-- Modal -->
<div class="modal fade" id="viewerpopup" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Pdf - Viewer</h5>
        <button type="button" class="close" id="VR1"data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <div class="container-fluid p-0">
<!--               <div id="pdf_view"  class="pdfobject-container border">
    </div>
      <div class="col-lg-12 col-md-12 col-sm-12 text-center">
  <button id="prev" class="btn btn-primary btn-sm">Previous</button>
  <button id="next" class="btn btn-primary btn-sm">Next</button>
  &nbsp; &nbsp;
  <span>Page: <span id="page_num"></span> / <span id="page_count"></span></span>-->

<div id="my_pdf_viewer_m">
                    	<div id="navigation_controls_m" class="text-center ">
                             <button class="btn btn-primary btn-sm" id="firstpg">First page</button>
                              <button class="btn btn-primary btn-sm" id="lastpg">Last page</button>
                         <a id="extbtn" type="button"  class="btn btn-primary btn-sm"   data-toggle="modal" data-target="#extModal1" value="<?php echo $row['Pdf_Path']?>"onclick="ext('<?php echo $row['Pdf_Name']?>','ClientCaseData/<?php echo $row['Client_Name']?>/<?php echo $row['Case_Name']?>/<?php echo $row['Pdf_Name']?>','<?php echo $row['Client_Name']?>','<?php echo $row['Case_Name']?>','<?php echo $row['Sr_no']?>')">Extract</a>
                            <button class="btn btn-primary btn-sm" id="go_previous_m">Previous</button>
                            <input id="current_page_m" value="1" type="number"/>
                            <button class="btn btn-primary btn-sm" id="go_next_m">Next</button>
                            &nbsp; &nbsp;
                            <button class="btn btn-primary btn-sm" id="zoom_in_m">+</button>
                            <button class="btn btn-primary btn-sm" id="zoom_out_m">-</button>
                            <button class="btn btn-primary btn-sm" id="rotate_page_m">R</button>
                        </div> 
                    	<div id="canvas_container" class="mt-1 mb-1">
                            <canvas id="pdf_renderer_m"></canvas> 
                        </div>
    <div id="navigation_controls_m1" class="text-center">
         <button class="btn btn-primary btn-sm" id="firstpg1">First page</button>
                              <button class="btn btn-primary btn-sm" id="lastpg1">Last page</button>
                            <button class="btn btn-primary btn-sm" id="go_previous1_m">Previous</button>
                            <input id="current_page1_m" value="1" type="number"/>
                            <button class="btn btn-primary btn-sm" id="go_next1_m">Next</button>
                            
                            &nbsp; &nbsp;
                            <button class="btn btn-primary btn-sm" id="zoom_in1_m">+</button>
                            <button class="btn btn-primary btn-sm" id="zoom_out1_m">-</button>
                            <button class="btn btn-primary btn-sm" id="rotate_page1_m">R</button>
                        </div>
     
					</div>
</div>

<!--<canvas id="the-canvas" class="col-lg-12 col-md-12 col-sm-12 mt-2"></canvas>-->
          </div>
      
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" id="VR2" data-dismiss="modal">Close</button>
       
      </div>
    </div>
  </div>
</div>
           
           
           
           
               <!-- Modal -->
<div class="modal fade" id="extModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Extract Pages</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <div class="container-fluid">
              <label class="font-weight-bold">Please Type a Name </label>
              <input type="text" id="ExtName" class="form-control" placeholder="Type Here..." value="">
               <input type="hidden" id="ExtPath" class="form-control"  value="">
                <input type="hidden" id="PdfSR" class="form-control"  value="">
               <input type="hidden" id="Clientname" class="form-control"  value="">
               <input type="hidden" id="Casename" class="form-control"  value="">
               
               <div class="row">
                   <div class="col-lg-6 col-md-6 col-sm-12">
                       <label class="font-weight-bold">Starting Page </label>
                       <input type="number" id="Startpg" class="form-control" placeholder="eg :1">
                   </div>
                   <div class="col-lg-6 col-md-6 col-sm-12">
                       <label class="font-weight-bold">Ending Page </label>
                       <input type="number" id="Endpg" class="form-control" placeholder="eg :4">
                   </div>
               </div>
              
                <label class="font-weight-bold mt-2">Select Date</label>
        <input type="text" class="form-control" required id="date"name="Date"  value="<?php echo date('d/m/Y');?>"placeholder="Select Date">
            
        <div class="container mt-1">
                <div class="row">
                    
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                         <button id="ExtBtn" class="btn btn-primary mt-2">Extract only</button>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                         <button id="ExtNBtn" class="btn btn-primary mt-2">Extract & Delete Old</button>
                    </div>
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
    

               
                <!-- Modal -->
<div class="modal fade" id="extModal1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Extract Pages</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <div class="container-fluid">
              <label class="font-weight-bold">Please Type a Name </label>
              <input type="text" id="ExtName1" class="form-control" placeholder="Type Here..." value="">
               <input type="hidden" id="ExtPath1" class="form-control"  value="">
                <input type="hidden" id="PdfSR1" class="form-control"  value="">
               <input type="hidden" id="Clientname1" class="form-control"  value="">
               <input type="hidden" id="Casename1" class="form-control"  value="">
               
               <div class="row">
                   <div class="col-lg-6 col-md-6 col-sm-12">
                       <label class="font-weight-bold">Starting Page </label>
                       <input type="number" id="Startpg1" class="form-control" placeholder="eg : 1">
                   </div>
                   <div class="col-lg-6 col-md-6 col-sm-12">
                       <label class="font-weight-bold">Ending Page </label>
                       <input type="number" id="Endpg1" class="form-control" placeholder="eg :4">
                   </div>
               </div>
              
                <label class="font-weight-bold mt-2">Select Date</label>
        <input type="text" class="form-control" required id="date1"name="Date"  value="<?php echo date('d/m/Y');?>"placeholder="Select Date">
            
        <div class="container mt-1">
                <div class="row">
                    
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                         <button id="ExtBtn1" class="btn btn-primary mt-2">Extract only</button>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                         <button id="ExtNBtn1" class="btn btn-primary mt-2">Extract & Delete Old</button>
                    </div>
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
    

    
</div>

 <form method="POST" id="php" action="">
                                <input type="hidden" name="pid" id="path">

                            </form>
  
    
    
<script>
    
    
     function phpviewer(link){
                   console.log(link);
                   $('#path').val(link);
                   
                   document.getElementById("php").submit();
                   
               };
     document.getElementById("ExtNBtn").addEventListener("click",extractN);
        function extractN(){
            
            var pdfsr= document.getElementById('PdfSR').value;
              var path = document.getElementById('ExtPath').value;
            var name= document.getElementById('ExtName').value;
            var client= document.getElementById('Clientname').value;
            var cases= document.getElementById('Casename').value;
           var date= document.getElementById('date').value;
           var stpg= document.getElementById('Startpg').value;
           var enpg= document.getElementById('Endpg').value;
          //  alert(pdfsr);
            
            
            
$.ajax({ 
       type: "POST", 
       //url: "extractNpdf.php", 
        url: "remextNpdf.php", 
       data: {Path : path,Sr:pdfsr,Fname:name,Start:stpg,End:enpg,Client:client,Case:cases,Date:date},
       success: function(res) { 
         console.log(res);
         location.reload();
             // alert("Success"); 
              //PDFObject.embed("Splited/"+FName+".pdf","#pdf_view");   

             
        } 
        
});
        };
    
     document.getElementById("ExtBtn").addEventListener("click",extract);
        function extract(){
            var path = document.getElementById('ExtPath').value;
            var name= document.getElementById('ExtName').value;
            var client= document.getElementById('Clientname').value;
            var cases= document.getElementById('Casename').value;
           var date= document.getElementById('date').value;
           var stpg= document.getElementById('Startpg').value;
           var enpg= document.getElementById('Endpg').value;
           
//        console.log("Extracting Starting:::");
//            console.log(path);
//            console.log(name);
//            console.log(client);
//            console.log(cases);
//            console.log(date);
//            console.log(stpg);
//            console.log(enpg);
//            console.log("Extracting Ending:::");
//            
            
$.ajax({ 
       type: "POST", 
       url: "extractpdfs.php", 
       data: {Path : path,Fname:name,Start:stpg,End:enpg,Client:client,Case:cases,Date:date},
       success: function(res) { 
         console.log(res);
         location.reload();
             // alert("Success"); 
              //PDFObject.embed("Splited/"+FName+".pdf","#pdf_view");   

             
        } 
        
}); 

            
            
        };
        
        
           document.getElementById("ExtBtn1").addEventListener("click",extract1);
        function extract1(){
            var path = document.getElementById('ExtPath1').value;
            var name= document.getElementById('ExtName1').value;
            var client= document.getElementById('Clientname1').value;
            var cases= document.getElementById('Casename1').value;
           var date= document.getElementById('date1').value;
           var stpg= document.getElementById('Startpg1').value;
           var enpg= document.getElementById('Endpg1').value;

            
$.ajax({ 
       type: "POST", 
       url: "extractpdfs.php", 
      // url: "remextpdf.php", 
       data: {Path : path,Fname:name,Start:stpg,End:enpg,Client:client,Case:cases,Date:date},
       success: function(res) { 
         console.log(res);
         location.reload();
             // alert("Success"); 
              //PDFObject.embed("Splited/"+FName+".pdf","#pdf_view");   

             
        } 
        
}); 
   
        };
        
         document.getElementById("ExtNBtn1").addEventListener("click",extractN1);
        function extractN1(){
            
            var pdfsr= document.getElementById('PdfSR1').value;
              var path = document.getElementById('ExtPath1').value;
            var name= document.getElementById('ExtName1').value;
            var client= document.getElementById('Clientname1').value;
            var cases= document.getElementById('Casename1').value;
           var date= document.getElementById('date1').value;
           var stpg= document.getElementById('Startpg1').value;
           var enpg= document.getElementById('Endpg1').value;
            //alert(pdfsr);
            
            
            
$.ajax({ 
       type: "POST", 
       url: "remextNpdf.php", 
       data: {Path : path,Sr:pdfsr,Fname:name,Start:stpg,End:enpg,Client:client,Case:cases,Date:date},
       success: function(res) { 
         console.log(res);
         location.reload();
             // alert("Success"); 
              //PDFObject.embed("Splited/"+FName+".pdf","#pdf_view");   

             
        } 
        
});
        };
    
    
    
    
    // $("#date").datepicker().datepicker("setDate", new Date('dd/mm/yyyy'));
 $("#date").datepicker({ dateFormat: 'dd/mm/yy',});
   $("#date1").datepicker({ dateFormat: 'dd/mm/yy',}); 
     document.getElementById("reload").addEventListener("click",refresh);
        function refresh(){
            console.log("Refresh me");
            location.reload();
        }
    document.getElementById("reload1").addEventListener("click",refreshbtn);
        function refreshbtn(){
            console.log("Refresh me");
            location.reload();
        }
    
    
    
    
//    document.getElementById("renamebtn").addEventListener("click", RenamePdf);
//    function RenamePdf() {
//        
//         var Sr = document.getElementById('sr').value;
//         var Rename=document.getElementById('rename').value;
//        console.log(Sr);
//        console.log(Rename);
//        var rename=JSON.stringify(Rename);
//        var sr = JSON.stringify(Sr);
//        $.ajax({
//            type: "POST",
//            url: "UploadCase/Editpdf.php",
//            data: {Sr: sr, Rename:rename},
//            success: function (res) {
//                console.log(res);
//                location.reload();
//            }
//
//        });
//        
//    };
    
     $('#UserList').DataTable({
//        "pagingType":"full_numbers",
            "bFilter": true,
            "bInfo": true,
            "lengthMenu": [
                [10, 25, 50, -1],
                [10, 25, 50, "All"]
            ],
            "responsive": true,
            language: {
                //"search": "_INPUT_",
                searchPlaceholder: "Search Document"
            }
        });
        
       
    
   
   // var editbtn= document.getElementById("editbtn").value;
    
   function ext(name,path,clientN,caseN,sr){
//       console.log(name);
//       console.log(path);
//        console.log(clientN);
//       console.log(caseN);
       $("#ExtName").val(name);
       $("#PdfSR").val(sr);
       $('#ExtPath').val(path);
       $('#Casename').val(caseN);
       $('#Clientname').val(clientN);
      
   }
    
//var viewbtn = document.getElementById("viewbtn").value;
//const pdf_view = document.getElementById("pdf_view");
//
//
//$('#viewbtn').click(function() {
//$.ajax({
//url: "",
//context: document.body,
//success: function(s,x){
//$('html[manifest=saveappoffline.appcache]').attr('content', '');
//
//$(this).html(s);
//}
//});
//});

//function view(link){
    
    
    
// location.reload();
 cache: false;
   // viewbtn.textContent = link;
//console.log(link);
   // PDFObject.embed(link,"#pdf_view");    
     $("#current_page").val('1');
     $("#current_page1").val('1');

     //var link = 'http://apajuris.in/work/ClientCaseData/Aditya%20Pratap/Raju%20Jettappa%20Vs%20Sanket%20Jadhav/156(3)%20parwani.pdf';
    var myState = {
        pdf: null,
        currentPage: 1,
        zoom: 1
//        cache: false
    }
	//console.log(link);
    pdfjsLib.getDocument("<?php echo $path;?>").then((pdf) => {
       myState.pdf = pdf;
        pdfDoc = pdf;
	   render();
           //myState.showPreviousViewOnLoad = false;
           
 });
 


function render() {
	
    myState.pdf.getPage(myState.currentPage).then((page) => {
 
        var canvas = document.getElementById("pdf_renderer");
		var ctx = canvas.getContext('2d'); 
		var viewport = page.getViewport(myState.zoom);
		canvas.width = viewport.width;
		canvas.height = viewport.height;
//                canvas.scale =3.8;
//		canvas.showPreviousViewOnLoad = false;
		 
		page.render({
			canvasContext: ctx,
			viewport: viewport
		});
		
 		 
 
    });
}


  

		document.getElementById('go_previous')
        .addEventListener('click', (e) => {
            if(myState.pdf == null
               || myState.currentPage == 1) return;
            myState.currentPage -= 1;
            document.getElementById("current_page")
                    .value = myState.currentPage;
			document.getElementById("current_page1")
                    .value = myState.currentPage;
            render();
        });
		document.getElementById('go_previous1')
        .addEventListener('click', (e) => {
            if(myState.pdf == null
               || myState.currentPage == 1) return;
            myState.currentPage -= 1;
            document.getElementById("current_page")
                    .value = myState.currentPage;
			document.getElementById("current_page1")
                    .value = myState.currentPage;		
            render();
        });
		
		
		
		
		document.getElementById('go_next')
        .addEventListener('click', (e) => {
            if(myState.pdf == null
               || myState.currentPage > myState.pdf
                                               ._pdfInfo.numPages) 
               return;
         
            myState.currentPage += 1;
            document.getElementById("current_page")
                    .value = myState.currentPage;
			document.getElementById("current_page1")
                    .value = myState.currentPage;		
            render();
        });
		document.getElementById('go_next1')
        .addEventListener('click', (e) => {
            if(myState.pdf == null
               || myState.currentPage > myState.pdf
                                               ._pdfInfo.numPages) 
               return;
         
            myState.currentPage += 1;
            document.getElementById("current_page1")
                    .value = myState.currentPage;
			document.getElementById("current_page")
                    .value = myState.currentPage;
            render();
        });
		
		
		
		document.getElementById('current_page')
        .addEventListener('keypress', (e) => {
            if(myState.pdf == null) return;
         
            // Get key code
            var code = (e.keyCode ? e.keyCode : e.which);
         
            // If key code matches that of the Enter key
            if(code == 13) {
                var desiredPage = 
                        document.getElementById('current_page')
                                .valueAsNumber;
                                 
                if(desiredPage >= 1 
                   && desiredPage <= myState.pdf
                                            ._pdfInfo.numPages) {
                        myState.currentPage = desiredPage;
                        document.getElementById("current_page")
                                .value = desiredPage;
						document.getElementById("current_page1")
                                .value = desiredPage;
                        render();
                }
            }
        });
		
		document.getElementById('current_page1')
        .addEventListener('keypress', (e) => {
            if(myState.pdf == null) return;
         
            // Get key code
            var code = (e.keyCode ? e.keyCode : e.which);
         
            // If key code matches that of the Enter key
            if(code == 13) {
                var desiredPage = 
                        document.getElementById('current_page1')
                                .valueAsNumber;
                                 
                if(desiredPage >= 1 
                   && desiredPage <= myState.pdf
                                            ._pdfInfo.numPages) {
                        myState.currentPage = desiredPage;
                        document.getElementById("current_page")
                                .value = desiredPage;
						document.getElementById("current_page1")
                                .value = desiredPage;
                        render();
                }
            }
        });
		
		document.getElementById('zoom_in')
        .addEventListener('click', (e) => {
            if(myState.pdf == null) return;
			
			$("#pdf_renderer").css("width", "auto");
            myState.zoom += 0.1;
            render();
        });
		document.getElementById('zoom_in1')
        .addEventListener('click', (e) => {
            if(myState.pdf == null) return;
			
			$("#pdf_renderer").css("width", "auto");
            myState.zoom += 0.1;
            render();
        });
		
		
		
		document.getElementById('zoom_out')
        .addEventListener('click', (e) => {
            if(myState.pdf == null) return;
			$("#pdf_renderer").css("width", "auto");
            myState.zoom -= 0.1;
            render();
        });
		document.getElementById('zoom_out1')
        .addEventListener('click', (e) => {
            if(myState.pdf == null) return;
			$("#pdf_renderer").css("width", "auto");
            myState.zoom -= 0.1;
            render();
        });
		
		var deg = 90;
		document.getElementById('rotate_page')
        .addEventListener('click', (e) => {
             if(myState.pdf == null) return; 
			 $("#pdf_renderer").css("transform", "rotate("+deg+"deg)"); 
            render();
			deg = deg + 90; 
        });
		document.getElementById('rotate_page1')
        .addEventListener('click', (e) => {
             if(myState.pdf == null) return; 
			 $("#pdf_renderer").css("transform", "rotate("+deg+"deg)"); 
            render();
			deg = deg + 90; 
        });
		
		function pdfpage(pageno,id)
		{
			var desiredPage = pageno;
			if(desiredPage >= 1 
                   && desiredPage <= myState.pdf
                                            ._pdfInfo.numPages) {
                        myState.currentPage = desiredPage;
						document.getElementById("current_page")
                                .value = desiredPage;
								document.getElementById("current_page1")
                                .value = desiredPage;
                        render();
                }
				
				
				$('#sampleTable tr').removeClass("rowbg");
				$('#row'+id).addClass("rowbg");
			
		}
                
                
                document.getElementById("Firstpg").addEventListener("click", Firstpg0);
    function Firstpg0() { 
        //console.log("Hello i am First page");
        $("#current_page").val(1);
        $("#current_page1").val(1);
        
        myState.currentPage = 1;
          render();
    }
    
               document.getElementById("Lastpg").addEventListener("click", Lastpg0);
    function Lastpg0() { 
        //console.log("Hello i am First page");
       
       // document.getElementById('#current_page').textContent = pdfDoc.numPages;
        $("#current_page").val(pdfDoc.numPages);
        $("#current_page1").val(pdfDoc.numPages);
        
        
        myState.currentPage = pdfDoc.numPages;
        
          render();
    }
     document.getElementById("Firstpg1").addEventListener("click", Firstpgv);
    function Firstpgv() { 
        //console.log("Hello i am First page");
        $("#current_page").val(1);
        $("#current_page1").val(1);
        
        myState.currentPage = 1;
          render();
    }
    
               document.getElementById("Lastpg1").addEventListener("click", Lastpgv);
    function Lastpgv() { 
        //console.log("Hello i am First page");
       
       // document.getElementById('#current_page').textContent = pdfDoc.numPages;
        $("#current_page").val(pdfDoc.numPages);
        $("#current_page1").val(pdfDoc.numPages);
        
        
        myState.currentPage = pdfDoc.numPages;
        
          render();
    }


    
//}
   function viewmodal(name,link,clientN,caseN,sr){
       console.log("viewmodal");
       console.log(name);
       
       
         $("#ExtName1").val(name);
       $("#PdfSR1").val(sr);
       $('#ExtPath1').val(link);
       $('#Casename1').val(caseN);
       $('#Clientname1').val(clientN);
       
       
// location.reload();
 cache: false;
   // viewbtn.textContent = link;
console.log(link);
   // PDFObject.embed(link,"#pdf_view");    
     $("#current_page_m").val('1');
     $("#current_page1_m").val('1');

     //var link = 'http://apajuris.in/work/ClientCaseData/Aditya%20Pratap/Raju%20Jettappa%20Vs%20Sanket%20Jadhav/156(3)%20parwani.pdf';
    var myState = {
        pdf: null,
        currentPage: 1,
        zoom: 1
//        cache: false
    }
	console.log(link);
    pdfjsLib.getDocument(link).then((pdf) => {
       myState.pdf = pdf;
       pdfDoc = pdf;
	   render();
           //myState.showPreviousViewOnLoad = false;
           
 });
 


function render() {
	
    myState.pdf.getPage(myState.currentPage).then((page) => {
 
        var canvas = document.getElementById("pdf_renderer_m");
		var ctx = canvas.getContext('2d'); 
		var viewport = page.getViewport(myState.zoom);
		canvas.width = viewport.width;
		canvas.height = viewport.height;
//                canvas.scale =3.8;
//		canvas.showPreviousViewOnLoad = false;
		 
		page.render({
			canvasContext: ctx,
			viewport: viewport
		});
		
 		 
 
    });
}


  

		document.getElementById('go_previous_m')
        .addEventListener('click', (e) => {
            if(myState.pdf == null
               || myState.currentPage == 1) return;
            myState.currentPage -= 1;
            document.getElementById("current_page_m")
                    .value = myState.currentPage;
			document.getElementById("current_page1_m")
                    .value = myState.currentPage;
            render();
        });
		document.getElementById('go_previous1_m')
        .addEventListener('click', (e) => {
            if(myState.pdf == null
               || myState.currentPage == 1) return;
            myState.currentPage -= 1;
            document.getElementById("current_page_m")
                    .value = myState.currentPage;
			document.getElementById("current_page1_m")
                    .value = myState.currentPage;		
            render();
        });
		
		
		
		
		document.getElementById('go_next_m')
        .addEventListener('click', (e) => {
            if(myState.pdf == null
               || myState.currentPage > myState.pdf
                                               ._pdfInfo.numPages) 
               return;
         
            myState.currentPage += 1;
            document.getElementById("current_page_m")
                    .value = myState.currentPage;
			document.getElementById("current_page1_m")
                    .value = myState.currentPage;		
            render();
        });
		document.getElementById('go_next1_m')
        .addEventListener('click', (e) => {
            if(myState.pdf == null
               || myState.currentPage > myState.pdf
                                               ._pdfInfo.numPages) 
               return;
         
            myState.currentPage += 1;
            document.getElementById("current_page1_m")
                    .value = myState.currentPage;
			document.getElementById("current_page_m")
                    .value = myState.currentPage;
            render();
        });
		
		
		
		document.getElementById('current_page_m')
        .addEventListener('keypress', (e) => {
            if(myState.pdf == null) return;
         
            // Get key code
            var code = (e.keyCode ? e.keyCode : e.which);
         
            // If key code matches that of the Enter key
            if(code == 13) {
                var desiredPage = 
                        document.getElementById('current_page_m')
                                .valueAsNumber;
                                 
                if(desiredPage >= 1 
                   && desiredPage <= myState.pdf
                                            ._pdfInfo.numPages) {
                        myState.currentPage = desiredPage;
                        document.getElementById("current_page_m")
                                .value = desiredPage;
						document.getElementById("current_page1_m")
                                .value = desiredPage;
                        render();
                }
            }
        });
		
		document.getElementById('current_page1_m')
        .addEventListener('keypress', (e) => {
            if(myState.pdf == null) return;
         
            // Get key code
            var code = (e.keyCode ? e.keyCode : e.which);
         
            // If key code matches that of the Enter key
            if(code == 13) {
                var desiredPage = 
                        document.getElementById('current_page1_m')
                                .valueAsNumber;
                                 
                if(desiredPage >= 1 
                   && desiredPage <= myState.pdf
                                            ._pdfInfo.numPages) {
                        myState.currentPage = desiredPage;
                        document.getElementById("current_page_m")
                                .value = desiredPage;
						document.getElementById("current_page1_m")
                                .value = desiredPage;
                        render();
                }
            }
        });
		
		document.getElementById('zoom_in_m')
        .addEventListener('click', (e) => {
            if(myState.pdf == null) return;
			
			$("#pdf_renderer_m").css("width", "auto");
            myState.zoom += 0.1;
            render();
        });
		document.getElementById('zoom_in1_m')
        .addEventListener('click', (e) => {
            if(myState.pdf == null) return;
			
			$("#pdf_renderer_m").css("width", "auto");
            myState.zoom += 0.1;
            render();
        });
		
		
		
		document.getElementById('zoom_out_m')
        .addEventListener('click', (e) => {
            if(myState.pdf == null) return;
			$("#pdf_renderer_m").css("width", "auto");
            myState.zoom -= 0.1;
            render();
        });
		document.getElementById('zoom_out1_m')
        .addEventListener('click', (e) => {
            if(myState.pdf == null) return;
			$("#pdf_renderer_m").css("width", "auto");
            myState.zoom -= 0.1;
            render();
        });
		
		var deg = 90;
		document.getElementById('rotate_page_m')
        .addEventListener('click', (e) => {
             if(myState.pdf == null) return; 
			 $("#pdf_renderer_m").css("transform", "rotate("+deg+"deg)"); 
            render();
			deg = deg + 90; 
        });
		document.getElementById('rotate_page1_m')
        .addEventListener('click', (e) => {
             if(myState.pdf == null) return; 
			 $("#pdf_renderer_m").css("transform", "rotate("+deg+"deg)"); 
            render();
			deg = deg + 90; 
        });
		
		function pdfpage(pageno,id)
		{
			var desiredPage = pageno;
			if(desiredPage >= 1 
                   && desiredPage <= myState.pdf
                                            ._pdfInfo.numPages) {
                        myState.currentPage = desiredPage;
						document.getElementById("current_page_m")
                                .value = desiredPage;
								document.getElementById("current_page1_m")
                                .value = desiredPage;
                        render();
                }
				
				
//				$('#sampleTable tr').removeClass("rowbg");
//				$('#row'+id).addClass("rowbg");
			
		}
                
                      document.getElementById("firstpg").addEventListener("click", Firstpg);
    function Firstpg() { 
        //console.log("Hello i am First page");
        $("#current_page_m").val(1);
        $("#current_page1_m").val(1);
        
        myState.currentPage = 1;
          render();
    }
    
               document.getElementById("lastpg").addEventListener("click", Lastpg);
    function Lastpg() { 
        //console.log("Hello i am First page");
       
       // document.getElementById('#current_page').textContent = pdfDoc.numPages;
        $("#current_page_m").val(pdfDoc.numPages);
        $("#current_page1_m").val(pdfDoc.numPages);
        
        
        myState.currentPage = pdfDoc.numPages;
        
          render();
    }
    
          document.getElementById("firstpg1").addEventListener("click", Firstpg1);
    function Firstpg1() { 
        //console.log("Hello i am First page");
        $("#current_page_m").val(1);
        $("#current_page1_m").val(1);
        
        myState.currentPage = 1;
          render();
    }
    
               document.getElementById("lastpg1").addEventListener("click", Lastpg1);
    function Lastpg1() { 
        //console.log("Hello i am First page");
       
       // document.getElementById('#current_page').textContent = pdfDoc.numPages;
        $("#current_page_m").val(pdfDoc.numPages);
        $("#current_page1_m").val(pdfDoc.numPages);
        
        
        myState.currentPage = pdfDoc.numPages;
        
          render();
    }

    
}


 document.getElementById("VR1").addEventListener("click",refresh);
        function refresh(){
            console.log("Refresh me");
            location.reload();
        }
    document.getElementById("VR2").addEventListener("click",refreshbtn);
        function refreshbtn(){
            console.log("Refresh me");
            location.reload();
        }
   
   
   
   
  //End of pdfjs  
    
     $("#ClientN").on("change",function(){
     var category = $("#ClientN").val();
     
     console.log(category);
     
     var cid= JSON.stringify(category);
      $.ajax({
        url :"UploadCase/CaseNameDy.php",
        type:"POST",
        cache:false,
        data:{countryId:cid},
        success:function(data){
            console.log(data);
            $("#CaseName").html(data);
          
        }
      });
 });
 
   $("#CaseName").on("change",function(){
     var category = $("#CaseName").val();
     
     console.log(category);
     
     var cid= JSON.stringify(category);
      $.ajax({
        url :"UploadCase/ViewTableDy.php",
        type:"POST",
        cache:false,
        data:{countryId:cid},
        success:function(data){
            console.log(data);
           $("#dytable").html(data);
          
        }
      });
 });
    
     $('select').select2();
    </script>
    
    
    
    
    
    
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>

    
  </body>
</html>