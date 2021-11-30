

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

?>


<div class="topnav" id="myTopnav">


        <a href="Cms.php" class="nav__link" id="ds">DashBoard</a>
        <a href="Team.php" class="nav__link" id="TM">Team</a>
        <a href="Task.php" id="taskm"class="nav_link">Task Management</a>
            <a href="calendar.php" class="nav_link " id="cl">Calendar</a>
        <a href="library.php" class="nav__link" id="Lb">Library</a>
        <a href="knowledge.php" class="nav__link "id="kn">Knowledge</a>
        <a href="Clients.php" id="CM"class="nav__link active">Clients </a>
        
        <a href="Drafting.php"class="nav_link" id='df'>Drafting</a>
        <a href="editor.php" class="nav_link" id='ed'>Editor</a>
        <a href="Pleadings.php"class="nav_link"id="pl">Pleading</a>
        <a href="Training.php" class="nav_link"id="tr">Training</a>
<!--        <a href="#" class="nav__link">Manage Kms</a>
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
</div> <!-- ===== IONICONS ===== -->
<script src="https://unpkg.com/ionicons@5.1.2/dist/ionicons.js"></script>

<div class="topnav1" id="mybottomnav">
    <a href="Clients.php"  id="ClientNav"class="nav__link" >Client</a>
    <a href="ClientCase.php" id="CaseNav" class="nav__link ">Case</a>
<!--    <a href="uploadcasedoc.php" id="UCDNav"class="nav__link">Upload Case Documents</a>
    <a href="Timelines.php" id="TimelineNav" class="nav__link">TimeLine</a>
    <a href="ViewDoc.php" id="VCDNav"class="nav__link">View Case Documents</a>-->
    <a href="ClientBrief.php" id="UCBNav" class="nav__link ">Upload Client Brief</a>
    <a href="viewbriefs.php"id="VCBNav" class="nav__link">View Client Brief</a>
    <a href="PdfManager.php"  id="PDFMNav"class="nav__link">PDF Manager</a>
    <a  href="Sorting.php" id="sorting" class="nav__link">Sorting</a>
    <a href="viewSorted.php"id="viewsorting" class="nav__link">View Sorted Documents</a>
    <!--         <a href="javascript:void(0);" class="icon1" onclick="myFunction1()">
                                  <i class="fa fa-bars"></i>
                                 </a>-->

</div>
