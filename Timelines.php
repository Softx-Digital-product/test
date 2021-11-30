
<?php
include 'Timeline/Dp.php';

if(isset($_POST['pid'])){
    
  // $path=$_POST['pid'];
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
   //echo $path;
   
   $path="ClientCaseData/$clientName/$caseName/$pdfName";
   
}


if(isset($_POST['CTsubmit'])){
    $ctdate=$_POST['CTDate'];
    $ctstpg=$_POST['CTstpg'];
    $ctendpg=$_POST['CTendpg'];
    $ctdocType=$_POST['CTDT'];
    $ctcid=$_POST['Cidpdf'];
    $ctpdf=$_POST['CTpdf'];
    $cttitle=$_POST['CTtitle'];
    $cteditor=($_POST['CTeditor']);
    
    
//    echo $ctcid;
//    echo $cteditor;
    
    
       $check=mysqli_num_rows(mysqli_query($con,"SELECT * from Timeline_data Where Title='$cttitle'"));
if($check>0){
   $msgs="<br> This DATA is already present";
  //echo $msgs;
   
// }
}
else{

  $sql ="INSERT into Timeline_data (Cid,T_date,St_pg,Ed_pg,Doc_type,Pdf_Name,Title,Content) 
  VALUE('$ctcid','$ctdate','$ctstpg','$ctendpg','$ctdocType','$ctpdf','$cttitle','$cteditor')";
    // echo $sql;
if ($con->query($sql) === TRUE) {
  $msgs="Add Sucessfully";
     header("Refresh:0");
     
}
else {
  $msgs =  "Error: ----->" . $sql . "<br>" . $con->error;
  echo "Error: ----->" . $sql . "<br>" . $con->error;
}

$con->close();
}  

    
    
    
}
if(isset($_POST['submit'])){
    
    $TDate =$_POST['TDate'];
    $stpg =$_POST['TSTpg'];
    $etpg =$_POST['TETpg'];
     $DocType =$_POST['TDy'];
    $title =$_POST['Ttitle'];
       
      $cid = $_POST['Tcid'];
        $Tpdf =$_POST['TPdf'];
        $TClientN= $_POST['TclientN'];
       $TCaseN= $_POST['TcaseN'];
       $Tcontent = $_POST['Teditor'];
       
//       echo $title."<br>";
//       echo $stpg."<br>";
//       echo $etpg."<br>";
//       
//       echo $Tpdf;
       
      $check=mysqli_num_rows(mysqli_query($con,"SELECT * from Timeline_data Where Title='$title'"));
if($check>0){
   $msgs="<br> This DATA is already present";
  //echo $msgs;
   
// }
}
else{

  $sql ="INSERT into Timeline_data (Cid,T_date,St_pg,Ed_pg,Doc_type,Pdf_Name,Client_Name,Case_Name,Title,Content) 
  VALUE('$cid','$TDate','$stpg','$etpg','$DocType','$Tpdf','$TClientN','$TCaseN','$title','$Tcontent')";
    // echo $sql;
if ($con->query($sql) === TRUE) {
  $msgs="Add Sucessfully";
     header("Refresh:0");
}
else {
  $msgs =  "Error: ----->" . $sql . "<br>" . $con->error;
  echo "Error: ----->" . $sql . "<br>" . $con->error;
}

$con->close();
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


        <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css'>
        <link rel='stylesheet' href='https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css'>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link rel="stylesheet" href="assets12/css/sam.css">
        <link rel="stylesheet" href="Timeline/timeline.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha512-SfTiTlX6kk+qitfevl/7LibUOeJWlt9rbyDn92a1DqWOw9vWG2MFoays0sgObmWazO5BQPiFucnnEAjpAB+/Sw==" crossorigin="anonymous" />

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/themes/ui-lightness/jquery-ui.min.css" integrity="sha512-NaCOGQe8bs7/BxJpnhZ4t4f4psMHnqsCxH/o4d3GFqBS4/0Yr/8+vZ08q675lx7pNz7lvJ6fRPfoCNHKx6d/fA==" crossorigin="anonymous" />
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

        <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
        <script src='https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js'></script>
  <script src="ckeditor/ckeditor.js"></script>
  
       <script src="https://mozilla.github.io/pdf.js/build/pdf.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.0.943/pdf.min.js"></script>

  
  
        <title>TimeLine</title>


        <style>
            
           #timelinebars{
/*                background: teal;*/
           background:#66b2b2;	
                color:white;
            }
            .timelinelink{
                color:white;
            }
            .timelinelink:hover
            {
                color:white;
                text-decoration: underline;
               
                    
            }   
             #link_active{
/*               background:#66b2b2;*/
 background:#40e0d0;
               border-radius: 0 !important;
                
            }
            .cc{
                background:#66b2b2;
                height:40px;
            }
            .CN{
                padding: 0px;
            }
            .vbg{
                background: #008080;
                padding:5px;
            }
            .btn{
                background: #66b2b2;
                border:none;
            }
             .btn:hover{
                background: #66b2b2;
                border:none;
                    outline: none;
                text-decoration: underline;
            }
            .btn:focus{
                background: #66b2b2;
                border:none;
                    outline: none;
                text-decoration: underline;
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
}
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

       
            .tooltip{
                color:white;
                /*          background-color:blue;*/
            }
            .tooltip-inner {
                background-color:  #00ace6;
            }
                   div.dataTables_filter, div.dataTables_length {

 margin-bottom:-15px !important;
 padding-left:30px !important;
/*  padding-left:30px;*/
 background:#006161;
 color:white;
 padding:6px;
   text-transform: uppercase;
   overflow:hidden;

              }  
              div.dataTables_wrapper div.dataTables_filter input {
width:300px;
   
    overflow: hidden !important;
   
}
.table-striped > tbody > tr:nth-child(2n+1) > td, .table-striped > tbody > tr:nth-child(2n+1) > th {
   background-color: #98D7C2 ;
}

