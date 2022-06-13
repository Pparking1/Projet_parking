<!DOCTYPE html>
<html lang="fr" data-color-mode="dark" data-light-theme="light" data-dark-theme="dark">
<head>
  <title>Project parking</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="h.css">
  <link rel="stylesheet" href="h2.css">
  <script src="app.js" defer></script>


  <!-- Table historique -->
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
	<script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
	<script type="text/javascript" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>

</head>

<body>
  <!-- Header -->
  <section id="header">
    <div class="header container">
      <div class="nav-bar">
        <div class="brand">
          <a href="#hero">
            <h1><span2>T</span2>ableau de <span2>B</span2>ord</h1>
          </a>
        </div>
        <div class="nav-list">
          <div class="hamburger">
            <div class="bar"></div>
          </div>
          <ul>
            <li><a href="index.php" data-after="IHM">ihm</a></li>
            <li><a href="pagehistorique.php" data-after="Historique">Historique</a></li>
            <li><a href="page2.html" data-after="Aide">Aide</a></li>
          </ul>
        </div>
      </div>
    </div>
  </section>
  <!-- End Header -->

  <section id="hero">


    <!-----Console-->

  <div id="ele_3" class="btn_ele"> 
    <div id="scroll">
    <script type="text/javascript">
		$(document).ready(function() {
		    $('#est_garer').DataTable({
		      	'processing': true,
		      	'serverSide': true,
		      	'serverMethod': 'post',
		      	'ajax': {
		          	'url':'datatable.php'
		      	},
		      	'columns': [
		         	{ data: 'Id_parking_parking' },
		         	{ data: 'immatriculation_voiture' },
		         	{ data: 'date_arrivee_est_garer' },
		         	{ data: 'date_sortie_est_garer' }
		      	]
		   });

		} );
	</script>
	<div class="histo mt-5">
		<h2 style="margin-bottom: 10px;">Historique des <span2>LOGS</span2></h2>
		<table id="est_garer" class="display" style="width:100%">
	        <thead>
	            <tr>
	                <th>ID parking</th>
	                <th>Immatriculation</th>
	                <th>Date et heure d'arrivée</th>
	                <th>Date et heure de sortie</th>
	            </tr>
	        </thead>
	    </table>
	</div>

</div>
</div>
</div>
  </section>
  <!-- End Hero Section  -->

  <!-- Footer -->
  <section id="footer">
    <div class="footer container">
      <div class="brand">
        <h1><span2>E</span2>n savoir <span2>P</span2>lus</h1>
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
