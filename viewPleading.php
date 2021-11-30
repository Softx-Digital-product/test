<?php include 'Database/Dp.php';
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

.vbg{
    height:40px;
}

          .vbg .btn{
    margin-top: 5px;
    background: #0f5353;
/*    padding:6px;*/
    margin-bottom:5px;
}
         .vbg  input{
             padding:0px;
             height:-1px;
    margin-top: 5px;
    margin-bottom: 5px;
    width:10%;
    text-align: center;
}
.vbg selete{
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
 .nav-pills .nav-link.active, .nav-pills .show > .nav-link {
    color: #fff;
    background-color:#40e0d0;
}
    </style>
  </head>
  <body>
  <?php include 'Navbars.php';?>
      <div class="topnav1">
          <a id="cp" href="Pleadings.php" class="nav__link  ">Create Pleadings</a>
          <a id="vp"href="viewPleading.php" class="nav_link active">View Pleadings</a>
          <a id="book" href="Bookmark.php" class="nav_link ">Bookmark</a>
             
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
                                        echo "<option value=".$row['Sr_no'].">" . $row['Full_Name'] . "</option>";
                                    }

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
      
      
      <?php 
      
      if(isset($_GET['c']) && isset($_GET['v']) ){
      $clientid= mysqli_real_escape_string($con, $_GET['c']);
        $caseid= mysqli_real_escape_string($con, $_GET['v']);
?>
<script>
    $( document ).ready(function() {
   $("#cp").attr("href", "Pleadings.php?c="+<?php echo $clientid;?>+"&v="+<?php echo $caseid;?>);
   $("#book").attr("href", "Bookmark.php?c="+<?php echo $clientid;?>+"&v="+<?php echo $caseid;?>);
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
        
          $( document ).ready(function() {
               $('select').select2();
          });
               
        

       
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
                    
                    var caseId= $('#CaseName').val();
                    var caseName=$("#CaseName option:selected");
                    var caseName= caseName.text();
                    
              $('#dycontents').html("<div class='container text-center'><img src='images/loadings.gif' class='text-center mt-5'/></div>");
                 
                   $.ajax({
                        url: "pleading/viewpleadingFunctions.php",
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

                        }
                    }); 
//                    alert(caseId+caseName.text());
                        
                });
                
                    function Back(){
           $('#vt').trigger('click');
    }
    
    function Briefdata(sr,tb,sp){
       // alert(sr);
       Etpg(tb,sp);
         $('#vd').trigger('click');
           $.ajax({
                        url: "Sorting/ViewSortingFunction.php",
                        type: "POST",
                        cache: false,
                        data: {BreifId:sr},
                        success: function (res) {
                            $('#dyTimelineDetails').html(res);
                          
                        }
                    });
         
    }
    
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
            var activeon = 'View Pleadings';
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