.table-hover tbody tr:hover td, .table-hover tbody tr:hover th {
  background-color:  #c9ffe5;
  text-decoration: underline;
      
}
        </style>
    </head>
    <body>

 <?php include 'timelineheaader.php';?>


        <div class="container-fluid mt-0 p-0 pt-0" style="">


            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12 p-0">

                    <!--            <button class="btn btn-primary btn-md" id="VD">View Documents</button>
                                 <button class="btn btn-primary btn-md" id="VD">View Documents</button>
                                  <button class="btn btn-primary btn-md" id="VD">View Documents</button>
                                   <button class="btn btn-primary btn-md" id="VD">View Documents</button>-->

                    <ul class="nav nav-pills" id="timelinebars">
                        <li class="nav-item"id="timelineitem">
                            <a id="link_active" class="nav-link active timelinelink" data-toggle="pill" href="#VD" >View Documents</a>
                        </li>
                        <li class="nav-item"id="timelineitem">
                            <a  class="nav-link timelinelink" href="CreateTimeline.php" >Create TimeLine</a>
                        </li>

                        <li class="nav-item" id="timelineitem">
                            <a class="nav-link timelinelink" href="viewtimeline.php" >View TimeLine</a>
                        </li>
                        <!--                    <li class="nav_item">
                                               <a href="" class="nav-link" data-toggle="tab" href="#VD" >View Documents</a>
                                           </li>-->


                    </ul>
<!--                    <hr class="bg-secondary">-->
                    <div class="tab-content text-center" >

                        <div class="tab-pane fade show active " id="VD">

                            <div class="tables col-lg-12 col-md-12 col-sm-12 table-responsive" >

