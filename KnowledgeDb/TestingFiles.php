<?php
include 'Dp.php';
?>


<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
        <!--        <link rel="stylesheet" href="select2.css">-->

        <!--Datepicker-->

        <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/css/bootstrap-datepicker.css" rel="stylesheet">  
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  

        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/js/bootstrap-datepicker.js"></script> 

        <script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/js/standalone/selectize.min.js" integrity="sha256-+C0A5Ilqmu4QcSPxrlGpaZxJ04VjsRjKu+G82kl5UJk=" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/css/selectize.bootstrap3.min.css" integrity="sha256-ze/OEYGcFbPRmvCnrSeKbRTtjG4vGLHXgOqsyLFTRjg=" crossorigin="anonymous" />



        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

        <title>Add Case</title>
        <style>

            .ModalSelect{
                width: 100% !important;
            }
        </style>
    </head>
    <body>
        <div class="container shadow mt-5">
            <!--      <div class="Container mt-5 shadow">-->
            <div class="row">
                <div class="col-lg-6 col-lg-6 col-sm-12">
                    <a href="../ClientCase.php" class="btn btn-primary mt-1 md-3"><- Back</a>
                </div>
                <div class="col-lg-6 col-lg-6 col-sm-12">
                    <h3 class="mt-1 md-2 text-right text-uppercase"> Add Client Case </h3>
                </div>

            </div>

            <form class="mt-2" method="POST" action="">


                <div class="row">

                    <div class="col-lg-6  col-md-6 col-sm-12">

                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Select Client Name</label>
                            <select class="custom-select"  placeholder="Please Select Client Name"onchange="document.getElementById('text_CT').value = this.options[this.selectedIndex].text">
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


                    </div>
                    <div class="col-lg-6  col-md-6 col-sm-12">
                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Select Case Status</label>

                            <select class="form-control col-xl-12 col-lg-12 col-md-12 col-sm-12" id="status" placeholder="Please Select Case Status"onchange="document.getElementById('text_CT').value = this.options[this.selectedIndex].text">
                                <option value=""disabled selected>Please Select Case Status</option>
                                <option value="1">Pending</option>
                                <option value="2">Disposed</option>


                            </select>
                            <input type="hidden" name="type" id="text_CT" value="<?php echo $row['Court_Name']; ?>" />
                        </div>

                    </div>


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
                    <select class="form-control"  id="CName" placeholder="Please Select Court"onchange="document.getElementById('CaseN').value = this.options[this.selectedIndex].text">
                        <option value=""disabled selected>Please Choose Court</option>
                        <?php
                        $sql = mysqli_query($con, "SELECT * FROM CourtDb");
                        while ($row = $sql->fetch_assoc()) {
                            echo "<option value=" . $row['Sr_no'] . ">" . $row['Court_Name'] . "</option>";
                        }
                        ?>
                    </select>
                    <input type="hidden" name="type" id="CaseN" value="" />
                </div>

                <div class="form-group">
                    <label >Enter Case Name</label>
                    <input type="text" class="form-control"  name="Casename"autocomplete="off" aria-describedby=""placeholder="Enter Case Name">
                </div>
                <div class="form-group">
                    <label>Enter Case Number</label>
                    <input type="text" class="form-control"  name="CaseNo" autocomplete="off" aria-describedby=""placeholder="Enter Case Number">
                </div>
                <div class="row">
                    <div class="col-lg-6  col-md-6 col-sm-12">
                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Select Case Type</label>
                            <a class="" data-toggle="modal" data-target="#AddType">  
                                (Add Type)
                            </a><a class="ml-2" data-toggle="modal" data-target="#EditType">
                                (Edit Type)
                            </a><a class="ml-2" data-toggle="modal" data-target="#DeleteType">
                                (Delete Type)
                            </a>
                            <select class="form-control"  id="CT" placeholder="Please Select Case Type"onchange="document.getElementById('text_CT').value = this.options[this.selectedIndex].text">
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

                    </div>
                    <div class="col-lg-6  col-md-6 col-sm-12">
                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Select Sub Type</label>
                            <a class="" data-toggle="modal" data-target="#AddSType">  
                                (Add Sub Type)
                            </a><a class="ml-2" data-toggle="modal" data-target="#EditSType">
                                (Edit Sub Type)
                            </a><a class="ml-2" data-toggle="modal" data-target="#DeleteSType">
                                (Delete Sub Type)</a>

                            <select class="form-control" required id="SubType" name="SC" placeholder="Choose Sub Category..." onchange="document.getElementById('text_SC').value = this.options[this.selectedIndex].text">

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
                    </div>

                </div>


                <div class="row">

                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Select Case Category</label><a class="" data-toggle="modal" data-target="#AddCategory">  
                                (Add Category)
                            </a><a class="ml-2" data-toggle="modal" data-target="#EditCategory">
                                (Edit Category)
                            </a><a class="ml-2" data-toggle="modal" data-target="#DeleteCategory">
                                (Delete Category)
                            </a>
                            <select class="form-control"  id="exampleFormControlSelect1" placeholder="Please Select type"onchange="document.getElementById('text_CT').value = this.options[this.selectedIndex].text">
                                <option value=""disabled selected>Choose Case Category</option>
                                <?php
                                $sql = mysqli_query($con, "SELECT * FROM Case_categ");
                                while ($row = $sql->fetch_assoc()) {
                                    echo "<option value=" . $row['Sr_no'] . ">" . $row['Category'] . "</option>";
                                }
                                ?>
                            </select>
                            <input type="hidden" name="type" id="text_CT" value="" />
                        </div>
                    </div>

                    <div class="col-lg-6 col-md-6 col-sm-12">
                        
                          <div class="form-group">
                            <label for="exampleFormControlSelect1">Select Case Category</label><a class="" data-toggle="modal" data-target="#AddSubCategory">  
                                (Add Category)
                            </a><a class="ml-2" data-toggle="modal" data-target="#EditSubCategory">
                                (Edit Category)
                            </a><a class="ml-2" data-toggle="modal" data-target="#DeleteSubCategory">
                                (Delete Category)
                            </a>
                            <select class="form-control"  id="" placeholder="Please Select type"onchange="document.getElementById('text_ST').value = this.options[this.selectedIndex].text">
                                <option value=""disabled selected>Choose Case Sub Category</option>
                                <?php
                                $sql = mysqli_query($con, "SELECT * FROM Case_subCateg");
                                while ($row = $sql->fetch_assoc()) {
                                    echo "<option value=" . $row['Sr_no'] . ">" . $row['Sub_Category'] . "</option>";
                                }
                                ?>
                            </select>
                            <input type="hidden" name="type" id="text_ST" value="" />
                        </div>
                    
                        
                    </div>
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
                                <label class="font-weight-bold">Select Court</label><br>
                                <select class="ModalSelect" style="width:100%;" id="editTC" placeholder="Choose Court..">
                                    <option value="" disabled selected>Choose Court...</option>

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
                                <select  class="" id="DeleteT" placeholder="Choose Court..">
                                    <option value="" disabled selected>Please Choose Court</option>

                                    <?php
                                    include 'KnowledgeDb/Dp.php';
                                    $sql = mysqli_query($con, "SELECT * FROM CourtDb");
                                    while ($row = $sql->fetch_assoc()) {
                                        echo "<option value=" . $row['Sr_no'] . ">" . $row['Court_Name'] . "</option>";
                                    }
                                    ?>
                                </select>
                                <button type="button" id="DelT" class="btn btn-primary mt-1 ml-1" >Delete Court</button>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                        </div>
                    </div>
                </div>
            </div>




            <!---- Type Modal -->

            <!-- ADD TypeModal -->
            <div class="modal fade" id="AddType" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h2 class="modal-title font-weight-bold" id="exampleModalLabel">Add Type</h2>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="continer border">
                                <input class="form-control" id="CTname" type="text" placeholder="Enter Type">

                                <button type="button" id="CTadd" class="btn btn-primary mt-2" >Add Type</button>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                        </div>
                    </div>
                </div>
            </div>

            <!-- Edit Type Modal -->
            <div class="modal fade" id="EditType" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h2 class="modal-title font-weight-bold" id="exampleModalLabel">Edit Type</h2>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="continer border">
                                <label class="font-weight-bold">Select Type</label>
                                <select class="form-select" id="CTEdit" placeholder="Choose Type..">
                                    <option value="" disabled selected>Please Choose Case Type</option>

                                    <?php
                                    $sql = mysqli_query($con, "SELECT * FROM Case_Type");
                                    while ($row = $sql->fetch_assoc()) {
                                        echo "<option value=" . $row['Sr_no'] . ">" . $row['Case_Type'] . "</option>";
                                    }
                                    ?>
                                </select>
                                <input class="form-control mt-2" type="text"  id="CTRename" placeholder=" Edit Type">

                                <button type="button" id="CTedit" class="btn btn-primary mt-2" >Edit Type</button>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                        </div>
                    </div>
                </div>
            </div>

            <!-- Delete Type Modal -->
            <div class="modal fade" id="DeleteType" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h2 class="modal-title font-weight-bold" id="exampleModalLabel">Delete Type</h2>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="continer border">
                                <label class="font-weight-bold">Select Type</label>
                                <select  class="" id="CTDelete" placeholder="Choose Type..">
                                    <option value="" disabled selected>Choose Case Type</option>

                                    <?php
                                    $sql = mysqli_query($con, "SELECT * FROM Case_Type");
                                    while ($row = $sql->fetch_assoc()) {
                                        echo "<option value=" . $row['Sr_no'] . ">" . $row['Case_Type'] . "</option>";
                                    }
                                    ?>
                                </select>
                                <button type="button" id="CTdel" class="btn btn-primary mt-1 ml-1" >Delete Type</button>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                        </div>
                    </div>
                </div>
            </div>


            <!--Sub Type Modal --->

            <!--Add Sub Type-->
            <div class="modal fade" id="AddSType" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h2 class="modal-title font-weight-bold" id="exampleModalLabel">Add Sub Type</h2>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="continer">
                                <label class="font-weight-bold">Select Type</label>
                                <select class="" id="selectT" placeholder="Choose Case Type..">
                                    <option value="" disabled selected>Please Choose Case Type </option>

                                    <?php
                                    $sql = mysqli_query($con, "SELECT * FROM Case_Type");
                                    while ($row = $sql->fetch_assoc()) {
                                        echo "<option value=" . $row['Sr_no'] . ">" . $row['Case_Type'] . "</option>";
                                    }
                                    ?>
                                </select>
                                <br>
                                <input class="form-control mt-1" type="text"  id="SubT" placeholder="Enter Sub Category">

                                <button type="button" class="btn btn-primary mt-2"  id="AddSubT" >Add Sub Category</button>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                        </div>
                    </div>
                </div>
            </div>


            <!-- Edit Type  Sub Modal -->
            <div class="modal fade" id="EditSType" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h2 class="modal-title font-weight-bold" id="exampleModalLabel">Edit Sub-Type</h2>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="continer border">
                                <label class="font-weight-bold">Select Sub Type</label>
                                <select class="form-select" id="STEdit" placeholder="Choose Type.." onchange="document.getElementById('STRename').value = this.options[this.selectedIndex].text">
                                    <option value="" disabled selected>Please Choose Case Sub Type</option>

                                    <?php
                                    $sql = mysqli_query($con, "SELECT * FROM Case_SubType");
                                    while ($row = $sql->fetch_assoc()) {
                                        echo "<option value=" . $row['Sr_no'] . ">" . $row['Case_SubType'] . "</option>";
                                    }
                                    ?>
                                </select>
                                <input class="form-control mt-2" type="text"  id="STRename" placeholder=" Edit Type">

                                <button type="button" id="STedit" class="btn btn-primary mt-2" >Edit Type</button>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                        </div>
                    </div>
                </div>
            </div>



            <!-- Delete Type Modal -->
            <div class="modal fade" id="DeleteSType" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h2 class="modal-title font-weight-bold" id="exampleModalLabel">Delete Sub-Type</h2>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="continer border">
                                <label class="font-weight-bold">Select Sub Type</label><br>
                                <select  class="" id="STDelete" placeholder="Choose Type..">
                                    <option value="" disabled selected>Please Choose Sub Type</option>

                                    <?php
                                    $sql = mysqli_query($con, "SELECT * FROM Case_SubType");
                                    while ($row = $sql->fetch_assoc()) {
                                        echo "<option value=" . $row['Sr_no'] . ">" . $row['Case_SubType'] . "</option>";
                                    }
                                    ?>
                                </select>
                                <button type="button" id="STdel" class="btn btn-primary mt-1 ml-1" >Delete Type</button>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                        </div>
                    </div>
                </div>
            </div>



            <!--- End of Sub Type Modal--->

            <!-- Category Modal --->
            <!-- Modal -->
            <div class="modal fade" id="AddCategory" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h2 class="modal-title font-weight-bold" id="exampleModalLabel">Add Category</h2>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="continer border">
                                <input class="form-control" id="Cname" type="text" placeholder="Enter Category">

                                <button type="button" id="addC" class="btn btn-primary mt-2" >Add Category</button>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                        </div>
                    </div>
                </div>
            </div>

            <!-- Delete Modal -->
            <div class="modal fade" id="DeleteCategory" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h2 class="modal-title font-weight-bold" id="exampleModalLabel">Delete Category</h2>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="continer border">
                                <label class="font-weight-bold">Select Category</label><br>
                                <select class="" id="DeleteC" placeholder="Choose Category..">
                                    <option value="" disabled selected>Please Choose Case Category</option>

                                    <?php
                                    $sql = mysqli_query($con, "SELECT * FROM Case_categ");
                                    while ($row = $sql->fetch_assoc()) {
                                        echo "<option value=" . $row['Sr_no'] . ">" . $row['Category'] . "</option>";
                                    }
                                    ?>
                                </select>
                                <button type="button" id="DelC" class="btn btn-primary mt-1 ml-1" >Delete Category</button>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                        </div>
                    </div>
                </div>
            </div>


            <!-- Edit Modal -->
            <div class="modal fade" id="EditCategory" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h2 class="modal-title font-weight-bold" id="exampleModalLabel">Edit Category</h2>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="continer border">
                                <label class="font-weight-bold">Select Category</label>
                                <select  class="" id="editsC" placeholder="Choose Category.." onchange="document.getElementById('Rename').value = this.options[this.selectedIndex].text">
                                    <option value="" disabled selected>Please Choose Case Category</option>

                                    <?php
                                    $sql = mysqli_query($con, "SELECT * FROM Case_categ");
                                    while ($row = $sql->fetch_assoc()) {
                                        echo "<option value=" . $row['Sr_no'] . ">" . $row['Category'] . "</option>";
                                    }
                                    ?>
                                </select>
                                <input class="form-control mt-2" type="text"  id="Rename" placeholder=" Edit Category" >

                                <button type="button" id="EditC" class="btn btn-primary mt-2" >Edit Category</button>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                        </div>
                    </div>
                </div>
            </div>

            
            
            <!-- Sub Category-->
            
            


        </div>




        <script>

            $("#CT").on("change", function () {
                var category = $("#CT").val();

                console.log(category);

                var cid = JSON.stringify(category);
                $.ajax({
                    url: "SubTypeDy.php",
                    type: "POST",
                    cache: false,
                    data: {countryId: cid},
                    success: function (data) {
                        console.log(data);
                        $("#SubType").html(data);

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
                    url: "EditCourt.php",
                    data: {id: cid, rename: renames},
                    success: function (res) {
                        console.log(res);
                        location.reload();
                    }

                });
            }
            ;



            document.getElementById("DelT").addEventListener("click", DelT);
            function DelT() {
                var Cid = document.getElementById('DeleteT').value;
                console.log(Cid);
                var cid = JSON.stringify(Cid);
                $.ajax({
                    type: "POST",
                    url: "DelCourt.php",
                    data: {id: cid},
                    success: function (res) {
                        console.log(res);
                        location.reload();
                    }

                });
            }
            ;


            document.getElementById("addT").addEventListener("click", ADDCourt);
            function ADDCourt() {
                var tname = document.getElementById("Tname").value;
                console.log(tname);
                var Tname = JSON.stringify(tname);
//var AddCourt= JSON.stringify('AddCourt');


                $.ajax({
                    type: "POST",
//      url: "CaseDb/Court.php", 
//       data: {name:Tname,method:AddCourt},

                    url: "AddCourt.php",
                    data: {name: Tname},
                    success: function (res) {
                        console.log(res);
                        location.reload();
                    }

                });

            }
            ;



            document.getElementById("CTadd").addEventListener("click", AddType);
            function AddType() {
                var CTname = document.getElementById("CTname").value;
                console.log(CTname);
                var Ctname = JSON.stringify(CTname);
                $.ajax({
                    type: "POST",
                    url: "AddType.php",
                    data: {name: Ctname},
                    success: function (res) {
                        console.log(res);
                        location.reload();
                    }

                });

            }
            ;

            document.getElementById("CTedit").addEventListener("click", EditCT);
            function EditCT() {
                var Cid = document.getElementById('CTEdit').value;
                var Rename = document.getElementById('CTRename').value;
                console.log(Cid);
                console.log(Rename);
                var cid = JSON.stringify(Cid);
                var renames = JSON.stringify(Rename);
                $.ajax({
                    type: "POST",
                    url: "EditType.php",
                    data: {id: cid, rename: renames},
                    success: function (res) {
                        console.log(res);
                        location.reload();
                    }

                });
            }
            ;


            document.getElementById("CTdel").addEventListener("click", DelCT);
            function DelCT() {
                var Cid = document.getElementById('CTDelete').value;
                console.log(Cid);
                var cid = JSON.stringify(Cid);
                $.ajax({
                    type: "POST",
                    url: "DelType.php",
                    data: {id: cid},
                    success: function (res) {
                        console.log(res);
                        location.reload();
                    }

                });
            }
            ;



            // Category  Date Control Department


            document.getElementById("addC").addEventListener("click", myADD);
            function myADD() {
                var Cname = document.getElementById("Cname").value;
                console.log(Cname);
                var cname = JSON.stringify(Cname);

                $.ajax({
                    type: "POST",
                    url: "AddCatag.php",
                    data: {name: cname},
                    success: function (res) {
                        console.log(res);
                        location.reload();
                    }

                });

            }
            ;


            document.getElementById("EditC").addEventListener("click", editC);
            function editC() {
                var Cid = document.getElementById('editsC').value;
                var Rename = document.getElementById('Rename').value;
                console.log(Cid);
                console.log(Rename);
                var cid = JSON.stringify(Cid);
                var renames = JSON.stringify(Rename);
                $.ajax({
                    type: "POST",
                    url: "EditCat.php",
                    data: {id: cid, rename: renames},
                    success: function (res) {
                        console.log(res);
                        location.reload();
                    }

                });
            }
            ;



            document.getElementById("DelC").addEventListener("click", DelC);
            function DelC() {
                var Cid = document.getElementById('DeleteC').value;
                console.log(Cid);
                var cid = JSON.stringify(Cid);
                $.ajax({
                    type: "POST",
                    url: "DelCat.php",
                    data: {id: cid},
                    success: function (res) {
                        console.log(res);
                        location.reload();
                    }

                });
            }
            ;

            // Sub Type Department


            document.getElementById("AddSubT").addEventListener("click", myFunction);
            function myFunction() {

                var Cid = document.getElementById('selectT').value;
                var SubC = document.getElementById('SubT').value;
                console.log(Cid);
                console.log(SubC);

                var cid = JSON.stringify(Cid);
                var subc = JSON.stringify(SubC);
                $.ajax({
                    type: "POST",
                    url: "AddSubT.php",
                    data: {id: cid, Subc: subc},
                    success: function (res) {
                        console.log(res);
                        location.reload();
                    }

                });
            }
            ;

            document.getElementById("STedit").addEventListener("click", EditST);
            function EditST() {
                var Cid = document.getElementById('STEdit').value;
                var Rename = document.getElementById('STRename').value;
                console.log(Cid);
                console.log(Rename);
                var cid = JSON.stringify(Cid);
                var renames = JSON.stringify(Rename);
                $.ajax({
                    type: "POST",
                    url: "EditSubT.php",
                    data: {id: cid, rename: renames},
                    success: function (res) {
                        console.log(res);
                        location.reload();
                    }

                });
            }
            ;

                document.getElementById("STdel").addEventListener("click", DelST);
            function DelST() {
                var Cid = document.getElementById('STDelete').value;
                console.log(Cid);
                var cid = JSON.stringify(Cid);
                $.ajax({
                    type: "POST",
                    url: "DelSubT.php",
                    data: {id: cid},
                    success: function (res) {
                        console.log(res);
                        location.reload();
                    }

                });
            }
            ;





            $(document).ready(function () {


                $('#year').datepicker({
                    minViewMode: 'years',
                    autoclose: true,
                    format: 'yyyy'
                });
                $('select').select2();
//                        $('#CTDelete').selectize({
//                          sortField: 'text'
//                $('select').select2();
                // });

            });
        </script>





        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>


    </body>
</html>