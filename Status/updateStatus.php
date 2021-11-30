<?php 

date_default_timezone_set('Asia/Kolkata');
ini_set('session.save_path', '../session');

session_start();
include '../Database/Dp.php';

$umail= $_SESSION['username'];
$tsr= $_SESSION['Tsr'];
$time = time()+5;



if(isset($_POST['TWords'])){
    
      $newwords= $_POST['TWords'];
      
   $check="SELECT * FROM TeamWork WHERE Tsr = '$tsr'";
          $check=mysqli_num_rows(mysqli_query($con,$check));
          
if($check>0){
    //$records = mysqli_query($con,"SELECT * FROM Teamwork WHERE TSR = $tsr"); // fetch data from database
$query = "SELECT TotalWords FROM TeamWork WHERE Tsr = '$tsr'";
//echo $query;
 $quariy = $con->query($query);
                    $num = mysqli_num_rows($quariy);
                    if ($num >= 0) {
                        while ($row = mysqli_fetch_array($quariy)) {
//                    echo "<pre>";
//                    print_r($row);
//                    echo "</pre>";
   $oldwords= $row['TotalWords'];
    $finalwords= $oldwords+$newwords;
                   
//if($oldwords>$newwords){
//    $finalwords= $oldwords-$newwords;
//}else{
//    $finalwords= $oldwords+$newwords;
//}
//   
   
   
//   echo $finalwords;
 
   $updateq = "UPDATE TeamWork SET TotalWords = '$finalwords' WHERE Tsr = {$tsr}";
   if ($con->query($updateq) === TRUE) {
 echo $finalwords;
 
} else {
  echo "Error updating record: " . $con->error;
 
}
   
                    }}
//   echo "Update query firing";
}
else{
// $insq="INSERT INTO TeamWork (Tsr,TotalWords) VALUES ('$tsr','$newwords')";
 $insq= "INSERT INTO TeamWork(Tsr, ClientW, CaseW, DraftW, Workingon, TotalWords) VALUES"
         . " ('$tsr',' ',' ',' ',' ',' ','$newwords')";
 if ($con->query($insq) === TRUE) {
    echo $newwords;
}
else {

  echo "Error: ----->" . $insq . "<br>" . $con->error;
}
 
 
    
}
   
   
   die();
    
}




//echo $umail;
$query ="UPDATE TeamMembers SET last_login = $time WHERE Mail_Id = '$umail'";
echo $query;
//$sql= mysqli_query($con,$query);
if ($con->query($query) === TRUE) {
  echo "Record updated successfully";
  // header("Refresh:0");
} else {
  echo "Error updating record: " . $con->error;
   //header("Location:http://apajuris.in/work/viewBrief.php");
}



if(isset($_POST['status'])){
    $time = time()+2;
   $query ="UPDATE TeamMembers SET Attendance = $time WHERE Mail_Id = '$umail'";
echo $query;
//$sql= mysqli_query($con,$query);
if ($con->query($query) === TRUE) {
  echo "Record updated successfully";
  // header("Refresh:0");
} else {
  echo "Error updating record: " . $con->error;
   //header("Location:http://apajuris.in/work/viewBrief.php");
} 
die();
}

$datum = new DateTime();
$startTime = $datum->format('Y-m-d H:i:s');

if(isset($_POST['activity'])){
    
   $query ="UPDATE TeamMembers SET Active_on = '{$_POST['activity']}', last_visit= '$startTime' WHERE Mail_Id = '$umail'";
echo $query;
//$sql= mysqli_query($con,$query);
if ($con->query($query) === TRUE) {
  echo "Record updated successfully";
  // header("Refresh:0");
} else {
  echo "Error updating record: " . $con->error;
   //header("Location:http://apajuris.in/work/viewBrief.php");
} 
die();
}




?>