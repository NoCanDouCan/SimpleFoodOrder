<?php

include "inc/query.php";
include "inc/html2.php";



$html = head();

$getlang = "de";
if (isset($_GET['lang'])) {
	$getlang = $_GET['lang'];
}

if ($getlang == "de") {
	$html .= body_top($getlang,"index.php?lang=en");
} else {
	$html .= body_top($getlang,"index.php?lang=de");
}

if (isset($_GET['step'])) {
	$getstep = $_GET['step'];
	$getid = $_GET['id'];
	$getdate = $_GET['date'];
	$gettime = "";
	$getname = "";
	$getlastname = "";
	$getphone = "";
	$getemail = "";
	$getwait = 0;
	$geterror = 0;
	if (isset($_GET['time'])) {
		$gettime = $_GET['time'];
	} else {
		$gettime="";
	}
	if (isset($_GET['name'])) {
		$getname = $_GET['name'];
	} else {
		$getname="";
	}
	if (isset($_GET['lastname'])) {
		$getlastname = $_GET['lastname'];
	} else {
		$getlastname="";
	}
	if (isset($_GET['phone'])) {
		$getphone = $_GET['phone'];
	} else {
		$getphone="";
	}
	if (isset($_GET['email'])) {
		$getemail = $_GET['email'];
	} else {
		$getemail="";
	}
	if (isset($_GET['wait'])) {
		$getwait = $_GET['wait'];
	} else {
		$getwait="";
	}
	if (isset($_GET['error'])) {
		$geterror = $_GET['error'];
	} else {
		$geterror="";
	}
	
	
	if ($getstep == 1) {
		//select optional food
		$meals = getMeals();
		$counter = 0;

		$html2 = element_head();

		$time = strtotime($getdate);
		//$html3 = "<strong>".date('d.m.Y',$time)."</strong>";
		$html3 .= form_head("index.php", "GET");
		$html3 .= form_hidden("lang",$getlang,"","");
		$html3 .= form_hidden("step","2","","");
		$html3 .= form_hidden("id",$getid,"","");
		$html3 .= form_hidden("date",$getdate,"","");
		foreach ($meals as $meal) {
		
			$today = time();
			if ($today <= strtotime($meal["datum"])){
				//date is today or future
				if ($meal["optional"]==1 && $meal["datum"]==$getdate && $meal["disabled"]==0) {
					$counter += 1;
					if ($getlang == "de") {
						$html3 .= form_checkbox("opt".$meal["mealid"],$meal["mealid"],"",$meal["name_de"]);
					} else {
						$html3 .= form_checkbox("opt".$meal["mealid"],$meal["mealid"],"",$meal["name_eng"]);
					}
				}
			} else {
				//date is old
			}	
		}
		if ($getlang == "de") {
			$html3 .= form_end2("","Weiter");
		} else {
			$html3 .= form_end2("","Continue");
		}
		$html3 .= "</div>";
		$html3 .= "</span>";
		
		if ($counter == 0) {
			//if no optional food then go to next step
			header("Location: index.php?lang=".$getlang."&step=2&id=".$getid."&date=".$getdate);
			die;
		} else {
			if ($getlang == "de") {
				$html2 .= element(date('d.m.Y',$time), $html3, "", 1, "");
			} else {
				$html2 .= element(date('m/d/Y',$time), $html3, "", 1, "");
			}
			$html2 .= element_bottom();
			echo $html;
			echo $html2;
		}
	} else if ($getstep == 2) {
		//select time
		$link = "index.php?lang=".$getlang."&step=3&id=".$getid."&date=".$getdate;
		foreach ($_GET as $key => $value) { 
			$pos = strpos ($key, "opt");
			if ($pos > -1) {
				$link .= "&".$key."=".$value;
			}
		}
		
		echo $html;
		echo element_head();
		$timeslots = getTimeslotsForMeal($getid);
		foreach($timeslots as $timeslot) {
			if ($timeslot["enabled"]==1) {
				
				$available = ($timeslot["count"]-$timeslot["booked"]);
				if ($available < 0) {
					$available = 0;
				}
				if ($getlang == "de") {
					$text = "Verfügbar: ".$available."/".$timeslot["count"];
				} else {
					$text = "Left: ".$available."/".$timeslot["count"];
				}
				$href = $link."&time=".$timeslot["timeslotid"];
				if ($available <= 0) {
					$href .= "&wait=1";
					if ($getlang == "de") { 
						echo element_dark($timeslot["zeit"],$text,$href,1,"zur Warteliste hinzufügen");
					} else {
						echo element_dark($timeslot["zeit"],$text,$href,1,"Add me to the waiting list");
					}
				} else {
					$href .= "&wait=0";
					if ($getlang == "de") {
						echo element($timeslot["zeit"],$text,$href,1,"Weiter");
					} else {
						echo element($timeslot["zeit"],$text,$href,1,"Continue");
					}
				}
			}
		}
		echo element_bottom();
	} else if ($getstep == 3) {
		//enter name + phone
		echo $html;
		echo element_head();
		
		$html2 = "";
		
		$html2 .= form_head("index.php", "GET");
		$html2 .= form_hidden("lang",$getlang,"","");
		$html2 .= form_hidden("step","4","","");
		$html2 .= form_hidden("id",$getid,"","");
		$html2 .= form_hidden("date",$getdate,"","");
		
		//opt
		foreach ($_GET as $key => $value) { 
			$pos = strpos ($key, "opt");
			if ($pos > -1) {
				$html2 .= form_hidden($key,$value,"","");
			}
		}
		
		$html2 .= form_hidden("time",$gettime,"","");
		$html2 .= form_hidden("wait",$getwait,"","");
		
		if ($getlang == "de") {
			if ($geterror == 1) {
				$html2 .= form_text("name",$getname,"Vorname:","benötigt");
				$html2 .= form_text("lastname",$getlastname,"Nachname:","benötigt");
			}	else {
				$html2 .= form_text("name",$getname,"Vorname:","");
				$html2 .= form_text("lastname",$getlastname,"Nachname:","");
			}
			
			if ($geterror == 2) {
				$html2 .= form_text("phone",$getphone,"Telefon:","benötigt, Beispiel: 012345 012 1234");
				$html2 .= form_text("email",$getemail,"eMail:","eMail benötigt, Beispiel: firstname.lastname@domain.de");
			} else {
				$html2 .= form_text("phone",$getphone,"Telefon:","012345 012 1234");
				$html2 .= form_text("email",$getemail,"eMail:","firstname.lastname@domain.de");
			}
			$html2 .= form_end2("submit","Buchen");
			echo element_single("Kontaktdaten",$html2,"","");
		} else {
			if ($geterror == 1) {
				$html2 .= form_text("name",$getname,"First Name:","mandatory");
				$html2 .= form_text("lastname",$getlastname,"Last Name:","mandatory");
			}	else {
				$html2 .= form_text("name",$getname," First Name:","");
				$html2 .= form_text("lastname",$getlastname,"Last Name:","");
			}
			
			if ($geterror == 2) {
				$html2 .= form_text("phone",$getphone,"phone:","mandatory, Example: 01234 123 1234");
				$html2 .= form_text("email",$getemail,"eMail:","eMail mandatory, Example: firstname.lastname@domain.de");
			} else {
				$html2 .= form_text("phone",$getphone,"phone:","01234 123 1234");
				$html2 .= form_text("email",$getemail,"eMail:","firstname.lastname@domain.de");
			}
			$html2 .= form_end2("submit","Book");
			echo element_single("Contact details",$html2,"","");
		}

		
		echo element_bottom();
		
	} else if ($getstep == 4) {
		//first check if name, email and phone is entered
		if ($getname != "" && $getlastname != "")	{
			if ($getphone != "" && $getemail != "") {
				$pos1 = strpos($getemail,"@domain.de");
				$pos2 = strpos($getemail,"@domain.de");
				if ($pos1 > -1 || $pos2 > -1) {
					//order done
					//main dish
					newOrder($getid,$getname,$getlastname,$getphone,$gettime,$getwait,$getemail);
					//side dish
					foreach ($_GET as $key => $value) { 
						$pos = strpos ($key, "opt");
						if ($pos > -1) {
							newOrder($value,$getname,$getlastname,$getphone,$gettime,$getwait,$getemail);
						}
					}
					if ($getwait == 0) {
						$time = strtotime($getdate);
						$timeslot = getTimeslot($gettime);
						if ($getlang=="de") {
							$betreff = '=?UTF-8?B?'.base64_encode("Bestätigung Lunch am ".date('d.m.Y',$time)." von ".$timeslot["zeit"]).'?=';
							mail($getemail, $betreff,"", "From: xyz@domain.de");
						} else {
							mail($getemail, "Confirmation Lunch on ".date('m/d/Y',$time)." from ".$timeslot["zeit"], "", "From: xyz@domain.de");
						}
					}
					
					
					//jump to next step without parameters to prevent multi order by reload
					$link = "Location: index.php?lang=".$getlang."&step=5&date=".$getdate;
					header($link);
					die;
				} else {
					$link = "Location: index.php?lang=".$getlang."&step=3&id=".$getid."&date=".$getdate;
				
					foreach ($_GET as $key => $value) { 
						$pos = strpos ($key, "opt");
						if ($pos > -1) {
							$link .= "&".$key."=".$value;
						}
					}
					$link .= "&time=".$gettime;
					$link .= "&wait=".$getwait;
					$link .= "&name=".$getname;
					$link .= "&lastname=".$getlastname;
					$link .= "&phone=".$getphone;
					$link .= "&email=".$getemail;
					$link .= "&error=1";
					header($link);
					die;
				}
			} else {
				
				$link = "Location: index.php?lang=".$getlang."&step=3&id=".$getid."&date=".$getdate;
				
				foreach ($_GET as $key => $value) { 
					$pos = strpos ($key, "opt");
					if ($pos > -1) {
						$link .= "&".$key."=".$value;
					}
				}
				$link .= "&time=".$gettime;
				$link .= "&wait=".$getwait;
				$link .= "&name=".$getname;
				$link .= "&lastname=".$getlastname;
				$link .= "&phone=".$getphone;
				$link .= "&email=".$getemail;
				$link .= "&error=2";
				header($link);
				die;
			}
		} else {
			$link = "Location: index.php?lang=".$getlang."&step=3&id=".$getid."&date=".$getdate;
				
			foreach ($_GET as $key => $value) { 
				$pos = strpos ($key, "opt");
				if ($pos > -1) {
					$link .= "&".$key."=".$value;
				}
			}
			$link .= "&time=".$gettime;
			$link .= "&wait=".$getwait;
			$link .= "&name=".$getname;
			$link .= "&lastname=".$getlastname;
			$link .= "&phone=".$getphone;
			$link .= "&email=".$getemail;
			$link .= "&error=1";
			header($link);
			die;
		}

	} else if ($getstep == 5) {
		echo $html;
		$time = strtotime($getdate);
		echo element_head();
		if ($getlang=="de") {
			echo element("","Deine Bestellung für den ".date('d.m.Y',$time)." ist gebucht.","index.php",1,"Zurück");
		} else {
			echo element("","Your order for ".date('m/d/Y',$time)." is booked.","index.php?lang=en",1,"Back");
		}
		echo element_bottom();
	}
} else {
	echo $html;
	
	echo "<div class='grid-container'>";
	echo "<section class='grid-100 tablet-grid-100 mobile-grid-100'><div id='c38' class='csc-frame csc-frame-default'><div class='tx-ws-flexslider'>";
	echo "<div class='greyBG'><div id='c330' class='csc-frame csc-frame-default'>";
	echo "<div class='csc-textpic-text'>";
	if ($getlang == "de") {
		echo "<p class='bodytext'>";
		echo nl2br(getSetting("front_de"));
		echo "</p>";
	} else {
		echo "<p class='bodytext'>";
		echo nl2br(getSetting("front_en"));
		echo "</p>";
	}
	echo "</div></div></div>";
	echo "</section>";
	echo "</div>'";
	
	
	$meals = getMeals();
	$date = "";
	$column = 0;
	
	foreach ($meals as $meal) {
		if ($meal["disabled"]==0) {
		
			$today = strtotime(date('d.m.Y H:i'));
			$mealdate = strtotime($meal["datum"]);
			//add meal date + 14:00
			$mealdate += 60*60*14;
		
			
			if ($today <= $mealdate){
				
			// $today = time();
			// if ($today <= strtotime($meal["datum"])){
				
				//date is today or future
				if ($meal["optional"]==0) {
					//if column==0 then we set it to 1, if already 1 then we dont care
					//print head before first element, always 3 elements per head<->bottom
					if ($column <= 1)
					{
						$column = 1;
						echo element_head();
					}
					$time = strtotime($meal["datum"]);
					$link = "index.php?lang=".$getlang."&step=1&id=".$meal["mealid"]."&date=".$meal["datum"];
					if ($getlang == "de") {
						echo element(wochentag(date('N',$time),"de").", ".date('d.m.Y',$time),$meal["name_de"]."<br><br>".$meal["sidemeal_de"],$link, $column, "Weiter");
					} else {
						echo element(wochentag(date('N',$time),"en").", ".date('m/d/Y',$time),$meal["name_eng"]."<br><br>".$meal["sidemeal_eng"],$link, $column, "Continue");
					}
					//if column is 1&2 then we increase by 1
					//if its 3 then we set back to 1 and add and element_bottom to close the 3 elements
					if ($column < 3)
					{
						$column += 1;
					} else {
						echo element_bottom();
						$column = 1;
					}
				}
			}	
		}
	}
	//if column==0 then no need for an element_end because there is no beginning
	//if 1&2 then there is the end missing and we add it here
	if ($column > 0 && $column < 3)
	{
		echo element_bottom();
	}
	
}

echo body_bottom();
?>