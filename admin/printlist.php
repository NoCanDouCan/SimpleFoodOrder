<?php
session_start();
if (!isset($_SESSION['username'])) {
	header("Location: login.php");
	die();
}
$username = $_SESSION['username'];

include "../inc/query.php";

$getmealid = 0;
if (isset($_GET['mealid'])) {
	$getmealid = $_GET['mealid'];
}


$meal = getMeal($getmealid);
$time = strtotime($meal['datum']);
echo "Datum:".date("d.m.Y",$time)."<br>";
echo "Gericht:".$meal['name_de']."<br>";
echo "Druckdatum:".date("d.m.Y H:i")."Uhr<br><br>";

$html = "<table width='600px' border='1' >";
$html .= "<tr>";
$html .= "<th align='left'>Time</th>";
$html .= "<th align='left'>Waitlist</th>";
$html .= "<th align='left'>FirstName</th>";
$html .= "<th align='left'>LastName</th>";
$html .= "<th align='left'>Phone</th>";
$html .= "<th align='left'>eMail</th>";
//$html .= "<th align='left'>Optional</th>";

$html .= "</tr>";

$orders = getOrdersForMeal($getmealid);
$lasttime = "";
foreach($orders as $order) {
	if ($lasttime == "") {
		//add top info for timeslot
		
		$timeslot = getTimeslotForMeal($getmealid,$order['timeslotid']);

		$lasttime = $order['zeit'];
		$html .= "<tr>";
		$html .= "<td colspan='6'>".$lasttime." ".$timeslot["booked"]."/".$timeslot["count"]." booked</td>";
		$html .= "</tr>";
		
	} else if ($lasttime != $order['zeit']) {
		//add empty row
		$html .= "<tr>";
		$html .= "<td>".$lasttime."</td>";
		$html .= "<td></td>";
		$html .= "<td></td>";
		$html .= "<td></td>";
		$html .= "<td></td>";
		$html .= "<td></td>";
		$html .= "</tr>";
		//add top info for timeslot
		$timeslot = getTimeslotForMeal($getmealid,$order['timeslotid']);
		$lasttime = $order['zeit'];
		$html .= "<tr>";
		$html .= "<td colspan='6'>".$lasttime." ".$timeslot["booked"]."/".$timeslot["count"]." booked</td>";
		$html .= "</tr>";
		
	}
	$html .= "<tr>";
	$html .= "<td>".$order['zeit']."</td>";
		if ($order['wait'] == 1) {
		$html .= "<td>Y</td>";
	} else {
		$html .= "<td></td>";
	}
	$html .= "<td>".$order['name']."</td>";
	$html .= "<td>".$order['lastname']."</td>";
	$html .= "<td>".$order['phone']."</td>";
	$html .= "<td>".$order['email']."</td>";
	
	$html .= "</tr>";
	$optionals = getOptionalsforOrder($order['orderid']);
	foreach ($optionals as $optional) {
		$html .= "<tr>";
		$html .= "<td></td>";
		$html .= "<td colspan='5'>";
		$html .= $optional['name_de'];
		$html .= "</td>";
		$html .= "</tr>";
	}
	
	

	
}
//add empty row
$html .= "<tr>";
$html .= "<td>".$lasttime."</td>";
$html .= "<td></td>";
$html .= "<td></td>";
$html .= "<td></td>";
$html .= "<td></td>";
$html .= "<td></td>";
$html .= "</tr>";

$html .= "</table>";


echo $html;


?>