<!--                                <table class="table table-striped table-bordered table-responsive  table-hover " id='UserList'>-->
                                 <table class="table table-striped table-bordered  table-hover " id='UserList'>
                                    <thead class="vbg text-light">
                                        <tr>
                                            <th class="text-center" data-toggle="tooltip" data-placement="top" title="SR_NO" scope="col">SRN</th>
                                            <th class="d-none"scope="col">ClientN</th>
                                             <th class="d-none"scope="col">caseN</th>
                                            <th class="text-center"data-toggle="tooltip" data-placement="top" title="Date of Creation"  scope="col">DOC</th>
                                            <th class="text-center" data-toggle="tooltip" data-placement="top" title="Pdf File Name"  scope="col">PDF File Name</th>
                                            <th class="text-center"data-toggle="tooltip" data-placement="top" title="Total Pages"  scope="col">PGS</th>
                        <!--                    <th class="text-center" scope="col">LPG</th>-->
                                            <th class="text-center" data-toggle="tooltip" data-placement="top" title="Create TimeLine"  scope="col">TLE</th>
                                            <th class="text-center"data-toggle="tooltip" data-placement="top" title="View"  scope="col">View</th>


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
                                                    <td class="d-none"><?php echo $row['Client_Name'];?></td>
                                                    <td class="d-none"><?php echo $row['Case_Name'];?></td>
                                                    <td class="text-center text-nowrap" scope="row"style=""><?php echo $row['DOE'] ?></td>
                                                    <td class="text-center text-nowrap" scope="row"style="" data-toggle="tooltip-tip" title="<?php echo $row['Pdf_Name']?>"><?php echo substr($row['Pdf_Name'],0,35);?></td>
                                                    <td class="text-center text-nowrap" scope="row"style=""><?php echo $row['Pdf_Pages'] ?></td>
                                                    <td class="text-center text-nowrap" scope="row"style=""><a id="Createbtn"  href="#LTN"type="button"  class="nav_link"   data-toggle="modal" data-target="#TimelineModal" value="<?php echo $row['Pdf_Path'] ?>"onclick="timelines('<?php echo $row['Pdf_Name'] ?>', 'ClientCaseData/<?php echo $row['Client_Name'] ?>/<?php echo $row['Case_Name'] ?>/<?php echo $row['Pdf_Name'] ?>', '<?php echo $row['Client_Name'] ?>', '<?php echo $row['Case_Name'] ?>', '<?php echo $row['Sr_no'] ?>')">Create</a></td>
                                 <!--<td class="text-center" scope="row"style=""><?php echo $row['DOU'] ?></td>-->
                                 <!--                            <td class="text-center" scope="row"style=""><a  id="Createbtn" type="button"  class="nav_link"   data-toggle="modal" data-target="#exampleModals" onclick="timelines('<?php echo $row['Pdf_Path'] ?>')">create</a></td>-->
