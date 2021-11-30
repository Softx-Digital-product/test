
<?php
//index.php


 
$Dtitle= "Interim Application for Amendment in Suit No. 366/2\?021";
echo $DTitle;
//rm_special_char($str);
$finalname= rm_special_char($Dtitle);

function rm_special_char($str) {
$finalval = str_replace( array("#", "'", ";","/","?","$","*","\\","<",">"), '', $str);
return $finalval;
}



?>
<!--<!DOCTYPE html>
<html>
 <head>
  <title>Jquery Fullcalandar Integration with PHP and Mysql</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha.6/css/bootstrap.css" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.js"></script>
  <script>
   
  $(document).ready(function() {
      
   var calendar = $('#calendar').fullCalendar({
    editable:true,
    header:{
     left:'prev,next today',
     center:'title',
     right:'month,agendaWeek,agendaDay'
    },
//    events: 'load.php',
//events_source: 'Calendar/load.php',

  selectable:true,
    selectHelper:true,
   
<?php
include 'UploadCase/Dp.php';
$sql= "SELECT * FROM Events, EventTypes WHERE ETypeId = EventTypes.Sr_no; ";
     $sql = mysqli_query($con, $sql);
     while ($row = $sql->fetch_assoc()) {
//         echo "<pre>";
//         print_r($row);
//         echo "</pre>";
         
?>
            
events:[{
        id: '<?php echo $row['Sr_no'];?>', 
        title :'<?php echo $row['ETitle'];?>', 
        
        <?php
        $start = date('Y-m-d', strtotime($row['ESD']));
        $end= date('Y-m-d', strtotime($row['EED']));
        ?>
//        start :'<?php echo date('Y-m-d', strtotime($row['ESD']));?>',
//        end:'<?php echo date('Y-m-d', strtotime($row['EED']));?>',

//     start :'<?php echo $start;?>',
//        end:'<?php echo $end;?>',

            start: '2021-08-16',
            end: '2021-08-17',
            
            textColor:'white',
            backgroundColor:'<?php echo $row['EventColor'];?>',
        },
        
    ],
//        
//     events: [
//                            {
//                                title: 'Testing 1',
//                                start: '2021-08-16',
//                                end: '2021-08-17',
////                                allDay: false,
//                                color: 'green',
//                              textColor: 'white',
//                                backgroundColor: 'green'
//                            },
//                            {
//                                title: 'Testing',
//                                start: '2021-07-10',
//                                color: '#ff7538',
//                                textColor: 'white',
//                                backgroundColor: '#ff7538'
//                            }
//                        ],   
       
   
   <?php
} 
   ?>
               


   });
  });
   
  </script>
 </head>
 <body>
  <br />
  <h2 align="center"><a href="#">Jquery Fullcalandar Integration with PHP and Mysql</a></h2>
  <br />
  <div class="container">
   <div id="calendar"></div>
  </div>
 </body>
</html>-->
