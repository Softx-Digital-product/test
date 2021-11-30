<?php 
include '../Database/Dp.php';

date_default_timezone_set('Asia/Kolkata');
ini_set('session.save_path', '../session');
session_start();
$tsr= $_SESSION['Tsr'];

if(isset($_POST['caseId'])){
      $cid= mysqli_real_escape_string($con, $_POST['caseId']);
    $CaseName=  mysqli_real_escape_string($con, $_POST['CaseName']);
     $sqlu="SELECT UploadClientBrief.Sr_no, ClientDb.Full_Name as Client_Name, Client_CaseDb.Case_Name as Case_Name, UploadClientBrief.Pdf_Name,UploadClientBrief.Pdf_Size,UploadClientBrief.Pdf_Pages,UploadClientBrief.DOU FROM UploadClientBrief,Client_CaseDb,ClientDb WHERE UploadClientBrief.CaseId = Client_CaseDb.Sr_no AND Client_CaseDb.Cid= ClientDb.Sr_no AND UploadClientBrief.CaseId = '{$cid}'";
//echo $sqlu;
      $quariy = $con->query($sqlu);
//     echo $quariy;
                    $num = mysqli_num_rows($quariy);
                    if ($num >= 0) {
                        while ($row = mysqli_fetch_array($quariy)) {
                          
                           $clientName= $row['Client_Name'];
                           $caseName=$row['Case_Name'];
                           $pdfName= $row['Pdf_Name'];
                           $pdfSr= $row['Sr_no'];
                      
                        }
                        }
                        
$source ="ClientCaseData/$clientName/$caseName/ClientBrief/$pdfName";

    ?>
<div class="container-fluid p-0 ">
    <div class="row">
        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 p-0">
           <div class="tables p-0 col-lg-12 col-md-12 col-sm-12 table-responsive ">

                                <table class="table table-striped table-bordered  table-hover p-0 " id='Timelist'>
                                    <thead class="vbg text-white">
                                        <tr>
<!--                                            <th class="text-center" data-toggle="tooltip" data-placement="top" title="SR_NO" scope="col">SRN</th>-->
                                            <th class="text-center"data-toggle="tooltip" data-placement="top" title="Date of Creation"  scope="col">DOC</th>
                                             <th class="text-center"data-toggle="tooltip" data-placement="top" title="Document Type"  scope="col">Type</th>
                                            <th class="text-center"data-toggle="tooltip" data-placement="top" title="Title of Timeline"  scope="col">Title of Timeline</th>
<!--                                                            <th class="text-center"data-toggle="tooltip" data-placement="top" title="Description"  scope="col">DESC</th>-->
                                            <th class="text-center d-none"data-toggle="tooltip" data-placement="top" title="Starting page"  scope="col">STR</th>
                        <!--                    <th class="text-center" scope="col">LPG</th>-->
<!--                                            <th class="text-center" data-toggle="tooltip" data-placement="top" title="Ending page"  scope="col">END</th>-->
                                            <th class="d-none">titles</th>
                                            <th class="d-none">sr_no </th>
                                            <th class="text-center"data-toggle="tooltip" data-placement="top" title="Add of Sorting"  scope="col">ADD</th>
<!--                                             <th class="text-center"data-toggle="tooltip" data-placement="top" title="To Sorting"  scope="col">To</th>-->



                                        </tr>
                                    </thead>
                                    <tbody class="tbodys1">

                                        <?php
                                        $sr = 1;
                                        //echo  " Hello Tis".$cid;
//                                        $quariy = $con->query("SELECT * FROM BreifTimeline_data WHERE Cid={$cid} ORDER BY STR_TO_DATE(Date, '%d/%m/%Y' ) ASC");
                                        $sql="SELECT * FROM BreifTimeline_data WHERE Cid = {$pdfSr} ORDER BY STR_TO_DATE(DATE, '%d/%m/%Y' ) ASC";
                                    //  echo $sql;
                                        $quariy= $con->query($sql);
                                   
                                        $num = mysqli_num_rows($quariy);
                                        if ($num >= 0) {
                                            while ($row = mysqli_fetch_array($quariy)) {
                                                
//                                                echo "<pre>";
//                                                print_r($row);
//                                                echo "</pre>";
                                                ?>
                                              
                                                    <tr id="row<?php echo $sr;?>">
                                                                                                
                                                   <td class="text-center text-nowrap" scope="row"style="width:10%" data-toggle="tooltip" data-placement="top" title="<?php echo $row['Date']?>"><?php echo $row['Date']?></td>
                                                   <td class="text-center text-nowrap" scope="row"style="width:10%" data-toggle="tooltip" data-placement="top" title="<?php echo $row['Doc_type']?>"><?php echo substr($row['Doc_type'],0,10); ?></td>
                                                    <td class=" text-nowrap" scope="row"style="max-width:3rem; cursor:pointer;overflow: hidden" onclick="Etpg(<?php echo $sr;?>,<?php echo $row['St_pg']?>)" data-toggle="tooltip" data-placement="top" title="<?php echo $row['Title']?>"><?php echo $row['Title'] ?></td>
                                                    <td class="text-center d-none" scope="row" style="cursor: pointer;" onclick="Etpg(<?php echo $sr;?>,<?php echo $row['St_pg']?>)">
                                                     <a class="nav_link no " ><?php echo $row['St_pg'] ?></a> </td>
     
 <td scope="row" class="text-center d-none"><?php echo $row['Title']?></td>
  <td scope="row" class="text-center d-none"><?php echo $row['Sr_no']?></td>          
             
           
<!--                    <td scope="row" class="text-center" style=""><a id="Addbtn"   class="Addbtn nav_link text-success" value="<?php echo $row['Pdf_Path']?>">ADD</a>
                        -->
                 <td scope="row" class="text-center" style="width:10%">       <button class="btn btn-secondary dropdown-toggles  Addbtn" type="button" id="dropdownMenuButtons" data-toggle="dropdowns" aria-haspopup="true" aria-expanded="false">
    Add
  </button>
  <div class="dropdown-menus dymenu" aria-labelledby="dropdownMenuButton">
        <?php 
                    $srs=1;
                  //  $sqls="SELECT FlagsAccordion.FlagId as FlagSr, Flags.FlagName FROM FlagsAccordion,Flags WHERE Flags.Sr_no = FlagsAccordion.Flagid AND CaseId = '$cid'";
            $sqls="SELECT Document_type.Sr_no as FlagSr, Document_type.Document_name as FlagName FROM Document_type,BreifTimeline_data WHERE BreifTimeline_data.Doc_type = Document_name AND Case_Name = '$CaseName' Group By(FlagName)";
                    $quariys= $con->query($sqls);
                                   
                                        $num = mysqli_num_rows($quariys);
                                        if ($num >= 0) {
                                            while ($rows = mysqli_fetch_array($quariys)) {
                                                ?>
      
<!--    <a class="dropdown-item Addbtn " id='dybtns<?php echo $row['Sr_no']?>'    data-animal-type="<?php echo $rows['FlagSr'];?>"><?php echo $rows['FlagName'];?></a>
    -->
    <?php
                                        }}
    ?>
  </div></td>
<!--                       <td scope="row" class="text-center" style=""><a id="Addbtn"   class="Addbtn nav_link text-success" value="<?php echo $row['Pdf_Path']?>">To</a>
                       -->

                                                </tr>
                                                <?php
                                                $sr++;
                                            }
                                        }else{
                                            echo "No Data Found !!!";
                                        }
                                        ?>
                                    </tbody>
                                </table>
                    </div>
        </div>
        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 p-0 ">
            <div class="container-fluid text-center text-white pt-3 cc ">
          Pleadings 
         </div>
               <div class="tables p-0 table-responsive" >
                  <div class="table  mt-0 table-bordered table-hover   ">
  <table class="table sortable " id="WTable" > 
      <thead class="vbg text-white p-3 ">
<!--          <tr>
-->        
      <th onclick="sort_name()" class="text-center d-none" scope="col">Date</th>
       <th onclick="sort_name()" scope="col"class="text-center">Title</th>
<!--       <th scope="col">Start</th>
       <th scope="col">end</th>-->
<!--       <th onclick="sort_name()" scope="col"class="text-center">STPG</th>-->
      <th  onclick="sort_name()" scope="col" class="text-center">REM</th>
      <!--
</tr>-->

      </thead>
  <tbody class="tbodys p-0" >
<!--      <tr class="p-5">
          <td scope="row" class="p-3">04/10/2020</td>
          <td scope="row" class="p-3">Testing Doc</td>
          <td scope="row" class="p-3">30</td>
          <td scope="row" class="p-3">Rem</td>

      </tr>-->
          

<!--<tr>
       <th scope="col">Sr.NO</th> 
      <th scope="col">Date</th>
       <th scope="col">Type</th>
       <th scope="col">Title</th>
       <th scope="col">page</th>
      <th scope="col">Remove</th>
</tr>-->
      
      <?php 
          $sql="SELECT * From Pleading,BreifTimeline_data WHERE BreifTimeline_data.Sr_no = Pleading.Bid AND CaseId ='$cid'";
                                     // echo $sql;
                                        $quariy= $con->query($sql);
                                   
                                        $num = mysqli_num_rows($quariy);
                                        if ($num >= 0) {
                                            while ($rowi = mysqli_fetch_array($quariy)) {
                                                ?>
           <tr class='copy_<?php echo $rowi['Title']; ?> table-striped'>
            <td scope='row'class='text-center d-none Dates'  style='width:8%;'> <?php echo rowi['Date'];?> </td>
            <td class='text-center Totals text-nowrap' data-toggle='tooltip' data-placement='top'  title="<?php echo $rowi['Title']; ?>" style='cursor:pointer;max-width:8rem;overflow:hidden' Onclick='Etpg(0,<?php echo $rowi['St_pg']; ?>)'><?php echo $rowi['Title']; ?></td>
            <td class='d-none'><?php echo $rowi['Title']; ?></td>
            <td class='Removes' style='width:8%'><a class='nav-link text-center text-danger btn_remove' data-Bid-type="<?php echo $rowi['Bid']; ?>">Rem</a>
            </td><td class='d-none'><?php echo $rowi['Bid']; ?></td>
        </tr>
      
      <?php
                                            }
                                        }

      ?>



</tbody>
  </table>

                      
<input type="hidden" id="name_order" value="asc">
<input type="hidden" id="age_order" value="asc">

  </div>
                  </div>
     
         
        </div>
        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 p-0">
            <div id="my_pdf_viewer" class=" ">
                    	<div id="navigation_controls" class="text-center cc">
                              <button class="btn btn-primary btn-sm" id="Firstpg">First page</button>
                              <button class="btn btn-primary btn-sm" id="Lastpg">Last page</button>
                            <button class="btn btn-primary btn-sm" id="go_previous">Previous</button>
                             <button class="btn btn-primary btn-sm" id="go_next">Next</button>
                            <input id="current_page" class="from-conrol-sm"value="1" type="number"/>
                           
                            <button class="btn btn-primary btn-sm" id="zoom_in">+</button>
                            <button class="btn btn-primary btn-sm" id="zoom_out">-</button>
                            <button class="btn btn-primary btn-sm" id="rotate_page">R</button>
                           
                           
                        </div> 
                  <div class="loaderinfo  mb-1  mt-5 border-left">  </div>
                  
                    	<div id="canvas_container" class="mt-1 mb-1 border-left">
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
                           
                              
                        </div>
     
					</div>
        </div>
    </div>
</div>
<script>
    
   
    
    function Etpg(id,pageno)
		{
                    $('.loaderinfo').html("<div class='container text-center loader mt-5'><img src='images/loader.gif' class='text-center mt-5'/></div>");
     
//$('#Timelist tr').removeClass("rowbg");
//$('#Timelist tr').removeClass("no");
//        $('#row'+id).addClass("rowbg");
//        $('#row'+id).addClass("no");
        
//$('tr','#row'+id).addClass("rowbg");
			var desiredPage = pageno;
			if(desiredPage >= 1  && desiredPage <= myState.pdf._pdfInfo.numPages) {
                        myState.currentPage = desiredPage;
	document.getElementById("current_page").value = desiredPage;
	document.getElementById("current_page1").value = desiredPage;
                        render();
                }
				
				console.log(id+"  "+pageno);
				//$('#sampleTable tr').removeClass("rowbg");
				//$('#row'+id).addClass("rowbg");
			
		}
          
    
    $('.loaderinfo').html("<div class='container text-center loader mt-5'><img src='images/loader.gif' class='text-center mt-5'/></div>");
      
  //  viewpdfdata('<?php echo $source; ?>');
   //  const viewdatapdf = viewpdfdata = (source) =>{
//    function viewpdfdata(soruce){
        
        var myState = {
        pdf: null,
        currentPage: 1,
        zoom: 1,
       cache: true,
       enableHandToolOnLoad: true
    }
   
var source ="<?php echo $source;?>";

//  pdfjsLib.getDocument({ url: source }, false, null, function(progress) {
//	var percent_loaded = (progress.loaded/progress.total)*100;
//        console.log(percent_loaded);
//}).then(function(pdf_doc) {
//	render();
//        console.log(pdf_doc);
//}).catch(function(error) {
//	// error
//        console.log(error);
//});

       pdfjsLib.getDocument("<?php echo $source;?>").then((pdf) => {
       myState.pdf = pdf;
        pdfDoc = pdf;
        
	   render();
           //myState.showPreviousViewOnLoad = false;
       
        finaltotal = pdf.numPages;
        console.log(pdf.numPages);
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
		 
//		page.render({
//			canvasContext: ctx,
//			viewport: viewport,
//                                                        
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
        
        document.getElementById('go_previous').addEventListener('click', (e) => {
            if(myState.pdf == null  || myState.currentPage == 1) return;
            myState.currentPage -= 1;
            document.getElementById("current_page") .value = myState.currentPage;
            document.getElementById("current_page1") .value = myState.currentPage;
            render();
        });
        
        document.getElementById('go_previous1') .addEventListener('click', (e) => {
            if(myState.pdf == null   || myState.currentPage == 1) return;
            myState.currentPage -= 1;
            document.getElementById("current_page") .value = myState.currentPage;
            document.getElementById("current_page1").value = myState.currentPage;		
            render();
        });
        
        
        document.getElementById('go_next').addEventListener('click', (e) => {
            if(myState.pdf == null || myState.currentPage >= myState.pdf._pdfInfo.numPages) 
               return;
         
            myState.currentPage += 1;
                document.getElementById("current_page").value = myState.currentPage;
                document.getElementById("current_page1").value = myState.currentPage;		
            render();
        });

        document.getElementById('go_next1').addEventListener('click', (e) => {
            if(myState.pdf == null  || myState.currentPage >= myState.pdf ._pdfInfo.numPages) 
               return;
         
            myState.currentPage += 1;
            document.getElementById("current_page1").value = myState.currentPage;
            document.getElementById("current_page") .value = myState.currentPage;
            render();
        });
        
        document.getElementById('current_page').addEventListener('keypress', (e) => {
            if(myState.pdf == null) return;
         
            // Get key code
            var code = (e.keyCode ? e.keyCode : e.which);
         
            // If key code matches that of the Enter key
            if(code == 13) {
                var desiredPage =  document.getElementById('current_page') .valueAsNumber;             
                if(desiredPage >= 1   && desiredPage <= myState.pdf ._pdfInfo.numPages) {
                        myState.currentPage = desiredPage;
                        document.getElementById("current_page") .value = desiredPage;
	document.getElementById("current_page1") .value = desiredPage;
                        render();
                }
            }
        });
		
document.getElementById('current_page1') .addEventListener('keypress', (e) => {
            if(myState.pdf == null) return;
         
            // Get key code
            var code = (e.keyCode ? e.keyCode : e.which);
         
            // If key code matches that of the Enter key
            if(code == 13) {
                var desiredPage = document.getElementById('current_page1') .valueAsNumber;                  
                if(desiredPage >= 1 && desiredPage <= myState.pdf._pdfInfo.numPages) {
                        myState.currentPage = desiredPage;
                        document.getElementById("current_page").value = desiredPage;
	document.getElementById("current_page1") .value = desiredPage;
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
		
		
		
		document.getElementById('zoom_out') .addEventListener('click', (e) => {
            if(myState.pdf == null) return;
    $("#pdf_renderer").css("width", "auto");
            myState.zoom -= 0.1;
            render();
        });
		
        
        document.getElementById('zoom_out1').addEventListener('click', (e) => {
            if(myState.pdf == null) return;
            $("#pdf_renderer").css("width", "auto");
            myState.zoom -= 0.1;
            render();
        });
		
		var deg = 90;
		document.getElementById('rotate_page') .addEventListener('click', (e) => {
             if(myState.pdf == null) return; 
			 $("#pdf_renderer").css("transform", "rotate("+deg+"deg)"); 
            render();
			deg = deg + 90; 
        });
		
        document.getElementById('rotate_page1').addEventListener('click', (e) => {
             if(myState.pdf == null) return; 
    $("#pdf_renderer").css("transform", "rotate("+deg+"deg)"); 
            render();
            deg = deg + 90; 
        });




document.getElementById("Firstpg").addEventListener("click", Firstpg0);
    function Firstpg0() { 
        //console.log("Hello i am First page");
        $("#current_page").val(1);
        $("#current_page1").val(1);
        
        myState.currentPage = 1;
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
    
               document.getElementById("Lastpg").addEventListener("click", Lastpg0);
    function Lastpg0() { 
        //console.log("Hello i am First page");
       
       // document.getElementById('#current_page').textContent = pdfDoc.numPages;
        $("#current_page").val(pdfDoc.numPages);
        $("#current_page1").val(pdfDoc.numPages);
        
        
        myState.currentPage = pdfDoc.numPages;
        
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
  
    
             
        
   // }
</script>
    
   <?php 
    die();
}




if(isset($_POST['briefSrno'])){
    
    $CaseId= mysqli_real_escape_string($con, $_POST['caseNo']);
    $ClientId=  mysqli_real_escape_string($con, $_POST['clientNo']);
    $Briefid= mysqli_real_escape_string($con, $_POST['briefSrno']);
   
    
  $sql="INSERT INTO Pleading(ClientId, CaseId, Bid, Position, CreatedBy) VALUES ('$ClientId','$CaseId','$Briefid','0','$tsr')";
      if ($con->query($sql) === TRUE) {
          echo "Added Successfully";
      }else{
           echo "Error: ----->" .$sql . "<br>" . $con->error;
      }
    die();
}

if(isset($_POST['RBriefSrno'])){
    
      $CaseId= mysqli_real_escape_string($con, $_POST['RcaseNo']);
    $ClientId=  mysqli_real_escape_string($con, $_POST['RclientNo']);
    $Briefid= mysqli_real_escape_string($con, $_POST['RBriefSrno']);
    
    $sql="DELETE FROM Pleading WHERE Bid = '$Briefid' AND  CaseId= '$CaseId' AND ClientId= '$ClientId'";
          if ($con->query($sql) === TRUE) {
              echo "Deleted Successfully";
          }else{
              echo "Error ===> ".$sql. "<br>".$con->error;
          }

    
    die();
}
?>
