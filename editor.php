
<?php 
include 'KnowledgeDb/Dp.php';


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
          <link rel="stylesheet" href="Editor/ruler.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha512-SfTiTlX6kk+qitfevl/7LibUOeJWlt9rbyDn92a1DqWOw9vWG2MFoays0sgObmWazO5BQPiFucnnEAjpAB+/Sw==" crossorigin="anonymous" />
        
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        
        <style>
            .vbg a{
                cursor: pointer;
            }
            nav-pills .nav-link.active, .nav-pills .show > .nav-link {
    color: #fff;
    background-color:#40e0d0;
}
.nav-item .nav-link .active{
        background:#40e0d0;
        padding:8px;
    }
    .page{
        height: 75vh;
        width: 60%;
       border: solid #000 thin;
       font-size: 25px;
       
    }
    .btns-active:hover{
        pointer-events: none;
    }
    .btns-active{
  background:#40e0d0;

  color: white;
    
}
    
    .topnav{
/*        position: absolute;*/
     

       
    }
    .Navfixed{
/*        position: fixed;*/
/*        margin-top:3rem;*/
        
        
        
    }
    .Tools{
/*            margin-top:3rem;
            position: fixed;*/
/*        position: fixed;
        top:5rem;*/
        
    }
    .page{
        overflow: auto;
    }
  
    .main{
/*        margin-top:20rem;*/
    }
        </style>
       
    <title>Editor</title>
  </head>
  <body>

    <div class="contianer-fluid p-0">
         <?php  include'Navbars.php'; ?>
        
        <div class="container-fluid  vbg Navfixed">
            <div class="row">
                <div class="col-lg-3">
                           <ul class="nav nav-pills p-0 vbg" id="">
                        
                       

                        <li class="nav-item ">
                            <a id="eh" class="nav-link active timelinelink " data-toggle="pill" href="#EH" >Home</a>
                        </li>
                         <li class="nav-item">
                             <a id="ee"   class="nav-link timelinelink" data-toggle="pill" href="#EE">Edit</a>
                        </li>
                        <li class="nav-item">
                             <a id="ev"  class="nav-link timelinelink" data-toggle="pill" href="#EV">View </a>
                        </li>
                        <li class="nav-item">
                            <a id="ef"   class="nav-link timelinelink" data-toggle="pill" href="#EF">Format </a>
                        </li>
                         <li class="nav-item">
                            <a id="et"   class="nav-link timelinelink" data-toggle="pill" href="#ET">Tools</a>
                        </li>
      
                    </ul>
                </div>
                <div class="col-lg-8  ">
                    <div class="row">
                        <div class="col-lg-4  ">
                           <div class="form-group mt-1  ">
                              
                                <select class="CN form-control" name="ClientId" id="ClientId" style="width:100%;">
                                    <option value=""disabled selected>Please Choose Client Name</option>
                                    <?php
                                    $sql = mysqli_query($con, "SELECT * FROM ClientDb");
                                    while ($row = $sql->fetch_assoc()) {
                                        echo "<option value=" . $row['Sr_no'] . ">" . $row['Full_Name'] . "</option>";
                                    }

                                  ?>
                                </select>
                              
                            </div>
                        </div>
                        <div class="col-lg-4 ">
                               <div class="form-group mt-1 ">
                 
                                 <select class="form-control CN" name="CaseId"  style="width:100%;" id="CaseId">
                                     <option value=""disabled selected>Please Choose Case Name</option>
                                    <?php
                                    $sql = mysqli_query($con, "SELECT * FROM Client_CaseDb");
                                    while ($row = $sql->fetch_assoc()) {
                                        echo "<option value=" . $row['Sr_no'] . ">" . $row['Case_Name'] . "</option>";
                                    }
                                    ?>
                                </select>
                                
                            </div>
                        </div>
                        <div class="col-lg-4">
                          <div class="form-group mt-1  ">
                              
                                <select class="CN form-control" name="DraftId" id="DraftId" style="width:100%;">
                                    <option value=""disabled selected>Please Choose Draft Name</option>
                                    <?php
                                    $sql = mysqli_query($con, "SELECT * FROM Drafting");
                                    while ($row = $sql->fetch_assoc()) {
                                        echo "<option value=" . $row['Sr_no'] . ">" . $row['DTitle'] . "</option>";
                                    }

                                  ?>
                                </select>
                              
                            </div>
                        </div>
                    </div>
                </div>
            </div>
     
 </div>
      
       
            <div class="tab-content " id="pills-tabContent">
                <div class="tab-pane fade show active p-0" id="EH" role="tabpanel" >
                    <div class="container-fluid cc  p-2 text-white Tools ">
                        <div class='container-fluid'>
                            Home Tootls
