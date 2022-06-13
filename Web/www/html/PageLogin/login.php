<?php 

session_start();
include "db_conn.php";

if (isset($_POST['uname']) && isset($_POST['password'])) {

	function validate($data){
       $data = trim($data);
	   $data = stripslashes($data);
	   $data = htmlspecialchars($data);
	   return $data;
	}

	$uname = validate($_POST['uname']);
	$pass = validate($_POST['password']);

	if (empty($uname)) {
		header("Location: index.php?error=Entrer le nom d'utilisateur");
		
	    exit();
	}else if(empty($pass)){
        header("Location: index.php?error=Entrer le Mot de passe");
		
	    exit();
	}else{
		$sql = "SELECT * FROM responsable WHERE login='$uname' AND mdp='$pass'";
		$result = mysqli_query($conn, $sql);
		if (mysqli_num_rows($result) === 1) {
			$row = mysqli_fetch_assoc($result);
            if ($row['login'] === $uname && $row['mdp'] === $pass) {
            	$_SESSION['login'] = $row['login'];
            	$_SESSION['prenom'] = $row['prenom'];
            	$_SESSION['id_responsable'] = $row['id_responsable'];
				
            	header("Location: home.php");
		        exit();
            }else{
				header("Location: index.php?error=Le nom d'utilisateur ou le mot de passe est incorrect");
		        exit();
			}
		}else{
			header("Location: index.php?error=Le nom d'utilisateur ou le mot de passe est incorrect");
	        exit();
		}
	}
}else{
	header("Location: index.php");
	exit();
}

