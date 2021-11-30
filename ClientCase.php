<?php
include('ClientDb/Dp.php');
?>


<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
        <title>Case-Panel</title>


        <!-- Datatable -->

        <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css'>
        <link rel='stylesheet' href='https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css'>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

      

        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link rel="stylesheet" href="assets12/css/sam.css">
                <link rel="stylesheet" href="Timeline/timeline.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha512-SfTiTlX6kk+qitfevl/7LibUOeJWlt9rbyDn92a1DqWOw9vWG2MFoays0sgObmWazO5BQPiFucnnEAjpAB+/Sw==" crossorigin="anonymous" />


        

        <!--Datepicker-->

        <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/css/bootstrap-datepicker.css" rel="stylesheet">  
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  

        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/js/bootstrap-datepicker.js"></script> 
        
        <script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/js/standalone/selectize.min.js" integrity="sha256-+C0A5Ilqmu4QcSPxrlGpaZxJ04VjsRjKu+G82kl5UJk=" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/css/selectize.bootstrap3.min.css" integrity="sha256-ze/OEYGcFbPRmvCnrSeKbRTtjG4vGLHXgOqsyLFTRjg=" crossorigin="anonymous" />

      <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
        <script src='https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js'></script>

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    </head>




    <style>

        
/*        select {
            width:780px !important;
        }*/
        div.dataTables_filter, div.dataTables_length {
/*            margin-top:2px;*/
            /* padding-right:20px;*/
/*            padding-left:20px;*/

            text-transform: uppercase;
            
           
            

        } 

        div.dataTables_filter {
            margin-left: -10rem;
            /*     margin-right: -1rem;*/
        }
        div.dataTables_wrapper div.dataTables_filter input {
            /*    margin-left: .5em;*/
            display: inline-block;
            width: 40rem !important;

        }
   .tooltip { pointer-events: none; }
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

    <?php include "Navbars.php";?>

   
