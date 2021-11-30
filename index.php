<?php


include('KnowledgeDb/Dp.php');

//echo "Hello";

ini_set('session.save_path', 'session');

session_start();

  if (isset($_POST['submit'])) {
    
    $userMail=$_POST['mail'];
    $Pass=$_POST['pass'];
    

    
    
    $sql= "Select * from TeamMembers Where Mail_Id = '$userMail' && Password = '$Pass' AND  status = 'Active'";
   // echo $sql;
      
    $result = mysqli_query($con, $sql);
    $num= mysqli_num_rows($result);
    if($num ==1){
        while ($row = mysqli_fetch_array($result)) {
//            echo "<pre>";
//            print_r($row);
//            echo "</pre>";
            $_SESSION['role']= $row['Role'];
            $_SESSION['Tsr']= $row['Sr_no'];
        }
        $_SESSION['username']= $userMail;
        
        
        
     
       header("Location:http://apajuris.in/work/Cms.php");
        die();
    }else{
        echo "<Strong Style='color:red'>Invalid Email Address or Password Please Contact to Super Admin</Strong>";
        
    }
    
//  if($userMail=='testing@gmail.com' || $userMail == $Rmail  && $Pass=='Hello@2021' || $pass== $Rpass){ 
//        if($userMail == $Rmail  && $pass== $Rpass){ 
//        $_SESSION['username']=$userMail;
//        echo $_SESSION['username'];
//        
//       header("Location:http://apajuris.in/work/Cms.php");
//        die();
//    }else{
//      echo "Invalid Email or Password !!!";
//    }
// 
    
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

    <title>Login</title>
  </head>
  <body>
    
      
      <div class="container border mt-5 shadow">
          
  <div class="row">
    <div class="col-lg-6 col-md-6 col-sm-12">
    <div class="container">
                        <figure><img class="rounded mx-auto d-block" src="images/signin-image.jpg" alt="sing up image"></figure>
                   
    </div>
    </div>
  <div class="col-lg-6 col-md-6 col-sm-12">
      <form class="mt-3" method="POST" action="">
          <h3 class="text-center">Login </h3>
                   <div class="form-group">
    <label class=" mt-3 "for="exampleInputEmail1">Enter Your Email address</label>
    <input type="email" class="form-control" name="mail" id="exampleInputEmail1"  placeholder="Email Address"aria-describedby="emailHelp">
  </div>
           <div class="form-group">
    <label for="exampleInputPassword1">Password</label>
    <input type="password" class="form-control" name="pass" placeholder="Password" id="exampleInputPassword1">
  </div>
          
             <div class="form-group">
                 <button type="submit"class="btn btn-success" name="submit" >Submit</button>
              
  </div>
             <a href="#" class="nav-link">Forget Password </a>
        
              </form>
              
    </div>
         
          
      </div>
      </div>
    
    
    
    
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>

   
  </body>
</html>