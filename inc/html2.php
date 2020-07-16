<?php

	function head()
	{
		$html = "<!DOCTYPE html>";
		$html .= "<html lang='de'>";
		$html .= "<head><meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1' />";
		$html .= "<meta charset='utf-8'>";
		$html .= "<meta name='generator' content='TYPO3 CMS'>";
		$html .= "<meta name='X-UA-Compatible' content='IE=edge,chrome = 1'>";
		$html .= "<link rel='stylesheet' type='text/css' href='inc/css2/2.css' media='all'>";
		$html .= "<link rel='stylesheet' type='text/css' href='inc/css2/merged-1.css' media='all'>";
		$html .= "<script src='inc/js2/merged-3.js' type='text/javascript'></script>";
		$html .= "<meta name='viewport' content='width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1' />";
		$html .= "<link rel='stylesheet' href='inc/css2/unsemantic-grid-responsive-tablet.css' />";
		$html .= "<title>Catering</title>";
			
		$html .= "<style> ";
		$html .= "input[type=button], input[type=submit], input[type=reset] {";
		$html .= "display: inline-block;";
		$html .= "margin-top: 12px;";
		$html .= "padding: 10px 15px;";
		$html .= "font-weight: normal;";
		$html .= "line-height: 1.42857143;";
		$html .= "text-align: center;";
		$html .= "white-space: nowrap;";
		$html .= "vertical-align: middle;";
		$html .= "cursor: pointer;";
		$html .= "-webkit-user-select: none;";
		$html .= "-moz-user-select: none;";
		$html .= "-ms-user-select: none;";
		$html .= "user-select: none;";
		$html .= "background-image: none;";
		$html .= "text-decoration: none;";
		$html .= "clear: both;";
		$html .= "background: #eeede7;";
		$html .= "text-transform: uppercase;";
		$html .= "color: #116757;";
		$html .= "font-weight: 400;";
		$html .= "}";
		$html .= "a.darker {background: #AAE2E3;}";
		$html .= "</style>";
		
		    
		
		
		$html .= "</head>";
		return $html;
	}
	function body_top($language, $link)
	{
		$html = "<body class='layout5' id='top'>";
		$html .= "<div id='globalWrapper'>";
		$html .= "<header>";
		$html .= "<div class='grid-container'>";
		$html .= "<div class='grid-40 tablet-grid-100 mobile-grid-100 prefix-60 lang hide-on-mobile' id='langNav'>";
		$html .= "<ul class='langMenu'>";
		
		if ($language == "de") {
			$html .= "<li class='menuItemLang active'><span>DE</span></li>";
			$html .= "<a href='".$link."'><li class='menuItemLang normal'><span>EN</span></li></a>";
		} else {
			$html .= "<a href='".$link."'><li class='menuItemLang normal'><span>DE</span></li></a>";			
			$html .= "<li class='menuItemLang active'><span>EN</span></li>";
		}
		
		
		$html .= "</ul></div>";
		$html .= "<div class='clear'></div> <div class='grid-30 tablet-grid-40 mobile-grid-100'><div class='logoDevices'>";
		$html .= "<a href='/' title='Zur Startseite'><img id='logo' src='inc/img/Logo_dt.png' alt='Logo' /> ";
		$html .= "<img id='logoSmall' src='/inc/img/logo_small.jpg' alt='Logo' /></a></div></div> ";
		$html .= "<div class='grid-70 tablet-grid-100 mobile-grid-100'><a href='#mainNav' id='hamburger' class='hide-on-desktop'>";
		$html .= "<span class='top-bar'></span><span class='middle-bar'></span><span class='bottom-bar'></span></a>";
		$html .= "<nav id='mainNav'><ul id='navigation'><li class='first'><a href='/' title='Startseite' class='lv1'>Startseite</a></li>";
		$html .= "</ul>";
		$html .= "</nav></div>";
		$html .= "</div>";
		$html .= "</header>";
		return $html;
	}
	
	function body_bottom()
	{
		$html = "</section>";
		$html .= "<footer><div class='footer'><div class='grid-container'><div id='c59' class='csc-frame csc-frame-default'></div> ";
		$html .= "<div class='grid-25 tablet-grid-30 mobile-grid-90 footerLeft'>";
		$html .= "<div id='c6' class='csc-frame csc-frame-default'>";
		$html .= "<p class='bodytext'>";
		$html .= "<strong>Title</strong><br />";
		
		$html .= "Company Name<br />";
		$html .= "and some text<br />";
		$html .= "Street<br />";
		$html .= "City<br /><br />";
		
		$html .= "Phone.: 01234 56789<br />";
		$html .= "Mail:&nbsp;";
		$html .= "<a href='javascript:linkTo_UnCryptMailto('ocknvq,kphqBocz\/rncpem\/jcwu0fg');' title='Email schreiben' class='mail'>xyz(at)domain.com</a>";
		$html .= "<br /> </p></div></div> ";
		$html .= "<div class='grid-35 tablet-grid-50 mobile-grid-90 footerMiddle'></div> <div class='grid-25 tablet-grid-100 mobile-grid-90 footerNav'>";
		

		$html .= "</li></ul> ";
		$html .= "<div style='clear:both';><br />";
		$html .= "</div></div> ";
		$html .= "<div class='grid-15 tablet-grid-20 mobile-grid-90 footerMinerva'><a href='http://domain.de' title='Website of Company' target='_blank'>";
		$html .= "<img src='/inc/img/footer.png' /></a></div></div></div>";
		$html .= "<div class='bottomText'><div class='grid-container'><div class='grid-100'>&copy; Company City Date &#124; <a href='http://domain.com/impressum'>Impressum</a> &#124; <a href='http://domain.com/datenschutz'>Datenschutzerklärung</a></div></div></div>";
		$html .= "</footer>";
		$html .= "</div>";
		$html .= "<script src='inc/js2/merged-5.js' type='text/javascript'></script>";
		$html .= "<script src='inc/js2/merged-4.js' type='text/javascript'></script>";
		$html .= "</body>";
		$html .= "</html>";
		return $html;
	}
	
	function element_head()
	{
		$html = "<section class='pageContent'>";
		$html .= "<div class='grid-container'>";
		return $html;
	}
	
	function element_bottom()
	{
		$html = "</div>";
		$html .= "</section>";
		return $html;
	}
	
	function element_single($date,$text,$link,$button)
	{
		$html = "<section class='grid-100 tablet-grid-100 mobile-grid-100 leftColumn'>";
		$html .= "<div id='c1' class='csc-frame csc-frame-default'>";
		$html .= "<div class='csc-header csc-header-n1'>";
		$html .= "<h1 class='csc-firstHeader'>".$date."</h1>";
		$html .= "</div>";
		$html .= "<div class='csc-textpic csc-textpic-responsive csc-textpic-left csc-textpic-above'>";
		$html .= "<div class='csc-textpic-imagewrap columnAmount1' data-csc-images='1' data-csc-cols='1'>";
		$html .= "<p class='bodytext'>".$text."</p>";
		$html .= "</div>";
		$html .= "<div class='csc-textpic-text'>";
		$html .= "<p class='bodytext'>";
		if ($link == "") {
			
		} else {
			$html .= "<a href='".$link."' title='Order' class='readmore'>".$button."</a>";	
		}
		$html .= "</p></div></div></div></section>";
		return $html;
	}
	
	function element($date,$text,$link,$column,$button)
	{
		if ($column == 1) {
			$html = "<section class='grid-33 tablet-grid-50 mobile-grid-100 leftColumn'>";
		} else if ($column == 2) {
			$html = "<section class='grid-33 tablet-grid-50 mobile-grid-100 middleColumn'>";
		} else {
			$html = "<section class='grid-33 tablet-grid-50 mobile-grid-100 rightColumn'>";
		}
		$html .= "<div id='c1' class='csc-frame csc-frame-default'>";
		$html .= "<div class='csc-header csc-header-n1'>";
		$html .= "<h1 class='csc-firstHeader'>".$date."</h1>";
		$html .= "</div>";
		$html .= "<div class='csc-textpic csc-textpic-responsive csc-textpic-left csc-textpic-above'>";
		$html .= "<div class='csc-textpic-imagewrap columnAmount1' data-csc-images='1' data-csc-cols='1'>";
		$html .= "<p class='bodytext'>".$text."</p>";
		$html .= "</div>";
		$html .= "<div class='csc-textpic-text'>";
		$html .= "<p class='bodytext'>";
		if ($link == "") {
			
		} else {
			$html .= "<a href='".$link."' title='Order' class='readmore'>".$button."</a>";	
		}
		$html .= "</p></div></div></div></section>";
		return $html;
	}
	
	function element_dark($date,$text,$link,$column,$button)
	{
		if ($column == 1) {
			$html = "<section class='grid-33 tablet-grid-50 mobile-grid-100 leftColumn'>";
		} else if ($column == 2) {
			$html = "<section class='grid-33 tablet-grid-50 mobile-grid-100 middleColumn'>";
		} else {
			$html = "<section class='grid-33 tablet-grid-50 mobile-grid-100 rightColumn'>";
		}
		$html .= "<div id='c1' class='csc-frame csc-frame-default'>";
		$html .= "<div class='csc-header csc-header-n1'>";
		$html .= "<h1 class='csc-firstHeader'>".$date."</h1>";
		$html .= "</div>";
		$html .= "<div class='csc-textpic csc-textpic-responsive csc-textpic-left csc-textpic-above'>";
		$html .= "<div class='csc-textpic-imagewrap columnAmount1' data-csc-images='1' data-csc-cols='1'>";
		$html .= "<p class='bodytext'>".$text."</p>";
		$html .= "</div>";
		$html .= "<div class='csc-textpic-text'>";
		$html .= "<p class='bodytext'>";
		if ($link == "") {
			
		} else {
			$html .= "<a href='".$link."' title='Order' class='readmore darker'>".$button."</a>";	
		}
		$html .= "</p></div></div></div></section>";
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
		$html = "<form action='".$link."' method='".$getpost."' id='form_continue'>";
		$html .= "<table>";
		return $html;
	}
	
	function form_end($name,$value)
	{
		$html = "</table>";
		$html .= "<input type='submit' class='readmore'";
		$html .= "name='".$name."'";
		$html .= " value='".$value."' />";
		$html .= "</form>";
		return $html;
	}
	

	
	function form_end2($name,$value)
	{
		$html = "</table>";
		
		$html .= "<noscript>";
		$html .= "<input type='submit' class='readmore'";
		$html .= " name='".$name."'";
		$html .= " value='".$value."' />";
		$html .= "</noscript>";
		
		$html .= "<div class='csc-textpic-text'><p class='bodytext'>";
		$html .= "<a href='#' title='Order' class='readmore' onclick='document.getElementById(\"form_continue\").submit()'>".$value."</a>";
		$html .= "</p></div>";
		
		$html .= "</form>";
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
	

?>