<div class="container-fluid p-0">
<!--    <div class="container-fluid border">-->
    <!--       <button type="button" class="btn btn-primary mt-3 mb-3" data-toggle="modal" data-target="#AddCase">ADD CASE</button>-->
    <div class="container-fluid  vc">
        <a class="btn btn-primary btn-sm mt-1 mb-1 ml-2" href="AddCase.php">ADD CASE</a>
        
    </div>
    
        <!-- Modal -->
        <div class="modal fade" id="AddCase" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add Case</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <form class="" method="POST" action="">

                            <div class="form-group">
                                <label for="exampleFormControlSelect1">Select Client Name</label>
                                <!--<a class="" data-toggle="modal" data-target="#AddType">  
                                  (Add Type)
                                </a><a class="ml-2" data-toggle="modal" data-target="#EditType">
                                  (Edit Type)
                                </a><a class="ml-2" data-toggle="modal" data-target="#DeleteType">
                                    (Delete Type)
                                </a>-->
                                <select class="form-control" style="width:100%;" placeholder="Please Select Client Name"onchange="document.getElementById('text_CT').value = this.options[this.selectedIndex].text">
                                    <option value=""disabled selected>Please Choose Client Name</option>
                                    <?php
                                    $sql = mysqli_query($con, "SELECT * FROM ClientDb");
                                    while ($row = $sql->fetch_assoc()) {
                                        echo "<option value=" . $row['Sr_no'] . ">" . $row['Full_Name'] . "</option>";
                                    }
                                    ?>
                                </select>
                                <input type="hidden" name="type" id="text_CT" value="<?php echo $row['Full_Name']; ?>" />
                            </div>

                            <div class="form-group">
                                <label for="exampleFormControlSelect1">Select Court Name</label>
                                <a class="" data-toggle="modal" data-target="#AddCourt">  
                                    (Add Court)
                                </a><a class="ml-2" data-toggle="modal" data-target="#EditCourt">
                                    (Edit Court)
                                </a><a class="ml-2" data-toggle="modal" data-target="#DeleteCourt">
                                    (Delete Court)
                                </a>
                                <select class="form-control"style="width:100%;"  id="exampleFormControlSelect1" placeholder="Please Select Court"onchange="document.getElementById('text_CT').value = this.options[this.selectedIndex].text">
                                    <option value=""disabled selected>Please Choose Court</option>
                                    <?php
                                    $sql = mysqli_query($con, "SELECT * FROM CourtDb");
                                    while ($row = $sql->fetch_assoc()) {
                                        echo "<option value=" . $row['Sr_no'] . ">" . $row['Court_Name'] . "</option>";
                                    }
                                    ?>
                                </select>
                                <input type="hidden" name="type" id="text_CT" value="<?php echo $row['Court_Name']; ?>" />
                            </div>
                            <div class="form-group">
                                <label >Enter Case Name</label>
                                <input type="text" class="form-control"  name="Casename"autocomplete="off" aria-describedby=""placeholder="Enter Case Name">
                            </div>
                            <div class="form-group">
                                <label>Enter Case Number</label>
                                <input type="text" class="form-control"  name="CaseNo" autocomplete="off" aria-describedby=""placeholder="Enter Case Number">
                            </div>


                            <div class="form-group">
                                <label for="exampleFormControlSelect1">Select Case Type</label>
                                <a class="" data-toggle="modal" data-target="#AddCType">  
                                    (Add Type)
                                </a><a class="ml-2" data-toggle="modal" data-target="#EditCType">
                                    (Edit Type)
                                </a><a class="ml-2" data-toggle="modal" data-target="#DeleteCType">
                                    (Delete Type)
                                </a>
                                <select class="custom-select"style="width:100%;"  id="CT" placeholder="Please Select Case Type"onchange="document.getElementById('text_CT').value = this.options[this.selectedIndex].text">
                                    <option value=""disabled selected>Please Choose Case Type</option>
                                    <?php
                                    $sql = mysqli_query($con, "SELECT * FROM Case_Type");
                                    while ($row = $sql->fetch_assoc()) {
                                        echo "<option value=" . $row['Sr_no'] . ">" . $row['Case_Type'] . "</option>";
                                    }
                                    ?>
                                </select>
                                <input type="hidden" name="type" id="text_CT" value="" />
                            </div>
                            
                            
                            
                             <div class="form-group">
                                <label for="exampleFormControlSelect1">Select Sub Type</label>
                                <a class="" data-toggle="modal" data-target="#AddCType">  
                                    (Add Sub Type)
                                </a><a class="ml-2" data-toggle="modal" data-target="#EditCType">
                                    (Edit Sub Type)
                                </a><a class="ml-2" data-toggle="modal" data-target="#DeleteCType">
                                    (Delete Sub Type)</a>
                              
                                    <select class="custom-select" style="width:100%;" required id="SubCategory" name="SC" placeholder="Choose Sub Type..." onchange="document.getElementById('text_SC').value=this.options[this.selectedIndex].text">
  
                                <option value=""disabled selected>Please Choose Case Type</option>
                                    <?php
                                    $sql = mysqli_query($con, "SELECT * FROM Case_SubType");
                                    while ($row = $sql->fetch_assoc()) {
                                        echo "<option value=" . $row['Sr_no'] . ">" . $row['Case_SubType'] . "</option>";
                                    }
                                    ?>
                                </select>
                                <input type="hidden" name="type" id="text_CT" value="" />
                            </div>
                            

                            <div class="form-group">
                                <label>Choose Case Year</label>
                                <input type="text" class="form-control"  name="Caseyear" id="year" autocomplete="off" aria-describedby=""placeholder="YYYY" value="2021">
                            </div>

                            <div class="form-group">
                                <label>Enter Case Description</label>
                                <textarea class="form-control" rows="4" name="CaseDesc" placeholder="Enter Case Description"></textarea>


                            </div>


                            <div class="form-group">
                                <button class="btn btn-primary mt-2 mb-2" name="submit" >Submit</button>    

                            </div>

                        </form>


                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                    </div> 
                </div>
            </div>
        </div>

