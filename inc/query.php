<?php
include "db.php";

function createAdminUser()
{
	global $pdo;
	$statement = $pdo->prepare("INSERT INTO user (username, password) VALUES (?,?)");
	if ($statement->execute(array("admin",password_hash("password",PASSWORD_DEFAULT)))) {
		return $statement->errorInfo();
	} else {
		return $statement->errorInfo();
	}
}

function loginUser($username, $password)
{
	$login = false;
	global $pdo;
	$statement = $pdo->prepare("select user.userid, user.password FROM user where username = ? LIMIT 1");
	if ($statement->execute(array($username))) {
		while($row = $statement->fetch()) {
			$dbuserid = $row['userid'];
			$dbpassword = $row['password'];
			if (password_verify($password,$dbpassword)) {
				$login = true;
			}
			
		}
	}
	return $login;
}

function getMeals()
{
	$returnarray = [];
	global $pdo;
	$statement = $pdo->prepare("select meal.mealid, meal.datum, meal.name_de, meal.name_eng, meal.sidemeal_de, meal.sidemeal_eng, meal.optional, meal.disabled FROM meal ORDER BY meal.datum ASC, meal.optional ASC");
	if ($statement->execute()) {
		while($row = $statement->fetch()) {
			$pagearray = [];
			$pagearray['mealid'] = $row['mealid'];
			$pagearray['datum'] = $row['datum'];
			$pagearray['name_de'] = $row['name_de'];
			$pagearray['name_eng'] = $row['name_eng'];
			$pagearray['sidemeal_de'] = $row['sidemeal_de'];
			$pagearray['sidemeal_eng'] = $row['sidemeal_eng'];
			$pagearray['optional'] = $row['optional'];
			$pagearray['disabled'] = $row['disabled'];
			$returnarray[] = $pagearray;
		}
	}
	if ($returnarray != "") {
		return $returnarray;
	} else {
		return false;
	}
}

function getMealsDESC()
{
	$returnarray = [];
	global $pdo;
	$statement = $pdo->prepare("select meal.mealid, meal.datum, meal.name_de, meal.name_eng, meal.sidemeal_de, meal.sidemeal_eng, meal.optional, meal.disabled FROM meal ORDER BY meal.datum DESC, meal.optional ASC");
	if ($statement->execute()) {
		while($row = $statement->fetch()) {
			$pagearray = [];
			$pagearray['mealid'] = $row['mealid'];
			$pagearray['datum'] = $row['datum'];
			$pagearray['name_de'] = $row['name_de'];
			$pagearray['name_eng'] = $row['name_eng'];
			$pagearray['sidemeal_de'] = $row['sidemeal_de'];
			$pagearray['sidemeal_eng'] = $row['sidemeal_eng'];
			$pagearray['optional'] = $row['optional'];
			$pagearray['disabled'] = $row['disabled'];
			$returnarray[] = $pagearray;
		}
	}
	if ($returnarray != "") {
		return $returnarray;
	} else {
		return false;
	}
}

function getOptionalsforOrder($orderid)
{
	$returnarray = [];
	global $pdo;

	$statement = $pdo->prepare("SELECT DISTINCT meal2.mealid, meal2.datum, meal2.name_de, meal2.name_eng, meal2.sidemeal_de, meal2.sidemeal_eng, meal2.optional, meal2.disabled FROM `orders` INNER JOIN meal on meal.mealid = orders.mealid INNER JOIN meal as meal2 on meal.datum = meal2.datum INNER JOIN orders as orders2 ON meal2.mealid = orders2.mealid WHERE orders.orderid = ? and meal2.optional = 1 and orders.name = orders2.name and orders.lastname = orders2.lastname");
	if ($statement->execute(array($orderid))) {
		while($row = $statement->fetch()) {
			$pagearray = [];
			$pagearray['mealid'] = $row['mealid'];
			$pagearray['datum'] = $row['datum'];
			$pagearray['name_de'] = $row['name_de'];
			$pagearray['name_eng'] = $row['name_eng'];
			$pagearray['sidemeal_de'] = $row['sidemeal_de'];
			$pagearray['sidemeal_eng'] = $row['sidemeal_eng'];
			$pagearray['optional'] = $row['optional'];
			$pagearray['disabled'] = $row['disabled'];
			$returnarray[] = $pagearray;
		}
	}
	if ($returnarray != "") {
		return $returnarray;
	} else {
		return false;
	}
}