<!--                                                    <td class="text-center" scope="row"style=""><a  id="viewbtn" type="button"  class="nav_link"   data-toggle="modal" data-target="#exampleModals" value="<?php echo $row['Pdf_Path'] ?>"onclick="view('ClientCaseData/<?php echo $row['Client_Name'] ?>/<?php echo $row['Case_Name'] ?>/<?php echo $row['Pdf_Name'] ?>')">View</a>-->
                                                       <td class="text-center" scope="row"style=""><a  id="viewbtn" type="button"  class="nav_link"   data-toggle="modal" data-target="#exampleModals" value="<?php echo $row['Pdf_Path'] ?>"onclick="phpviewer('<?php echo $row['Sr_no']?>')">View</a>
                           <!--                           <td class="text-center" scope="row"style=""><a id="viewbtn" type="button"  class="nav_link"   data-toggle="modal" data-target="#exampleModals" value="<?php echo $row['Pdf_Path'] ?>"onclick="view('<?php echo $row['Pdf_Name'] ?>','ClientCaseData/<?php echo $row['Client_Name'] ?>/<?php echo $row['Case_Name'] ?>/<?php echo $row['Pdf_Name'] ?>','<?php echo $row['Client_Name'] ?>','<?php echo $row['Case_Name'] ?>','<?php echo $row['Sr_no'] ?>')">View</a>-->
                                                           <br>
                                                        <a  id="viewmodalbtn" type="button"  class="nav_link text-danger text-nowrap"   data-toggle="modal" data-target="#viewerpopup" value="<?php echo $row['Pdf_Path'] ?>"onclick="viewmodal('ClientCaseData/<?php echo $row['Client_Name'] ?>/<?php echo $row['Case_Name'] ?>/<?php echo $row['Pdf_Name'] ?>')">Pop up</a>
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

                            <form method="POST" id="php" action="">
                                <input type="hidden" name="pid" id="path">
                            
                            </form>
                                
                            

                        </div>
                        <div class="tab-pane fade" id="TLN">
                           
                                                       
                        </div>
                        <div class="tab-pane fade" id="VT">
                            
                           
      
                            </div><!--VT-->
                   
                        </div>

                    


                </div> <!--container left End-->
                
                
                <div class="col-lg-6 col-md-6 col-sm-12 p-0">
                     <div id="my_pdf_viewer" class="p-0">
                    	<div id="navigation_controls" class="text-center cc">
                             <button class="btn btn-primary btn-sm" id="Firstpg">First page</button>
                              <button class="btn btn-primary btn-sm" id="Lastpg">Last page</button>
                            <button class="btn btn-primary btn-sm" id="go_previous">Previous</button>
                            <button class="btn btn-primary btn-sm" id="go_next">Next</button>
                             <input id="current_page"  style="width:10%;" class="form-control-sm text-center mt-1 mb-1" value="1" type="number"/>
                            <button class="btn btn-primary btn-sm" id="zoom_in">+</button>
                            <button class="btn btn-primary btn-sm" id="zoom_out">-</button>
                            <button class="btn btn-primary btn-sm" id="rotate_page">R</button>
                            <button class="btn btn-primary btn-sm" id="reload">Refresh</button>
                        </div> 
<!--                           <hr class="bg-secondary">-->
                          
                    	<div id="canvas_container" class="">
                           
                            <canvas id="pdf_renderer"></canvas> 
                        </div>
                           
<!--                              <hr class="bg-secondary">-->
    <div id="navigation_controls" class="text-center cc">
         <button class="btn btn-primary btn-sm" id="Firstpg1">First page</button>
                              <button class="btn btn-primary btn-sm" id="Lastpg1">Last page</button>
                            <button class="btn btn-primary btn-sm" id="go_previous1">Previous</button>
                         <button class="btn btn-primary btn-sm"id="go_next1">Next</button>
                               <input id="current_page1"  style="width:10%;" class="form-control-sm text-center mt-1 mb-1" value="1" type="number"/>
                            
                            &nbsp;
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
            
            
            <!--Timeline Edit Modal -->
            
<div class="modal fade" id="EditTimeline" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel"><strong>Edit TimeLine</strong></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <div class="container-fluid">
              <form method="POST" action="" >
              <div class="row">  
                  <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2">
                                            <div class="form-group">
                                                <label class="font-weight-bold">Choose Date</label>
                                                <input class="form-control" placeholder="Date" name="UDate" id="UDate"value="<?php echo Date('d/m/Y') ?>">
                                            </div>
                                        </div>

                                        <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2">
                                            <div class="form-group">
                                                <label class="font-weight-bold">Start page</label>
                                                <input class="form-control" type="number" name="USTpg" placeholder="eg. 1" value="<?php echo Date('d/m/Y') ?>">
                                            </div>
                                        </div>
                                        <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2">
                                            <div class="form-group">
                                                <label class="font-weight-bold">End page</label>
                                                <input class="form-control" type="number" name="TETpg"placeholder="eg. 4" value="<?php echo Date('d/m/Y') ?>">
                                            </div>
                                        </div>
                                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-2">
                                            <div class="form-group">
                                                <label class="font-weight-bold">Document Type</label>
                                                <a class="ml-1" data-toggle="modal" data-target="#AddDocTy">
                                                    (ADD Type)
                                                </a><a class="ml-2" data-toggle="modal" data-target="#EditDocTy">
                                                    (Edit Type)
                                                </a><a class="ml-2" data-toggle="modal" data-target="#DelDocTy">
                                                    (Delete Type)
                                                </a>
                                                <select class="form-control" style="width:100%;" id="Tdy" placeholder="Choose Document Type.." onchange="document.getElementById('text_DTs').value=this.options[this.selectedIndex].text">
                                                    <option value="" disabled selected>Choose Document Type</option>

                                                    <?php
                                                   $sql = mysqli_query($con, "SELECT * FROM Document_type");
                                                    while ($row = $sql->fetch_assoc()) {
                                                        echo "<option value=" . $row['Sr_no'] . ">" . $row['Document_name'] . "</option>";
                                                    }
                                                    ?>
                                                    </select>
                                                   <input type="text" name="TDys" id="text_DTs" value="" />
                                            </div>
                                        </div>
                  
                  
                  
              </div>
              </form>
          </div>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        
      </div>
    </div>
  </div>
