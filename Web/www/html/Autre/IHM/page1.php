<!DOCTYPE html>
<html lang="fr" data-color-mode="dark" data-light-theme="light" data-dark-theme="dark">
<head>
  <title>Project parking</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="scroll.css">
  <link rel="stylesheet" href="app.js">
  <script src="app.js" defer></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src='https://cdn.jsdelivr.net/npm/rtsp-relay@1.6.1/browser/index.js'></script>


		<!--Table utilisateur-->
		<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/jqc-1.12.4/moment-2.18.1/dt-1.12.1/b-2.2.3/date-1.1.2/sl-1.4.0/datatables.min.css">
		<link rel="stylesheet" type="text/css" href="css/generator-base.css">
		<link rel="stylesheet" type="text/css" href="css/editor.dataTables.min.css">
		<script type="text/javascript" charset="utf-8" src="https://cdn.datatables.net/v/dt/jqc-1.12.4/moment-2.18.1/dt-1.12.1/b-2.2.3/date-1.1.2/sl-1.4.0/datatables.min.js"></script>
		<script type="text/javascript" charset="utf-8" src="js/dataTables.editor.min.js"></script>
		<script type="text/javascript" charset="utf-8" src="js/table.utilisateur.js"></script>

		<!--Table voiture-->
		<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/jqc-1.12.4/moment-2.18.1/dt-1.12.1/b-2.2.3/date-1.1.2/sl-1.4.0/datatables.min.css">
		<link rel="stylesheet" type="text/css" href="css/generator-base.css">
		<link rel="stylesheet" type="text/css" href="css/editor.dataTables.min.css">
		<script type="text/javascript" charset="utf-8" src="https://cdn.datatables.net/v/dt/jqc-1.12.4/moment-2.18.1/dt-1.12.1/b-2.2.3/date-1.1.2/sl-1.4.0/datatables.min.js"></script>
		<script type="text/javascript" charset="utf-8" src="js/dataTables.editor.min.js"></script>
		<script type="text/javascript" charset="utf-8" src="js/table.voiture.js"></script>

		<!--Table possede-->
		<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/jqc-1.12.4/moment-2.18.1/dt-1.12.1/b-2.2.3/date-1.1.2/sl-1.4.0/datatables.min.css">
		<link rel="stylesheet" type="text/css" href="css/generator-base.css">
		<link rel="stylesheet" type="text/css" href="css/editor.dataTables.min.css">
		<script type="text/javascript" charset="utf-8" src="https://cdn.datatables.net/v/dt/jqc-1.12.4/moment-2.18.1/dt-1.12.1/b-2.2.3/date-1.1.2/sl-1.4.0/datatables.min.js"></script>
		<script type="text/javascript" charset="utf-8" src="js/dataTables.editor.min.js"></script>
		<script type="text/javascript" charset="utf-8" src="js/table.possede.js"></script>

</head>

<body>
  <!-- Header -->
  <section id="header">
    <div class="header container">
      <div class="nav-bar">
        <div class="brand">
          <a href="#hero">
            <h1>Tableau de Bord</h1>
          </a>
        </div>
        <div class="nav-list">
          <div class="hamburger">
            <div class="bar"></div>
          </div>
          <ul>
            <li><a href="page1.php" data-after="IHM">ihm</a></li>
            <li><a href="pagehistorique.php" data-after="Historique">Historique</a></li>
            <li><a href="page2.html" data-after="Aide">Aide</a></li>
            <li><a href="page3.html" data-after="Propos">A propos</a></li>
          </ul>
        </div>
      </div>
    </div>
  </section>
  <!-- End Header -->

  <section id="hero">
    <div id="ele_1" class="btn_ele">
      <!--camera1-->
      <div id="video" class="btn_cam">
        <canvas id='canvas'></canvas>
        <script>
          loadPlayer({
            url: 'ws://172.16.151.221:2000/api/stream',
            canvas: document.getElementById('canvas')
          });
        </script>
      </div>
      <!-- Fin camera1 -->
      <!--camera2-->
      <div id="video_2" class="btn_cam">
        <canvas id='canvas_2'></canvas>
        <script>
          loadPlayer({
            url: 'ws://172.16.151.221:2001/api/stream_2',
            canvas: document.getElementById('canvas_2')
          });
        </script>
      </div>
    	<!-- Fin camera2 -->
    </div>
    <!-----Console-->
    <div id="ele_2" class="btn_ele">
      <div id="console"></div>
      <code>      
      <?php
