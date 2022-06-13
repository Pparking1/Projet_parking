<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="utf-8">
        <title>Projet_parking</title>
	</head>
	<body>
        <h1>Table Parking</h1>
		<?php
		$mysqli = new mysqli("localhost", "openalpr", "openalpr", "projet_parking");
		$mysqli->set_charset("utf8");
		$requete = "SELECT * FROM parking";
		$resultat = $mysqli->query($requete);
		while ($ligne = $resultat->fetch_assoc()) {
			echo $ligne[''] . ' ' . 
			     $ligne['nom_parking'] . ' ' . 
				 $ligne['adresse_parking'] . ' ' . 
				 $ligne['ville_parking'] . ' ' . 
				 $ligne['latitude_parking'] . ' ' . 
				 $ligne['longitude_parking'] . ' ' . 
				 $ligne['Nombre_de_place_parking'] . '<br>';
		}
		$mysqli->close();
		?>
	</body> 
</html>