</div>

            
            
            
            

            <!-- Modal -->
            <div class="modal fade" id="TimelineModal"  aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class=" modal-dialog modal-dialog-centered modal-xl">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Create TimeLine
                          
<!--                            <a  id="viewmodalbtn" class="btn btn-secondary btn-sm"   data-toggle="modal" data-target="#viewerpopup" value="<?php echo $row['Pdf_Path'] ?>"onclick="viewmodal('ClientCaseData/<?php echo $row['Client_Name'] ?>/<?php echo $row['Case_Name'] ?>/<?php echo $row['Pdf_Name'] ?>')">View Pdf</a>-->
                            <button id="viewpdfmodal" class=" ml-3 btn btn-primary btn-sm" data-toggle="modal" data-target="#viewerpopup" value="Hey">view Pdf</button> 
                            <strong class="text-center ml-3">Pdf Name :</strong> <label id="pdfnamelabel"></label> 
                            </h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">

                            <div class="continer-fluid">
                                <form method="POST" action="" >

                                    <div class="row">
                                        <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2">
                                            <div class="form-group">
                                                <label class="font-weight-bold">Choose Date</label>
                                                <input class="form-control" placeholder="Date" name="TDate" id="Date"value="<?php echo Date('d/m/Y') ?>">
                                            </div>
                                        </div>

                                        <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2">
                                            <div class="form-group">
                                                <label class="font-weight-bold">Start page</label>
                                                <input class="form-control" type="number" name="TSTpg" placeholder="eg. 1" value="<?php echo Date('d/m/Y') ?>">
                                            </div>
                                        </div>
                                        <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2">
                                            <div class="form-group">
                                                <label class="font-weight-bold">End page</label>
                                                <input class="form-control" type="number" name="TETpg"placeholder="eg. 4" value="<?php echo Date('d/m/Y') ?>">
                                            </div>
                                        </div>
                                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-2">
                                            <div class="form-group">
                                                <label class="font-weight-bold">Document Type</label>
                                                <a class="ml-1" data-toggle="modal" data-target="#AddDocTy">
                                                    (ADD Type)
                                                </a><a class="ml-2" data-toggle="modal" data-target="#EditDocTy">
                                                    (Edit Type)
                                                </a><a class="ml-2" data-toggle="modal" data-target="#DelDocTy">
                                                    (Delete Type)
                                                </a>
                                                <select class="form-control" style="width:100%;" id="Tdy" placeholder="Choose Document Type.." onchange="document.getElementById('text_DT').value=this.options[this.selectedIndex].text">
                                                    <option value="" disabled selected>Choose Document Type</option>

                                                    <?php
                                                   $sql = mysqli_query($con, "SELECT * FROM Document_type");
                                                    while ($row = $sql->fetch_assoc()) {
                                                        echo "<option value=" . $row['Sr_no'] . ">" . $row['Document_name'] . "</option>";
                                                    }
                                                    ?>
                                                    </select>
                                                   <input type="hidden" name="TDy" id="text_DT" value="" />
                                            </div>
                                        </div>
                                        
                                    </div>
                                      <div class="form-group">
                                                <label class="font-weight-bold">Enter Title</label>
                                                <input class="form-control" id="Ttitle"name="Ttitle" placeholder="Title">
                                            </div>
                                    
                                     <div class="form-group">
                                                <label class="font-weight-bold">Enter Content</label>
                                                <textarea class="form-control"id="editor" required name="Teditor"  aria-label="With textarea"></textarea>
               
                                            </div>
                                    <div class="form-group">
                                        <button type="submit" name="submit" class="btn btn-primary"> Submit</button>
                                    </div>
                                    
                                    
                                    <input type="hidden" name="TPdf" id="pdfname">
                                    <input type="hidden" name="Tcid" id="sr">
                                     <input type="hidden" name="TclientN" id="TclientN">
                                      <input type="hidden" name="TcaseN" id="TcaseN">
                                    
                                    
                                    
                                </form>


                            </div>



                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <!--        <button type="button" class="btn btn-primary">Save changes</button>-->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
                
                
                <!-- Add Modal -->
