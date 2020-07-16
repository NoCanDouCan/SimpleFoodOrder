<?php
session_start();
if (!isset($_SESSION['username'])) {
	header("Location: login.php");
	die();
}
$username = $_SESSION['username'];

include "../inc/query.php";
include "../inc/html.php";
include "../inc/admin_menu.php";

$getmealid = 0;
$getselect = "";
if (isset($_GET['select'])) {
	$getmealid = $_GET['mealid'];
	$getselect = $_GET['select'];
}

if (isset($_GET['delete'])) {
	$orderid = $_GET['delete'];
	//deleteorder
	
	

	$order = getOrder($orderid);
	$meal = getMeal($order["mealid"]);
	$time = strtotime($meal["datum"]);
	$timeslot = getTimeslot($order["timeslotid"]);

	$betreff = "Lunch MPH ".date('d.m.Y',$time)." ".$timeslot["zeit"]." cancelled";
	mail($order["email"], $betreff,"", "From: xyz@domain.com");

	deleteOrder($orderid);
	
	$link = "Location: print.php?mealid=".$getmealid."&select=Filter";
	header($link);
	die;
}
if (isset($_GET['deletemeal'])) {
	$mealid = $_GET['deletemeal'];
	//deleteorder
	deleteMeal($mealid);
	
	$link = "Location: print.php?mealid=".$getmealid."&select=Filter";
	header($link);
	die;
}
if (isset($_GET['update'])) {
	$getorderid = $_GET['update'];
	$getwait = $_GET['wait'];
	
	$order = getOrder($getorderid);
	$meal = getMeal($order["mealid"]);
	$time = strtotime($meal["datum"]);
	$timeslot = getTimeslot($order["timeslotid"]);
	if ($getwait == 1) {
		//to waitlist
		$betreff = "Your booked Lunch on ".date('m/d/Y',$time)." from ".$timeslot["zeit"]." was moved to the waitlist";
		mail($order["email"], $betreff,"", "From: xyz@domain.com");
	} else {
		//from waitlist
		$betreff = "Confirmation Lunch on ".date('m/d/Y',$time)." from ".$timeslot["zeit"];
		mail($order["email"], $betreff,"", "From: xyz@domain.com");
	}
	
	
	//deleteorder
	updateWaitlist($getorderid,$getwait);
	
	$link = "Location: print.php?mealid=".$getmealid."&select=Filter";
	header($link);
	die;
}



echo head("Ordering - Admin");
echo body_top_admin("Ordering",$username);
echo display_admin_menu("page", 2);
echo body_title_top("Print List");
echo body_title_bottom();



$meals = getMealsDESC();
$values = [];
foreach ($meals as $meal) {
	if ($meal['optional'] == 0)
	{
		
		if ($getmealid == 0) {
			$getmealid = $meal['mealid'];
			$values[] = array("valueid" => $meal['mealid'], "value" => $meal['datum']." ".$meal['name_de']);
		} elseif ($getmealid == $meal['mealid']) {
			$values[] = array("valueid" => $meal['mealid'], "value" => $meal['datum']." ".$meal['name_de'], "selected" => "1");
		} else {
			$values[] = array("valueid" => $meal['mealid'], "value" => $meal['datum']." ".$meal['name_de']);
		}
		
	}
}

//filter for table
echo form_head("print.php", "GET");
echo form_select("mealid", $values, "Select Date", "");
echo form_mid();
echo form_button("select","Filter");
echo form_end();
echo "<br>";

//Print list button
$meal = getMeal($getmealid);
echo "Active Filter: ".$meal["datum"];
echo "<br><a target='_blank' href='printlist.php?mealid=".$getmealid."' class='btn btn-primary' >Print list</a>";

//delete button
echo "<button type='button' class='btn btn-primary float-right' data-toggle='modal' data-target='#ModalDelete'>Delete</button>";
echo modal_form("ModalDelete", "Confirm delete ".$meal['datum'], "This will delete all data meals/orders/personal data for ".$meal['datum'].".<br>Continue?", "print.php?deletemeal=".$getmealid);

//table with filtered data
echo table_head(array("FirstName","LastName","Phone","eMail","Waiting List","Time", ""));
$orders = getOrdersForMeal($getmealid);
foreach($orders as $order) {
	$button_delete = "<a class='btn btn-sm btn-outline-secondary' href='print.php?mealid=".$getmealid."&select=Filter&delete=".$order['orderid']."' role='button'>Delete</a>";
	if ($order['wait'] == 1) {
		$button_waitlist = "<a class='btn btn-sm btn-outline-secondary' href='print.php?mealid=".$getmealid."&select=Filter&update=".$order['orderid']."&wait=0' role='button'>From Waitlist</a>";
	} else {
		$button_waitlist = "<a class='btn btn-sm btn-outline-secondary' href='print.php?mealid=".$getmealid."&select=Filter&update=".$order['orderid']."&wait=1' role='button'>To Waitlist</a>";
	}
	echo table_body(array($order['name'],$order['lastname'],$order['phone'],$order['email'],$order['wait'],$order['zeit'],$button_delete." ".$button_waitlist));
}
echo table_end();

echo body_bottom();

?>