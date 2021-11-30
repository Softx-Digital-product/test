<?php
include '../Database/Dp.php';
date_default_timezone_set('Asia/Kolkata');

ini_set('session.save_path', '../session');
session_start();
$tsr= $_SESSION['Tsr'];

if(isset($_POST['CaseName'])){
//    echo "<pre>";
//    print_r($_POST);
//    echo "</pre>";
    
    $cid= mysqli_real_escape_string($con, $_POST['dataid']);
    $CaseName=  mysqli_real_escape_string($con, $_POST['CaseName']);
    $caseid =  mysqli_real_escape_string($con, $_POST['ClientIds']);
    
    
    $cid= $_POST['dataid'];
    
    $sqlu="SELECT UploadClientBrief.Sr_no, ClientDb.Full_Name as Client_Name, Client_CaseDb.Case_Name as Case_Name, UploadClientBrief.Pdf_Name,UploadClientBrief.Pdf_Size,UploadClientBrief.Pdf_Pages,UploadClientBrief.DOU FROM UploadClientBrief,Client_CaseDb,ClientDb WHERE UploadClientBrief.CaseId = Client_CaseDb.Sr_no AND Client_CaseDb.Cid= ClientDb.Sr_no AND UploadClientBrief.CaseId = '{$caseid}'";
//echo $sqlu;
    $quariy = $con->query($sqlu);
//     echo $quariy;
                    $num = mysqli_num_rows($quariy);
                    if ($num >= 0) {
                        while ($row = mysqli_fetch_array($quariy)) {
                          
                           $clientName= $row['Client_Name'];
                           $caseName=$row['Case_Name'];
                           $pdfName= $row['Pdf_Name'];
                      
                        }
                        }
                        
$source ="ClientCaseData/$clientName/$caseName/ClientBrief/$pdfName";
 //  echo $path;
//   echo $_POST['CaseName'];
    ?>

 <div class="container-fluid  p-0" id="dycontents">
          <div class="row">
          <div class="col-xl-4 col-lg-4 col-md-4 p-0 col-sm-4">
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
                                    <tbody id="TimelineTable1">

                                        <?php
                                        $sr = 1;
                                        //echo  " Hello Tis".$cid;
//                                        $quariy = $con->query("SELECT * FROM BreifTimeline_data WHERE Cid={$cid} ORDER BY STR_TO_DATE(Date, '%d/%m/%Y' ) ASC");
                                        $sql="SELECT * FROM BreifTimeline_data WHERE Cid = {$cid} ORDER BY STR_TO_DATE(DATE, '%d/%m/%Y' ) ASC";
                                      //echo $sql;
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
                 <td scope="row" class="text-center" style="width:20%">       <button class="btn btn-secondary dropdown-toggle " type="button" id="dropdownMenuButtons" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    Add
  </button>
  <div class="dropdown-menu dymenu" aria-labelledby="dropdownMenuButton">
        <?php 
                    $srs=1;
                  //  $sqls="SELECT FlagsAccordion.FlagId as FlagSr, Flags.FlagName FROM FlagsAccordion,Flags WHERE Flags.Sr_no = FlagsAccordion.Flagid AND CaseId = '$cid'";
            $sqls="SELECT Document_type.Sr_no as FlagSr, Document_type.Document_name as FlagName FROM Document_type,BreifTimeline_data WHERE BreifTimeline_data.Doc_type = Document_name AND Case_Name = '$CaseName' Group By(FlagName)";
                    $quariys= $con->query($sqls);
                                   
                                        $num = mysqli_num_rows($quariys);
                                        if ($num >= 0) {
                                            while ($rows = mysqli_fetch_array($quariys)) {
                                                ?>
      
    <a class="dropdown-item Addbtn " id='dybtns<?php echo $row['Sr_no']?>'    data-animal-type="<?php echo $rows['FlagSr'];?>"><?php echo $rows['FlagName'];?></a>
    
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
          <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4  p-0 " id="middlecontain">
         <div class="container-fluid p-0 cc">
              <div class="row cc">
                  <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 ">
                      <button class="ml-3 btn btn-sm text-white" data-toggle="modal" data-target="#CreateFlags">Create Flag</button>
                  </div>
                  <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 ">
                 
              <select style="width:100%;" id="FlagId" class="form-group mt-1 mb-1" onchange="document.getElementById('FlagText').value = this.options[this.selectedIndex].text">
   <option value="" disabled selected>Please Choose Flag</option>
  
<?php 
$sql = mysqli_query($con, "SELECT * FROM Document_type");
while ($row = $sql->fetch_assoc()){
echo "<option value=".$row['Sr_no'].">".$row['Document_name']."</option>";
}
?>
              </select>
             <input  type="hidden"  id="FlagText" placeholder="">
                  </div>
                    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3">
                      <button class="ml-3 btn btn-sm text-white" data-toggle="modal" data-target="#EditFlags">Edit Flag</button>
                  </div>
                
              </div>
         </div><!-- Heading Ends -->
         
          <div class="container-fluid p-0 " id="dyflags">
           <div class="accordion p-0" id="accordionExamples">
                     
                    <?php 
                    $sr=1;
                 //   $sqls="SELECT FlagsAccordion.FlagId as FlagSr, Flags.FlagName FROM FlagsAccordion,Flags WHERE Flags.Sr_no = FlagsAccordion.Flagid AND CaseId = '$cid '";
//                  $sqls="SELECT *,Sr_no as FlagSr,Doc_type as FlagName FROM BreifTimeline_data WHERE Case_Name = '$CaseName' ";
                   $sqls ="SELECT Document_type.Sr_no as FlagSr, Document_type.Document_name as FlagName FROM Document_type,BreifTimeline_data WHERE BreifTimeline_data.Doc_type = Document_name AND Case_Name = '$CaseName' Group By(FlagName)";
//                echo $sqls;
                   $quariys= $con->query($sqls);
                                   
                                        $num = mysqli_num_rows($quariys);
                                        if ($num >= 0) {
                                            while ($row = mysqli_fetch_array($quariys)) {
                                                $fsr= $row['FlagSr'];
//                                                echo "<pre>";
//                                                print_r($row);
//                                                echo "</pre>";
                                                ?>
                    
                                             <div class="card p-0" id="Caccordion<?php echo $row['FlagSr'];?>">
    <div class="card-header p-0 cc" id="<?php echo $row['FlagSr'];?>">
      <h2 class="mb-0">
          <div class="row">
              <div class="col-xl-10 col-lg-10 col-md-10 col-sm-10">
                  <button class="btn  btn-block text-white text-center" type="button" onclick="show(<?php echo $row['FlagSr'];?>)" data-toggle="collapse" data-target="#<?php echo $row['FlagSr']; ?>" aria-expanded="true" aria-controls="collapseOne">
           <?php echo $row['FlagName'];?>
        </button>
              </div>
              <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2">
                  <button class="btn-danger text-white text-center  btn" style="background: #C70039 " onclick="Remove(<?php echo $row['FlagSr'];?>)">remove</button>
              </div>
          </div>
        
          
      </h2>
    </div>

    <div id="coll<?php echo $row['FlagSr'];?>" class="collapse " data-parent="#accordionExamples">
      <div class="card-body p-0">
         
          <div class="tables p-0 col-lg-12 col-md-12 col-sm-12 table-responsive ">

                                <table class="table table-striped table-bordered  table-hover p-0 " id="WTable<?php echo $row['FlagSr'];?>">
                                    <thead class="vbg text-white text-center">
<!--                                        <tr>
                                    Under process
                                        </tr>-->
                                    </thead>
                                    <tbody >
                                                  <?php
//                                       $tsql="SELECT * From Flagslists,BreifTimeline_data WHERE Flagslists.Bid= BreifTimeline_data.Sr_no AND Flagslists.CaseId= '$cid' AND Flagslists.FlagId ={$row['FlagSr']}";
                                      $tsql="SELECT * FROM BreifTimeline_data WHERE Case_Name ='$CaseName' AND Doc_type = '{$row['FlagName']}'; ";
//                                                  echo $tsql;
                                       $quariy= $con->query($tsql);
                                   
                                        $num = mysqli_num_rows($quariy);
                                        if ($num >= 0) {
                                            while ($rows = mysqli_fetch_array($quariy)) {
//                                                echo "<pre>";
//                                                print_r($rows);
//                                                echo "</pre>";
                                                ?>
                                       <tr class="copy_"<?php echo $rows['Title'];?>"table-striped'>
                                              <td class="text-center text-nowrap" scope="row"style="cursor:pointer; width:6%" data-toggle="tooltip" data-placement="top" title="<?php echo $rows['Date']?>"><?php echo $rows['Date']?></td>
                                              <?php // echo substr($rows['Title'],0,50); ?>
                                                   <td class="text-center text-nowrap" style="cursor:pointer;max-width:8rem;overflow:hidden;" scope="row" Onclick='Etpg(0,<?php echo $rows['St_pg'];?>)' data-toggle="tooltip" data-placement="top" title="<?php echo $rows['Title']?>"><?php echo $rows['Title'];?></td>
                                                    <td scope="row" class="text-center d-none"><?php echo $rows['Title']?></td>
                                                   <td class='Removes' style="cursor:pointer;width:6%;"><a class='nav-link text-center text-danger btn_remove' data-Bid-type="<?php echo $rows['Bid'];?>"data-Fsr-type="<?php echo $fsr;;?>">Rem</a></td>
                                                   <td class='d-none'><?php echo $rows['Bid'];?></td>
      
                                        </tr>
                                                
                                                <?php
                                            }
                                            }
                                       ?>
                                     
                                    </tbody>
                                </table>
              </div>
      </div>
    </div>
  </div>
                 
                     <?php
              
                                 $sr++;               
                                        }}
                    ?>
      
  
    </div>
             </div>
              
          </div>
          <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 p-0 ">
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
                            <a class="btn btn-primary btn-sm " herf="" download id="Download">D</a>
                           
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
                            <a class="btn btn-primary btn-sm " href="" download id="Download1">D</a>
                              
                        </div>
     
					</div>
          </div>
      </div>
      </div>
<script>
    
    function show(sr){
        //alert(sr);
//        $('.collapse').removeClass('show');
//        $("#coll"+sr).addClass("show");

if ( $("#coll"+sr).hasClass("show") ) {  
//      $('.collapse').removeClass('show');
    $('#coll'+sr).removeClass('show');
     
//     console.log("yes Exists");
     
    }else{
//           console.log("Not Exists");
   $('.collapse').removeClass('show');
         $("#coll"+sr).addClass("show");
         
    }
  
   
    }
    
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



if(isset($_POST['CreateFlag'])){
     $flagname= mysqli_real_escape_string($con, $_POST['CreateFlag']);
     
     $sql="INSERT INTO Flags(FlagName, Status, CreatedBy) VALUES ('$flagname',0,'$tsr')";
//     echo $sql;
  if ($con->query($sql) === TRUE) {
          $fq = mysqli_query($con, "SELECT * FROM Flags");
      echo " <option value='' disabled selected>Please Choose Flag </option>";
 while ($row = $fq->fetch_assoc()) {
 echo "<option value=" . $row['Sr_no'] . ">" . $row['FlagName'] . "</option>";
                                    }

  }else{
       echo "Error: ----->" .$sql . "<br>" . $con->error;
  }
    
    die();
}



if(isset($_POST['flagId'])){
     $flagId=  mysqli_real_escape_string($con, $_POST['flagId']);
     $caseId = trim(preg_replace('/\s\s+/', ' ', $_POST['CaseId']));
  ?>
<!--<div class="container-fluid p-0">-->
  
<!--       <div class="accordion p-0 " id="accordionExample">-->
                     
                    <?php 
                    $sr=1;
                    $sql="SELECT *,Document_name as FlagName FROM Document_type WHERE Sr_no = '$flagId'";
                      $quariy= $con->query($sql);
                               
       
                                        $num = mysqli_num_rows($quariy);
                                        if ($num >= 0) {
                                            while ($row = mysqli_fetch_array($quariy)) {
                                                ?>
           <input id="dybtn<?php echo $flagId?>" type="hidden" value=" <a class='dropdown-item Addbtn'  id='dybtns<?php echo $row['Sr_no']?>'  data-animal-type='<?php echo $row['Sr_no']?>'><?php echo $row['FlagName'];?></a>"/>
                        <div class="card p-0" id="Caccordion<?php echo $row['Sr_no'];?>">
    <div class="card-header  cc" id="<?php echo $row['Sr_no'];?>">
      <h2 class="mb-0">
          <div class="row">
              <div class="col-xl-10 col-lg-10 col-md-10 col-sm-10">
                  <button class="btn  btn-block text-white text-center" type="button" onclick="show(<?php echo $row['Sr_no'];?>)" data-toggle="collapse" data-target="#<?php echo $sr; ?>" aria-expanded="true" aria-controls="collapseOne">
           <?php echo $row['FlagName'];?>
        </button>
              </div>
              <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2">
                  <button class="btn-danger text-white text-center  btn" style="background: #C70039 " onclick="Remove(<?php echo $row['Sr_no'];?>)">remove</button>
              </div>
          </div>
        
          
      </h2>
    </div>

    <div id="coll<?php echo $row['Sr_no'];?>" class="collapse " data-parent="#accordionExample">
      <div class="card-body p-0">   
         
          <div class="tables p-0 col-lg-12 col-md-12 col-sm-12 table-responsive ">

                                <table class="table table-striped table-bordered  table-hover p-0 Acc " id="WTable<?php echo $row['Sr_no'];?>">
                                    <thead class="vbg text-white text-center">
                                        <tr>
<!--                                            <th d-none>Date</th>
                                            <th>Title </th>
                                            <th>Remove</th>-->
                                        </tr>
                                    </thead>
                                    <tbody >
                                       <?php
                                       $tsql="SELECT * From Flagslists,BreifTimeline_data WHERE Flagslists.Bid= BreifTimeline_data.Sr_no AND Flagslists.CaseId= '$caseId' AND Flagslists.FlagId ='$flagId'";
                                       $quariy= $con->query($tsql);
                                   
                                        $num = mysqli_num_rows($quariy);
                                        if ($num >= 0) {
                                            while ($rows = mysqli_fetch_array($quariy)) {
//                                                echo "<pre>";
//                                                print_r($rows);
//                                                echo "</pre>";
                                                ?>
                                       <tr class="copy_"<?php echo $rows['Title'];?>"table-striped'>
                                              <td class="text-center text-nowrap d-none" scope="row"style="cursor:pointer" data-toggle="tooltip" data-placement="top" title="<?php echo $rows['Date']?>"><?php echo $rows['Date']?></td>
                                                   <td class="text-center text-nowrap" style="cursor:pointer;width:80%" scope="row"style="" Onclick='Etpg(0,<?php echo $rows['St_pg'];?>)' data-toggle="tooltip" data-placement="top" title="<?php echo $rows['Title']?>"><?php echo substr($rows['Title'],0,50); ?></td>
                                                   <td class='Removes' style="cursor:pointer"><a class='nav-link text-center text-danger btn_remove' data-Bid-type="<?php echo $rows['Bid'];?>">Rem</a></td><td class='d-none'><?php echo $rows['Bid'];?></td>
      
                                        </tr>
                                                
                                                <?php
                                            }
                                            }
                                       ?>
                                    </tbody>
                                </table>
              </div>
      </div>
    </div>
  </div>
                 
                     <?php
                                 $sr++;               
                                        }}
                    ?>
      
  

<!--</div>
</div>-->
    <?php
    die();
}

if(isset($_POST['BriefSrno'])){
    
//    echo "<pre>";
//    print_r($_POST);
//    echo "</pre>";
//    
        $flagId=  mysqli_real_escape_string($con, $_POST['flagNo']);
 
        $caseId = trim(preg_replace('/\s\s+/', ' ', $_POST['caseNo']));
//          $caseId=  mysqli_real_escape_string($con, $_POST['caseNo']);
        $clientId = mysqli_real_escape_string($con, $_POST['clientNo']);
        $BriefSrno = mysqli_real_escape_string($con, $_POST['BriefSrno']);

    $sql="INSERT INTO Flagslists(FlagId,Bid,ClientId,CaseId, AddedBy) VALUES ('$flagId','$BriefSrno','$clientId','$caseId','$tsr')";
   echo $sql;
     if ($con->query($sql) === TRUE) {
         echo "inserted Successfully";
     }else{
         echo "Error: ----->" .$sql . "<br>" . $con->error;
     }
    die();
}


if(isset($_POST['RBriefSrno'])){
      
    
     $RflagNo=  mysqli_real_escape_string($con, $_POST['RflagNo']);
      $RclientNo=  mysqli_real_escape_string($con, $_POST['RclientNo']);
       $RcaseNo = trim(preg_replace('/\s\s+/', ' ', $_POST['RcaseNo']));
       $RBriefSrno=  mysqli_real_escape_string($con, $_POST['RBriefSrno']);
    
    
  $sql="DELETE FROM Flagslists WHERE Bid = '$RBriefSrno' AND FlagId ='$RflagNo' AND CaseId ='$RcaseNo' ";
  echo $sql;
       if ($con->query($sql) === TRUE) {
         echo "Deleted Successfully";
     }else{
         echo "Error: ----->" .$sql . "<br>" . $con->error;
     }
  
    
    
    die();
}



if(isset($_POST['AflagNo'])){
//        echo "<pre>";
//    print_r($_POST);
//    echo "</pre>";
    $AflagNo=  mysqli_real_escape_string($con, $_POST['AflagNo']);
      $AclientNo=  mysqli_real_escape_string($con, $_POST['AclientNo']);
       $AcaseNo = trim(preg_replace('/\s\s+/', ' ', $_POST['AcaseNo']));
     
       $check=mysqli_num_rows(mysqli_query($con,"SELECT * from FlagsAccordion Where FlagId ='$AflagNo' AND CaseId='$AcaseNo' "));
if($check>0){
    echo "This Accordion is already present";
}else{
     $sql="INSERT INTO FlagsAccordion(FlagId, ClientId, CaseId, Status,CreatedBy) VALUES ('$AflagNo','$AclientNo','$AcaseNo','0','$tsr')";
//    echo $sql;
    
      if ($con->query($sql) === TRUE) {
        echo "Added to Database";
          
      }else{
          echo "Error: ----->" .$sql . "<br>" . $con->error;
      }
}
   
    
    die();
}

if(isset($_POST['DAflagNo'])){
            echo "<pre>";
    print_r($_POST);
    echo "</pre>";
      $DAflagNo=  mysqli_real_escape_string($con, $_POST['DAflagNo']);
      $DAclientNo=  mysqli_real_escape_string($con, $_POST['DAclientNo']);
       $DAcaseNo = trim(preg_replace('/\s\s+/', ' ', $_POST['DAcaseNo']));
       
         $sql="DELETE FROM FlagsAccordion WHERE FlagId = '$DAflagNo' AND ClientId = '$DAclientNo' AND CaseId ='$DAcaseNo' ";
  echo $sql;
       if ($con->query($sql) === TRUE) {
         echo "Accordion Deleted Successfully";
     }else{
         echo "Error: ----->" .$sql . "<br>" . $con->error;
     }
       
       
    die();
}




// Edit Flags 

if(isset($_POST['Eid'])){
    echo $_POST['Eid'];
    echo $_POST['Ename'];
    $Eid=  mysqli_real_escape_string($con, $_POST['Eid']);
    $Ename=  mysqli_real_escape_string($con, $_POST['Ename']);
    
    $sql="UPDATE Flags SET FlagName ='$Ename' WHERE Sr_no = '$Eid' ";
    if ($con->query($sql) === TRUE) {
         echo "Flag Edited Successfully";
     }else{
         echo "Error: ----->" .$sql . "<br>" . $con->error;
     }
die();
}

if(isset($_POST['Did'])){
    
    $Did=  mysqli_real_escape_string($con, $_POST['Did']);
    
    $sql="DELETE FROM Flags WHERE Sr_no = '$Did'";
    if ($con->query($sql) === TRUE) {
         echo "Flags Deleted Successfully";
     }else{
         echo "Error: ----->" .$sql . "<br>" . $con->error;
     }
    
   die(); 
}


?>