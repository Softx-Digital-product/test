
<?php

 ini_set('session.save_path', 'session');
 
session_start();
if(isset($_SESSION['username'])){
    
    $sessionV = $_SESSION['username'];
    $time=time();
    
    
}else{
//        
        header("Location:http://apajuris.in/work/index.php");
       die();
}





 if($clientName === NULL){
                            $clientName = "Please Choose Client Name";
                        }
                        if($caseName === NULL){
                            $caseName = "Please Choose Case Name";
                        }
                        if($pdfName === NULL){
                            $pdfName = "Choose pdf Document";
                        }

?>


<div class="topnav" id="myTopnav">


            <a href="Cms.php" class="nav__link">Dashboard</a>
            <a href="Team.php" class="nav__link">Team</a>
            <a href="Task.php" class="nav_link">Task Management</a>
            <a href="calendar.php" class="nav_link">Calendar</a>
            <a href="library.php" class="nav__link">Library</a>
            <a href="knowledge.php" class="nav__link ">Knowledge</a>
            <a href="Clients.php" class="nav__link active" id="cl">Clients </a>
<!--            <a href="calendere1.php" class="nav_link">Task Management</a>-->
            <a href="Drafting.php"class="nav_link" id="df">Drafting</a>
              <a href="editor.php" class="nav_link" id='ed'>Editor</a>
            <a href="Pleadings.php"class="nav_link"id="pl">Pleading</a>
            <a href="Training.php" class="nav_link"id="tr">Training</a>
<!--            <a href="#" class="nav__link">Manage Cme</a>-->
<!--            <a href="#" class="nav__link">Manage Kms</a>
            <a href="#" class="nav__link">Mange Law</a>-->
            <a href="#" class="nav__link">Control panel</a>




            <a href="#" class="btn1"><i class="fa fa-search" aria-hidden="true"></i></a>  
            <a href="#" class="btn1"><i class="fa fa-calendar" aria-hidden="true"></i></a>  
            <a href="#" class="btn1"><i class="fa fa-bell-o" aria-hidden="true"></i></a>   &nbsp;
            <a href="logout.php"class="btn1"><i class="fa fa-sign-out" aria-hidden="true"></i></a>

               <p class="mt-1 mr-4 p-0 text-white float-right">login as : <?php echo  $sessionV ?></p>

            <a href="javascript:void(0);" class="icon" onclick="myFunction()">
                <i class="fa fa-bars"></i>
            </a>

        </div>

        <script src="https://unpkg.com/ionicons@5.1.2/dist/ionicons.js"></script>

        <div class="topnav1" id="myTopnav">
            <a href="Clients.php" class="nav__link" >Client</a>
            <a href="ClientCase.php" class="nav__link">Case</a>
<!--            <a href="uploadcasedoc.php" class="nav__link">Upload Case Documents</a>
            <a href="Timelines.php" id="tl" class="nav__link active">TimeLine</a>
            <a href="ViewDoc.php" class="nav__link">View Case Documents</a>-->
             <a href="ClientBrief.php" class="nav__link">Upload Client Brief</a>
             <a href="viewbriefs.php"id="cb" class="nav__link">View Client Brief</a>
             <a  href="PdfManager.php" id="PDFMNav" class="nav__link">PDF Manager</a>
              <a  href="Sorting.php" id="sorting" class="nav__link">Sorting</a>
              <a href="viewSorted.php"id="viewsorting" class="nav__link">View Sorted Documents</a>
            <!--         <a href="javascript:void(0);" class="icon1" onclick="myFunction1()">
                                          <i class="fa fa-bars"></i>
                                         </a>-->

        </div>
        <div class="container-fluid vc">


            <div class="container">

                <!--    <form method="POST" action="" enctype="multipart/form-data">-->
                <div class="container">

                    <div class="row">

                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="form-group mt-1 mb-1">
                                <!--                                <label class="font-weight-bolder" for="exampleFormControlSelect1">Select Client Name</label>-->

                                <select class="CN" id="ClientN" style="width:100%;" placeholder="Please Select Client Name"onchange="document.getElementById('text_CT').value = this.options[this.selectedIndex].text">
<!--                                    <option value=""disabled selected>Please Choose Client Name</option>-->
                                    <option value=""disabled selected><?php echo $clientName ?></option>
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
                                <!--                            <label class="font-weight-bolder" for="exampleFormControlSelect1">Select Case Name</label>-->
                                <select class="CN"  style="width:100%;" id="CaseName" placeholder="Please Select Client Name"onchange="document.getElementById('text_CN').value = this.options[this.selectedIndex].text">
<!--                                    <option value=""disabled selected>Please Choose Case Name</option>-->
                                    <option value=""disabled selected><?php echo $caseName?></option>
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
           

        </div>