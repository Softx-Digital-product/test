<?php include 'Database/Dp.php'; ?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
<link rel="preconnect" href="https://fonts.gstatic.com">
        <link rel="stylesheet" href="assets12/css/sam.css">
        <link rel="stylesheet" href="Timeline/timeline.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha512-SfTiTlX6kk+qitfevl/7LibUOeJWlt9rbyDn92a1DqWOw9vWG2MFoays0sgObmWazO5BQPiFucnnEAjpAB+/Sw==" crossorigin="anonymous" />

          <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        
            <link rel='stylesheet' href='https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css'>
   <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
        <script src='https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js'></script>    
        
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/themes/ui-lightness/jquery-ui.min.css" integrity="sha512-NaCOGQe8bs7/BxJpnhZ4t4f4psMHnqsCxH/o4d3GFqBS4/0Yr/8+vZ08q675lx7pNz7lvJ6fRPfoCNHKx6d/fA==" crossorigin="anonymous" />
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        
           <script src="https://mozilla.github.io/pdf.js/build/pdf.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.0.943/pdf.min.js"></script>
    <title>View Sorting</title>
    <style>
        .tooltip { 
    pointer-events: none;
}
        *{
            padding:0px;
            margin:0px;
           box-sizing: border-box;
        }
                              div.dataTables_wrapper div.dataTables_filter input {
width:200px;
   
    overflow: hidden !important;
   
}
        #canvas_container {
        width: 99.9%;
        height: 900px;
        overflow: auto;
    }
    #pdf_renderer{ width:99.9%; cursor:pointer;}

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
        
  .nav-pills .nav-link.active, .nav-pills .show > .nav-link {
    color: #fff;
    background-color:#40e0d0;
}
label{
    font-size: 20px;
}
    </style>
  </head>
  <body>
      <?php include 'timelineheaader.php';?>
    
      
      <div class="container-fluid " id="dycontents">
          <div class="row">
         
          <div class="col-xl-5 col-lg-5 col-md-5 col-sm-5 ">
             
          </div>
          <div class="col-xl-7 col-lg-7 col-md-7 col-sm-7 ">
           
          </div>
      </div>
      </div>
      
      
      
      
     
      

   <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
<script> 
  
    $('#viewsorting').addClass('active');
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

                        }
                    });
                });
                
                $("#CaseName").on("change",function(){
                    var caseId= $('#CaseName').val();
                    var caseName=$("#CaseName option:selected");
                    var caseName= caseName.text();
                    
              $('#dycontents').html("<div class='container text-center'><img src='images/loadings.gif' class='text-center mt-5'/></div>");
                 
                   $.ajax({
                        url: "Sorting/ViewSortingFunction.php",
                        type: "POST",
                        cache: false,
                        data: {CaseName: caseName,caseId:caseId},
                        success: function (res) {
                            $('#dycontents').html(res);
                                  $(function () {
  $('[data-toggle="tooltip"]').tooltip()
})
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
            var activeon = 'View Sorting';
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