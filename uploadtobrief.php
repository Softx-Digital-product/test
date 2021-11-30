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

                             
                        $q= "TRUNCATE TABLE Temp_data";
                        if(mysqli_query($con, $q)){
//   echo " Delete Succesfully"; 

}else{
//    echo "Can't Clear";
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

    
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link rel="stylesheet" href="assets12/css/sam.css">
        <link rel="stylesheet" href="Timeline/timeline.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha512-SfTiTlX6kk+qitfevl/7LibUOeJWlt9rbyDn92a1DqWOw9vWG2MFoays0sgObmWazO5BQPiFucnnEAjpAB+/Sw==" crossorigin="anonymous" />
        
        
      <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
        <script src='https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js'></script>
        
        
           <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<!--          <script type="text/javascript" src="js/vpb_uploader.js"></script>-->
<script src="https://mozilla.github.io/pdf.js/build/pdf.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.0.943/pdf.min.js"></script>
<!--           <script type="text/javascript" src="js/vpb_uploaderU.js"></script>-->
           
           <script type="text/javascript" src="js/vpb_uploaderM.js"></script>
<!--           <script src="http://malsup.github.com/jquery.form.js"></script> -->
           <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.3.0/jquery.form.min.js" integrity="sha384-qlmct0AOBiA2VPZkMY3+2WqkHtIQ9lSdAsAn5RUJD/3vA5MKDgSGcdmIv4ycVxyn" crossorigin="anonymous"></script>

    
        
    <title>Upload to brief</title>
  </head>
  <body>

<!--      <Strong class="text-center text-danger"><h1> Please Don't Uplaoad Files !!! Work Under Process :) </h1></Strong>-->
      
<div class="container mt-5 shadow-md">
    
   <div class="container shadow mt-5 h-100">
            <!--      <div class="Container mt-5 shadow">-->
            <div class="row">
                <div class="col-lg-6 col-lg-6 col-sm-12">
                    <a href="ClientBrief.php" class="btn btn-primary mt-1 md-3"><- Back</a>
                </div>
                <div class="col-lg-6 col-lg-6 col-sm-12">
                    <h3 class="mt-1 md-2 text-right text-uppercase"> Upload File to ClientBrief </h3>
                </div>

            </div>
<center class="mt-3">

<h2 style="color:blue; text-align:center;">Upload Pdf </h2>
<hr class="bg-dark mt-1 md-1">
<div class="container-fluid p-0 ">
     <form name="form_id" id="form_id" action="javascript:void(0);" enctype="multipart/form-data" style="width:800px; margin-top:20px;">
<!--     <form name="form_id" id="form_id" action="BriefMerger.php" method="POST" enctype="multipart/form-data" style="width:800px; margin-top:20px;">  -->
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
 <div class="col-lg-4 col-md-4 col-sm-12">
     
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
                        <input type="file" class="form-control-sm" name="vasplus_multiple_files" id="vasplus_multiple_filesu" multiple="multiple" style=""/>
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

<table class="table table-striped table-bordered " style="width:60%;" id="btable">
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
<table class="table table-striped table-bordered" style="width:80%;" id="add_files">
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
            <div class="mt-5">
                 <a href="ClientBrief.php" class="btn btn-primary mt-1 mb-3"><- Back</a>
                 <Strong id="note" class="ml-5 text-danger">Note :- After Files upload Please Wait Until Page Reload</strong>
            </div>

          </div>
</div>
        

<div class="modals">

    
</div>
        
        
        
        
    
<script>
    $("select").select2();
    
                $("#ClientN").on("change", function () {
                    var category = $("#ClientN").val();
                    
                        var selected = $(this).find('option:selected');
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
             
//document.getElementById("btable").style.display="none";
$("#btable").hide();
                       $("#CaseName").on("change", function () {
                                var selected = $(this).find('option:selected');
       var extra = selected.data('foo'); 
       
                    var category = $("#CaseName").val();

                    console.log(category);

                    var cid = JSON.stringify(category);
                    $.ajax({
                        url: "UploadClientBrief/TableDy.php",
                        type: "POST",
                        cache: false,
                        data: {countryId: extra},
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
            

                
                

    
    </script>
    
    <script>
      $(document).ready(function()
       
{
      
	// Call the main function
	new vpb_multiple_file_uploader
	({
           
            
		vpb_form_id: "form_id", // Form ID
		autoSubmit: true,
//		vpb_server_url: "UploadClientBrief/BriefMerger.php" 
                vpb_server_url: "BriefMerger.php" 
	});
        
    
      
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