function getOptionalsforMeal($datum, $name, $lastname)
{
	echo "datum=".$datum;
	echo "name=".$datum;
	echo "lastname=".$datum;
	$returnarray = [];
	global $pdo;
	$statement = $pdo->prepare("SELECT meal.mealid, meal.datum, meal.name_de, meal.name_eng, meal.sidemeal_de, meal.sidemeal_eng, meal.optional, meal.disabled FROM meal where mealid IN (select orders.mealid from orders where orders.name = ? and orders.lastname = ? and orders.mealid in (select meal.mealid from meal where optional = 1 and meal.datum = ?))");
	if ($statement->execute(array($name,$lastname,$datum))) {
		while($row = $statement->fetch()) {
			$pagearray = [];
			$pagearray['mealid'] = $row['mealid'];
			$pagearray['datum'] = $row['datum'];
			$pagearray['name_de'] = $row['name_de'];
			$pagearray['name_eng'] = $row['name_eng'];
			$pagearray['sidemeal_de'] = $row['sidemeal_de'];
			$pagearray['sidemeal_eng'] = $row['sidemeal_eng'];
			$pagearray['optional'] = $row['optional'];
			$pagearray['disabled'] = $row['disabled'];
			$returnarray[] = $pagearray;
		}
	}
	if ($returnarray != "") {
		return $returnarray;
	} else {
		return false;
	}
}

function getMeal($mealid)
{
	$pagearray = [];
	
	global $pdo;
	$statement = $pdo->prepare("select meal.mealid, meal.datum, meal.name_de, meal.name_eng, meal.optional, meal.sidemeal_de, meal.sidemeal_eng FROM meal where mealid = ? LIMIT 1");
	if ($statement->execute(array($mealid))) {
		while($row = $statement->fetch()) {
			$pagearray['mealid'] = $row['mealid'];
			$pagearray['datum'] = $row['datum'];
			$pagearray['name_de'] = $row['name_de'];
			$pagearray['name_eng'] = $row['name_eng'];
			$pagearray['optional'] = $row['optional'];
			$pagearray['sidemeal_de'] = $row['sidemeal_de'];
			$pagearray['sidemeal_eng'] = $row['sidemeal_eng'];
		}
	} 
	if ($pagearray != "") {
		return $pagearray;
	} else {
		return false;
	}
	
}

function getOrder($orderid)
{
	$pagearray = [];
	
	global $pdo;
	$statement = $pdo->prepare("select orders.mealid, orders.name, orders.lastname, orders.phone, orders.timeslotid, orders.bookedtime, orders.wait, orders.email FROM orders where orderid = ? LIMIT 1");
	if ($statement->execute(array($orderid))) {
		while($row = $statement->fetch()) {
			$pagearray['mealid'] = $row['mealid'];
			$pagearray['name'] = $row['name'];
			$pagearray['lastname'] = $row['lastname'];
			$pagearray['phone'] = $row['phone'];
			$pagearray['timeslotid'] = $row['timeslotid'];
			$pagearray['bookedtime'] = $row['bookedtime'];
			$pagearray['wait'] = $row['wait'];
			$pagearray['email'] = $row['email'];
		}
	} 
	if ($pagearray != "") {
		return $pagearray;
	} else {
		return false;
	}
	
}

function getUser($userid)
{
	$pagearray = [];
	
	global $pdo;
	$statement = $pdo->prepare("select user.userid, user.username from user where userid = ? LIMIT 1");
	if ($statement->execute(array($userid))) {
		while($row = $statement->fetch()) {
			$pagearray['userid'] = $row['userid'];
			$pagearray['username'] = $row['username'];
		}
	} 
	if ($pagearray != "") {
		return $pagearray;
	} else {
		return false;
	}
	
}

function getTimeslot($timeslotid)
{
	$pagearray = [];
	
	global $pdo;
	$statement = $pdo->prepare("select timeslot.timeslotid, timeslot.zeit, timeslot.count, timeslot.enabled from timeslot where timeslotid = ? LIMIT 1");
	if ($statement->execute(array($timeslotid))) {
		while($row = $statement->fetch()) {
			$pagearray['timeslotid'] = $row['timeslotid'];
			$pagearray['zeit'] = $row['zeit'];
			$pagearray['count'] = $row['count'];
			$pagearray['enabled'] = $row['enabled'];
		}
	} 
	if ($pagearray != "") {
		return $pagearray;
	} else {
		return false;
	}
	
}

function updateMeal($mealid, $name_de, $name_eng,$sidemeal_de, $sidemeal_eng, $datum, $optional)
{
	
	global $pdo;
	$statement = $pdo->prepare("UPDATE meal SET name_de=?,name_eng=?,sidemeal_de=?,sidemeal_eng=?,datum=?,optional=? WHERE mealid = ?");
	if ($statement->execute(array($name_de,$name_eng,$sidemeal_de,$sidemeal_eng,$datum, $optional,$mealid))) {
		return true;
	} else {
		return false;
	}
	
}

function updateSetting($name,$value)
{
	global $pdo;
	$statement = $pdo->prepare("UPDATE settings SET value=? where name=?");
	if ($statement->execute(array($value,$name))) {
		return true;
	} else {
		return false;
	}
}


