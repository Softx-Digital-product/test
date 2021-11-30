<?php
include 'Database/Dp.php';
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
    
    <script type="text/javascript" src="js/vpb_uploaderS.js"></script>
           
<!--           <script type="text/javascript" src="js/vpb_uploaderM.js"></script>-->
    
        
    <title>Client Brief</title>
    <style>
        .rowbg{ border:2px solid red;}
        
            #canvas_container {
        width: 99.9%;
        height: 750px;
        overflow: auto;
    }
	#pdf_renderer{ width:99.9%; cursor:pointer;}
  

         div.dataTables_filter, div.dataTables_length {
/*            margin-top:2px;*/
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
        #pdf_view { height:850px;};
        
          .tooltip { pointer-events: none; }
            .tooltip{
                color:white;
                /*          background-color:blue;*/
            }
            .tooltip-inner {
                background-color:  #00ace6;
            }
    </style>
  </head>
  <body>
      
   <?php include'Navbars.php';?>

<div class="container-fluid p-0 ">

<div class="continer-fulid vc ">
                
                <div class="row">
                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12">
<!--                        <button class="btn text-white"data-toggle="modal" data-target="#AddBriefModal">Add Client Brief</button>
                         <button class="btn text-white" data-toggle="modal" data-target="#UploadBriefModal">Upload files to Client Brief</button> -->
<a class="btn  ml-3 text-white btn-sm mt-1 mb-1"data-toggle="modal" data-target="#AddBriefModal">Add Client Brief</a>
<a class="btn  ml-2 text-white btn-sm mt-1 mb-1" href="uploadtobrief.php">Upload file to client Brief</a>

                    </div>
                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12">
                         <div class="form-group mt-1 mb-1">
                                <!--                                <label class="font-weight-bolder" for="exampleFormControlSelect1">Select Client Name</label>-->

                                <select class="CN" id="ClientNs" style="width:100%;" placeholder="Please Select Client Name"onchange="document.getElementById('text_CTs').value = this.options[this.selectedIndex].text">
<!--                                    <option value=""disabled selected>Please Choose Client Name</option>-->
                                    <option value=""disabled selected><?php echo $clientName ?></option>
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
//                                    
                                    ?>
                                </select>
                                <input type="hidden" name="ClientName" id="text_CTs" value="<?php echo $row['Full_Name']; ?>" />
                            </div>
                      
                        
                        
                    </div>
                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12">
                        
                        
                            <div class="form-group mt-1 mb-1">
                                <!--                            <label class="font-weight-bolder" for="exampleFormControlSelect1">Select Case Name</label>-->
                                <select class="CN"  style="width:100%;" id="CaseNames" placeholder="Please Select Client Name"onchange="document.getElementById('text_CNs').value = this.options[this.selectedIndex].text">
<!--                                    <option value=""disabled selected>Please Choose Case Name</option>-->
                                    <option value=""disabled selected><?php echo $caseName?></option>
                                    <?php
                                    $sql = mysqli_query($con, "SELECT * FROM Client_CaseDb");
                                    while ($row = $sql->fetch_assoc()) {
                                        echo "<option value=" . $row['Sr_no'] . ">" . $row['Case_Name'] . "</option>";
                                    }
                                    ?>
                                </select>
                                <input type="hidden" name="CaseN" id="text_CNs" value="<?php echo $row['Case_Name']; ?>" />
                            </div>
                    

                        
                        
                    </div>
                   
                    
                
                
            </div>
            
            
            
            
        </div>

<div class="container-fluid p-0 ">
    
    <div class="tables  table-responsive ">

         <table class="table table-striped table-bordered  table-hover " id='UserList'>
            <thead class="vbg text-white">
                <tr>
                    <th class="text-center"scope="col">SRN</th>
                    <th class="text-center"scope="col">DOC</th>
                    <th class="text-center" scope="col">Client Name</th>
                    <th class="text-center" scope="col">Case Name</th>
                    <th class="text-center" scope="col">PDF Name</th>
                    <th class="text-center" scope="col">Size</th>
                    <th class="text-center" scope="col">PGS</th>
<!--                    <th class="text-center" scope="col">Upload Date</th>-->
                    <th class="text-center" scope="col">View</th>
                     <th class="text-center" scope="col">EDT</th>
                    <th class="text-center" scope="col">DEL</th>
                    

                </tr>
            </thead>
            <tbody id="dytable">
               
                    <?php
                    $sr = 1;
                    $sql="SELECT UploadClientBrief.Sr_no, ClientDb.Full_Name as Client_Name, Client_CaseDb.Case_Name as Case_Name, UploadClientBrief.Pdf_Name,UploadClientBrief.Pdf_Size,UploadClientBrief.Pdf_Pages,UploadClientBrief.DOU FROM UploadClientBrief,Client_CaseDb,ClientDb WHERE UploadClientBrief.CaseId = Client_CaseDb.Sr_no AND Client_CaseDb.Cid= ClientDb.Sr_no;";
                    $quariy = $con->query($sql);
                    $num = mysqli_num_rows($quariy);
                    if ($num >= 0) {
                        while ($row = mysqli_fetch_array($quariy)) {
                            ?>
                 <tr id="row<?php echo $sr;?>">
                            <th class="text-center" scope="row" style=""><?php echo $sr ?></th>
                               <td class="text-center text-nowrap" scope="row"style="" data-toggle="tooltip" title="<?php echo $row['DOU']?>"><?php echo substr($row['DOU'],0,30);?></td>
                            <td class=" text-nowrap" scope="row"style="width:10%"data-toggle="tooltip" title="<?php echo $row['Client_Name']?>"><?php echo substr($row['Client_Name'],0,40);?></td>
                            <td class=" text-nowrap" scope="row"style="width:10%"data-toggle="tooltip" title="<?php echo $row['Case_Name']?>"><?php echo substr($row['Case_Name'],0,40); ?></td>
                            <td class=" text-nowrap" scope="row"style="width:10%;"data-toggle="tooltip" title="<?php echo $row['Pdf_Name']?>"><?php echo substr($row['Pdf_Name'],0,40);?></td>
                            <td class="text-center text-nowrap" scope="row"style=""data-toggle="tooltip" title="<?php echo $row['Pdf_Size']?>"><?php echo substr($row['Pdf_Size'],0,30); ?></td>
                            <td class="text-center text-nowrap" scope="row"style=""data-toggle="tooltip" title="<?php echo $row['Pdf_Pages']?>"><?php echo substr($row['Pdf_Pages'],0,30); ?></td>
<!--                            <td class="text-center text-nowrap" scope="row"style=""data-toggle="tooltip-top" title="<?php echo $row['DOU']?>"><?php echo $row['DOU'] ?></td>-->
<!--                            <td class="text-center" scope="row"style=""><a  id="viewbtn" type="button"  class="nav_link"   data-toggle="modal" data-target="#exampleModal" value="<?php echo $row['Pdf_Path']?>"onclick="view('<?php echo $row['Pdf_Path']?>')">View</a></td>-->
                                <td class="text-center" scope="row"style=""><a  id="viewbtn" type="button"  class="nav_link"   data-toggle="modal" data-target="#exampleModal" value="<?php echo $row['Pdf_Path']?>"onclick="view('ClientCaseData/<?php echo $row['Client_Name']?>/<?php echo $row['Case_Name']?>/ClientBrief/<?php echo $row['Pdf_Name']?>','<?php echo $sr;?>')">View</a></td>
                           <td class="text-center" scope="row"style=""><a  id="editbtn" type="button"  class="nav_link"   data-toggle="modal" data-target="#EditModal" value="<?php echo $row['Sr_no']?>"onclick="edit('<?php echo $row['Sr_no']?>','<?php echo $row['Pdf_Name']?>','<?php echo $row['DOE']?>')">Edit</a></td>
                            
<!--                            <td class="text-center" scope="row"style=""><a class="nav_link" href="CaseDb//EditCase.php/?v=<?php echo $row['Sr_no'] ?>">Edit </a></td>-->
                           <td class="text-center" scope="row"style=""><a  class="text-danger"href="UploadClientBrief/DelpdfBrief.php/?n=<?php echo $row['Sr_no']?>">Delete </a></td>
                        </tr>
                        <?php
                        $sr++;
                    }
                }
                ?>
            </tbody>
         </table>

    </div>
</div>
    
    
    
<div class="modals">
    
    <!-- Modal -->
<div class="modal fade" id="EditModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <div class="contianer-fluid">
              <input type="text" id="rename" class="form-control" placeholder="Rename pdf Name">
              <input type="hidden" id="sr" class="form-control">
              <button class="btn text-white mt-2" id="renamebtn">Rename Pdf Name</button>
          </div>
          
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      
      </div>
    </div>
  </div>
</div>
    
    
    
    
         <!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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

<div id="my_pdf_viewer">
                    	<div id="navigation_controls" class="text-center">
                            <button class="btn btn-primary btn-sm" id="firstpg">First page</button>
                              <button class="btn btn-primary btn-sm" id="lastpg">Last page</button>
                            <button class="btn btn-primary btn-sm" id="go_previous">Previous</button>
                            <button class="btn btn-primary btn-sm" id="go_next">Next</button>
                            <input id="current_page" class="text-center from-conrol-sm" style=" width:10%;" value="1" type="number"/>
                            
                          
                            <button class="btn btn-primary btn-sm" id="zoom_in">+</button>
                            <button class="btn btn-primary btn-sm" id="zoom_out">-</button>
                            <button class="btn btn-primary btn-sm" id="rotate_page">R</button>
                        </div> 
      <div class="loaderinfo  mb-1  mt-5 border-left">  </div>
                    	<div id="canvas_container" class="mt-1 mb-1">
                            <canvas id="pdf_renderer"></canvas> 
                        </div>
    <div id="navigation_controls" class="text-center">
                         <button class="btn btn-primary btn-sm" id="firstpg1">First page</button>
                              <button class="btn btn-primary btn-sm" id="lastpg1">Last page</button>
                            <button class="btn btn-primary btn-sm" id="go_previous1">Previous</button>
                             <button class="btn btn-primary btn-sm" id="go_next1">Next</button>
                            <input id="current_page1" class="text-center from-conrol-sm" style=" width:10%;" value="1" type="number"/>
                           
                            <button class="btn btn-primary btn-sm" id="zoom_in1">+</button>
                            <button class="btn btn-primary btn-sm" id="zoom_out1">-</button>
                            <button class="btn btn-primary btn-sm" id="rotate_page1">R</button>
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
<div class="modal fade" id="exampleModals" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Pdf - Viewer</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <div class="container-fluid p-0">
               <div id="pdf_view"  class="pdfobject-container border">
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
<div class="modal fade" id="AddBriefModal" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Client Brief</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
    
          <div class="container-fluid p-0">
              
<center>

<h2 style="color:blue; text-align:center;">PDF UPLOAD</h2>
<hr class="bg-dark mt-1 md-1">
<div class="container-fluid p-0 ">
     <form name="form_id" id="form_id" action="javascript:void(0);" enctype="multipart/form-data" style="width:800px; margin-top:20px;">
       <div class="row">
            
    <div class="col-lg-4 col-md-4 col-sm-12">
     <div class="form-group">
                                <label class="font-weight-bolder" for="exampleFormControlSelect1">Select Client Name</label>
                              
                                <select class="form-control"  id="ClientN" style="width:100%;" placeholder="Please Select Client Name"onchange="document.getElementById('text_CT').value = this.options[this.selectedIndex].text">
                                    <option value=""disabled selected>Please Choose Client Name</option>
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
                                <input type="hidden" name="ClientName" id="text_CT" value="<?php echo $row['Full_Name']; ?>" />
                            </div>
    </div>
 <div class="col-lg-3 col-md-3 col-sm-12">
     
         <div class="form-group">
                                <label class="font-weight-bolder" for="exampleFormControlSelect1">Select Case Name</label>
                            
                                <select class="form-control mt-1" style="width:100%;" id="CaseName" placeholder="Please Select Client Name"onchange="document.getElementById('text_CN').value = this.options[this.selectedIndex].text">
                                    <option value=""disabled selected>Please Choose Case Name</option>
                                    <?php
                                    $sql = mysqli_query($con, "SELECT * FROM Client_CaseDb");
                                    while ($row = $sql->fetch_assoc()) {
                                        echo "<option value=" . $row['Sr_no'] . ">" . $row['Case_Name'] . "</option>";
                                    }
                                    ?>
                                </select>
                                <input type="hidden" name="CaseN" id="text_CN" value="<?php echo $row['Case_Name']; ?>" />
                            </div>
    </div>
     
            <div class="col-lg-5 col-md-5 col-sm-12">
                
                    <label class="font-weight-bolder"> Choose Document</label><br>
                    <div style="display:flex">
                        <input type="file" class="form-control-sm" name="vasplus_multiple_files" id="vasplus_multiple_files" multiple="multiple" style=""/>
<!--                        <input type="submit" class="btn btn-primary ml-5 " value="Upload" style="margin-left:20px"/>-->
                        <button type="submit" class="btn btn-primary ">upload</button>

</div>
               
    </div>
               
    </div>
     </form>
</div>
<hr class="bg-dark mt-2 md-2">
<!--<form name="form_id" id="form_id" action="javascript:void(0);" enctype="multipart/form-data" style="width:800px; margin-top:20px;"> 
  
	<input type="file" name="vasplus_multiple_files" id="vasplus_multiple_files" multiple="multiple" style="padding:5px;"/>      
	<input type="submit" value="Upload" style="padding:5px;"/>
</form>-->

<table class="table table-striped table-bordered" style="width:60%;" id="add_files">
	<thead>
		<tr>
			<th style="color:blue; text-align:center;">File Name</th>
			<th style="color:blue; text-align:center;">Status</th>
			<th style="color:blue; text-align:center;">File Size</th>
			<th style="color:blue; text-align:center;">Action</th>
		<tr>
	</thead>
	<tbody>
	
	</tbody>
</table>

</center>

          </div>
          
      </div>
      <div class="modal-footer ">
          
                    <strong id="note" class="mr-5 text-danger">Note :- Please Wait Until This Page Auto Reload</strong>
       
         
     <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
<!--        <button type="button" class="btn btn-primary">Save changes</button>-->
      </div>
    </div>
  </div>
</div>
    
     <!-- Modal -->
<div class="modal fade" id="UploadBriefModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Upload Files to Client Brief</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          
           <div class="container-fluid p-0">
              
<center>

<h2 style="color:blue; text-align:center;">Upload Pdf </h2>
<hr class="bg-dark mt-1 md-1">
<div class="container-fluid p-0 ">
     <form name="form_idu" id="form_idu" action="javascript:void(0);" enctype="multipart/form-data" style="width:800px; margin-top:20px;">
       <div class="row">
            
    <div class="col-lg-4 col-md-4 col-sm-12">
     <div class="form-group">
                                <label class="font-weight-bolder" for="exampleFormControlSelect1">Select Client Name</label>
                              
                                <select class="form-control"  id="ClientNu" style="width:100%;" placeholder="Please Select Client Name"onchange="document.getElementById('text_CTu').value = this.options[this.selectedIndex].text">
                                    <option value=""disabled selected>Please Choose Client Name</option>
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
                                <input type="hidden" name="ClientNameu" id="text_CTu" value="<?php echo $row['Full_Name']; ?>" />
                            </div>
    </div>
 <div class="col-lg-4 col-md-4 col-sm-12">
     
         <div class="form-group">
                                <label class="font-weight-bolder" for="exampleFormControlSelect1">Select Case Name</label>
                            
                                <select class="form-control mt-1" style="width:100%;" id="CaseNameu" placeholder="Please Select Client Name"onchange="document.getElementById('text_CNu').value = this.options[this.selectedIndex].text">
                                    <option value=""disabled selected>Please Choose Case Name</option>
                                    <?php
                                    $sql = mysqli_query($con, "SELECT * FROM Client_CaseDb");
                                    while ($row = $sql->fetch_assoc()) {
                                        echo "<option value=" . $row['Sr_no'] . ">" . $row['Case_Name'] . "</option>";
                                    }
                                    ?>
                                </select>
                                <input type="hidden" name="CaseN" id="text_CNu" value="<?php echo $row['Case_Name']; ?>" />
                            </div>
    </div>
<!--            <div class="col-lg-6 col-md-6 col-sm-12">
     <div class="form-group">
                                <label class="font-weight-bolder" for="exampleFormControlSelect1">Select Pdf Document</label>
                              
                                <select class="form-control"  id="pdfu" style="width:100%;" placeholder="Please Select Client Name"onchange="document.getElementById('text_pdfu').value = this.options[this.selectedIndex].text">
                                    <option value=""disabled selected>Please Choose Pdf Document</option>
                                    <?php
                                    $sql = mysqli_query($con, "SELECT * FROM UploadClientBrief");
                                    while ($row = $sql->fetch_assoc()) {
                                        echo "<option value=" . $row['Sr_no'] . ">" . $row['Pdf_Name'] . "</option>";
                                    }
//                                    
//                                    $sql = mysqli_query($con, "SELECT * FROM Client_CaseDb");
//                                    while ($row = $sql->fetch_assoc()) {
//                                        echo "<option value=" . $row['Sr_no'] . ">" . $row['Client_Name'] . "</option>";
//                                    }
//                                    ?>
                                </select>
                                <input type="hidden" name="ClientNameu" id="text_pdfu" value="<?php echo $row['Full_Name']; ?>" />
                            </div>
    </div>-->

     
            <div class="col-lg-4 col-md-4 col-sm-12">
                
                    <label class="font-weight-bolder"> Choose Document</label><br>
                    <div style="display:flex">
                        <input type="file" class="form-control-sm" name="vasplus_multiple_files" id="vasplus_multiple_files" multiple="multiple" style=""/>
<!--                        <input type="submit" class="btn btn-primary ml-5 " value="Upload" style="margin-left:20px"/>-->
                        <button type="submit" class="btn btn-primary ">upload</button>

</div>
               
    </div>
               
    </div>
     </form>
</div>
<hr class="bg-dark mt-2 md-2">
<!--<form name="form_id" id="form_id" action="javascript:void(0);" enctype="multipart/form-data" style="width:800px; margin-top:20px;"> 
  
	<input type="file" name="vasplus_multiple_files" id="vasplus_multiple_files" multiple="multiple" style="padding:5px;"/>      
	<input type="submit" value="Upload" style="padding:5px;"/>
</form>-->

<table class="table table-striped table-bordered" style="width:60%;" id="btable">
	<thead>
		<tr>
			<th style="color:blue; text-align:center;">File Name</th>
			<th style="color:blue; text-align:center;">File Size</th>
			<th style="color:blue; text-align:center;">File Pages</th>
		<tr>
	</thead>
	<tbody id="tabledy">
	
	</tbody>
</table>
<table class="table table-striped table-bordered" style="width:60%;" id="add_filesu">
	<thead>
		<tr>
			<th style="color:blue; text-align:center;">File Name</th>
			<th style="color:blue; text-align:center;">Status</th>
			<th style="color:blue; text-align:center;">File Size</th>
			<th style="color:blue; text-align:center;">Action</th>
		<tr>
	</thead>
	<tbody>
	
	</tbody>
</table>

</center>

          </div>
    
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
    
</div>
        
        
        
        


  
    
    
<script>
     $("#UCBNav").addClass("active");
    function edit(sr,file,doc){
       console.log(file);
       console.log(sr);
       console.log(doc);
      // $("#date").val(doc);
       $("#rename").val(file);
       $('#sr').val(sr);
      
      
   }
    document.getElementById("renamebtn").addEventListener("click", rempdf);
function rempdf(){
      var fname=document.getElementById('rename').value;
      var sr=document.getElementById('sr').value;
      console.log(fname);
      var Fname= JSON.stringify(fname);
       var Sr= JSON.stringify(sr);
      $.ajax({ 
     type: "POST", 
      url: "UploadClientBrief/Editpdfname.php", 
       data: {id:Sr,Rname:Fname},
      success: function(res) { 
        console.log(res);
      location.reload();
 } 
       
});  
};
    
     $("#ClientN").on("change", function () {
                    var category = $("#ClientN").val();

                    console.log(category);

                    var cid = JSON.stringify(category);
                    $.ajax({
                        url: "UploadCase/CaseNameDy.php",
                        type: "POST",
                        cache: false,
                        data: {countryId: cid},
                        success: function (data) {
                            console.log(data);
                            $("#CaseName").html(data);

                        }
                    });
                });
                $("#ClientNu").on("change", function () {
                    var category = $("#ClientNu").val();

                    console.log(category);

                    var cid = JSON.stringify(category);
                    $.ajax({
                        url: "UploadCase/CaseNameDy.php",
                        type: "POST",
                        cache: false,
                        data: {countryId: cid},
                        success: function (data) {
                            console.log(data);
                            $("#CaseNameu").html(data);

                        }
                    });
                });
                
//document.getElementById("btable").style.display="none";
$("#btable").hide();
                       $("#CaseNameu").on("change", function () {
                    var category = $("#CaseNameu").val();

                    console.log(category);

                    var cid = JSON.stringify(category);
                    $.ajax({
                        url: "UploadClientBrief/TableDy.php",
                        type: "POST",
                        cache: false,
                        data: {countryId: cid},
                        success: function (data) {
                            $("#btable").show();
                            console.log(data);
                            $("#tabledy").html(data);

                        }
                    });
                });

 $("#ClientsN").on("change", function () {
                    var category = $("#ClientsN").val();

                    console.log(category);

                    var cid = JSON.stringify(category);
                    $.ajax({
                        url: "UploadCase/CaseNameDy.php",
                        type: "POST",
                        cache: false,
                        data: {countryId: cid},
                        success: function (data) {
                            console.log(data);
                            $("#CasesName").html(data);

                        }
                    });
                });
            

  $("#ClientNs").on("change", function () {
                    var category = $("#ClientNs").val();

                    console.log(category);

                    var cid = JSON.stringify(category);
                    $.ajax({
                     //   url: "UploadCase/CaseNameDy.php",
                     url:"Calendar/function.php",
                        type: "POST",
                        cache: false,
                        data: {clientdids: cid},
                        success: function (data) {
                            console.log(data);
                            $("#CaseNames").html(data);

                        }
                    });
                });

                $("#CaseNames").on("change", function () {
                    var category = $("#CaseNames").val();

                    console.log(category);

                    var cid = JSON.stringify(category);
                    $.ajax({
                        url: "UploadClientBrief/ViewTableDy.php",
                        type: "POST",
                        cache: false,
                        data: {countryId: cid},
                        success: function (data) {
                            
                            console.log(data);
                            $("#dytable").html(data);

                        }
                    });
                });
                
                

    
    
    
   
     $('select').select2();
     
//          $('#UserLists').DataTable({
////        "pagingType":"full_numbers",
//            "bFilter": true,
//            "bInfo": true,
//            "lengthMenu": [
//                [10, 25, 50, -1],
//                [10, 25, 50, "All"]
//            ],
//            responsive: true,
//            language: {
//                //"search": "_INPUT_",
//                searchPlaceholder: "Search Document"
//            }
//        });
        
    </script>
    <script>
//        $("#note").hide();
      $(document).ready(function()
       
        

{
      
	// Call the main function
	new vpb_multiple_file_uploader
	({
           
            
		vpb_form_id: "form_id", // Form ID
		autoSubmit: true,
		vpb_server_url: "UploadClientBrief/upload.php" 
              
	});
        
        // Call the main function
//	new vpb_multiple_file_uploaderM
//	({
//           
//		vpb_form_id: "form_idu", // Form ID
//		autoSubmit: true,
//		vpb_server_url: "UploadClientBrief/uploads.php" 
//	});
      
});
</script>

<script>
   
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
//    
//    document.getElementById("refresh").addEventListener("click",Refresh);
//        function Refresh(){
//            console.log("Refresh me");
//            location.reload();
//        }
//    document.getElementById("refreshbtn").addEventListener("click",Refreshbtn);
//        function Refreshbtn(){
//            console.log("Refresh me");
//            location.reload();
//        }
//        
//        
//        
//        
//        
function view(link,id){
   // viewbtn.textContent = link;
console.log(link);
console.log(id);
$('#UserList tr').removeClass("rowbg");

$('#row'+id).addClass("rowbg"); 

   // PDFObject.embed(link,"#pdf_view");    
    $('.loaderinfo').html("<div class='container text-center loader mt-5'><img src='images/loader.gif' class='text-center mt-5'/></div>");
     
     //var link = 'http://apajuris.in/work/ClientCaseData/Aditya%20Pratap/Raju%20Jettappa%20Vs%20Sanket%20Jadhav/156(3)%20parwani.pdf';
    var myState = {
        pdf: null,
        currentPage: 1,
        zoom: 1,
      scale: 2.8
    }
	console.log(link);
    pdfjsLib.getDocument(link).then((pdf) => {
       myState.pdf = pdf;
       pdfDoc = pdf;
	   render();
 });
 


function render() {
	
    myState.pdf.getPage(myState.currentPage).then((page) => {
 
        var canvas = document.getElementById("pdf_renderer");
		var ctx = canvas.getContext('2d'); 
		var viewport = page.getViewport(myState.zoom);
		canvas.width = viewport.width;
		canvas.height = viewport.height;
//                canvas.scale =3.8;
		
		 
//		page.render({
//			canvasContext: ctx,
//			viewport: viewport
//		});
		
 	var renderContext = {
      canvasContext: ctx,
      viewport: viewport,
    };

var renderTask = page.render(renderContext);
    renderTask.promise.then(function (e) {  
        console.log(e);
      console.log('Page rendered');
        $('.loaderinfo').addClass('d-none'); 
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
               || myState.currentPage >= myState.pdf
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
               || myState.currentPage >= myState.pdf
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
		$('#row'+id).addClass("rowbg");
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
                
             document.getElementById("firstpg").addEventListener("click", Firstpg);
    function Firstpg() { 
        //console.log("Hello i am First page");
        $("#current_page").val(1);
        $("#current_page1").val(1);
        
        myState.currentPage = 1;
          render();
    }
    
               document.getElementById("lastpg").addEventListener("click", Lastpg);
    function Lastpg() { 
        //console.log("Hello i am First page");
       
       // document.getElementById('#current_page').textContent = pdfDoc.numPages;
        $("#current_page").val(pdfDoc.numPages);
        $("#current_page1").val(pdfDoc.numPages);
        
        
        myState.currentPage = pdfDoc.numPages;
        
          render();
    }
    
          document.getElementById("firstpg1").addEventListener("click", Firstpg1);
    function Firstpg1() { 
        //console.log("Hello i am First page");
        $("#current_page").val(1);
        $("#current_page1").val(1);
        
        myState.currentPage = 1;
          render();
    }
    
               document.getElementById("lastpg1").addEventListener("click", Lastpg1);
    function Lastpg1() { 
        //console.log("Hello i am First page");
       
       // document.getElementById('#current_page').textContent = pdfDoc.numPages;
        $("#current_page").val(pdfDoc.numPages);
        $("#current_page1").val(pdfDoc.numPages);
        
        
        myState.currentPage = pdfDoc.numPages;
        
          render();
    }
}
      $(document).ready(function () {
  $('#UserList').DataTable({
//        "pagingType":"full_numbers",
            "bFilter": true,
            "bInfo": true,
            "lengthMenu": [
                [15, 25, 50, -1],
                [15, 25, 50, "All"]
            ],
            "responsive": true,
            language: {
                //"search": "_INPUT_",
                searchPlaceholder: "Search Documents"
            }
        });
         
                    
                });
    
   $(function () {
                        $('[data-toggle="tooltip"]').tooltip()
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
    
     <script>
        function updateActivity(){
            var activeon = 'Client Brief';
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