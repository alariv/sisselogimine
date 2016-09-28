<?php


	//functions.php
	
	//alustan sessiooni
	//$_SESSION muutujad
	session_start();	
 
	//*******************************
	//************SIGNUP*************
	//*******************************
	
	$database = "if16_ALARI_VEREV";
	function signup ($email, $password){
		
		
		
		//yhendus olemas
	$mysqli = new mysqli($GLOBALS["serverHost"],$GLOBALS["serverUsername"],$GLOBALS["serverPassword"],$GLOBALS["database"]);
		
		//kask
		$stmt = $mysqli->prepare("INSERT INTO user_sample (email,password) VALUES (?, ?)");
		
		echo $mysqli->error;
		//asendan kysimargid vaartustega
		//iga muutuja kohta 1 taht
		//s tahistab stringi
		//i integer
		//d double/float
		$stmt->bind_param("ss", $email, $password);
		
		if($stmt->execute()){
			echo "salvestamine onnestus ";
		}else {
			echo"ERROR ".$stmt->error;
		}
		
		
		
	}
	
	function login($email, $password){
		
		$error = "";
		
		$mysqli = new mysqli($GLOBALS["serverHost"],$GLOBALS["serverUsername"],$GLOBALS["serverPassword"],$GLOBALS["database"]);
		
		//kask
		$stmt = $mysqli->prepare("
			SELECT id, email, password, created
			FROM user_sample
			WHERE email=?
		");
		
	echo $mysqli->error;
	
	//asendan kysimargid
	$stmt->bind_param("s", $email);
	
	//maaran tulpadele muutujad
	$stmt->bind_result($id, $emailfromdatabase, $passwordfromdatabase, $created);
	$stmt->execute();
	
	if($stmt->fetch()) {
		//oli rida
		
		//vordlen paroole
		$hash = hash("sha512", $password);
		if($hash == $passwordfromdatabase){
			
			echo "kasutaja ".$id."logis sisse";
			
			$_SESSION["userId"]= $id;
			$_SESSION["email"]=$emailfromdatabase;
			
			//suunan uuele lehele
			header("location: data.php");
			
			
		}else {
			$error = "parool vale";
		}
		
	}else {
		//ei olnud
		$error = "sellise emailiga ".$email." kasutajat ei olnud";
		
	}

	return $error;
	}
	?>
	
	
	
	
	
	
	
	
	
	
	
	
	