function getSetting($name)
{
	$value = "";
	
	global $pdo;
	$statement = $pdo->prepare("select settings.value from settings where name = ? LIMIT 1");
	if ($statement->execute(array($name))) {
		while($row = $statement->fetch()) {
			$value = $row['value'];
		}
	} 
	return $value;
}




function disableMeal($mealid)
{
	
	global $pdo;
	$statement = $pdo->prepare("UPDATE meal SET disabled=1 WHERE mealid = ?");
	if ($statement->execute(array($mealid))) {
		return true;
	} else {
		return false;
	}
	
}



function updateWaitlist($orderid,$wait)
{
	
	global $pdo;
	$statement = $pdo->prepare("UPDATE orders SET wait=? WHERE orders.orderid = ?");
	if ($statement->execute(array($wait,$orderid))) {
		return true;
	} else {
		return false;
	}
	
}


function updateTimeslot($timeslotid, $zeit, $count, $enabled)
{
	
	global $pdo;
	$statement = $pdo->prepare("UPDATE timeslot SET zeit=?,count=?,enabled=? WHERE timeslotid = ?");
	if ($statement->execute(array($zeit,$count,$enabled,$timeslotid))) {
		return true;
	} else {
		return false;
	}
	
}


function updatePassword($userid, $password)
{
	
	global $pdo;
	$statement = $pdo->prepare("UPDATE user SET password=? WHERE userid = ?");
	if ($statement->execute(array(password_hash($password, PASSWORD_DEFAULT),$userid))) {
		return true;
	} else {
		return false;
	}
	
}

function updateUser($userid, $username)
{
	
	global $pdo;
	$statement = $pdo->prepare("UPDATE user SET username=? WHERE userid = ?");
	if ($statement->execute(array($username,$userid))) {
		return true;
	} else {
		return false;
	}
	
}


function newMeal($name_de, $name_eng,$sidemeal_de, $sidemeal_eng, $datum, $optional)
{
	
	global $pdo;
	$statement = $pdo->prepare("INSERT INTO meal (name_de,name_eng,sidemeal_de,sidemeal_eng,datum,optional) VALUES (?,?,?,?,?,?)");
	if ($statement->execute(array($name_de,$name_eng,$sidemeal_de,$sidemeal_eng,$datum,$optional))) {
		return true;
	} else {
		return false;
	}
	
}

function newOrder($mealid, $name, $lastname, $phone, $timeslotid, $wait, $email)
{
	
	global $pdo;
	$statement = $pdo->prepare("INSERT INTO orders (mealid,name,lastname,phone,timeslotid,bookedtime,wait,email) VALUES (?,?,?,?,?,CURRENT_TIME(),?,?)");
	if ($statement->execute(array($mealid,$name,$lastname,$phone,$timeslotid,$wait,$email))) {
		return true;
	} else {
		return false;
	}
	
}

function deleteOrder($orderid)
{
	
	global $pdo;
	$statement = $pdo->prepare("DELETE FROM orders WHERE orders.orderid = ?");
	if ($statement->execute(array($orderid))) {
		return true;
	} else {
		return false;
	}
	
}

function deleteMeal($mealid)
{
	global $pdo;
	$statement = $pdo->prepare("DELETE from orders where orders.mealid IN (select meal.mealid from meal where meal.datum IN (select meal.datum from meal where meal.mealid = ?))");
	$statement->execute(array($mealid));
	$statement = $pdo->prepare("DELETE FROM meal where meal.datum IN (select meal2.datum from (select * from meal) as meal2 where meal2.mealid = ?)");
	if ($statement->execute(array($mealid))) {
		return true;
	} else {
		return false;
	}
	
}

function newTimeslot($zeit, $count, $enabled)
{
	
	global $pdo;
	$statement = $pdo->prepare("INSERT INTO timeslot (zeit,count,enabled) VALUES (?,?,?)");
	if ($statement->execute(array($zeit,$count,$enabled))) {
		return true;
	} else {
		return false;
	}
	
}

function newUser($username, $password)
{
	
	global $pdo;
	$statement = $pdo->prepare("INSERT INTO user (username,password) VALUES (?,?)");
	if ($statement->execute(array($username,password_hash($password, PASSWORD_DEFAULT)))) {
		return true;
	} else {
		return false;
	}
	
}

function getUsers()
{
	$returnarray = [];
	global $pdo;
	$statement = $pdo->prepare("select user.userid, user.username from user");
	if ($statement->execute()) {
		while($row = $statement->fetch()) {
			$pagearray = [];
			$pagearray['userid'] = $row['userid'];
			$pagearray['username'] = $row['username'];
			$returnarray[] = $pagearray;
		}
	}
	if ($returnarray != "") {
		return $returnarray;
	} else {
		return false;
	}
}

