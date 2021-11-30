<?php 

include 'Dp.php';

$id = $_GET['v'];

//$id=2;
if(isset($_POST['USubmit'])){
    
    $uclientN=$_POST['UClientN'];
    $ucaseN=$_POST['UCaseN'];
    $updf=$_POST['UPdf'];
    $udate=$_POST['UDate'];
    $ustpg=$_POST['USTpg'];
    $uetpg=$_POST['UETpg'];
    $utdy=$_POST['UTDy'];
    $utitle=$_POST['UTitle'];
    $ucontent=$_POST['UEditor'];
    
    
    
            
//    echo $uclientN;
//    echo $ucaseN;
//    echo $updf;
    
    
$sql = "UPDATE Timeline_data SET T_date='$udate',St_pg='$ustpg', Ed_pg='$uetpg', Doc_type='$utdy',Pdf_Name='$updf', Client_Name='$uclientN',Case_Name='$ucaseN',Title='$utitle',Content='$ucontent' WHERE Sr_no='$id'";
//echo $sql;
if ($con->query($sql) === TRUE) {
  echo "Record updated successfully";
   header("Location:http://apajuris.in/work/viewtimeline.php");
} else {
  echo "Error updating record: " . $con->error;
   header("Location:http://apajuris.in/work/viewtimeline.php");
}

$con->close();
           
            
    
}



$sr; $cid; $tdate; $st; $et; $doctype;$pdfn; $title ;$content;

	$query = "SELECT * FROM Timeline_data WHERE Sr_no = {$id}";
	$result = $con->query($query);
        
    if ($result->num_rows > 0) {
		while ($row = $result->fetch_assoc()) {

                    $sr= $row['Sr_no'];
                    $cid=$row['Cid'];
                    $tdate=$row['T_date'];
                    $st=$row['St_pg'];
                    $et=$row['Ed_pg'];
                    $doctype=$row['Doc_type'];
                    $pdfn=$row['Pdf_Name'];
                    $title=$row['Title'];
                    $content=$row['Content'];
                     $clientName= $row['Client_Name'];
                           $caseName=$row['Case_Name'];
                           $pdfName= $row['Pdf_Name'];
                           $sR= $row['Sr_no'];
                    
                    
                    
                    $path="../ClientCaseData/$clientName/$caseName/$pdfName";        
                  //  echo $title;
                }
    }else{
         echo "no Record founded!!!";
     }      


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
                           $sR= $row['Sr_no'];
                        }
                        }
                        //if (empty($clientName)){
//                        if($clientName === NULL){
//                            $clientName = "Please Choose Client Name";
//                        }
                   $clientName;
                   $caseName;
                  $pdfName;
                  $sR;
