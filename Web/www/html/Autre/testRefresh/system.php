<?php
$conn = mysqli_connect("localhost", "openalpr", "openalpr", "projet_parking");
$rows = mysqli_query($conn, "SELECT * FROM est_garer");
?>
<table border = 1 cellpadding = 10>
  <tr>
    <td>#</td>
    <td>ID</td>
    <td>Immatriculation</td>
    <td>Arrivée</td>
    <td>Sortie</td>
  </tr>
  <?php $i = 1; ?>
  <?php foreach($rows as $row) : ?>
    <tr>
      <td><?php echo $i++; ?></td>
      <td><?php echo $row["Id_parking_parking"]; ?></td>
      <td><?php echo $row["immatriculation_voiture"]; ?></td>
      <td><?php echo $row["date_arrivée_est_garer"]; ?></td>
      <td><?php echo $row["date_sortie_est_garer"]; ?></td>
    </tr>
  <?php endforeach; ?>
</table>
