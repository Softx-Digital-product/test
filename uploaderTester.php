<?php

//echo phpinfo();

if(isset($_FILES['file'])){
//     echo "<pre>";
//     print_r($_FILES);
//     echo "</pre>";
    $file_dir ="TempFolder/";
  echo "Hello <Br><br>";
    echo "pre";
    print_r($_FILES['file']);
    
//      $file_name = $_FILES['file']['name'];
//      $file_size = $_FILES['file']['size'];
//      $file_tmp = $_FILES['file']['tmp_name'];
//      $file_type = $_FILES['file']['type'];

 foreach($_FILES['file']['name']as $key=>$val){
      $fileName = basename($_FILES['file']['name'][$key]); 
      $fileSize= basename($_FILES['file']['size'][$key]);
      $targetFilePath = $file_dir . $fileName; 
      if(move_uploaded_file($_FILES["file"]["tmp_name"][$key], $targetFilePath)){
        echo "file Uploaded Successfully Bro";
      
      }
      else{
          echo "file Can't upload";
      }

        

     }
     
   
}
?>


<html>
    <head>
        <title>
            Upload Testing
        </title>
        
    </head>
    <body>
        
        <form action="" method="POST" enctype="multipart/form-data" >
            <br><br>
            <input type="file" name="file[]" multiple><br><br>
            <input type="submit" name="submit" value="Upload">
            
        
    </form>
        
        
    </body>
    
</html>