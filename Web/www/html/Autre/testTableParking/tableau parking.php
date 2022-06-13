<?php
$servername = "localhost";
$username = "openalpr";
$password = "openalpr";
$db_name = "projet_parking";
$conn = mysqli_connect($servername, $username, $password, $db_name); 
?> 
<table border='1' style=''>

<?php
$sql="SELECT * FROM parking";
$result = mysqli_query($conn, $sql); 
if (mysqli_num_rows($result)>0) {

echo "<thead>";
echo "<tr>";
   echo "<th>Id_parking_parking</th>";
   echo "<th>nom_parking</th>";
   echo "<th>adresse_parking</th>"; 
   echo "<th>ville_parking</th>";
   echo "<th>latitude_parking</th>"; 
   echo "<th>longitude_parking</th>";
   echo "<th>Nombre_de_place_parking</th>";
echo "</tr>";
echo "</thead>";

}
while($row=mysqli_fetch_assoc($result)) {

echo "<tr>";
   echo "<td>".$row['Id_parking_parking']."</td>";
   echo "<td>".$row['nom_parking']."</td>";
   echo "<td>".$row['adresse_parking']."</td>";
   echo "<td>".$row['ville_parking']."</td>";
   echo "<td>".$row['latitude_parking']."</td>";
   echo "<td>".$row['longitude_parking']."</td>";
   echo "<td>".$row['Nombre_de_place_parking']."</td>"; 
echo "</tr>";
}

?>
