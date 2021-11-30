<?php
 ini_set('session.save_path', 'session');
 
session_start();
if(isset($_SESSION['username'])){
    
    $sessionV = $_SESSION['username'];
    $time=time();
    
    
}else{
//        echo $_SESSION['username'];
        header("Location:http://apajuris.in/work/index.php");
       die();
        echo"Hello";
        //session_start();
        echo $_SESSION['username'];
}

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">

        <!-- ===== CSS ===== -->
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link rel="stylesheet" href="assets12/css/sam.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha512-SfTiTlX6kk+qitfevl/7LibUOeJWlt9rbyDn92a1DqWOw9vWG2MFoays0sgObmWazO5BQPiFucnnEAjpAB+/Sw==" crossorigin="anonymous" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
 
        
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
 
        <style>
            .nav-link:hover{
                color:white;
            }
</style>
        <title>DashBoard</title>
    </head>
    <body>
 

    
        <div class="topnav" id="myTopnav">
                       
                
<!--                        <a href="#" class="nav__link active">Timeline</a></li>
                        <a href="#" class="nav__link">Client Brief</a></li>
                        <a href="#" class="nav__link">Law</a></li>
<a href="knowledge.php" class="nav__link">Knowledge</a></li>
                        <a href="Clients.php" class="nav__link">Clients </a></li>
                        <a href="./calendere1.php" class="nav__link ">Task Management</a></li>
                        <a href="#" class="nav__link">Manage Cms</a></li>
                        <a href="#" class="nav__link">Manage Kms</a></li>
                        <a href="#" class="nav__link">Mange Law</a></li>
                        <a href="#" class="nav__link">Manage Tms</a></li>-->
                      
          <a href="Cms.php" class="nav__link active">DashBoard</a>
        <a href="Teams.php" class="nav__link " id="TM">Team</a>
         <a href="Task.php" class="nav_link">Task Management</a>
            <a href="calendar.php" class="nav_link">Calendar</a>
        <a href="Library.php" class="nav__link">Library</a>
        <a href="knowledge.php" class="nav__link ">Knowledge</a>
        <a href="Clients.php" id="CM"class="nav__link">Clients </a>
       
        <a href="Drafting.php"class="nav_link">Drafting</a>
        <a href="editor.php" class="nav_link" id='ed'>Editor</a>
        <a href="Pleadings.php"class="nav_link"id="pl">Pleading</a>
        <a href="Training.php" class="nav_link"id="tr">Training</a>
        <a href="control.php" class="nav__link">Control panel</a>
                    
                        &nbsp;
                    <a href="#" class="btn1"><i class="fa fa-search" aria-hidden="true"></i></a> 
                    <a href="#" class="btn1"><i class="fa fa-calendar" aria-hidden="true"></i></a>   
                    <a href="#" class="btn1"><i class="fa fa-bell-o" aria-hidden="true"></i></a>  
                    <a href="./login.php" class="btn1">   
                    <i class="fa fa-user-o" aria-hidden="true"></i></a>
                    
                    <p class="mt-1 mr-4 p-0 text-white float-right">login as : <?php echo  $sessionV ?></p>
                  
                <a href="javascript:void(0);" class="icon" onclick="myFunction()">
                   <i class="fa fa-bars"></i>
                  </a>
            
        </div>
       
        </div> <!-- ===== IONICONS ===== -->
        <script src="https://unpkg.com/ionicons@5.1.2/dist/ionicons.js"></script>

        <script>
            
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
            
            
            
            
function myFunction() {
  var x = document.getElementById("myTopnav");
  if (x.className === "topnav") {
    x.className += " responsive";
  } else {
    x.className = "topnav";
  }
}
</script>

 <script>
        function updateActivity(){
            var activeon = 'Dashboard';
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