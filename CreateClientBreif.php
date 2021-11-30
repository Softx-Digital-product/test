<?php

include 'Timeline/Dp.php';
$value = $_GET['v'];

//echo $value."<br><br>";
//$value ="%Test1%";


$sr; $clientName; $caseName; $folderN; $pdfName;


$query = "SELECT * FROM UploadClientBrief WHERE Pdf_Name = '{$value}'";
//echo $query;
	$result = $con->query($query);
        
    if ($result->num_rows > 0) {
		while ($row = $result->fetch_assoc()) {
                    
                      $sr= $row['Sr_no'];
                                $clientName=$row['Client_Name'];
                                $caseName=$row['Case_Name'];
//                                $folderN=$row['Folder_Name'];
                                $pdfName=$row['Pdf_Name'];
                            $path="ClientCaseData/$clientName/$caseName/ClientBrief/$pdfName";
//echo  $path;

                }
    }else{
//         echo "Error: ----->" . $sql . "<br>" . $con->error;
//         echo "no Record founded!!!";
         $clientName = "Please Choose Client Name";
         $caseName = "Please Choose Case Name";
         $pdfName = "Choose pdf Document";
         $sr =0;
     }    
     if(isset($_POST['pid'])){
    
   $cid=$_POST['pid'];
   
  
    $quariy = $con->query("SELECT * FROM UploadClientBrief WHERE Sr_no = $cid");
//     echo $quariy;
                    $num = mysqli_num_rows($quariy);
                    if ($num >= 0) {
                        while ($row = mysqli_fetch_array($quariy)) {
                          
                           $clientName= $row['Client_Name'];
                           $caseName=$row['Case_Name'];
                           $pdfName= $row['Pdf_Name'];
                           $sr= $row['Sr_no'];
                        }
                        }
                        //if (empty($clientName)){
//                        if($clientName === NULL){
//                            $clientName = "Please Choose Client Name";
//                        }
                   $clientName;
                   $caseName;
                  $pdfName;
                  $sr;
$path="ClientCaseData/$clientName/$caseName/ClientBrief/$pdfName";
//echo  $path;

}

//echo $sr."<br>";
//echo $clientName."<br>";
//echo $caseName."<br>";
//echo $pdfName."<br>";
//
//
//echo "<h1 Style='text-align: center; color:orange'>Under Development !!! </h2>";