<!--    </div>-->

    <div class="tables table-responsive">

        <table class="table table-striped table-bordered   table-hover " id='UserList'>
            <thead class="vbg text-light">
                <tr>
                    <th class="text-center"scope="col">SRN</th>
                    <th class="text-center" scope="col">Client Name</th>
                     <th class="text-center" style="display:none;" scope="col">ClientN</th>
                    <th class="text-center" scope="col">Court Name</th>
                          <th class="text-center" style="display:none;" scope="col">CourtN</th>
                    <th class="text-center" scope="col">Case Type</th>
                     <th class="text-center" scope="col">Case Sub Type</th>
                    <th class="text-center" scope="col">Case Name</th>
                          <th class="text-center" style="display:none;" scope="col">CaseN</th>
                    <th class="text-center" scope="col">CSN</th>
                    <th class="text-center" scope="col">CSY</th>
                    <th class="text-center" scope="col">Case Description</th>
                     <th class="text-center" style="display:none;"scope="col">Case Description</th>
                    <th class="text-center" scope="col">EDT</th>
                    <th class="text-center" scope="col">DEL</th>

                </tr>
            </thead>
            <tbody>
                <tr>
                    <?php
                    $sr = 1;
                    include('ClientDb/Dp.php');
                    $quariy = $con->query("SELECT * FROM Client_CaseDb");
                    $num = mysqli_num_rows($quariy);
                    if ($num >= 0) {
                        while ($row = mysqli_fetch_array($quariy)) {
                            ?>
                            <th class="text-center text-nowrap" scope="row" style=""><?php echo $sr ?></th>
                            <td class="text-center text-nowrap" scope="row"style=""data-toggle="tooltip" title="<?php echo $row['Client_Name']?>"><?php echo substr($row['Client_Name'],0,15); ?></td>
                             <td scope="row"style="display:none"><?php echo $row['Client_Name']?></td>
                            <td class="text-center text-nowrap" scope="row"style=""data-toggle="tooltip" title="<?php echo $row['Court_Name']?>"><?php echo substr($row['Court_Name'],0,20);?></td>
                             <td scope="row"style="display:none"><?php echo $row['Court_Name']?></td>
                            <td class="text-center text-nowrap" scope="row"style=""data-toggle="tooltip" title="<?php echo $row['Case_Type']?>"><?php echo substr($row['Case_Type'],0,20); ?></td>
                            <td class="text-center text-nowrap" scope="row"style=""data-toggle="tooltip" title="<?php echo $row['Case_SubType']?>"><?php echo substr($row['Case_SubType'],0,20);?></td>
                            <td class="text-center text-nowrap" scope="row"style=""data-toggle="tooltip" title="<?php echo $row['Case_Name']?>"><?php echo substr($row['Case_Name'],0,20); ?></td>
                             <td scope="row"style="display:none"><?php echo $row['Case_Name']?></td>
                            <td class="text-center text-nowrap" scope="row"style=""data-toggle="tooltip" title="<?php echo $row['Case_Number']?>"><?php echo substr($row['Case_Number'],0,20); ?></td>
                            <td class="text-center text-nowrap" scope="row"style=""data-toggle="tooltip" title="<?php echo $row['Case_Year']?>"><?php echo substr($row['Case_Year'],0,20); ?></td>
                            <td class="text-center text-nowrap" scope="row"style="" data-toggle="tooltip" title="<?php echo $row['Case_Desc']?>"><?php echo substr($row['Case_Desc'],0,20);?></td>
                             <td scope="row"style="display:none"><?php echo $row['Case_Desc']?></td>
                            <td class="text-center" scope="row"style=""><a class="nav_link" href="CaseDb//EditCase.php/?v=<?php echo $row['Sr_no'] ?>">Edit </a></td>
                      <!--      <td class="text-center"  scope="row"style=""><a id="editbtn" class="nav_link" data-toggle="modal" data-target="#EditClient" onclick="data('<?php echo $row['Full_Name'] ?>','<?php echo $row['Type'] ?>','<?php echo $row['Mobile'] ?>','<?php echo $row['Email'] ?>','<?php echo $row['Address'] ?>','<?php echo $row['Sr_no'] ?>');">Edit</a>-->
                            <td class="text-center" scope="row"style="color:red;"><a  class="text-danger"href="CaseDb/DelCase.php/?n=<?php echo $row['Case_Path']?>">Delete </a></td>
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






<div class="modals">
    <!-- ADD Court Modal -->
    <div class="modal fade" id="AddCourt" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-dark text-light">
                    <h2 class="modal-title font-weight-bold" id="exampleModalLabel">Add Court</h2>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="continer border">
                        <input class="form-control" id="Tname" type="text" placeholder="Enter Court Name">

                        <button type="button" id="addT" class="btn btn-primary mt-2" >Add Court</button>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary">Save changes</button>
        </div> 
    </div>



    <!-- Edit Court Modal -->
    <div class="modal fade" id="EditCourt" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-dark text-light">
                    <h2 class="modal-title font-weight-bold" id="exampleModalLabel">Edit Court</h2>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="continer border">
                        <label class="font-weight-bold">Select Type</label>
                        <select class="form-control" style="width:100%;" id="editTC" placeholder="Choose Court..">
                            <option value="" disabled selected>Choose Category</option>

                            <?php
                            $sql = mysqli_query($con, "SELECT * FROM CourtDb");
                            while ($row = $sql->fetch_assoc()) {
                                echo "<option value=" . $row['Sr_no'] . ">" . $row['Court_Name'] . "</option>";
                            }
                            ?>
                        </select>
                        <input class="form-control mt-2" type="text"  id="RenameT" placeholder=" Edit Court">

                        <button type="button" id="EditT" class="btn btn-primary mt-2" >Edit Court</button>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                </div>
            </div>
        </div>
    </div>


    <!-- Delete Court Modal -->
    <div class="modal fade" id="DeleteCourt" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-dark text-light">
                    <h2 class="modal-title font-weight-bold" id="exampleModalLabel">Delete Court</h2>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="continer border">
                        <label class="font-weight-bold">Select Type</label>
                        <select  class="form-control" style="width:100%;" id="DeleteT" placeholder="Choose Court..">
                            <option value="" disabled selected>Choose Category</option>

                            <?php
                            include 'KnowledgeDb/Dp.php';
                            $sql = mysqli_query($con, "SELECT * FROM CourtDb");
                            while ($row = $sql->fetch_assoc()) {
                                echo "<option value=" . $row['Sr_no'] . ">" . $row['Court_Name'] . "</option>";
                            }
                            ?>
                        </select>
                        <button type="button" id="DelT" class="btn btn-primary mt-2" >Delete Court</button>
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
    
     $("#CaseNav").addClass("active");
                     $(function () {
  $('[data-toggle="tooltip"]').tooltip();
});

 $("#CT").on("change",function(){
     var category = $("#CT").val();
     
     console.log(category);
     
     var cid= JSON.stringify(category);
      $.ajax({
        url :"CaseDb/SubTypeDy.php",
        type:"POST",
        cache:false,
        data:{countryId:cid},
        success:function(data){
            console.log(data);
            $("#SubCategory").html(data);
          
        }
      });
 });



    document.getElementById("EditT").addEventListener("click", editT);
    function editT() {
        var Cid = document.getElementById('editTC').value;
        var Rename = document.getElementById('RenameT').value;
        console.log(Cid);
        console.log(Rename);
        var cid = JSON.stringify(Cid);
        var renames = JSON.stringify(Rename);
        $.ajax({
            type: "POST",
            url: "CaseDb/EditCourt.php",
            data: {id: cid, rename: renames},
            success: function (res) {
                console.log(res);
                location.reload();
            }

        });
    };
    


    document.getElementById("DelT").addEventListener("click", DelT);
    function DelT() {
        var Cid = document.getElementById('DeleteT').value;
        console.log(Cid);
        var cid = JSON.stringify(Cid);
        $.ajax({
            type: "POST",
            url: "CaseDb/DelCourt.php",
            data: {id: cid},
            success: function (res) {
                console.log(res);
                location.reload();
            }

        });
    };
    

    document.getElementById("addT").addEventListener("click", ADDType);
    function ADDType() {
        var tname = document.getElementById("Tname").value;
        console.log(tname);
        var Tname = JSON.stringify(tname);
//var AddCourt= JSON.stringify('AddCourt');


        $.ajax({
            type: "POST",
//      url: "CaseDb/Court.php", 
//       data: {name:Tname,method:AddCourt},

            url: "CaseDb/AddCourt.php",
            data: {name: Tname},
            success: function (res) {
                console.log(res);
                location.reload();
            }

        });

    };




    $(document).ready(function () {


        $('#year').datepicker({
            minViewMode: 'years',
            autoclose: true,
            format: 'yyyy'
        });

//        $('select').selectize({
//            sortField: 'text'
 $('select').select2();
       // });
        $('#UserList').DataTable({
//        "pagingType":"full_numbers",
            "bFilter": true,
            "bInfo": true,
            "lengthMenu": [
                [15, 25, 50, -1],
                [15, 25, 50, "All"]
            ],
            responsive: true,
            language: {
                //"search": "_INPUT_",
                searchPlaceholder: "Search Client",

            }
        });
        
       
    });
   
  
   

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
            var activeon = 'ClientCase';
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










<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>


</body>
</html>