$servername = "localhost";
$username = "openalpr";
$password = "openalpr";
$db_name = "projet_parking";
$conn = mysqli_connect($servername, $username, $password, $db_name); 
?> 
<h3>VEHICULE ENTRANT</h3>
<?php
$sql="SELECT * FROM est_garer WHERE date_prise = CURRENT_DATE()";
$result = mysqli_query($conn, $sql); 
if (mysqli_num_rows($result)>0) {
}

while($row=mysqli_fetch_assoc($result)) {
echo "<tr></br>";
   echo "<td>".$row['immatriculation_voiture']."</td>";
   echo "<td>".$row['date_arrivée_est_garer']."</td>";
echo "</tr>";
}
      ?><br><br>

<h3>VEHICULE SORTANT</h3>
<?php
$sql="SELECT * FROM est_garer WHERE date_prise = CURRENT_DATE()";
$result = mysqli_query($conn, $sql); 
if (mysqli_num_rows($result)>0) {
}

while($row=mysqli_fetch_assoc($result)) {
echo "<tr></br>";
   echo "<td>".$row['immatriculation_voiture']."</td>";
   echo "<td>".$row['date_sortie_est_garer']."</td>";
echo "</tr>";
}
      ?>
      </code>
      </div>
    </div>
  <div id="ele_3" class="btn_ele"> 
    <div id="scroll">
    <table cellpadding="0" cellspacing="0" border="0" class="display" id="utilisateur" width="100%">
				<h2>Table Utilisateur</h2><br>
				<thead>
					<tr>
						<th>Prenom</th>
						<th>Nom</th>
						<th>Adresse</th>
						<th>Ville</th>
						<th>Numero de telephone</th>
						<th>Adresse mail</th>
						<th>Metier</th>
						<th>Age</th>
					</tr>
				</thead>
			</table>
			<table cellpadding="0" cellspacing="0" border="0" class="display" id="voiture" width="100%">
				<br><br><br><h2>Table Voiture</h2><br>
				<thead>
				  <tr>
					<th>Immatriculation</th>
					<th>Marque</th>
					<th>Modele</th>
					<th>Couleur</th>
					<th>Carburant</th>
					<th>options</th>
					<th>date</th>
					<th>vignette crit air</th>
				  </tr>
				</thead>
			  </table>
			  <table cellpadding="0" cellspacing="0" border="0" class="display" id="possede" width="100%">
				<br><br><br><h2>Table Possede</h2><br>
				<thead>
					<tr>
						<th>IDutilisateur</th>
						<th>IDplaque</th>
					</tr>
				</thead>
			</table>
</div><br>
<h6>INFORMATION PARKING</h6>
<div class="information_parking">
<?php
$servername = "localhost";
$username = "openalpr";
$password = "openalpr";
$db_name = "projet_parking";
$conn = mysqli_connect($servername, $username, $password, $db_name); 
?> 
<table cellpadding="0" cellspacing="0" border="0" class="display" id="information" width="100%">
<?php
$sql="SELECT * FROM parking";
$result = mysqli_query($conn, $sql); 
if (mysqli_num_rows($result)>0) {

echo "<thead>";
echo "<tr>";
   echo "<th>Nom du parking</th>";
   echo "<th>Adresse du parking</th>"; 
   echo "<th>Ville du parking</th>";
   echo "<th>Latitude du parking</th>"; 
   echo "<th>Longitude du parking</th>";
   echo "<th>Nombre de place du parking</th>";
echo "</tr>";
echo "</thead>";
}

while($row=mysqli_fetch_assoc($result)) {
echo "<tr>";
   echo "<td>".$row['nom_parking']."</td>";
   echo "<td>".$row['adresse_parking']."</td>";
   echo "<td>".$row['ville_parking']."</td>";
   echo "<td>".$row['latitude_parking']."</td>";
   echo "<td>".$row['longitude_parking']."</td>";
   echo "<td>".$row['Nombre_de_place_parking']."</td>"; 
echo "</tr>";
}
?>
</table>
</div><br>

<h6>COMMANDE BARRIERE ET LED</h6>
<div class="commande_barriere">
<script
  src="https://code.jquery.com/jquery-3.6.0.min.js"
  integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
  crossorigin="anonymous">