<div class="modal fade" id="AddDocTy"  tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"> Add Type</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          
          <div class="container-fluid">
              
               <div class="form-group">
                <label class="font-weight-bold">Enter Type</label>
               <input class="form-control" name="Type" id="Docty" placeholder="Enter DocumentType">
               
               <button id="addty" class="btn btn-primary mt-2"> Add Doc Type</button>
               
                </div>  
              
           
          </div>
            
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
       
      </div>
    </div>
  </div>
</div>
                
                              <!-- Edit Modal -->
<div class="modal fade" id="EditDocTy" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"> Edit Type</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          
          <label class="font-weight-bold">Select Document Type</label><br>
          <select  class="form-control" style="width:100%;" id="editty" placeholder="Choose Docuement Type..">
   <option value="" disabled selected>Choose Document Type</option>
  
<?php 

$sql = mysqli_query($con, "SELECT * FROM Document_type");
while ($row = $sql->fetch_assoc()){
echo "<option value=".$row['Sr_no'].">".$row['Document_name']."</option>";
}
?>
</select>
             <input class="form-control mt-3" type="text"  id="Renamety" placeholder=" Edit Document ">
             
              <button type="button" id="EditTy" class="btn btn-primary mt-2" >Edit Document</button>
          
 
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
       
      </div>
    </div>
  </div>
</div>
                                              <!--Delete Modal -->
<div class="modal fade" id="DelDocTy" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Delete Type</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          
          <label class="font-weight-bold">Select Document Type</label><br>
              <select  class="form-control" style="width:100%;" id="DeleteTy" placeholder="Choose Document Type..">
   <option value="" disabled selected>Choose Document Category</option>
  
<?php 

$sql = mysqli_query($con, "SELECT * FROM Document_type");
while ($row = $sql->fetch_assoc()){
echo "<option value=".$row['Sr_no'].">".$row['Document_name']."</option>";
}
?>
</select>
              <button type="button" id="DelTy" class="btn btn-primary mt-2" >Delete Type</button>
        
 
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
       
      </div>
    </div>
  </div>
</div>

                                              
                                              
                                              
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


