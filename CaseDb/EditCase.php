<?php
include 'Dp.php';

$id = $_GET['v'];
//$id= 5;
 $SR; $CN; $CS; $CoN; $CT; $CST; $CC; $CSC; $CaN; $CNO; $CY; $CD; $CP;$CId; $FN;
 
 echo $FN;
 
$query = "SELECT * FROM Client_CaseDb WHERE Sr_no = {$id}";
	$result = $con->query($query);
        
    if ($result->num_rows > 0) {
		while ($row = $result->fetch_assoc()) {
                    $SR=$row['Sr_no'];
                    $CId=$row['Cid'];
                    $CN=$row['Client_Name'];
                    $CS=$row['Case_Status'];
                    $CoN=$row['Court_Name'];
                    $CT=$row['Case_Type'];
                    $CST=$row['Case_SubType'];
                    $CC=$row['Case_Categ'];
                    $CSC=$row['Case_SubCateg'];
                    $CaN=$row['Case_Name'];
                     $FN=$row['Case_Name'];
                    $CNO=$row['Case_Number'];
                    $CY=$row['Case_Year'];
                    $CD=$row['Case_Desc'];
                    $CP=$row['Case_Path'];
                }
    }else{
        echo "No Record Founded !!!";
    }
    
    $Fn=$FN;
    
    
    
    if(isset($_POST['submit'])){
        
          //$clientName =$_POST['ClientName'];
           $clientName = mysqli_real_escape_string($con, $_POST['ClientName']);
    //$casestatus = $_POST['Case_Status'];
   $casestatus = mysqli_real_escape_string($con, $_POST['Case_Status']);
   // $courtName= $_POST['CourtName'];
   $courtName=  mysqli_real_escape_string($con, $_POST['CourtName']);
   // $caseName=$_POST['CaseName'];
    $caseName= mysqli_real_escape_string($con, $_POST['CaseName']);
//    $caseno= $_POST['CaseNo'];
//    $casetype=$_POST['CaseType'];
//    $casesubtype=$_POST['CaseSType'];
//    $casecat= $_POST['CaseCateg'];
//    $casesub=$_POST['Case_SCateg'];
   $caseyear= $_POST['CaseYear'];
   $caseno= mysqli_real_escape_string($con, $_POST['CaseNo']);
    $casetype = mysqli_real_escape_string($con, $_POST['CaseType']);
    $casesubtype =mysqli_real_escape_string($con, $_POST['CaseSType']);
    $casecat= mysqli_real_escape_string($con, $_POST['CaseCateg']);
    $casesub= mysqli_real_escape_string($con, $_POST['Case_SCateg']);
    
      $caseDesc= mysqli_real_escape_string($con, $_POST['CaseDesc']);
//    $caseDesc= $_POST['CaseDesc'];
      $clientId= $_POST['ClientId'];
  //  echo $caseDesc;
    $path="ClientCaseData/$clientName/$caseName";
    
    echo $Fn."<br>";
    
$check=mysqli_num_rows(mysqli_query($con,"SELECT * FROM UploadDocs WHERE Case_Name='$Fn'"));
echo $check;
if($check>0){
   
   $sql = "UPDATE UploadDocs SET Client_Name='$clientName',Case_Name='$caseName' WHERE Case_Name='$Fn'";
//  echo "<br><br>".$sql."<br><br>";
if ($con->query($sql) === TRUE) {
  echo "Updated!!! in uploadDocs" ;
}else{
    echo "Can't Update in uploadDocs "; 
}
     
        
    }else{
        echo "No Data Founded in UploadDocs <br>  ";
    }
    
    $uploadarea="UPDATE  UploadClientBrief SET Case_Name = '$caseName' WHERE Case_Name='$Fn'";
    if ($con->query($uploadareal) === TRUE) {
 
}else{

}
    
    $sql = "UPDATE Client_CaseDb SET Cid='$clientId',Client_Name='$clientName',Case_Status='$casestatus',Court_Name='$courtName',Case_Type='$casetype',Case_SubType='$casesubtype',Case_Categ='$casecat',Case_SubCateg='$casesub',Case_Name='$caseName',Case_Number='$caseno',Case_Year='$caseyear',Case_Desc='$caseDesc',Case_Path='$path' WHERE Sr_no='$id'";
     
    //echo $sql;
if ($con->query($sql) === TRUE) {
 // echo "Updated!!! <br>";
  
  $oldname = "../$CP";
$newname = "../$path";

//echo $oldname."<br><br>";
//echo $newname;
 



if(rename($oldname, $newname)){
   echo "Directory has been renamed";
} else {
   echo "Fail to rename directory";
}



    
    


  
  header("Location:http://apajuris.in/work/ClientCase.php");
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
    
<!--     <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/css/bootstrap-datepicker.css" rel="stylesheet">  
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  -->

<!--        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/js/bootstrap-datepicker.js"></script> -->


        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    
    
    <title>Update Case Data</title>
  </head>
  <body>
<!--    <h1>Under Process</h1>-->
    
   <div class="container border mt-5">
          <div class="row">
              <div class="col-lg-6 col-lg-6 col-sm-12">
                  <a href="../../../ClientCase.php" class="btn btn-primary mt-1 md-3"><-Back</a>
              </div>
              <div class="col-lg-6 col-lg-6 col-sm-12">
          <h3 class="mt-1 md-2 text-right text-uppercase"> Update Case Data </h3>
              </div>
          </div>
       
              <form class="mt-2" method="POST" action="">
                  
                  <div class="row">
                      
               <div class="col-lg-6  col-md-6 col-sm-12">

                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Select Client Name</label>
                            <select class="custom-select" name="ClientId"placeholder="Please Select Client Name"onchange="document.getElementById('text_CN').value = this.options[this.selectedIndex].text">
                                 <option Selected value="<?php echo $CId?>"><?php echo $CN?></option>
                                <?php
                                $sql = mysqli_query($con, "SELECT * FROM ClientDb");
                                while ($row = $sql->fetch_assoc()) {
                                    echo "<option value=" . $row['Sr_no'] . ">" . $row['Full_Name'] . "</option>";
                                }
                                ?>
                            </select>
                            <input type="hidden" name="ClientName" id="text_CN" value="<?php echo $CN ?>" />
                        </div>


                    </div>
              <div class="col-lg-6  col-md-6 col-sm-12">
                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Select Case Status</label>

                            <select class="form-control" id="status" placeholder="Please Select Case Status"onchange="document.getElementById('text_status').value = this.options[this.selectedIndex].text">
                                 <option Selected value="<?php echo $CS?>"><?php echo $CS?></option>
                                <option value="1">Pending</option>
                                <option value="2">Disposed</option>


                            </select>
                            <input type="hidden" name="Case_Status" id="text_status" value="<?php echo $CS?>" />
                        </div>

                    </div>

                  </div>
                   <div class="form-group">
                    <label for="exampleFormControlSelect1">Select Court Name</label>
                    <a class="" data-toggle="modal" data-target="#AddCourt">  
                        (Add Court)
                    </a><a class="ml-2" data-toggle="modal" data-target="#EditCourt">
                        (Edit Court)
                    </a><a class="ml-2" data-toggle="modal" data-target="#DeleteCourt">
                        (Delete Court)
                    </a>
                    <select class="form-control"  id="CName" placeholder="Please Select Court"onchange="document.getElementById('CourtN').value = this.options[this.selectedIndex].text">
                         <option Selected value="<?php echo $CoN?>"><?php echo $CoN?></option>
                        <?php
                        $sql = mysqli_query($con, "SELECT * FROM CourtDb");
                        while ($row = $sql->fetch_assoc()) {
                            echo "<option value=" . $row['Sr_no'] . ">" . $row['Court_Name'] . "</option>";
                        }
                        ?>
                    </select>
                    <input type="hidden" name="CourtName" id="CourtN" value="<?php echo $CoN?>" />
                </div>
                  
                    <div class="form-group">
                    <label >Enter Case Name</label>
                    <input type="text" class="form-control"   name="CaseName"autocomplete="off" aria-describedby=""placeholder="Enter Case Name" value="<?php echo $CaN?>">
                </div>
                <div class="form-group">
                    <label>Enter Case Number</label>
                    <input type="text" class="form-control"  name="CaseNo" autocomplete="off" aria-describedby=""placeholder="Enter Case Number" value="<?php echo $CNO?>">
                </div>
                   <div class="row">
                    <div class="col-lg-6  col-md-6 col-sm-12">
                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Select Case Type</label>
                                <a class="" data-toggle="modal" data-target="#AddType">  
                                (Add Type)
                            </a><a class="ml-2" data-toggle="modal" data-target="#EditType">
                                (Edit Type)
                            </a><a class="ml-2" data-toggle="modal" data-target="#DeleteType">
                                (Delete Type)
                            </a>
                          
                            <select class="form-control"  id="CT" placeholder="Please Select Case Type"onchange="document.getElementById('text_Type').value = this.options[this.selectedIndex].text">
                                  <option Selected value="<?php echo $CT?>"><?php echo $CT?></option>
                                <?php
                                $sql = mysqli_query($con, "SELECT * FROM Case_Type");
                                while ($row = $sql->fetch_assoc()) {
                                    echo "<option value=" . $row['Sr_no'] . ">" . $row['Case_Type'] . "</option>";
                                }
                                ?>
                            </select>
                            <input type="hidden" name="CaseType" id="text_Type" value="<?php echo $CT?>" />
                        </div>

                    </div>
                    <div class="col-lg-6  col-md-6 col-sm-12">
                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Select Sub Type</label>
                             <a class="" data-toggle="modal" data-target="#AddSType">  
                                (Add Sub Type)
                            </a><a class="ml-2" data-toggle="modal" data-target="#EditSType">
                                (Edit Sub Type)
                            </a><a class="ml-2" data-toggle="modal" data-target="#DeleteSType">
                                (Delete Sub Type)</a>
                            
                            <select class="form-control" required id="SubType" name="SC" placeholder="Choose Sub Category..." onchange="document.getElementById('text_SType').value = this.options[this.selectedIndex].text">

                                 <option Selected value="<?php echo $CST?>"><?php echo $CST?></option>
                                <?php
                                $sql = mysqli_query($con, "SELECT * FROM Case_SubType");
                                while ($row = $sql->fetch_assoc()) {
                                    echo "<option value=" . $row['Sr_no'] . ">" . $row['Case_SubType'] . "</option>";
                                }
                                ?>
                            </select>
                            <input type="hidden" name="CaseSType" id="text_SType" value="<?php echo $CST?>" />
                        </div>
                    </div>

                </div>
                  
                   <div class="row">

                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Select Case Category</label>
                            <a class="" data-toggle="modal" data-target="#AddCategory">  
                                (Add Category)
                            </a><a class="ml-2" data-toggle="modal" data-target="#EditCategory">
                                (Edit Category)
                            </a><a class="ml-2" data-toggle="modal" data-target="#DeleteCategory">
                                (Delete Category)
                            </a>
                            <select class="form-control" required id="Category" placeholder="Please Select category"onchange="document.getElementById('text_Cat').value = this.options[this.selectedIndex].text">
                             <option Selected value="<?php echo $CC?>"><?php echo $CC?></option>
                                <?php
                              
$sql = mysqli_query($con, "SELECT * FROM knowledge_categ");
while ($row = $sql->fetch_assoc()){
echo "<option value=".$row['Sr_no'].">".$row['Category']."</option>";
}
                                ?>
                            </select>
                            <input type="hidden" name="CaseCateg" id="text_Cat" value="<?php echo $CC?>" />
                        </div>
                    </div>

                    <div class="col-lg-6 col-md-6 col-sm-12">
                        
                          <div class="form-group">
                            <label for="exampleFormControlSelect1">Select Sub Category</label>
                            <a class="" data-toggle="modal" data-target="#AddSubCategory">  
                                (Add Sub-Categ)
                            </a><a class="ml-2" data-toggle="modal" data-target="#EditSubCategory">
                                (Edit Sub-Categ)
                            </a><a class="ml-2" data-toggle="modal" data-target="#DeleteSubCategory">
                                (Delete Sub-Categ)
                            </a>
                            <select class="form-control"  id="SubCategorys" placeholder="Please Select type"onchange="document.getElementById('text_SubCat').value = this.options[this.selectedIndex].text">
                                 <option Selected value="<?php echo $CSC?>"><?php echo $CSC?></option>
                                <?php
$sql = mysqli_query($con, "SELECT * FROM knowledge_subcateg");
while ($row = $sql->fetch_assoc()){
echo "<option value=".$row['Sr_no'].">".$row['Sub_Category']."</option>";
}
                                ?>
                            </select>
                            <input type="hidden" name="Case_SCateg" id="text_SubCat" value="<?php echo $CSC?>" />
                        </div>
                    
                        
                    </div>
                </div>
                  
                  
                <div class="form-group">
                    <label>Choose Case Year</label>
                    <input type="text" class="form-control"  name="CaseYear" id="year" autocomplete="off" aria-describedby=""placeholder="YYYY" value="<?php echo $CY?>">
                </div>

                <div class="form-group">
                    <label>Enter Case Description</label>
                    <textarea class="form-control" rows="4" name="CaseDesc" placeholder="Enter Case Description"><?php echo $CD?></textarea>


                </div>




                <div class="form-group">
                    
                     <a href="../../ClientCase.php" class="btn btn-primary  md-2">Cancel</a>
                    <button class="btn btn-primary ml-2 mt-2 mb-2" name="submit" >Submit</button> 
<!--                    <button class="btn btn-danger ml-2 mt-2 mb-2" type="reset"  >Reset</button>  -->
                     

                </div>


                  
                  
                  
              </form>
              
          </div>
        
   


<div clas="Modal">
    
    <!-- Court Modals -->
    
      <!-- ADD Court Modal -->
            <div class="modal fade" id="AddCourt" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h2 class="modal-title font-weight-bold" id="exampleModalLabel">Add Court</h2>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="continer border">
                                <input class="form-control" id="Tname" type="text" placeholder="Enter Court Name">

                                <button type="button" id="addT" class="btn btn-primary mt-2" >Add Court</button>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div> 
            </div>



            <!-- Edit Court Modal -->
            <div class="modal fade" id="EditCourt" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h2 class="modal-title font-weight-bold" id="exampleModalLabel">Edit Court</h2>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="continer border">
                                <label class="font-weight-bold">Select Court</label><br>
                                <select class="ModalSelect" style="width:100%;" id="editTC" placeholder="Choose Court..">
                                    <option value="" disabled selected>Choose Court...</option>

                                    <?php
                                    $sql = mysqli_query($con, "SELECT * FROM CourtDb");
                                    while ($row = $sql->fetch_assoc()) {
                                        echo "<option value=" . $row['Sr_no'] . ">" . $row['Court_Name'] . "</option>";
                                    }
                                    ?>
                                </select>
                                <input class="form-control mt-2" type="text"  id="RenameT" placeholder=" Edit Court">

                                <button type="button" id="EditT" class="btn btn-primary mt-2" >Edit Court</button>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                        </div>
                    </div>
                </div>
            </div>


            <!-- Delete Court Modal -->
            <div class="modal fade" id="DeleteCourt" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h2 class="modal-title font-weight-bold" id="exampleModalLabel">Delete Court</h2>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="continer border">
                                <label class="font-weight-bold">Select Type</label><br>
                                <select  class="" style="width:100%;" id="DeleteT" placeholder="Choose Court..">
                                    <option value="" disabled selected>Please Choose Court</option>

                                    <?php
                                    include 'KnowledgeDb/Dp.php';
                                    $sql = mysqli_query($con, "SELECT * FROM CourtDb");
                                    while ($row = $sql->fetch_assoc()) {
                                        echo "<option value=" . $row['Sr_no'] . ">" . $row['Court_Name'] . "</option>";
                                    }
                                    ?>
                                </select>
                                <button type="button" id="DelT" class="btn btn-primary mt-1 ml-1" >Delete Court</button>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                        </div>
                    </div>
                </div>
            </div>


    
    <!-- End of Court Modals -->
    
    
    <!-- Type Modals -->
    
    
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
                                <input class="form-control" id="CTname" type="text" placeholder="Enter Type">

                                <button type="button" id="CTadd" class="btn btn-primary mt-2" >Add Type</button>
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
                                <select class="form-select" style="width:100%;" id="CTEdit" placeholder="Choose Type..">
                                    <option value="" disabled selected>Please Choose Case Type</option>

                                    <?php
                                    $sql = mysqli_query($con, "SELECT * FROM Case_Type");
                                    while ($row = $sql->fetch_assoc()) {
                                        echo "<option value=" . $row['Sr_no'] . ">" . $row['Case_Type'] . "</option>";
                                    }
                                    ?>
                                </select>
                                <input class="form-control mt-2" type="text"  id="CTRename" placeholder=" Edit Type">

                                <button type="button" id="CTedit" class="btn btn-primary mt-2" >Edit Type</button>
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
                                <select  class="" id="CTDelete" style="width:100%;" placeholder="Choose Type..">
                                    <option value="" disabled selected>Choose Case Type</option>

                                    <?php
                                    $sql = mysqli_query($con, "SELECT * FROM Case_Type");
                                    while ($row = $sql->fetch_assoc()) {
                                        echo "<option value=" . $row['Sr_no'] . ">" . $row['Case_Type'] . "</option>";
                                    }
                                    ?>
                                </select>
                                <button type="button" id="CTdel" class="btn btn-primary mt-1 ml-1" >Delete Type</button>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                        </div>
                    </div>
                </div>
            </div>


    
    <!-- End of Type Modals -->
    
    
    <!-- SubType Modals -->
     <!--Add Sub Type-->
            <div class="modal fade" id="AddSType" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h2 class="modal-title font-weight-bold" id="exampleModalLabel">Add Sub Type</h2>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="continer">
                                <label class="font-weight-bold">Select Type</label><br>
                                <select class="" id="selectT" style="width:100%;" placeholder="Choose Case Type..">
                                    <option value="" disabled selected>Please Choose Case Type </option>

                                    <?php
                                    $sql = mysqli_query($con, "SELECT * FROM Case_Type");
                                    while ($row = $sql->fetch_assoc()) {
                                        echo "<option value=" . $row['Sr_no'] . ">" . $row['Case_Type'] . "</option>";
                                    }
                                    ?>
                                </select>
                                <br>
                                <input class="form-control mt-1" type="text"  id="SubT" placeholder="Enter Sub Category">

                                <button type="button" class="btn btn-primary mt-2"  id="STAdd" >Add Sub Category</button>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                        </div>
                    </div>
                </div>
            </div>


            <!-- Edit Type  Sub Modal -->
            <div class="modal fade" id="EditSType" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h2 class="modal-title font-weight-bold" id="exampleModalLabel">Edit Sub-Type</h2>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="continer border">
                                <label class="font-weight-bold">Select Sub Type</label><br>
                                <select class="form-select" style="width:100%;" id="STEdit" placeholder="Choose Type.." onchange="document.getElementById('STRename').value = this.options[this.selectedIndex].text">
                                    <option value="" disabled selected>Please Choose Case Sub Type</option>

                                    <?php
                                    $sql = mysqli_query($con, "SELECT * FROM Case_SubType");
                                    while ($row = $sql->fetch_assoc()) {
                                        echo "<option value=" . $row['Sr_no'] . ">" . $row['Case_SubType'] . "</option>";
                                    }
                                    ?>
                                </select>
                                <input class="form-control mt-2" type="text"  id="STRename" placeholder=" Edit Type">

                                <button type="button" id="STedit" class="btn btn-primary mt-2" >Edit Type</button>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                        </div>
                    </div>
                </div>
            </div>



            <!-- Delete Type Modal -->
            <div class="modal fade" id="DeleteSType" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h2 class="modal-title font-weight-bold" id="exampleModalLabel">Delete Sub-Type</h2>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="continer border">
                                <label class="font-weight-bold">Select Sub Type</label><br>
                                <select  class="" id="STDelete" style="width:100%;" placeholder="Choose Type..">
                                    <option value="" disabled selected>Please Choose Sub Type</option>

                                    <?php
                                    $sql = mysqli_query($con, "SELECT * FROM Case_SubType");
                                    while ($row = $sql->fetch_assoc()) {
                                        echo "<option value=" . $row['Sr_no'] . ">" . $row['Case_SubType'] . "</option>";
                                    }
                                    ?>
                                </select>
                                <button type="button" id="STdel" class="btn btn-primary mt-1 ml-1" >Delete Type</button>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                        </div>
                    </div>
                </div>
            </div>


    <!-- End of Sub Type Modals -->
    
    
    <!-- Category Modal --->
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
                                <select class="" id="DeleteC" style="width:100%;" placeholder="Choose Category..">
                                    <option value="" disabled selected>Please Choose Case Category</option>

                                    <?php
                                    $sql = mysqli_query($con, "SELECT * FROM knowledge_categ");
while ($row = $sql->fetch_assoc()){
echo "<option value=".$row['Sr_no'].">".$row['Category']."</option>";
}
                                    ?>
                                </select>
                                <button type="button" id="DelC" class="btn btn-primary mt-1 ml-1" >Delete Category</button>
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
                                <select  class="" id="editsC" style="width:100%;" placeholder="Choose Category.." onchange="document.getElementById('Rename').value = this.options[this.selectedIndex].text">
                                    <option value="" disabled selected>Please Choose Case Category</option>

                                    <?php
                                    $sql = mysqli_query($con, "SELECT * FROM knowledge_categ");
while ($row = $sql->fetch_assoc()){
echo "<option value=".$row['Sr_no'].">".$row['Category']."</option>";
}
                                    ?>
                                </select>
                                <input class="form-control mt-2" type="text"  id="Rename" placeholder=" Edit Category" >

                                <button type="button" id="EditC" class="btn btn-primary mt-2" >Edit Category</button>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                        </div>
                    </div>
                </div>
            </div>

            
            
            <!-- Sub Category-->
            
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
              <select class="" style="width:100%;" id="selects" placeholder="Choose Category..">
   <option value="" disabled selected>Choose case Category</option>
  
<?php 
 $sql = mysqli_query($con, "SELECT * FROM knowledge_categ");
while ($row = $sql->fetch_assoc()){
echo "<option value=".$row['Sr_no'].">".$row['Category']."</option>";
}
?>
</select>
              <br>
              <input class="form-control mt-1" type="text"  id="Subc" placeholder="Enter Sub Category">
              
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
              <select class="" id="editSC"  style="width:100%;" placeholder="Choose Sub-Category..">
   <option value="" disabled selected>Please Choose Sub-Category</option>
  
<?php 
                               $sql = mysqli_query($con, "SELECT * FROM knowledge_subcateg");
while ($row = $sql->fetch_assoc()){
echo "<option value=".$row['Sr_no'].">".$row['Sub_Category']."</option>";

}
?>
</select>
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
              <select class="" id="DeleteSC"  style="width:100%;" placeholder="Choose Sub-Category..">
   <option value="" disabled selected>Please Choose Sub Category</option>
  
<?php 

$sql = mysqli_query($con, "SELECT * FROM knowledge_subcateg");
while ($row = $sql->fetch_assoc()){
echo "<option value=".$row['Sr_no'].">".$row['Sub_Category']."</option>";
}
?>
</select>
              <button type="button" id="DelSC" class="btn btn-primary mt-1 ml-1" >Delete Sub-Category</button>
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
        
        
        
        
        $("#CT").on("change", function () {
                var category = $("#CT").val();

                console.log(category);

                var cid = JSON.stringify(category);
                $.ajax({
                    url: "../SubTypeDy.php",
                    type: "POST",
                    cache: false,
                    data: {countryId: cid},
                    success: function (data) {
                        console.log(data);
                        $("#SubType").html(data);

                    }
                });
            });

$("#Category").on("change",function(){
     var category = $("#Category").val();
     
     console.log(category);
     
     var cid= JSON.stringify(category);
      $.ajax({
        url :"../SubCategDy.php",
        type:"POST",
        cache:false,
        data:{countryId:cid},
        success:function(data){
            console.log(data);
          $("#SubCategorys").html(data);
        }
      });
 });
 
 
 
            document.getElementById("EditT").addEventListener("click", editT);
            function editT() {
                var Cid = document.getElementById('editTC').value;
                var Rename = document.getElementById('RenameT').value;
                console.log(Cid);
                console.log(Rename);
                var cid = JSON.stringify(Cid);
                var renames = JSON.stringify(Rename);
                $.ajax({
                    type: "POST",
                    url: "../EditCourt.php",
                    data: {id: cid, rename: renames},
                    success: function (res) {
                        console.log(res);
                        location.reload();
                    }

                });
            }
            ;



            document.getElementById("DelT").addEventListener("click", DelT);
            function DelT() {
                var Cid = document.getElementById('DeleteT').value;
                console.log(Cid);
                var cid = JSON.stringify(Cid);
                $.ajax({
                    type: "POST",
                    url: "../DelCourt.php",
                    data: {id: cid},
                    success: function (res) {
                        console.log(res);
                        location.reload();
                    }

                });
            }
            ;


            document.getElementById("addT").addEventListener("click", ADDCourt);
            function ADDCourt() {
                var tname = document.getElementById("Tname").value;
                console.log(tname);
                var Tname = JSON.stringify(tname);
//var AddCourt= JSON.stringify('AddCourt');


                $.ajax({
                    type: "POST",
//      url: "CaseDb/Court.php", 
//       data: {name:Tname,method:AddCourt},

                    url: "../AddCourt.php",
                    data: {name: Tname},
                    success: function (res) {
                        console.log(res);
                        location.reload();
                    }

                });

            }
            ;

 
 
     document.getElementById("CTadd").addEventListener("click", AddType);
            function AddType() {
                var CTname = document.getElementById("CTname").value;
                console.log(CTname);
                var Ctname = JSON.stringify(CTname);
                $.ajax({
                    type: "POST",
                    url: "../AddType.php",
                    data: {name: Ctname},
                    success: function (res) {
                        console.log(res);
                        location.reload();
                    }

                });

            }
            ;

            document.getElementById("CTedit").addEventListener("click", EditCT);
            function EditCT() {
                var Cid = document.getElementById('CTEdit').value;
                var Rename = document.getElementById('CTRename').value;
                console.log(Cid);
                console.log(Rename);
                var cid = JSON.stringify(Cid);
                var renames = JSON.stringify(Rename);
                $.ajax({
                    type: "POST",
                    url: "../EditType.php",
                    data: {id: cid, rename: renames},
                    success: function (res) {
                        console.log(res);
                        location.reload();
                    }

                });
            }
            ;


            document.getElementById("CTdel").addEventListener("click", DelCT);
            function DelCT() {
                var Cid = document.getElementById('CTDelete').value;
                console.log(Cid);
                var cid = JSON.stringify(Cid);
                $.ajax({
                    type: "POST",
                    url: "../DelType.php",
                    data: {id: cid},
                    success: function (res) {
                        console.log(res);
                        location.reload();
                    }

                });
            }
            ;

  // Sub Type Department


            document.getElementById("STAdd").addEventListener("click", AddST);
            function AddST() {

                var Cid = document.getElementById('selectT').value;
                var SubC = document.getElementById('SubT').value;
                console.log(Cid);
                console.log(SubC);

                var cid = JSON.stringify(Cid);
                var subc = JSON.stringify(SubC);
                $.ajax({
                    type: "POST",
                    url: "../AddSubT.php",
                    data: {id: cid, Subc: subc},
                    success: function (res) {
                        console.log(res);
                        location.reload();
                    }

                });
            }
            ;

            document.getElementById("STedit").addEventListener("click", EditST);
            function EditST() {
                var Cid = document.getElementById('STEdit').value;
                var Rename = document.getElementById('STRename').value;
                console.log(Cid);
                console.log(Rename);
                var cid = JSON.stringify(Cid);
                var renames = JSON.stringify(Rename);
                $.ajax({
                    type: "POST",
                    url: "../EditSubT.php",
                    data: {id: cid, rename: renames},
                    success: function (res) {
                        console.log(res);
                        location.reload();
                    }

                });
            }
            ;

                document.getElementById("STdel").addEventListener("click", DelST);
            function DelST() {
                var Cid = document.getElementById('STDelete').value;
                console.log(Cid);
                var cid = JSON.stringify(Cid);
                $.ajax({
                    type: "POST",
                    url: "../DelSubT.php",
                    data: {id: cid},
                    success: function (res) {
                        console.log(res);
                        location.reload();
                    }

                });
            }
            ;



 // Category  Date Control Department


            document.getElementById("addC").addEventListener("click", myADD);
            function myADD() {
                var Cname = document.getElementById("Cname").value;
                console.log(Cname);
                var cname = JSON.stringify(Cname);

                $.ajax({
                    type: "POST",
                    url: "../AddCatag.php",
                    data: {name: cname},
                    success: function (res) {
                        console.log(res);
                        location.reload();
                    }

                });

            }
            ;


            document.getElementById("EditC").addEventListener("click", editC);
            function editC() {
                var Cid = document.getElementById('editsC').value;
                var Rename = document.getElementById('Rename').value;
                console.log(Cid);
                console.log(Rename);
                var cid = JSON.stringify(Cid);
                var renames = JSON.stringify(Rename);
                $.ajax({
                    type: "POST",
                    url: "../EditCat.php",
                    data: {id: cid, rename: renames},
                    success: function (res) {
                        console.log(res);
                        location.reload();
                    }

                });
            }
            ;



            document.getElementById("DelC").addEventListener("click", DelC);
            function DelC() {
                var Cid = document.getElementById('DeleteC').value;
                console.log(Cid);
                var cid = JSON.stringify(Cid);
                $.ajax({
                    type: "POST",
                    url: "../DelCat.php",
                    data: {id: cid},
                    success: function (res) {
                        console.log(res);
                        location.reload();
                    }

                });
            }
            ;

            // Sub Type Department


            document.getElementById("STAdd").addEventListener("click", AddST);
            function AddST() {

                var Cid = document.getElementById('selectT').value;
                var SubC = document.getElementById('SubT').value;
                console.log(Cid);
                console.log(SubC);

                var cid = JSON.stringify(Cid);
                var subc = JSON.stringify(SubC);
                $.ajax({
                    type: "POST",
                    url: "../AddSubT.php",
                    data: {id: cid, Subc: subc},
                    success: function (res) {
                        console.log(res);
                        location.reload();
                    }

                });
            }
            ;

            document.getElementById("STedit").addEventListener("click", EditST);
            function EditST() {
                var Cid = document.getElementById('STEdit').value;
                var Rename = document.getElementById('STRename').value;
                console.log(Cid);
                console.log(Rename);
                var cid = JSON.stringify(Cid);
                var renames = JSON.stringify(Rename);
                $.ajax({
                    type: "POST",
                    url: "../EditSubT.php",
                    data: {id: cid, rename: renames},
                    success: function (res) {
                        console.log(res);
                        location.reload();
                    }

                });
            }
            ;

                document.getElementById("STdel").addEventListener("click", DelST);
            function DelST() {
                var Cid = document.getElementById('STDelete').value;
                console.log(Cid);
                var cid = JSON.stringify(Cid);
                $.ajax({
                    type: "POST",
                    url: "../DelSubT.php",
                    data: {id: cid},
                    success: function (res) {
                        console.log(res);
                        location.reload();
                    }

                });
            }
            ;


//Sub Category Department


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
      url: "../EditSubCat.php", 
       data: {id:cid,rename:renames},
      success: function(res) { 
        console.log(res);
      location.reload();
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
      url: "../DeleteSubCat.php", 
       data: {id:cid},
      success: function(res) { 
        console.log(res);
      location.reload();
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
      url: "../AddSub.php", 
       data: {id:cid,Subc:subc},
      success: function(res) { 
        console.log(res);
      location.reload();
 } 
       
});
};


 
 
 
        $(document).ready(function () {


//                $('#year').datepicker({
//                    minViewMode: 'years',
//                    autoclose: true,
//                    format: 'yyyy'
//                });
                $('select').select2();


            });
        
        </script>
    
    

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>

   
  </body>
</html>