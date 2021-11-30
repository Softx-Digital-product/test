<?php
include 'Timeline/Dp.php';

  header("Location:http://apajuris.in/work/errors.php");
    die();
 if(isset($_GET['v'])  && !empty($_GET['v']))
{
 $cid = $_GET['v'];
 //echo $cid;
   $quariy = $con->query("SELECT * FROM UploadClientBrief WHERE Sr_no = '{$cid}'");
    //print_r($quariy); 
                    $num = mysqli_num_rows($quariy);
                    if ($num >= 0) {
                        while ($row = mysqli_fetch_array($quariy)) {
                          
                           $clientName= $row['Client_Name'];
                           $caseName=$row['Case_Name'];
                           $pdfName= $row['Pdf_Name'];
                      
                        }
                        }
                        
$path="ClientCaseData/$clientName/$caseName/ClientBrief/$pdfName";
$id;

}



if(isset($_POST['pid'])){
    $id=$_Post['id'];
   $cid=$_POST['pid'];
  //echo $cid;
    $quariy = $con->query("SELECT * FROM UploadClientBrief WHERE Sr_no = $cid");
//     echo $quariy;
                    $num = mysqli_num_rows($quariy);
                    if ($num >= 0) {
                        while ($row = mysqli_fetch_array($quariy)) {
                          
                           $clientName= $row['Client_Name'];
                           $caseName=$row['Case_Name'];
                           $pdfName= $row['Pdf_Name'];
                      
                        }
                        }
                        
$path="ClientCaseData/$clientName/$caseName/ClientBrief/$pdfName";
$id;
//echo  $path;

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

        
                <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
        <script src='https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js'></script>
        
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/themes/ui-lightness/jquery-ui.min.css" integrity="sha512-NaCOGQe8bs7/BxJpnhZ4t4f4psMHnqsCxH/o4d3GFqBS4/0Yr/8+vZ08q675lx7pNz7lvJ6fRPfoCNHKx6d/fA==" crossorigin="anonymous" />
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        
          <script src="https://mozilla.github.io/pdf.js/build/pdf.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.0.943/pdf.min.js"></script>
        
    <title>Pdf Manager</title>
    <style>
        
                      div.dataTables_wrapper div.dataTables_filter input {
width:200px;
   
    overflow: hidden !important;
   
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

cc{
    height:40px;
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
.cc selete{
       padding:0px;
             height:-1px;
    margin-top: 5px;
    margin-bottom: 5px;
    width:10%;
    text-align: center;
}
.form-group{
     margin-top: 5px;
    margin-bottom: 0px;
} 
        </style>
  </head>
  <body>

      <?php include 'timelineheaader.php';?>

      <form method="POST" id="php" action="">
          <input type="hidden" name="pid" id="path">
          <input type="hidden" name="id" id="id">
                            </form>
      
       <?php
                           if(isset($_POST['pid']) || isset($_GET['v'])){
                                    
                           ?> 
      <div class="container-fluid">
          <div class="row">
              
              <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12  border-right p-0">
                  
                    <div class="tables p-0 col-lg-12 col-md-12 col-sm-12 table-responsive ">

                                <table class="table table-striped table-bordered  table-hover " id='Timelist'>
                                    <thead class="vbg text-white">
                                        <tr>
<!--                                            <th class="text-center" data-toggle="tooltip" data-placement="top" title="SR_NO" scope="col">SRN</th>-->
                                            <th class="text-center"data-toggle="tooltip" data-placement="top" title="Date of Creation"  scope="col">DOC</th>
                                             <th class="text-center"data-toggle="tooltip" data-placement="top" title="Document Type"  scope="col">Type</th>
                                            <th class="text-center"data-toggle="tooltip" data-placement="top" title="Title of Timeline"  scope="col">Title of Timeline</th>
<!--                                                            <th class="text-center"data-toggle="tooltip" data-placement="top" title="Description"  scope="col">DESC</th>-->
                                            <th class="text-center"data-toggle="tooltip" data-placement="top" title="Starting page"  scope="col">STR</th>
                        <!--                    <th class="text-center" scope="col">LPG</th>-->
                                            <th class="text-center" data-toggle="tooltip" data-placement="top" title="Ending page"  scope="col">END</th>
                            
                                            <th class="text-center"data-toggle="tooltip" data-placement="top" title="Add of Compilation"  scope="col">ADD</th>
                                             



                                        </tr>
                                    </thead>
                                    <tbody id="dytables">

                                        <?php
                                        $sr = 1;
                                        //echo  " Hello Tis".$cid;
//                                        $quariy = $con->query("SELECT * FROM BreifTimeline_data WHERE Cid={$cid} ORDER BY STR_TO_DATE(Date, '%d/%m/%Y' ) ASC");
                                        $sql="SELECT * FROM BreifTimeline_data WHERE Cid = {$cid} ORDER BY STR_TO_DATE(DATE, '%d/%m/%Y' ) ASC";
                                      // echo $sql;
                                        $quariy= $con->query($sql);
                                   
                                        $num = mysqli_num_rows($quariy);
                                        if ($num >= 0) {
                                            while ($row = mysqli_fetch_array($quariy)) {
                                                ?>
                                              
                                                    <tr id="row<?php echo $sr;?>">
<!--                                                    <th class="text-center" scope="row" style=""><?php echo $sr ?></th>-->                                                 
                                                   <td class="text-center text-nowrap" scope="row"style="" data-toggle="tooltip" data-placement="top" title="<?php echo $row['Date']?>"><?php echo $row['Date']?></td>
<!--                                                    <td class="text-center" scope="row"style=""><?php echo $row['Doc_type'] ?></td>-->
                                                                    <td class="text-center text-nowrap" scope="row"style="" data-toggle="tooltip" data-placement="top" title="<?php echo $row['Doc_type']?>"><?php echo substr($row['Doc_type'],0,10); ?></td>
<!--                                                    <td class="text-center" scope="row"style=""><?php echo $row['Title'] ?></td>-->
                                                                    <td class=" text-nowrap" scope="row"style="" data-toggle="tooltip" data-placement="top" title="<?php echo $row['Title']?>"><?php echo substr($row['Title'],0,20); ?></td>
<!--                                                                       <td class="text-nowrap" scope="row" data-toggle="tooltip" data-placement="top" title="<?php echo $row['Content']?>"><?php echo trim(substr($row['Content'],0,20))?></td>-->
                                                                       
                                                     <td class="text-center" scope="row" style="cursor: pointer;" onclick="Etpg(<?php echo $sr;?>,<?php echo $row['St_pg']?>)">
                                                     <a class="nav_link no " onclick="Etpg(<?php echo $sr;?>,<?php echo $row['St_pg']?>)"><?php echo $row['St_pg'] ?></a>
                                                    </td>
                                                 
              <td class="text-center" scope="row"style="cursor: pointer;" onclick="Etpg(<?php echo $sr;?>,<?php echo $row['Ed_pg']?>)">
                  <a class="nav_link no" onclick="Etpg(<?php echo $sr;?>,<?php echo $row['Ed_pg']?>)"><?php echo $row['Ed_pg'] ?></a>
                                                   
              </td>
              

           
             
<!--                <td class="text-nowrap" scope="row"   data-toggle="modal" data-target="#DescsModal"data-toggle="tooltip-top" title="<?php echo $row['Content']?>" onclick="DescB(<?php echo $row['Sr_no']?>)"><?php echo trim(substr($row['Content'],0,20))?></td>-->
                
<!--              <td class="text-center" scope="row"style=""><a class="btn btn-sm" onclick="Timelview('<?php echo $row['Cid']?>')">View</a></td>-->
<!--                    <td class="text-center" scope="row"style="cursor: pointer;"><a class="nav_link" onclick="phpviewer('<?php echo $row['Cid']?>','<?php echo $sr;?>')">View</a></td>-->
<!--                            <td class="text-center" scope="row"style=""><a class="nav-link"   data-toggle="modal" data-target="#EditTimeline" onclick="">Edit</a>-->
                    <td scope="row" class="text-center" style=""><a id="Addbtn"   class="Addbtn nav_link text-success" value="<?php echo $row['Pdf_Path']?>">ADD</a>


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
               <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 broder-right p-0">
                   <div class="container-fluid cc ">
                       <div class="row">
                           <div class="col-sm-4">
                                <button class="btn btn-sm text-white" data-toggle="modal" data-target="#CompilationName""> Create Compilation</button>
                           </div>
                           <div class="col-sm-6" id="dyselect">
                                 <div class="form-group">
<!--                                     <label class="font-weight-bolder">Select Compilation</label>-->
                                <select class="form-control"  style="width:100%;" id="Comilationselect" placeholder="Please Select Compilation "onchange="document.getElementById('CompiFileName').value = this.options[this.selectedIndex].text">
                                    <option value=""disabled selected>select Compilation</option>
<!--                                    <option value=""disabled selected><?php echo $caseName?></option>-->
                                    <?php
                                    $sql = mysqli_query($con, "SELECT * FROM Compilation");
                                    while ($row = $sql->fetch_assoc()) {
                                        echo "<option value=" . $row['Sr_no'] . ">" . $row['Cname'] . "</option>";
                                    }
                                    ?>
                                </select>
                                <input type="hidden" name="UCaseN" id="CompiFileName" value="<?php echo "null"; ?>" />
                            </div>
                           </div>
                           <div class="col-sm-2">
                                <button class="btn btn-sm text-white" id="create">Combine</button>
                           </div>
                       </div>
                      
                   </div>
                   
                 
                
                  <div class="tables p-0 table-responsive" >
                  <div class="table  mt-0 border table-bordered  table-striped">
  <table class="table" id="Mytable2"> 
      <thead class="vbg text-white">
<!--          <tr>
-->        
      <th scope="col">Date</th>
       <th scope="col">Title</th>
<!--       <th scope="col">Start</th>
       <th scope="col">end</th>-->
       <th scope="col">page</th>
      <th scope="col">Remove</th>
      <!--
</tr>-->

      </thead>
  <tbody class="tbodys">
<tr>
<!--       <th scope="col">Sr.NO</th> -->
<!--      <th scope="col">Date</th>
       <th scope="col">Type</th>
       <th scope="col">Title</th>
       <th scope="col">page</th>
      <th scope="col">Remove</th>-->
</tr>




</tbody>
  </table>
    
                      


  </div>
                  </div>
              </div>
              <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 p-0  ">
                  
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
                           <?php }?>
      
      
      <div class="modals">
          
          <!-- Modal -->
<div class="modal fade" id="CompilationName" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header" >
        <h5 class="modal-title" id="exampleModalLabel">Enter Name for Compilation</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <div class="container-fluid">
<!--              <form action="" method="POST">-->
                   <label>Enter Compilation Name</label>
              <input class="form-control " id="compiName" placeholder="Enter Name Here">
              <br>
                  <button type="button"  id="compidone" class="btn btn-primary">Done</button>
              <!--</form>-->
             
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
           $('select').select2();
      $('#PDFMNav').addClass("active");
     
      
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
                            console.log("srno:- "+ data);
                            $("#pdfct").html(data);
//                              var Cid = $("#pdfct").val();
//                                console.log(Cid);
     
                            $("#path").val(data);
                               var Cid = $("#path").val();
                               console.log(Cid);
                             $("#php").submit();
                        }
                    });
                });

      
      </script>
      
      <script>
           document.getElementById("compidone").addEventListener("click", Done);
    function Done() { 
        var clientname= "<?php echo $clientName?>";
        var casename= "<?php echo $caseName?>";
        
          $('#CompilationName').modal('hide');
         var compilation = $('#compiName').val();
         if(compilation == ""){
             alert("Compilation Name can't be Blank !!!");
         }else{
             console.log(compilation);
             
     var compilation= JSON.stringify(compilation);
     var clientn= JSON.stringify(clientname);
     var casen= JSON.stringify(casename);  
     //console.log(clientn);
      $.ajax({ 
     type: "POST", 
      url: "Compilation.php", 
       data: {compiname:compilation,Client:clientn,Case:casen},
      success: function(res) { 
        console.log(res);
    
       // $('#dyselect').html(res);
        
//        $('#dycaseN'+sr).html(res);
      location.reload();
 } 
       
}); 
             
             
         }
        // alert(compilation);
     }
          
          $(document).ready(function() {
//  var $tabs = $('#Timelist');
//  $("#dytables").sortable({
//    cursor:"move",
//    zIndex: 999990
//  }).disableSelection();
//

      
  var $tabs = $('#Mytable2');
  $(".tbodys").sortable({
    cursor:"move",
    zIndex: 999990
  }).disableSelection();


 $('#Timelist').DataTable({
//        "pagingType":"full_numbers",
            "bFilter": true,
            "bInfo": true,
            "sort":false,
            "lengthMenu": [
                [10, 25, 50, -1],
                [10, 25, 50, "All"]
            ],
            responsive: true,
            language: {
                //"search": "_INPUT_",
                searchPlaceholder: "Search Document"
            }
        });


$(".Addbtn").on("click",function(){
   // alert("Hello");
    
    var column1 = $(this).closest('tr').children()[0].textContent;
    console.log(column1);
//  var column2 = $(this).closest('tr').children()[1].textContent;
//  console.log(column2);
  var column3 = $(this).closest('tr').children()[2].textContent;
  console.log(column3);
  var column4 = $(this).closest('tr').children()[3].textContent;
    console.log("Start -> "+column4);
    var startpg = column4;
  var column5 = $(this).closest('tr').children()[4].textContent;
  console.log("End -> "+column5);
   var endpg = column5;
  column5++;
  
  column4 = column5-column4;
 if($("#Mytable2 .copy_"+column3).length==0)
  {
      $("#Mytable2").append("<tr class='copy_"+column3+"'><td scope='row'>" + column1 + "</td><td>" + column3 +"</td><td class='d-none'>"+startpg.trim()+"</td><td class='d-none'>"+endpg.trim()+"</td><td class='text-center'>" + column4 +"</td><td><a class='nav-link text-danger btn_remove'>Remove</a></td></tr>");
  
//    $("#Mytable2").append("<tr class='copy_"+column3+"'><td scope='row'>" + column1 + "</td><td>" + column2 +"</td><td>" + column3 +"</td><td class='text-center'>" + column4 +"</td><td><a class='nav-link text-danger btn_remove'>Remove</a></td></tr>");
  }
  else
  {
     var value = parseInt($("#Mytable2 .copy_"+column1+" input").val()) + 1;
     $("#Mytable2 .copy_"+column1+" input").val(value);
  }

});
$("body").on("click",".btn_remove", function() {
    $(this).parent().parent().remove();
});
      
});//Document end      
      
      </script>

      <script>
          
          function Etpg(id,pageno)
		{
$('#Timelist tr').removeClass("rowbg");
$('#Timelist tr').removeClass("no");
        $('#row'+id).addClass("rowbg");
        $('#row'+id).addClass("no");
        
//$('tr','#row'+id).addClass("rowbg");
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
				
				console.log(id+"  "+pageno);
				//$('#sampleTable tr').removeClass("rowbg");
				//$('#row'+id).addClass("rowbg");
			
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
		
		
		
		
		document.getElementById('go_next').addEventListener('click', (e) => {
            if(myState.pdf == null || myState.currentPage >= myState.pdf._pdfInfo.numPages) 
               return;
         
            myState.currentPage += 1;
                document.getElementById("current_page").value = myState.currentPage;
			document.getElementById("current_page1").value = myState.currentPage;		
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
				
				
//				$('#sampleTable tr').removeClass("rowbg");
//				$('#row'+id).addClass("rowbg");
			
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
      
      
      <script>
                  
                  $('#Download').hide();
                  $('#Download1').hide();
                  
                    document.getElementById("create").addEventListener("click", Compilation);
    function Compilation() { 
        
        var TableData = new Array();
    
$('.tbodys tr').each(function(row, tr){
    TableData[row]={
        "date" : $(tr).find('td:eq(0)').text()
        , "Title" :$(tr).find('td:eq(1)').text()
        , "Start" : $(tr).find('td:eq(2)').text()
        , "end" : $(tr).find('td:eq(3)').text()
    }
}); 
TableData.shift();

console.log(TableData);
 
        var pdfpath= "<?php echo $path ?>";

 var compilation = $('#CompiFileName').val();
 //console.log(compilation);
         if(compilation == "null"){
             alert("Compilation Name can't be Blank !!!");
         }else{
             console.log(compilation);
             
             
         }
        let myTab = document.getElementById('Mytable2');
     //   console.log(myTab);
  //let index = document.getElementById(1).cellIndex; 
  const xhr = new XMLHttpRequest();
  var dataString = new FormData();
                                
//dataString.append('upload_file',file[file_counter]);
 lists = new Array();

for (let i = 2; i < myTab.rows.length; i++) { 
            const objCells = myTab.rows.item(i).cells; 
            
            for (let j = 0; j <= 0; j++) { 
           // lists.push("PDFFiles/"+[objCells.item(j).innerHTML]); 
           lists.push([objCells.item(j).innerHTML]); 
           
//           if(j==4){
//               lists.push(" ");
//           }else{
//                lists.push([objCells.item(j).innerHTML]); 
//           }
           
            
//           lists.push[{'Title':[objCells.item(1).innerHTML],
//                    'Start':[objCells.item(2).innerHTML],
//                    'End':[objCells.item(3).innerHTML]
//                }];
//           console.log([objCells.item(j).innerHTML]);



        
            } 
                  
}

         
//for(let i = 0; i < lists.length; i++){
//    
//  console.log("arraylist --> "+lists[i]);
//}
var compilationid= $("#Comilationselect").val();
           var Jsons = JSON.stringify(lists);
           var compiId = JSON.stringify(compilationid);
           var datas= JSON.stringify(TableData);
var Fnames= JSON.stringify(compilation);
var Pdfpath= JSON.stringify(pdfpath);

console.log(compilationid);
$.ajax({ 
       type: "POST", 
       url: "Compilation.php", 
       data: {array : Jsons,Fname: Fnames,Pdf:Pdfpath,data:datas,Cid:compiId},
       success: function(res) { 
         console.log(res);
              alert("Success"); 
              var compifile = 'PdfManager/'+compilation;
              console.log(compifile);
              
              $('#Download').show();
              $('#Download1').show();
              $("#Download").attr("href", compifile);
              $("#Download1").attr("href", compifile);
               pdfjsLib.getDocument(compifile).then((pdf) => {
       myState.pdf = pdf;
        pdfDoc = pdf;
	   render();
           //myState.showPreviousViewOnLoad = false;
           
 });
              
             // PDFObject.embed("Merged/"+FName+".pdf","#pdf_view");   
        } 
        
}); 
    }
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