</script>
<table>
	<tr>
		<td>Ouvrire la barrière d'entree: </td>
		<td>
			<label class="switch">
  			<input type="checkbox" id="be">
  			<span class="slider round"></span>
			</label>
		</td>
	</tr>
	<tr>
		<td>Ouvrire la barrière de sortie: </td>
		<td>
			<label class="switch">
  			<input type="checkbox" id="bs">
  			<span class="slider round"></span>
			</label>
		</td>
	</tr>

	<tr>
		<td>Allumer le feu rouge: </td>
		<td>
			<label class="switch">
  			<input type="checkbox" id="fr">
  			<span class="slider round"></span>
			</label>
		</td>
	</tr>

	<tr>
		<td>Allumer le feu vert: </td>
		<td>
			<label class="switch">
  			<input type="checkbox" id="fv">
  			<span class="slider round"></span>
			</label>
		</td>
	</tr>

</table>
</div><br>
<h6>COMMANDE DE L'AFFICHEUR</h6>
<div class="afficheur_led">
<input type="text" size="112" placeholder="zone de texte pour l'afficheur" id="afficheurihm" /><br><br>
<input type="button" id="send_text" value="Envoyer"/>
<button id="reset" onclick="document.getElementById('afficheurihm').value = ''">Reset</button>

</div>
</div>
<script>
var toggle_bare=false;
var toggle_bars=false;
var toggle_feuv=false;
var toggle_feur=false;

$("#send_text").click(function(){
  var valeur_champ = $("#afficheurihm").val();
  $.ajax({url: "http://172.16.151.221:9898/maj_afficheur?i="+encodeURI(valeur_champ), success: function(result){
   }});
});


$("#be").click(function(){
if(toggle_bare == false)
{
 
   $.ajax({url: "http://172.16.151.221:9898/set_modbustcp?coil=0&value=1", success: function(result){
   }});
  toggle_bare=true;
}
else if(toggle_bare == true)
{
   $.ajax({url: "http://172.16.151.221:9898/set_modbustcp?coil=0&value=0", success: function(result){
  }});
  toggle_bare=false;
}

});

$("#bs").click(function(){
if(toggle_bars== false)
{
   $.ajax({url: "http://172.16.151.221:9898/set_modbustcp?coil=1&value=1", success: function(result){
   }});
  toggle_bars=true;
}
else if(toggle_bars== true)
{
   $.ajax({url: "http://172.16.151.221:9898/set_modbustcp?coil=1&value=0", success: function(result){
  }});
  toggle_bars=false;
}

});

$("#fv").click(function(){
if(toggle_feuv== false)
{
   $.ajax({url: "http://172.16.151.221:9898/set_modbustcp?coil=7&value=1", success: function(result){
   }});
  toggle_feuv=true;
}
else if(toggle_feuv== true)
{
   $.ajax({url: "http://172.16.151.221:9898/set_modbustcp?coil=7&value=0", success: function(result){
  }});
  toggle_feuv=false;
}

});

$("#fr").click(function(){
if(toggle_feur== false)
{
   $.ajax({url: "http://172.16.151.221:9898/set_modbustcp?coil=6&value=1", success: function(result){
   }});
  toggle_feur=true;
}
else if(toggle_feur== true)
{
   $.ajax({url: "http://172.16.151.221:9898/set_modbustcp?coil=6&value=0", success: function(result){
  }});
  toggle_feur=false;
}

});
</script>


  </section>
  <!-- End Hero Section  -->

  <!-- Footer -->
  <section id="footer">
    <div class="footer container">
      <div class="brand">
        <h1>En savoir Plus</h1>
      </div>
      <h2>Affichage administrateur</h2>
      <div class="social-icon">
        <div class="social-item">
          <a href="#"><img src="https://img.icons8.com/bubbles/100/000000/facebook-new.png" /></a>
        </div>
        <div class="social-item">
          <a href="#"><img src="https://img.icons8.com/bubbles/100/000000/instagram-new.png" /></a>
        </div>
        <div class="social-item">
          <a href="#"><img src="https://img.icons8.com/bubbles/100/000000/behance.png" /></a>
        </div>
      </div>
      <p>Copyright © 2022 Projet parking.</p>
    </div>
  </section>
  <!-- Fin Footer -->
</body>
</html>