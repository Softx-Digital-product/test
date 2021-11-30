<?php include 'Database/Dp.php'; ?>


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

          <link rel='stylesheet' href='https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css'>
   <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
        <script src='https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js'></script>    
        
         <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
         <script src="https://mozilla.github.io/pdf.js/build/pdf.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.0.943/pdf.min.js"></script>
    
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/themes/ui-lightness/jquery-ui.min.css" integrity="sha512-NaCOGQe8bs7/BxJpnhZ4t4f4psMHnqsCxH/o4d3GFqBS4/0Yr/8+vZ08q675lx7pNz7lvJ6fRPfoCNHKx6d/fA==" crossorigin="anonymous" />
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

        
    <title>Pleading</title>
    <style>
        .tooltip { 
    pointer-events: none;
}
cc{
    height:50px;
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
/*             height:-1px;*/
    margin-top: 5px;
    margin-bottom: 5px;
    width:10%;
    text-align: center;
}
.form-group{
     margin-top: 5px;
    margin-bottom: 0px;
} 
tooltip{
    font-size: 16px;
   
}
  .tooltip-inner {
      font-size:16px;
                background-color:  #00ace6;
              max-width: 80% !important;
            }
    </style>
  </head>
  <body>
  <?php include 'Navbars.php';?>
      <div class="topnav1">
          <a href="pleading.php" class="nav__link active ">Create Pleadings</a>
          <a id='vp' href="viewPleading.php" class="nav_link ">View Pleadings</a>
            <a id="book"href="Bookmark.php" class="nav_link ">Bookmark</a>
             
<!--             <a href="" class="nav_link ">View BookMarks</a>-->
            <div class="row">

                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="form-group mt-2 mb-1">
                                <!--                                <label class="font-weight-bolder" for="exampleFormControlSelect1">Select Client Name</label>-->

                                <select class="CN" id="ClientN" style="width:100%;" placeholder="Please Select Client Name"onchange="document.getElementById('text_CT').value = this.options[this.selectedIndex].text">
<!--                                    <option value=""disabled selected>Please Choose Client Name</option>-->
                                    <option value=""disabled selected>Please Choose Client </option>
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
                                <input type="hidden" name="ClientName" id="text_CT" value="<?php echo $row['Full_Name']; ?>" />
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6">

                            <div class="form-group mt-2 mb-1">
                                <!--                            <label class="font-weight-bolder" for="exampleFormControlSelect1">Select Case Name</label>-->
                                <select class="CN"  style="width:100%;" id="CaseName" placeholder="Please Select Client Name"onchange="document.getElementById('text_CN').value = this.options[this.selectedIndex].text">
<!--                                    <option value=""disabled selected>Please Choose Case Name</option>-->
                                    <option value=""disabled selected>Please Choose Case</option>
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



                    </div>

      </div>
<!--      <div class="container-fluid p-0 vbg">
         <div class="container">

                    <form method="POST" action="" enctype="multipart/form-data">
                <div class="container">

                    <div class="row">

                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="form-group mt-1 mb-1">
                                                                <label class="font-weight-bolder" for="exampleFormControlSelect1">Select Client Name</label>

                                <select class="CN" id="ClientN" style="width:100%;" placeholder="Please Select Client Name"onchange="document.getElementById('text_CT').value = this.options[this.selectedIndex].text">
                                    <option value=""disabled selected>Please Choose Client Name</option>
                                    <option value=""disabled selected>Please Choose Client </option>
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
                                <input type="hidden" name="ClientName" id="text_CT" value="<?php echo $row['Full_Name']; ?>" />
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12">

                            <div class="form-group mt-1 mb-1">
                                                            <label class="font-weight-bolder" for="exampleFormControlSelect1">Select Case Name</label>
                                <select class="CN"  style="width:100%;" id="CaseName" placeholder="Please Select Client Name"onchange="document.getElementById('text_CN').value = this.options[this.selectedIndex].text">
                                    <option value=""disabled selected>Please Choose Case Name</option>
                                    <option value=""disabled selected>Please Choose Case</option>
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



                    </div>

                </div>

            </div>
      </div>-->
      
      <div class="container-fluid" id="dycontents">
          
      </div>
      
      
      