function getTimeslots()
{
	$returnarray = [];
	global $pdo;
	$statement = $pdo->prepare("select timeslot.timeslotid, timeslot.zeit, timeslot.count, timeslot.enabled from timeslot");
	if ($statement->execute()) {
		while($row = $statement->fetch()) {
			$pagearray = [];
			$pagearray['timeslotid'] = $row['timeslotid'];
			$pagearray['zeit'] = $row['zeit'];
			$pagearray['count'] = $row['count'];
			$pagearray['enabled'] = $row['enabled'];
			$returnarray[] = $pagearray;
		}
	}
	if ($returnarray != "") {
		return $returnarray;
	} else {
		return false;
	}
}


function getTimeslotForMeal($mealid, $timeslotid)
{
	$pagearray = [];
	global $pdo;
	$statement = $pdo->prepare("select timeslot.timeslotid, timeslot.zeit, timeslot.count, timeslot.enabled , (SELECT count(orders.timeslotid) from orders INNER JOIN meal ON meal.mealid = orders.mealid where orders.timeslotid = timeslot.timeslotid and meal.optional = 0 and meal.mealid = ?) as booked from timeslot WHERE timeslot.timeslotid = ?");
	if ($statement->execute(array($mealid,$timeslotid))) {
		while($row = $statement->fetch()) {
			$pagearray['timeslotid'] = $row['timeslotid'];
			$pagearray['zeit'] = $row['zeit'];
			$pagearray['count'] = $row['count'];
			$pagearray['enabled'] = $row['enabled'];
			$pagearray['booked'] = $row['booked'];
		}
	} 
	if ($pagearray != "") {
		return $pagearray;
	} else {
		return false;
	}
}

function getTimeslotsForMeal($mealid)
{
	$returnarray = [];
	global $pdo;
	$statement = $pdo->prepare("select timeslot.timeslotid, timeslot.zeit, timeslot.count, timeslot.enabled , (SELECT count(orders.timeslotid) from orders INNER JOIN meal ON meal.mealid = orders.mealid where orders.timeslotid = timeslot.timeslotid and meal.optional = 0 and meal.mealid = ?) as booked from timeslot");
	if ($statement->execute(array($mealid))) {
		while($row = $statement->fetch()) {
			$pagearray = [];
			$pagearray['timeslotid'] = $row['timeslotid'];
			$pagearray['zeit'] = $row['zeit'];
			$pagearray['count'] = $row['count'];
			$pagearray['enabled'] = $row['enabled'];
			$pagearray['booked'] = $row['booked'];
			$returnarray[] = $pagearray;
		}
	} 
	if ($returnarray != "") {
		return $returnarray;
	} else {
		return false;
	}
}

function getOrdersForMeal($mealid)
{
	$returnarray = [];
	global $pdo;
	$statement = $pdo->prepare("select orders.name, orders.lastname, orders.orderid, orders.phone, orders.email, orders.wait, orders.timeslotid, timeslot.zeit from orders LEFT JOIN timeslot ON orders.timeslotid = timeslot.timeslotid where orders.mealid = ? order by timeslot.zeit,orders.wait,orders.bookedtime ,orders.name");
	if ($statement->execute(array($mealid))) {
		while($row = $statement->fetch()) {
			$pagearray = [];
			$pagearray['name'] = $row['name'];
			$pagearray['lastname'] = $row['lastname'];
			$pagearray['phone'] = $row['phone'];
			$pagearray['email'] = $row['email'];
			$pagearray['wait'] = $row['wait'];
			$pagearray['zeit'] = $row['zeit'];
			$pagearray['orderid'] = $row['orderid'];
			$pagearray['timeslotid'] = $row['timeslotid'];
			$returnarray[] = $pagearray;
		}
	} 
	if ($returnarray != "") {
		return $returnarray;
	} else {
		return false;
	}
}

function wochentag($weekday, $lang)
{
	if ($weekday == 1) {
		if ($lang == "de") {
			return "Montag";
		} else {
			return "Monday";
		}
	} else	if ($weekday == 2) {
		if ($lang == "de") {
			return "Dienstag";
		} else {
			return "Tuesday";
		}
	} else	if ($weekday == 3) {
		if ($lang == "de") {
			return "Mittwoch";
		} else {
			return "Wednesday";
		}
	} else	if ($weekday == 4) {
		if ($lang == "de") {
			return "Donnerstag";
		} else {
			return "Thursday";
		}
	} else	if ($weekday == 5) {
		if ($lang == "de") {
			return "Freitag";
		} else {
			return "Friday";
		}
	} else	if ($weekday == 6) {
		if ($lang == "de") {
			return "Samstag";
		} else {
			return "Saturday";
		}
	} else	if ($weekday == 7) {
		if ($lang == "de") {
			return "Sonntag";
		} else {
			return "Sunday";
		}
	}
}

?>