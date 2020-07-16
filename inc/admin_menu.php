<?php	
	function display_admin_menu($active, $isadmin)
	{
		$html = "<nav class='col-md-2 d-none d-md-block bg-light sidebar'>";
		$html = $html."<div class='sidebar-sticky'><ul class='nav flex-column'>";

		$html = $html."<li class='nav-item'>";
		if ($active == "home") {
			$html = $html."<a class='nav-link active' href='../index.php'>";
		} else {
			$html = $html."<a class='nav-link' href='../index.php'>";
		}
		$html = $html."<span data-feather='home'></span>";
		$html = $html." Home<span class='sr-only'>(current)</span></a></li>";
		
		$html = $html."<li class='nav-item'>";
		if ($active == "meal") {
			$html = $html."<a class='nav-link active' href='index.php'>";
		} else {
			$html = $html."<a class='nav-link' href='index.php'>";
		}
		$html = $html."<span data-feather='settings'></span>";
		$html = $html." Meal<span class='sr-only'>(current)</span></a></li>";
		
		$html = $html."<li class='nav-item'>";
		if ($active == "print") {
			$html = $html."<a class='nav-link active' href='print.php'>";
		} else {
			$html = $html."<a class='nav-link' href='print.php'>";
		}
		$html = $html."<span data-feather='settings'></span>";
		$html = $html." Print<span class='sr-only'>(current)</span></a></li>";
		
		

		$html = $html."<li class='nav-item'>";
		if ($active == "settings") {
			$html = $html."<a class='nav-link active' href='settings.php'>";
		} else {
			$html = $html."<a class='nav-link' href='settings.php'>";
		}
		$html = $html."<span data-feather='settings'></span>";
		$html = $html." Settings</a></li>";
	

		
		$html = $html."</ul></div></nav>";
		
		return $html;
	}

?>