<?php include 'pleading/Modals.php';?>
 <?php 
      
      if(isset($_GET['c']) && isset($_GET['v']) ){
      $clientid= mysqli_real_escape_string($con, $_GET['c']);
        $caseid= mysqli_real_escape_string($con, $_GET['v']);
?>
<script>
    $( document ).ready(function() {
   $("#cp").attr("href", "Pleadings.php?c="+<?php echo $clientid;?>+"&v="+<?php echo $caseid;?>);
   $('#ClientN').val(<?php echo $clientid?>);
   $("#ClientN").trigger("change");

   $('#CaseName').val('<?php echo $caseid?>');
   $("#CaseName").trigger("change");
});
    </script>
<?php
}
      ?>
<script>
    $('#mybottomnav').addClass('d-none');
//        $('.topnav1').addClass('d-none');
        $('#CM').removeClass('active');
        $('#pl').addClass('active');
        
        
        $('select').select2();
       
    </script>
    
    
    <script>
      $("#ClientN").on("change", function () {
                    var category = $("#ClientN").val();

                    console.log(category);

                    var cid = JSON.stringify(category);
                    $.ajax({
//                        url: "UploadCase/CaseNameDy.php",
                        url:"Calendar/function.php",
                        type: "POST",
                        cache: false,
                        data: {clientdids: cid},
                        success: function (data) {
                            console.log(data);
                            $("#CaseName").html(data);
                            
                            <?php
                                if(isset($_GET['c']) && isset($_GET['v']) ){
                                   ?>
                                                  $('#CaseName').val('<?php echo $caseid?>');
   $("#CaseName").trigger("change");  
                                                   <?php
                                }
                            
                            ?>

                        }
                    });
                });
                
                $("#CaseName").on("change",function(){
                    var clientId = $("#ClientN").val();
                    var caseId= $('#CaseName').val();
                    var caseName=$("#CaseName option:selected");
                    var caseName= caseName.text();
                    
                    $("#vp").attr("href", "viewPleading.php?c="+clientId+"&v="+caseId);
                     $("#book").attr("href", "Bookmark.php?c="+clientId+"&v="+caseId);
                    
              $('#dycontents').html("<div class='container text-center'><img src='images/loadings.gif' class='text-center mt-5'/></div>");
                 
                   $.ajax({
                        url: "pleading/function.php",
                        type: "POST",
                        cache: false,
                        data: {CaseName: caseName,caseId:caseId},
                        success: function (res) {
                            $('#dycontents').html(res);
        var $tabs = $('#Timelist');
  $(".tbodys").sortable({
    cursor:"move",
    zIndex: 999990
  }).disableSelection();
                              $( document ).ready(function() {
                            
                           $('#Timelist').DataTable({
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
                searchPlaceholder: "Search Timeline"
            }
        });
    
});
                         $(function () {
  $('[data-toggle="tooltip"]').tooltip();
});

   $(".Addbtn").on("click",function(){
                                   
var Asr = $(this).attr("data-animal-type");
//show(Asr);

  console.log("========== 1st Adding Department=========");
   let myTab = document.getElementById('WTable');
       console.log(myTab);
  //let index = document.getElementById(1).cellIndex; 
  
var check = new Array();

for (let i = 1; i < myTab.rows.length; i++) { 
            const objCells = myTab.rows.item(i).cells; 
         //   console.log(objCells);
            for (let j = 2; j <= 2; j++) { 
//                console.log(objCells.item(j));
           // lists.push("PDFFiles/"+[objCells.item(j).innerHTML]); 
           check.push([objCells.item(j).innerHTML]); 

            } 
                  
}
console.log(check);
   
   
    
    var column1 = $(this).closest('tr').children()[0].textContent;
    console.log("col=1 "+column1);
  var column2 = $(this).closest('tr').children()[1].textContent;
  console.log("col=2 "+column2);
  var column3 = $(this).closest('tr').children()[2].textContent;
  console.log("col=3 "+column3);
  var column4 = $(this).closest('tr').children()[3].textContent;
    console.log("col=4 "+column4);
    var startpg = column4;
      var column5 = $(this).closest('tr').children()[4].textContent;
    console.log("col=5 "+column5);
     var traimTitle = column5.substring(0,50);
     
   var column6 = $(this).closest('tr').children()[5].textContent;
  console.log("col=6"+column6);
 
  

  var checker = "false";
  for(var i=0; i<check.length; i++){
//      console.log(check[i]);
    var name = check[i];
    if(name == column5){
         //if(name == short6){
      result = 'Exist';
      alert('already added!!!');
      checker = "true";
      break;
    }
  }
  console.log(checker);
if(checker == "false"){  
    
// if($("#WTable.copy_"+column3).length==0)
 if(true)
  {
//      $("#WTable"+Asr).append("<tr class='copy_"+column3+" table-striped'><td scope='row'class='text-center Dates d-none'>" + column1 + "</td><td class='text-center d-none'data-toggle='tooltip' data-placement='top'  title='"+column2+"'  Onclick='Etpg(0,"+startpg.trim()+")'>" + column2 +"</td><td class='d-none'>"+startpg.trim()+"</td><td class='d-none'>"+startpg.trim()+"</td><td class='text-center Totals'  style='cursor:pointer;width:80%'>" + column3 +"</td><td class='d-none'>"+column5+"</td><td class='Removes'><a class='nav-link text-center text-danger btn_remove' data-Bid-type="+column6+">Rem</a></td><td class='d-none'>"+column6+"</td></tr>");
  $("#WTable").append("<tr class='copy table-striped'><td scope='row'class='text-center d-none Dates style='width:8%;'>" + column1 + "</td><td class='text-center Totals text-nowrap' data-toggle='tooltip' data-placement='top'  title='"+column5+"' style='cursor:pointer;max-width:8rem;overflow:hidden' Onclick='Etpg(0,"+column4.trim()+")'>" + column5 +"</td><td class='d-none'>"+column5+"</td><td class='Removes' style='width:8%'><a class='nav-link text-center text-danger btn_remove' data-Bid-type="+column6+">Rem</a></td><td class='d-none'>"+column6+"</td></tr>");
                    $(function () {
  $('[data-toggle="tooltip"]').tooltip();
});
        
          var caseNo = $("#CaseName").val();
        var clientNo = $("#ClientN").val();
        
//      
        $.ajax({
                        url: "pleading/function.php",
                        type: "POST",
                        cache: false,
                        data: {clientNo:clientNo,caseNo:caseNo,briefSrno:column6},
                        success: function (res) {
                            console.log(res);
                        }
                    });
  
//    $("#Mytable2").append("<tr class='copy_"+column3+"'><td scope='row'>" + column1 + "</td><td>" + column2 +"</td><td>" + column3 +"</td><td class='text-center'>" + column4 +"</td><td><a class='nav-link text-danger btn_remove'>Remove</a></td></tr>");
  }
  else
  {
//     var value = parseInt($("#WTable<?php echo $sr;?> .copy_"+column1+" input").val()) + 1;
//     $("#WTable<?php echo $sr; ?> .copy_"+column1+" input").val(value);
  }
  }else{
  console.log("checker is true");
  }
});
                     
                     
$("body").on("click",".btn_remove", function() {
    $(this).parent().parent().remove();
    
    var Bid = $(this).attr("data-Bid-type");
  //  alert(Bid);
//    var flagId= $(this).attr("data-Fsr-type");
       var caseNo = $("#CaseName").val();
        var clientNo = $("#ClientN").val();
//        var flagNo = $('#FlagId').val();
        
        

//        console.log(flagId);
         $.ajax({
                        url: "pleading/function.php",
                        type: "POST",
                        cache: false,
                        data: {RclientNo:clientNo,RcaseNo:caseNo,RBriefSrno:Bid},
                        success: function (res) {
                            console.log(res);
                        }
                    });

});
                          



                        }
                    }); 
//                    alert(caseId+caseName.text());
                        
                });
    
    </script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
<script>
       function updateUserStatused(){
  $.ajax({
    url:'Status/updateStatus.php',
    success:function(){
    }
  });

}
setInterval(function(){
updateUserStatused();
},3000);
    </script>
     <script>
        function updateActivity(){
            var activeon = 'Pleadings';
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
   
  </body>
</html>