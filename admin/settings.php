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

$user = -1;
if (isset($_GET['user'])) {
	$user = $_GET['user'];
}
$pw = -1;
if (isset($_GET['pw'])) {
	$pw = $_GET['pw'];
}
$gettimeslot = -1;
if (isset($_GET['timeslot'])) {
	$gettimeslot = $_GET['timeslot'];
}
if (isset($_POST['updatepw'])) {
	//save new password
	updatePassword($_POST['userid'], $_POST['password']);
	header("Location: settings.php");
    die();
}
if (isset($_GET['updateuser'])) {
	//save new password
	updateUser($_GET['userid'], $_GET['username']);
	header("Location: settings.php");
    die();
}
if (isset($_POST['adduser'])) {
	//save new password
	newUser($_POST['username'], $_POST['password']);
	header("Location: settings.php");
    die();
}
if (isset($_GET['updatetimeslot'])) {
	//save new password
	updateTimeslot($_GET['timeslotid'], $_GET['zeit'], $_GET['count'], $_GET['enabled']);
	header("Location: settings.php");
    die();
}
if (isset($_GET['addtimeslot'])) {
	//save new password
	newTimeslot($_GET['zeit'], $_GET['count'], $_GET['enabled']);
	header("Location: settings.php");
    die();
}
if (isset($_GET['Settings'])) {
	//save new password
	//updateFrontDe($_GET['front_de']);
	updateSetting($_GET['name'],$_GET['value']);
	header("Location: settings.php");
    die();
}


echo head("Ordering - Admin");
echo body_top_admin("Ordering",$username);
echo display_admin_menu("settings", 2);
echo body_title_top("Settings");
echo add_button("Add User", "settings.php?user=0");
echo "&nbsp;";
echo add_button("Add timeslot", "settings.php?timeslot=0");
echo body_title_bottom();

//user liste
echo "<h3 class='h3'>Users</h3>";
echo table_head(array("UserID","User","Edit","Password", "Delete"));
$users = getUsers();
foreach ($users as $array) {
	echo table_body(array($array["userid"],$array["username"],
	"<a href='settings.php?user=".$array["userid"]."'>Edit</a>",
	"<a href='settings.php?pw=".$array["userid"]."'>Change PW</a>",
	add_button("Delete", "settings.php?deluser=".$array["userid"])));
	
}
echo table_end();

if ($user == 0) {
	//display form, new page
	
	echo "<h3 class='h3'>Add new user</h3>";
	
	echo form_head("settings.php", "POST");
	echo form_text("username","","Username:","");
	echo form_text("password","","Password:","");
	echo form_mid();
	echo form_button("adduser","Save");
	echo form_end();
	echo "<br>";
} else if ($user > 0) {
	//display form, edit page
	
	echo "<h3 class='h3'>Update user</h3>";
	$user = getUser($user);
	echo form_head("settings.php", "GET");
	echo form_hidden("userid",$user['userid']);
	echo form_text("username",$user['username'],"Username:","");
	echo form_mid();
	echo form_button("updateuser","Save");
	echo form_end();
	
	echo "<br>";
} else if ($pw > 0) {
	//display form, edit pw
	
	$user = getUser($pw);
	echo "<h3 class='h3'>Update password for ".$user['username']."</h3>";
	echo form_head("settings.php", "POST");
	echo form_hidden("userid",$user['userid']);
	echo form_password("password","","Password:","");
	echo form_mid();
	echo form_button("updatepw","Save");
	echo form_end();
	echo "<br>";
	
}


//timeslot liste
echo "<h3 class='h3'>Timeslots</h3>";
echo table_head(array("ID","Time","Max Orders","Enabled","Edit"));
$timeslots = getTimeslots();
foreach ($timeslots as $array) {
	echo table_body(array($array["timeslotid"],$array["zeit"],$array["count"],$array["enabled"],"<a href='settings.php?timeslot=".$array["timeslotid"]."'>Edit</a>"));
}
echo table_end();

if ($gettimeslot == 0) {
	//display form, new page
	
	echo "<h3 class='h3'>Add new timeslot</h3>";
	
	echo form_head("settings.php", "GET");
	echo form_text("zeit","","Time:","");
	echo form_text("count","","Max Orders:","");
	echo form_checkbox("enabled","1","Enabled:","",0);
	echo form_mid();
	echo form_button("addtimeslot","Save");
	echo form_end();
	
	echo "<br>";
} else if ($gettimeslot > 0) {
	//display form, edit page
	
	echo "<h3 class='h3'>Update timeslot</h3>";
	$timeslot = getTimeslot($gettimeslot);
	echo form_head("settings.php", "GET");
	echo form_hidden("timeslotid",$timeslot['timeslotid']);
	echo form_text("zeit",$timeslot['zeit'],"Time:","");
	echo form_text("count",$timeslot['count'],"Max Orders:","");
	echo form_checkbox("enabled","1","Enabled:","",$timeslot['enabled']);
	echo form_mid();
	echo form_button("updatetimeslot","Save");
	echo form_end();
	
	echo "<br>";
}


//general settings
echo "<h3 class='h3'>Additional settings</h3>";
//get text from db settings->front_de front_en

//button for saving
echo form_head("settings.php", "GET");
echo form_hidden("name","front_de");
echo "<textarea name='value' cols='170' rows='5'>".getSetting("front_de")."</textarea><br>";
echo form_button("Settings","Save");
echo form_end();

echo form_head("settings.php", "GET");
echo form_hidden("name","front_en");
echo "<textarea name='value' cols='170' rows='5'>".getSetting("front_en")."</textarea><br>";
echo form_button("Settings","Save");
echo form_end();


echo body_bottom();



?>