<div id="my_pdf_viewer_m">
                    	<div id="navigation_controls_m" class="text-center">
                             <button class="btn btn-primary btn-sm" id="firstpg">First page</button>
                             <button class="btn btn-primary btn-sm" id="lastpg">Last page</button>
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
           
           
    

                                              
                                              
                                              
                                              
                                              
                                              
                                              
            </div>




            <script>
                
               function phpviewer(link){
                   console.log(link);
                   $('#path').val(link);
                   
                   document.getElementById("php").submit();
                   
               };
                
                
                
                
                //document.getElementById('reload').contentWindow.location.reload();
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
    
                function timelines(name, path, clientN, caseN, sr) {
                    console.log(path);
                    console.log(sr);
                    console.log(name);
                    console.log(clientN);
                    console.log(caseN);
                    
                     document.getElementById('pdfnamelabel').innerHTML = name;
                    
                    $("#pdfname").val(name);
                    $("#sr").val(sr);
                     $("#TclientN").val(clientN);
                      $("#TcaseN").val(caseN);
                    
                    $("#viewpdfmodal").val(path);
                    
                    
                    
                    
                    
                  //  $('#Ttitle').val(path);
                    // $(#VT).tab('show');


                }
                ;
                
                
document.getElementById("addty").addEventListener("click", AddDocTy);
function AddDocTy(){
  var Cname= document.getElementById("Docty").value;
console.log(Cname);
var cname= JSON.stringify(Cname);

$.ajax({ 
     type: "POST", 
      url: "Timeline/AddDocTy.php", 
       data: {name:cname},
      success: function(res) { 
        console.log(res);
        location.reload();
  } 
        
});

};

 document.getElementById("EditTy").addEventListener("click", editSC);
function editSC(){
      var Cid=document.getElementById('editty').value;
      var Rename=document.getElementById('Renamety').value;
      console.log(Cid);
      console.log(Rename);
      var cid= JSON.stringify(Cid);
      var renames=JSON.stringify(Rename);
      $.ajax({ 
     type: "POST", 
      url: "Timeline/EditDocTy.php", 
       data: {id:cid,rename:renames},
      success: function(res) { 
        console.log(res);
      location.reload();
 } 
       
});
};

 document.getElementById("DelTy").addEventListener("click", DelT);
function DelT(){
      var Cid=document.getElementById('DeleteTy').value;
      console.log(Cid);
      var cid= JSON.stringify(Cid);
      $.ajax({ 
     type: "POST", 
      url: "Timeline/DelDocTy.php", 
       data: {id:cid},
      success: function(res) { 
        console.log(res);
      location.reload();
 } 
       
});  
};




            </script>



            <script>
                
                
                
                
                
                 $("#Date").datepicker({ dateFormat: 'dd/mm/yy',});
                     $("#CTDate").datepicker({ dateFormat: 'dd/mm/yy',});
                //document.getElementById("Createbtn").addEventListener("click",ext);

                //    $('#Createbtn a').on('click', function (event) {
                //  event.preventDefault()
                //  $(#VC).tab('show')
                //})




                $('select').select2();


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

                $("#CaseName").on("change", function () {
                    var category = $("#CaseName").val();

                    console.log(category);

                    var cid = JSON.stringify(category);
                    $.ajax({
                        url: "Timeline/ViewTableDy.php",
                        type: "POST",
                        cache: false,
                        data: {countryId: cid},
                        success: function (data) {
                            console.log(data);
                            $("#dytable").html(data);

                        }
                    });
                });



