<?php
	require("functions.php");

	if(!isset ($_SESSION["userId"])) {
		
		header("Location: SisselogimineTund4.php");
	}
	if(isset($_GET["logout"])) {
		
		session_destroy();
		
		header("Location: SisselogimineTund4.php");
	}

?>

<h1>Data</h1>
<p>
	Tere tulemast <?=$_SESSION["email"];?>!
	<a href="?logout=1">LOGI VALJA</a>
</p>