<!--                            <button class='btn btn-sm   border border-dark'  onclick="Bold();" id="bold"> <i class="fa fa-bold  p-1" aria-hidden="true"></i></button>;
                           <button class='btn btn-sm    border border-dark' > <i class="fa fa-italic" aria-hidden="true"></i></button>
                           <button class='btn btn-sm   border border-dark' > <i class="fa fa-underline" aria-hidden="true"></i></i></button>
                           -->
                        </div>
                    </div>
                 
                </div>
                <div class="tab-pane fade  p-0" id="EE" role="tabpanel" >
                    <div class="cc p-2 text-white Tools">
                    Edit tools
                    </div>
                </div>
                <div class="tab-pane fade  p-0" id="EV" role="tabpanel" >
                    <div class="cc p-2 text-white Tools">
                    View tools
                    </div>
                </div>
                <div class="tab-pane fade  p-0" id="EF" role="tabpanel" >
                     <div class="cc p-2 text-white Tools">
                    Format tools
                </div>
                </div>
                   <div class="tab-pane fade p-0 " id="ET" role="tabpanel" >
                       <div class="cc p-2 text-white Tools">
                           Extra  Tools
                       </div>
                    
                </div>
            </div>
      
  
            

       
       
        
<!--            <h1 class="text-danger text-uppercase  text-center"><==== Editor ====></h1>-->
        <div class="container-fluid mt-1  main">
            <div class="row">
                <div class=" col-xl-1 col-lg-1 col-md-1 col-sm-1 ">
                    
                </div>
                <div class=" col-xl-11 col-lg-11 col-md-11 col-sm-11 ">
                    
                      <div class="contianer-fluid" id="ruler">
                    <?php include 'Editor/Ruler.php'; ?>
                          <div class="container-fluid" id="dycontents">
                                                    <div class="container-fluid  center  page  " contenteditable="true">
                
                </div>
                          </div>

                      </div>
                </div>
                    
                
                
                
            </div>
               
                   
          
            </div>
        
        
    </div>

      
    <script>
        const bolder= Bold =()=>{
            
            $('#bold').addClass('btns-active');
            
          document.getElementById('bold').addEventListener('click', function (e) {
    box.focus(); // make it the active element so the command is applied to it
    document.execCommand('bold', false, null); // apply command
});
        }
        
        </script>
    
     <script>
            
            $('select').select2();
            
            
            
                 $("#ClientId").on("change", function () {
                    var category = $("#ClientId").val();

                    console.log(category);

                    var cid = JSON.stringify(category);
                    $.ajax({
//                        url: "UploadCase/CaseNameDy.php",
                            url:"Calendar/function.php",
                        type: "POST",
                        cache: false,
                       // data: {countryId: cid},
                        data: {clientdids: cid},
                        success: function (data) {
                            console.log(data);
                            $("#CaseId").html(data);

                        }
                    });
                });
                
                  $("#CaseId").on("change",function(){
     var category = $("#CaseId").val();
     
     console.log(category);
     
     var cid= JSON.stringify(category);
      $.ajax({
        url :"Drafting/function.php",
        type:"POST",
        cache:false,
        data:{caseId:cid},
        success:function(data){
            console.log(data);
           $("#DraftId").html(data);
          
        }
      });
                  });
                  
             $("#DraftId").on("change",function(){
            var Sr = $("#DraftId").val(); 
            console.log("Draft -> "+Sr);
            
             $.ajax({
        url :"Editor/function.php",
        type:"POST",
        cache:false,
        data:{DraftId:Sr},
        beforeSend:function(){
              $("#dycontents").html("<strong class='mt-5 text-center  h1'>Loading.... :)  </strong>");
        },
        success:function(data){
            console.log(data);
           $("#dycontents").html(data);
          
        }
      });

           
           
              
     
             
         });

            </script>
    <script>
        
         $('#mybottomnav').hide();
        $('#CM').removeClass('active');
        $('#ed').addClass('active');
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
            var activeon = 'Editor';
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