$('#Timelist').DataTable({
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

                //     $('#someTab').tab('show')

                $(document).ready(function () {

                    $(function () {
                        $('[data-toggle="tooltip"]').tooltip()
                    });
                });
                
              
            </script>
            
            
            <script>
                
                
               
function Etpg(id,pageno)
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
          
          
         
         var link= "<?php echo $path;?>";
         
         if(link === null){
            console.log("no data founded"); 
         }
         else{
             
         
    //function view(link){

// location.reload();
 cache: false;
   
   // viewbtn.textContent = link;
//console.log(link);
   // PDFObject.embed(link,"#pdf_view"); 
   
   
     $("#current_page").val('1');
     $("#current_page1").val('1');
	
         var myState = {
        pdf: null,
        currentPage: 1,
        zoom: 1
//        cache: false
    }
     
    pdfjsLib.getDocument("<?php echo $path;?>").then((pdf) => {
       myState.pdf = pdf;
        pdfDoc = pdf;
	   render();
           //myState.showPreviousViewOnLoad = false;
           
 });
 
//
//pdfDoc.disableWorker = true;
//myState.disableWorker = true;
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


    
                 function jump(pg) { 
        //console.log("Hello i am First page");
       
       // document.getElementById('#current_page').textContent = pdfDoc.numPages;
        $("#current_page").val(pg);
        $("#current_page1").val(pg);
        
        
        myState.currentPage = pg;
        
          render();
    }

    

         }

   function viewmodal(link){
//       console.log("viewmodal");
       console.log(link);
       
//       
//         $("#ExtName1").val(name);
//       $("#PdfSR1").val(sr);
//       $('#ExtPath1').val(link);
//       $('#Casename1').val(caseN);
//       $('#Clientname1').val(clientN);
       
       
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
		
		function pdfpageM(pageno,id)
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
				
				
				$('#sampleTable tr').removeClass("rowbg");
				$('#row'+id).addClass("rowbg");
			
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

document.getElementById("viewpdfmodal").addEventListener("click", viewpdf);
function viewpdf(){
    
    var link=document.getElementById('viewpdfmodal').value;
    viewmodal(link);
    
    
    
}

 $("#pdfct").on("change", function () {
     var Cid = $("#pdfct").val();
     
     console.log(Cid);
      var cid= JSON.stringify(Cid);
      $.ajax({ 
     type: "POST", 
      url: "Timeline/ViewerDy.php", 
       data: {id:cid},
      success: function(res) { 
        console.log(res);
   view(res);
 }
 });
 
 
        });
        
        function Timelview(Cid){
            console.log(Cid);
             var cid= JSON.stringify(Cid);
      $.ajax({ 
     type: "POST", 
      url: "Timeline/ViewerDy.php", 
       data: {id:cid},
      success: function(res) { 
        console.log(res);
   view(res);
      }
  });
            
        }
        
        function Stpg(Cid,stpg){
            console.log(Cid);
            console.log(stpg);
            var cid= JSON.stringify(Cid);
      $.ajax({ 
     type: "POST", 
      url: "Timeline/ViewerDy.php", 
       data: {id:cid},
      success: function(res) { 
        console.log(res);
   view(res);
      }
  });
   
    $("#current_page").val(stpg);
        $("#current_page1").val(stpg);
        
        
//        stpg = 2;
        console.log(stpg);
        myState.currentPage = stpg;
        
          render();
            
            
        }
        
        
                function Etpgs(Cid,etpg){
            console.log(Cid);
            console.log(etpg);
            var cid= JSON.stringify(Cid);
      $.ajax({ 
     type: "POST", 
      url: "Timeline/ViewerDy.php", 
       data: {id:cid},
      success: function(res) { 
        console.log(res);
   view(res);
      }
  });
    // $("#current_page").val(etpg);
  // jump(etpg);
    $("#current_page").val(etpg);
        $("#current_page1").val(etpg);
        
        
        myState.currentPage = etpg;
        
          render();
              $("#current_page").val(etpg);
        $("#current_page1").val(etpg);
            
            
        }
                </script>
                
                <script>
                     
document.getElementById("CTsubmit").addEventListener("click", submitCT);
function submitCT(){
    
    var Date = $("#CTDate").val();
     var Stpg = $("#CTstpg").val();
     var Endpg = $("#CTendpg").val();
      var Doctype = $("#text_CTDT").val(); 
      var Pdf = $("#text_CTPDF").val();
     var Cid = $("#pdfct").val();
       var Title = $("#CTtitle").val();
        var Editor = $("#CTeditor").val();
     
     
         console.log(Date);
         console.log(Stpg);
         console.log(Endpg);
         console.log(Doctype);
         console.log(Pdf);
         console.log(Cid);
         console.log(Title);
         console.log(Editor);
    
}                               
                                                    
                                                    
                 </script>


            <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>



    </body>
</html>