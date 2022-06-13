<?php 

session_start();
if (isset($_SESSION['id_responsable']) && isset($_SESSION['login'])) {
     
 ?>
<!DOCTYPE html>
<html>
<head>
	<title>HOME</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
     <h1>Bonjour <?php echo $_SESSION['prenom']; ?></h1>
     <a href="../IHM/index.php">Accéder à IHM</a>
</body>
</html>

<?php 
}else{
     header("Location: index.php");
     exit();
}
 ?>