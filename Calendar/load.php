<?php

//load.php
$con=mysqli_connect("06.mysql.servage.net","1005138_ap72875","GolfTango@5432","1005138-sahyog");
$connect = new PDO('mysql:host=06.mysql.servage.net;dbname=1005138-sahyog', '1005138_ap72875', 'GolfTango@5432');

$data = array();

//$query = "SELECT * FROM Events, EventTypes WHERE ETypeId = EventTypes.Sr_no";
$query = "SELECT *, Events.Sr_no as Esr From Events, EventTypes Where EventTypes.Sr_no = Events.ETypeId ";
$statement = $connect->prepare($query);

$statement->execute();

$result = $statement->fetchAll();

//foreach($result as $row)
//{
// $data[] = array(
////  'id'   => $row["Sr_no"],
////  'title'   => $row["ETitle"],
////  // 'type' => $row['ETypetxt'],
////  'start'   => $row["ESD"],
////  'end'   => $row["EED"]
//     
//     
//      "title" => "Event 2",
//      "start"=> 2021-08-08,
//      "end" => 2021-08-12
// );
//}



	//$sqlEvents = "SELECT * FROM cms_task LIMIT 100";
	$resultset = mysqli_query($con, $query) or die("database error:". mysqli_error($con));
	$calendar = array();
	while( $rows = mysqli_fetch_array($resultset,MYSQLI_ASSOC) ) {	
		// convert  date to milliseconds
//		$start = strtotime($rows['ESD']) * 1000;
//		$end = strtotime($rows['EED']) * 1000;	
            
                 $start = date('Y-m-d', strtotime($row['ESD']));
        $end= date('Y-m-d', strtotime($row['EED']));
        
		$calendar[] = array(
			'id' =>$rows['Esr'],
			'title' => $rows['ETitle'],
//			'url' => "task-details.php?taskid=".$rows['taskid'],
//			"class" => 'event-important',
//			'start' => "2021-08-01T12:30:00",
//			'end' => "2021-08-19T12:20:00",
                        'start' => $rows['ESD'],
                        'end' => $rows['EED'],
                        'textColor' => "white",
                        'backgroundColor' => $rows['EventColor'],
                     
		);
	}
	$calendarData = array(
		"success" => 1,	
		"result"=>$calendar);
        
	echo json_encode($calendar);
	exit; 



//echo json_encode($data);

?>