if(isset($_POST['CTsubmit'])){
    $ctdate=$_POST['CTDate'];
    $ctstpg=$_POST['CTstpg'];
    $ctendpg=$_POST['CTendpg'];
    $ctdocType=$_POST['CTDT'];
    $ctcid=$_POST['CTsR'];
    $ctpdf=$_POST['CTpdf'];
    $cttitle=$_POST['CTtitle'];
    $cteditor=$_POST['CTeditor'];
    
    $client_name=$_POST['CTclientN'];
    $case_name=$_POST['CTcaseN'];
    
    
    
    
       $check=mysqli_num_rows(mysqli_query($con,"SELECT * from BreifTimeline_data Where Title='$cttitle'"));
if($check>0){
   $msgs="<br> This DATA is already present";
  //echo $msgs;
   
// }
}
else{

  $sql ="INSERT into BreifTimeline_data (Cid,St_pg,Ed_pg,Doc_type,Client_Name,Case_Name,Pdf_Name,Title,Content,Date) 
  VALUE('$ctcid','$ctstpg','$ctendpg','$ctdocType','$client_name','$case_name','$ctpdf','$cttitle','$cteditor','$ctdate')";
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
    
    <title>Add Client Brief</title>
    
  </head>
  <body>
     <?php include 'timelineheaader.php';?>
      
      
      <div class="container-fluid ">
         
          <div class="row">
              <div class="container-fluid p-0 col-xl-6  col-lg-6  col-md-6  col-sm-12">
                  <div class="continer-fluid vbg p-2 " id="timelinebars">
                       <a href="viewBrief.php" class="btn text-white ">view Client Brief</a>
                      <a href="CreateClientBreif.php"id="link_active" class="btn  text-white timelinelink">Create Client Brief</a>
                      
                  </div>
                <div class="container-fluid  ml-1 ">
                    
                                <form method="POST" action="">
                                    
                                                                    <div class="row">
                                     
                                          <div class="col-xl-6 col-lg-6 col-md-6 col-sm-2">
                                            <div class="form-group">
                                                <label class="font-weight-bold">Choose Document</label>
                                                <select class="form-control" style="width:100%;" name="Cidpdf" id="pdfct" placeholder="Choose UdploadDocs Type.."onchange="document.getElementById('text_CTPDF').value=this.options[this.selectedIndex].text">
<!--                                                    <option value="" disabled selected>Choose Pdf Document</option>-->
                                                        <option value=""disabled selected><?php echo $pdfName ?></option>
                                                        
                                                    <?php
                                                   $sql = mysqli_query($con, "SELECT * FROM UploadClientBrief");
                                                    while ($row = $sql->fetch_assoc()) {
//                                                        echo "<option value=".'ClientCaseData/'.$row['Client_Name'].'/'.$row['Client_Name'].'/'.$row['Pdf_Name'].">" . $row['Pdf_Name'] . "</option>";
                                                    
                                                        echo "<option value=" . $row['Sr_no'] . ">" . $row['Pdf_Name'] . "</option>";
                                                    }
                                                    ?>
                                                    </select>
                                                <input type="hidden" name="CTpdf" id="text_CTPDF" value="<?php echo $pdfName ?>" />
                                            </div>
                                        </div>
                                                                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-2">
                                            <div class="form-group">
                                                <label class="font-weight-bold">Document Type</label>
                                                <a class="ml-1" data-toggle="modal" data-target="#AddDocTy">
                                                    (ADD)
                                                </a><a class="ml-2" data-toggle="modal" data-target="#EditDocTy">
                                                    (Edit)
                                                </a><a class="ml-2" data-toggle="modal" data-target="#DelDocTy">
                                                    (Delete)
                                                </a>
                                                <select class="form-control" style="width:100%;"  id="Ctdy" placeholder="Choose Document Type.."onchange="document.getElementById('text_CTDT').value=this.options[this.selectedIndex].text">
                                                    <option value="" disabled selected>Choose Document Type</option>

                                                    <?php
                                                   $sql = mysqli_query($con, "SELECT * FROM Document_type");
                                                    while ($row = $sql->fetch_assoc()) {
                                                        echo "<option value=" . $row['Sr_no'] . ">" . $row['Document_name'] . "</option>";
                                                    }
                                                    ?>
                                                    </select>
                                                <input type="hidden" name="CTDT" id="text_CTDT" value="" />
                                            </div>
                                        </div>
                                                                        
                                </div>
                                <div class="row">
                                    
                                    <div class="col-xl-4 col-lg-4 col-md-3 col-sm-2">
                                            <div class="form-group">
                                                <label class="font-weight-bold">Choose Date</label>
                                                <input class="form-control" placeholder="Date" name="CTDate" id="CTDate" value="<?php echo Date('d/m/Y') ?>">
                                            </div>
                                        </div>
                                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-2">
                                            <div class="form-group">
                                                <label class="font-weight-bold">Start page</label>
                                                <input  type="number" class="form-control"name="CTstpg" placeholder="eg. 1" id="CTstpg">
                                            </div>
                                        </div>
                                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-2">
                                            <div class="form-group">
                                                <label class="font-weight-bold">End page</label>
                                                <input class="form-control"  type="number" name="CTendpg" placeholder="eg. 4" id="CTendpg">
                                            </div>
                                        </div>
                                    
                                    
                                </div>

                                  <div class="form-group">
                                                <label class="font-weight-bold">Enter Title</label>
                                                <input class="form-control" id="CTtitle"name="CTtitle" placeholder="Title">
                                            </div>
                                    
                                     <div class="form-group">
                                                <label class="font-weight-bold">Enter Content</label>
                                                <textarea class="form-control"id="editor" required name="CTeditor"  aria-label="With textarea"></textarea>
               
                                            </div>
                                    <div class="form-group">
                                        
                                        
                                        <button type="submit" name="CTsubmit" id="CTsubmit" class="btn btn-primary"> Submit</button>
                                    </div>
                                    
                                    <input type="hidden" name="CTclientN" id="CTcCTclientNlientN" value="<?php  echo $clientName; ?>">
                                     <input type="hidden" name="CTcaseN" id="CTcaseN" value="<?php  echo $caseName; ?>">
                                      <input type="hidden" name="CTsR" id="CTsR" value="<?php  echo $sr; ?>">
                                     
                                     
                                </form>
                            </div>
                            
                           <form method="POST" id="php" action="">
                                <input type="hidden" name="pid" id="path" value="<?php echo $sr?>">
                            
                            </form>  

                  
                  
                  
                  
                  
                  
              </div>
              <div class="container-fluid p-0 col-xl-6  col-lg-6  col-md-6  col-sm-12  ">
                  <div id="my_pdf_viewer" class="">
                    	<div id="navigation_controls" class="text-center vbg p-2">
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
<!--                           <hr class="bg-secondary">-->
                          
                    	<div id="canvas_container" class="mt-1 mb-1">
                           
                            <canvas id="pdf_renderer"></canvas> 
                        </div>
                           
<!--                              <hr class="bg-secondary">-->
    <div id="navigation_controls" class="text-center vbg">
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
          
          
          
          
          
          
      </div>
      
      



    
    
    
          <script>
          $("#tl").removeClass("active");
          $("#cb").addClass("active");
           $('select').select2();
           
            $("#CTDate").datepicker({ dateFormat: 'dd/mm/yy'});
         
           
CKEDITOR.replace('editor',{
      height: 500,
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
                        url: "UploadClientBrief/pdfDy.php",
                        type: "POST",
                        cache: false,
                        data: {countryId: cid},
                        success: function (data) {
                            console.log(data);
                            $("#pdfct").html(data);

                        }
                    });
                });
                
                 $("#pdfct").on("change", function () {
     var Cid = $("#pdfct").val();
       console.log(Cid);
     
     $("#path").val(Cid);
    $("#php").submit();
     
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
          
          
         
         var link= "<?php echo $path?>";
         
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