$path="../ClientCaseData/$clientName/$caseName/$pdfName";
//echo  $path;

}
else{
                         if($clientName === NULL){
                            $clientName = "Please Choose Client Name";
                        }
                        if($caseName === NULL){
                            $caseName = "Please Choose Case Name";
                        }
                        if($pdfName === NULL){
                            $pdfName = "Choose pdf Document";
                        }
                        
                        
                       // echo $clientName;
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
    
       <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/themes/ui-lightness/jquery-ui.min.css" integrity="sha512-NaCOGQe8bs7/BxJpnhZ4t4f4psMHnqsCxH/o4d3GFqBS4/0Yr/8+vZ08q675lx7pNz7lvJ6fRPfoCNHKx6d/fA==" crossorigin="anonymous" />
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        
         <script src="../ckeditor/ckeditor.js"></script>
  
       <script src="https://mozilla.github.io/pdf.js/build/pdf.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.0.943/pdf.min.js"></script>

    
    <title>Update Timeline!</title>
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
        height: 500px;
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
 
        </style>
  </head>
  <body>

         <div class="container-fluid border mt-4 shadow p-3 mb-5 bg-white rounded">
          <div class="row">
              <div class="col-lg-6 col-lg-6 col-sm-12">
                  <a href="../viewtimeline.php" class="btn btn-primary mt-1"><- Back</a>
              </div>
                <div class="col-lg-6 col-lg-6 col-sm-12">
          <h3 class="mt-1 text-right text-uppercase"> Update Timeline DATA </h3>
              </div>
          </div>
             
             <div class="row mt-3">
                 <div class="col-lg-6 col-lg-6 col-sm-12">
                     
                      <form class="mt-2" method="POST" action="">
                          
                          <div class="row">
                              <div class="col-xl-4 col-lg-4 col-md-4 col-12">
                                  <div class="form-group">
                                <label class="font-weight-bolder" for="exampleFormControlSelect1">Select Client Name</label>
                                <select class="form-control" id="ClientN" style="width:100%;" placeholder="Please Select Client Name"onchange="document.getElementById('text_CT').value = this.options[this.selectedIndex].text">
<!--                                    <option value=""disabled selected>Please Choose Client Name</option>-->
                                    <option value=""disabled selected><?php echo $clientName ?></option>
                                    <?php
                                    $sql = mysqli_query($con, "SELECT * FROM ClientDb");
                                    while ($row = $sql->fetch_assoc()) {
                                        echo "<option value=" . $row['Sr_no'] . ">" . $row['Full_Name'] . "</option>";
                                    }

                                    ?>
                                </select>
                                <input type="hidden" name="UClientN" id="text_CT" value="<?php echo $clientName; ?>" />
                            </div>
                                  
                              </div>
                               <div class="col-xl-4 col-lg-4 col-md-4 col-12">
                                 <div class="form-group">
                                     <label class="font-weight-bolder">Select Case Name</label>
                                <select class="form-control mt-1"  style="width:100%;" id="CaseName" placeholder="Please Select Client Name"onchange="document.getElementById('text_CN').value = this.options[this.selectedIndex].text">
<!--                                    <option value=""disabled selected>Please Choose Case Name</option>-->
                                    <option value=""disabled selected><?php echo $caseName?></option>
                                    <?php
                                    $sql = mysqli_query($con, "SELECT * FROM Client_CaseDb");
                                    while ($row = $sql->fetch_assoc()) {
                                        echo "<option value=" . $row['Sr_no'] . ">" . $row['Case_Name'] . "</option>";
                                    }
                                    ?>
                                </select>
                                <input type="hidden" name="UCaseN" id="text_CN" value="<?php echo $caseName; ?>" />
                            </div>
                                  
                              </div>
                               <div class="col-xl-4 col-lg-4 col-md-4 col-12">
                                   <div class="form-group">
                                                <label class="font-weight-bold">Choose Document</label>
                                                <select class="form-control" style="width:100%;" name="Cidpdf" id="pdfct" placeholder="Choose UdploadDocs Type.."onchange="document.getElementById('text_CTPDF').value=this.options[this.selectedIndex].text">
<!--                                                    <option value="" disabled selected>Choose Pdf Document</option>-->
                                                        <option value=""disabled selected><?php echo $pdfName ?></option>
                                                        
                                                    <?php
                                                   $sql = mysqli_query($con, "SELECT * FROM UploadDocs");
                                                    while ($row = $sql->fetch_assoc()) {
//                                                        echo "<option value=".'ClientCaseData/'.$row['Client_Name'].'/'.$row['Client_Name'].'/'.$row['Pdf_Name'].">" . $row['Pdf_Name'] . "</option>";
                                                    
                                                        echo "<option value=" . $row['Sr_no'] . ">" . $row['Pdf_Name'] . "</option>";
                                                    }
                                                    ?>
                                                    </select>
                                                <input type="hidden" name="UPdf" id="text_CTPDF" value="<?php echo $pdfName ?>" />
                                            </div>
                                  
                              </div>
                              
                          </div>
                          
                 <div class="row">
                  <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2">
                                            <div class="form-group">
                                                <label class="font-weight-bold">Date</label>
                                                <input class="form-control" placeholder="Date" name="UDate" id="UDate"value="<?php echo $tdate;?>">
                                            </div>
                                        </div>

                                        <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2">
                                            <div class="form-group">
                                                <label class="font-weight-bold">Start page</label>
                                                <input class="form-control" type="number" name="USTpg" placeholder="eg. 1" value="<?php echo $st;?>">
                                            </div>
                                        </div>
                                        <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2">
                                            <div class="form-group">
                                                <label class="font-weight-bold">End page</label>
                                                <input class="form-control" type="number" name="UETpg"placeholder="eg. 4" value="<?php echo $et;?>">
                                            </div>
                                        </div>
                                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-2">
                                            <div class="form-group">
                                                <label class="font-weight-bold">Document Type</label>
                                                <select class="form-control" style="width:100%;" id="Tdy" placeholder="Choose Document Type.." onchange="document.getElementById('text_DT').value=this.options[this.selectedIndex].text">
                                                    <option value="" disabled selected><?php echo $doctype?></option>

                                                    <?php
                                                   $sql = mysqli_query($con, "SELECT * FROM Document_type");
                                                    while ($row = $sql->fetch_assoc()) {
                                                        echo "<option value=" . $row['Sr_no'] . ">" . $row['Document_name'] . "</option>";
                                                    }
                                                    ?>
                                                    </select>
                                                   <input type="hidden" name="UTDy" id="text_DT" value="<?php echo $doctype?>" />
                                            </div>
                                        </div>
                 </div>
                          <div class="form-group">
                                                <label class="font-weight-bold">Enter Title</label>
                                                <input class="form-control" id="CTtitle"name="UTitle" placeholder="Title" value="<?php echo $title?>">
                                            </div>
                                    
                                     <div class="form-group">
                                                <label class="font-weight-bold">Enter Content</label>
                                                <textarea class="form-control"id="CTeditor" required name="UEditor"  aria-label="With textarea"><?php echo $content?></textarea>
               
                                            </div>
                                    <div class="form-group">
                                        
                                        
                                        <button type="submit" name="USubmit" id="CTsubmit" class="btn btn-primary">Update</button>
                                    </div>
                 
                 
                 
             </form>
                     
                     
                     <form method="POST" id="php" action="">
                                <input type="hidden" name="pid" id="path">
                            
                            </form>  
                 </div> <!--Content -->
                  <div class="col-lg-6 col-lg-6 col-sm-12">
                      <div id="my_pdf_viewer" class="border">
                    	<div id="navigation_controls" class="text-center">
                             <button class="btn btn-primary btn-sm" id="Firstpg">First page</button>
                              <button class="btn btn-primary btn-sm" id="Lastpg">Last page</button>
                            <button class="btn btn-primary btn-sm" id="go_previous">Previous</button>
                            <button class="btn btn-primary btn-sm" id="go_next">Next</button>
                             <input id="current_page" value="1" type="number"/>
                            &nbsp; &nbsp;
                            <button class="btn btn-primary btn-sm" id="zoom_in">+</button>
                            <button class="btn btn-primary btn-sm" id="zoom_out">-</button>
                            <button class="btn btn-primary btn-sm" id="rotate_page">R</button>
                            <button class="btn btn-primary btn-sm" id="reload">Refresh</button>
                        </div> 
                           <hr class="bg-secondary mt-4">
                          
                    	<div id="canvas_container" class="mt-1 mb-1">
                           
                            <canvas id="pdf_renderer"></canvas> 
                        </div>
                           
                              <hr class="bg-secondary">
    <div id="navigation_controls" class="text-center">
         <button class="btn btn-primary btn-sm" id="Firstpg1">First page</button>
                              <button class="btn btn-primary btn-sm" id="Lastpg1">Last page</button>
                            <button class="btn btn-primary btn-sm" id="go_previous1">Previous</button>
                         <button class="btn btn-primary btn-sm"id="go_next1">Next</button>
                               <input id="current_page1" value="1" type="number"/>
                            
                            &nbsp;
                            <button class="btn btn-primary btn-sm" id="zoom_in1">+</button>
                            <button class="btn btn-primary btn-sm" id="zoom_out1">-</button>
                            <button class="btn btn-primary btn-sm" id="rotate_page1">R</button>
                               <button class="btn btn-primary btn-sm" id="reload1">Refresh</button>
                        </div>
     
					</div>  
                </div>
            </div>
                     
                      
                      
                      
                 </div><!--viewer-->
                 
                 
             </div>
             
            
             
             
             
             
             
             
         </div><!--container end-->
    
    
    
    
         <script>
             
             
             $("#pdfct").on("change", function () {
     var Cid = $("#pdfct").val();
       console.log(Cid);
     
     $("#path").val(Cid);
     $("#php").submit();
     // document.getElementById("#php").submit();

 
        });
        
             $('select').select2();
              $("#UDate").datepicker({ dateFormat: 'dd/mm/yy',});
              
              
              
              $("#ClientN").on("change", function () {
                    var category = $("#ClientN").val();

                    console.log(category);

                    var cid = JSON.stringify(category);
                    $.ajax({
                        url: "../UploadCase/CaseNameDy.php",
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
                        url: "pdfDy.php",
                        type: "POST",
                        cache: false,
                        data: {countryId: cid},
                        success: function (data) {
                            console.log(data);
                            $("#pdfct").html(data);

                        }
                    });
                });






                 
CKEDITOR.replace('CTeditor',{
     //height: 380,
                          toolbarGroups: [{
          "name": "basicstyles",
          "groups": ["basicstyles"]
        },
        {
          "name": "links",
          "groups": ["links"]
        },
        {
          "name": "paragraph",
          "groups": ["list", "blocks"]
        },
        {
//          "name": "document",
//          "groups": ["mode"]
        },
        //{ name: 'clipboard', groups: [ 'clipboard', 'undo' ] },
		//{ name: 'editing', groups: [ 'find', 'selection', 'spellchecker', 'editing' ] },
		//{ name: 'forms', groups: [ 'forms' ] },
        {
          "name": "insert",
          "groups": ["insert"]
        },
        {
          "name": "styles",
          "groups": ["styles"]
        },
        {
        name: 'styles',
        groups: [ 'styles' ] 
    },
    
		{ name: 'colors', groups: [ 'colors' ] },
		{ name: 'tools', groups: [ 'tools' ] },
		{ name: 'others', groups: [ 'others' ] },
		
        
      ],
      // Remove the redundant buttons from toolbar groups defined above.
      removeButtons: 'Underline,Strike,Subscript,Superscript,Anchor,Styles,Specialchar'
    });               


                
CKEDITOR.replace('editor',{
                          toolbarGroups: [{
          "name": "basicstyles",
          "groups": ["basicstyles"]
        },
        {
          "name": "links",
          "groups": ["links"]
        },
        {
          "name": "paragraph",
          "groups": ["list", "blocks"]
        },
        {
//          "name": "document",
//          "groups": ["mode"]
        },
        //{ name: 'clipboard', groups: [ 'clipboard', 'undo' ] },
		//{ name: 'editing', groups: [ 'find', 'selection', 'spellchecker', 'editing' ] },
		//{ name: 'forms', groups: [ 'forms' ] },
        {
          "name": "insert",
          "groups": ["insert"]
        },
        {
          "name": "styles",
          "groups": ["styles"]
        },
        {
        name: 'styles',
        groups: [ 'styles' ] 
    },
    
		{ name: 'colors', groups: [ 'colors' ] },
		{ name: 'tools', groups: [ 'tools' ] },
		{ name: 'others', groups: [ 'others' ] },
		
        
      ],
      // Remove the redundant buttons from toolbar groups defined above.
      removeButtons: 'Underline,Strike,Subscript,Superscript,Anchor,Styles,Specialchar'
    });

             
             </script>
             
               <script>
                
                
                 var myState = {
        pdf: null,
        currentPage: 1,
        zoom: 1,
        cache: false,
    }
    
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
                
    
                 function jump(pg) { 
        //console.log("Hello i am First page");
       
       // document.getElementById('#current_page').textContent = pdfDoc.numPages;
        $("#current_page").val(pg);
        $("#current_page1").val(pg);
        
        
        myState.currentPage = pg;
        
          render();
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



         }
</script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>

  </body>
</html>
