<?php

	function head($title)
	{
		$html = "<!doctype html>";
		$html = $html."<html lang='en'>";
		$html = $html."<head>";
		$html = $html."<meta charset='utf-8'>";
		$html = $html."<title>$title</title>";
		$html = $html."<!-- Bootstrap core CSS -->";
		$html = $html."<link href='/inc/css/bootstrap.min.css' rel='stylesheet' crossorigin='anonymous'>";
		$html = $html."<style>";
		$html = $html.".bd-placeholder-img {";
		$html = $html."font-size: 1.125rem;";
		$html = $html."text-anchor: middle;";
		$html = $html."-webkit-user-select: none;";
        $html = $html."-moz-user-select: none;";
		$html = $html."-ms-user-select: none;";
		$html = $html."user-select: none;";
		$html = $html."}";
		$html = $html."@media (min-width: 768px) {";
		$html = $html.".bd-placeholder-img-lg {";
		$html = $html."font-size: 3.5rem;";
		$html = $html."}";
		$html = $html."}";
        $html = $html."</style>";
        $html = $html."<!-- Custom styles for this template -->";
        $html = $html."<link href='/inc/css/dashboard.css' rel='stylesheet'>";
		$html = $html."</head>";
		return $html;
	}
	function body_top($header, $username, $link)
	{
		$html = "<body>";
		$html .= "<br><br>";
		$html = $html."<nav class='navbar navbar-dark fixed-top bg-dark flex-md-nowrap p-0 shadow'>";
		$html = $html."<a class='navbar-brand col-sm-3 col-md-2 mr-0' href='".$link."'>".$header."</a>";

		$html = $html."<ul class='navbar-nav px-3'>";
		$html = $html."<li class='nav-item text-nowrap'>";
		$html = $html."</li>";
		$html = $html."</ul>";
		$html = $html."</nav>";

		$html = $html."<div class='container-fluid'>";
		$html = $html."<div class='row'>";
		return $html;
	}
	
	function body_top_admin($header, $username)
	{
		$html = "<body>";
		$html .= "<br><br>";
		$html = $html."<nav class='navbar navbar-light fixed-top flex-md-nowrap p-0 shadow' style='background-color: #ff5050;'>";
		$html = $html."<a class='navbar-brand col-sm-3 col-md-2 mr-0' href='index.php'>".$header."</a>";

		$html = $html."<ul class='navbar-nav px-3'>";
		$html = $html."<li class='nav-item text-nowrap'>";
		$html = $html."<a class='nav-link' href='logout.php'>";
		$html = $html.$username." - Sign out";
		$html = $html."</a>";
		$html = $html."</li>";
		$html = $html."</ul>";
		$html = $html."</nav>";

		$html = $html."<div class='container-fluid'>";
		$html = $html."<div class='row'>";
		return $html;
	}
	
	function body_title_top($title)
	{
		$html = "<main role='main' class='col-md-9 ml-sm-auto col-lg-10 px-4'>";
		$html = $html."<div class='d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom'>";
		$html = $html."<h1 class='h2'>$title</h1>";
		$html = $html."<div class='btn-toolbar mb-2 mb-md-0'>";
		$html = $html."<div class='btn-group mr-2'>";
		return $html;
	}
	
	function body_title_bottom()
	{
		$html = "</div></div></div>";
		return $html;
	}
	
	function body_bottom()
	{
		$html = "</main>";
		$html = $html."</div>";
		$html = $html."</div>";
		$html = $html."<script src='/inc/js/jquery-3.5.1.min.js' crossorigin='anonymous'></script>";
		$html .= "<script src='/inc/js/bootstrap.bundle.min.js' crossorigin='anonymous'></script>";
		$html = $html."<script src='/inc/js/feather.min.js'></script>";
		$html = $html."<script src='/inc/js/dashboard.js'></script></body>";
		$html = $html."</html>";
		return $html;
	}
	
	function delete_button($id, $link)
	{
		$html = "<form action='$link' method='POST'>";
		$html = $html."<input id='id' type='hidden' name='id' value='$id'/>";
		$html = $html."<input id='delete' type='hidden' name='delete' value='1'/>";
		$html = $html."<input class='btn btn-sm btn-outline-secondary' type='submit' name='delete' value='Delete' />";
		$html = $html."</form>";
		return $html;
	}
	
	function delete_button_get($id, $link)
	{
		$html = "<form action='$link' method='GET'>";
		$html = $html."<input id='id' type='hidden' name='id' value='$id'/>";
		$html = $html."<input id='delete' type='hidden' name='delete' value='1'/>";
		$html = $html."<input class='btn btn-sm btn-outline-secondary' type='submit' name='delete' value='Delete' />";
		$html = $html."</form>";
		return $html;
	}
	
	function add_button($title, $link)
	{
		$html = "<a class='btn btn-sm btn-outline-secondary' href='$link' role='button'>$title</a>";
		return $html;
	}
	
	function table_head($colnames)
	{
		$html = "";
		$html .= "<div class='table-responsive'>";
		$html .= "<table class='table table-striped table-sm'>";
		$html .= "<thead>";
		$html .= "<tr>";
		foreach($colnames as $column)
		{
			$html .= "<th>".$column."</th>";
		}
		$html .= "</tr>";
		$html .= "</thead>";
		$html .= "<tbody>";
		return $html;
	}
	
	function table_body($colvalue)
	{
		$html = "";
		$html .= "<tr>";
		foreach($colvalue as $value)
		{
			$html .= "<td>".$value."</td>";
		}
		return $html;
	}
	
	function table_end()
	{
		$html = "";
		$html .= "</tbody>";
		$html .= "</table>";
		$html .= "</div>";
		return $html;
	}
	
	function form_head($link, $getpost)
	{
		$html = "<form action='".$link."' method='".$getpost."'>";
		$html .= "<table>";
		return $html;
	}
	
	function form_mid()
	{
		$html = "</table>";
		return $html;
	}
	
	function form_button($name,$value)
	{
		$html = "<input type='submit' class='btn btn-primary'";
		$html .= "name='".$name."'";
		$html .= " value='".$value."' />";
		return $html;
	}
	
	function form_end()
	{
		$html = "</form>";
		return $html;
	}
	
	function form_label($name)
	{
		$html = "<tr><td colspan='3'>";
		$html .= "<label for='source'>".$name."</label>";
		$html .= "</td></tr>";
		return $html;
	}
	
	function form_select($fieldid, $values, $labelfront, $labelback)
	{
		$html = "<tr><td>";
		$html .= "<label>".$labelfront."&nbsp;</label></td><td>";
		$html .= "<select id='".$fieldid."' name='".$fieldid."'>";
		foreach($values as $array){
			if ($array['selected'] == 1) {
				$html .= "<option value='".$array['valueid']."' selected>".$array['value']."</option>";
			} else {
				$html .= "<option value='".$array['valueid']."' >".$array['value']."</option>";
			}
			
		}
		$html .= "</select>";
		$html .= "</td><td>";
		$html .= "<label>&nbsp;".$labelback."</label>";
		$html .= "</td></tr>";
		return $html;
	}
	
	function form_text($valueid, $value, $labelfront, $labelback)
	{
		$html = "<tr><td>";
		$html .= "<label>".$labelfront."&nbsp;</label></td><td>";
		$html .= "<input id='".$valueid."' name='".$valueid."' value='".$value."'>";
		$html .= "</input>";
		$html .= "</td><td>";
		$html .= "<label>&nbsp;".$labelback."</label>";
		$html .= "</td></tr>";
		return $html;
	}
	
	function form_password($valueid, $value, $labelfront, $labelback)
	{
		$html = "<tr><td>";
		$html .= "<label>".$labelfront."&nbsp;</label></td><td>";
		$html .= "<input type='password' id='".$valueid."' name='".$valueid."' value='".$value."'>";
		$html .= "</input>";
		$html .= "</td><td>";
		$html .= "<label>&nbsp;".$labelback."</label>";
		$html .= "</td></tr>";
		return $html;
	}
	
	function form_checkbox($valueid, $value, $labelfront, $labelback, $checked)
	{
		$html = "<tr><td>";
		$html .= "<label>".$labelfront."&nbsp;</label></td><td>";
		$html .= "<input type='checkbox' id='".$valueid."' name='".$valueid."' value='".$value."'";
		if ($checked == 1) {
			$html .= " checked='checked'";
		}
		$html .= "></input>";
		$html .= "</td><td>";
		$html .= "<label>&nbsp;".$labelback."</label>";
		$html .= "</td></tr>";
		return $html;
	}
	
	function form_hidden($valueid, $value)
	{
		$html .= "<input type='hidden' id='".$valueid."' name='".$valueid."' value='".$value."'>";
		$html .= "</input>";
		return $html;
	}
	
	function form_date($valueid, $value, $labelfront, $labelback)
	{
		$html = "<tr><td>";
		$html .= "<label>".$labelfront."&nbsp;</label></td><td>";
		$html .= "<input type='date' id='".$valueid."' name='".$valueid."' value='".$value."'>";
		$html .= "</input>";
		$html .= "</td><td>";
		$html .= "<label>&nbsp;".$labelback."</label>";
		$html .= "</td></tr>";
		return $html;
	}
	
	function line()
	{
		return "<div class='d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom'></div>";
	}
	
	function modal_form($id, $title, $text, $link)
	{
		$html = "<div class='modal fade' id='".$id."' tabindex='-1' role='dialog' aria-labelledby='exampleModalCenterTitle' aria-hidden='true'>";
		
		$html .= "<div class='modal-dialog modal-dialog-centered' role='document'>";
		$html .= "	<div class='modal-content'>";
		$html .= "<div class='modal-header'>";
		$html .= "<h5 class='modal-title' id='exampleModalLongTitle'>".$title."</h5>";
		$html .= "<button type='button' class='close' data-dismiss='modal' aria-label='Close'>";
		$html .= "<span aria-hidden='true'>&times;</span>";
		$html .= "</button>";
		$html .= "</div>";
		$html .= "<div class='modal-body'>".$text;
		$html .= "</div>";
		$html .= "<div class='modal-footer'>";
		$html .= "<button type='button' class='btn btn-secondary' data-dismiss='modal'>Close</button>";
		$html .= "<a href='".$link."' class='btn btn-primary'>OK</button>";
		$html .= "</div>";
		$html .= "</div>";
		$html .= "</div>";
		$html .= "</div>";
		return $html;
	}
	

?>