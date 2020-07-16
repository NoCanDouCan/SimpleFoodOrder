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

$edit = -1;
if (isset($_GET['edit'])) {
	$edit = $_GET['edit'];
}

if (isset($_GET['Save'])) {
	//save new entry in db
	$optional = 0;
	if (isset($_GET['optional'])) {
		$optional = $_GET['optional'];
	}
	newMeal($_GET['name_de'], $_GET['name_eng'],$_GET['sidemeal_de'], $_GET['sidemeal_eng'], $_GET['datum'], $optional);
	header("Location: index.php");
    die();
}

if (isset($_GET['Update'])) {
	//update entry in db
	$optional = 0;
	if (isset($_GET['optional'])) {
		$optional = $_GET['optional'];
	}
	updateMeal($_GET['mealid'],$_GET['name_de'], $_GET['name_eng'],$_GET['sidemeal_de'], $_GET['sidemeal_eng'], $_GET['datum'], $optional);
	header("Location: index.php");
    die();
}

if (isset($_GET['del'])) {
	//disable entry in db
	disableMeal($_GET['del']);
	header("Location: index.php");
    die();
}


echo head("Ordering - Admin");
echo body_top_admin("Ordering",$username);
echo display_admin_menu("meal", 2);
echo body_title_top("Meal Admin");
echo add_button("Add Meal", "index.php?edit=0");
echo body_title_bottom();


if ($edit == 0) {
	//display form, new page
	
	echo "<h3 class='h3'>Add new meal</h3>";
	
	echo form_head("index.php", "GET");
	echo form_text("name_de","","Name DE:","");
	echo form_text("name_eng","","Name ENG:","");
	echo form_text("sidemeal_de","","Dessert DE:","");
	echo form_text("sidemeal_eng","","Dessert ENG:","");
	echo form_date("datum","","Date:","");
	echo form_checkbox("optional","1","Optional:","",0);
	echo form_mid();
	echo form_button("Save","Save");
	echo form_end();
	
	echo "<br>";
} else if ($edit > 0) {
	//display form, edit page
	
	echo "<h3 class='h3'>Update meal</h3>";
	$meal = getMeal($edit);
	echo form_head("index.php", "GET");
	echo form_hidden("mealid",$meal['mealid']);
	echo form_text("name_de",$meal['name_de'],"Name DE:","");
	echo form_text("name_eng",$meal['name_eng'],"Name ENG:","");
	echo form_text("sidemeal_de",$meal['sidemeal_de'],"Dessert DE:","");
	echo form_text("sidemeal_eng",$meal['sidemeal_eng'],"Dessert ENG:","");
	echo form_hidden("datum",$meal['datum']);
	//echo form_date("datum",$meal['datum'],"Date:","");
	echo form_checkbox("optional","1","Optional:","",$meal['optional']);
	echo form_mid();
	echo form_button("Update","Update");
	echo form_end();
	
	echo "<br>";
}


echo table_head(array("Name DE","Dessert DE","Name EN","Dessert EN","Date","Optional","Edit","Delete"));
$meals = getMeals();
foreach ($meals as $array) {
	if ($array["disabled"] == 0) {
		$optional = "";
		if ($array["optional"] == 1) {
			$optional = "yes";
		} else {
			$optional = "no";
		}
		$edit_button="<a href='index.php?edit=".$array["mealid"]."' class='btn btn-sm btn-outline-secondary'>Edit</a>";
		$disable_button="<a href='index.php?del=".$array["mealid"]."' class='btn btn-sm btn-outline-secondary'>Delete</a>";
		echo table_body(array($array["name_de"],$array["sidemeal_de"],$array["name_eng"],$array["sidemeal_eng"],$array["datum"],$optional,$edit_button,$disable_button));
	}
}
echo table_end();






echo body_bottom();

?>