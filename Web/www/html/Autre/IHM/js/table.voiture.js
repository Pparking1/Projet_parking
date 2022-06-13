
/*
 * Editor client script for DB table voiture
 * Created by http://editor.datatables.net/generator
 */

(function($){

	$(document).ready(function() {
		var editor = new $.fn.dataTable.Editor( {
			ajax: 'php/table.voiture.php',
			table: '#voiture',
			fields: [
				{
					"label": "immatriculation:",
					"name": "immatriculation_voiture"
				},
				{
					"label": "Marque:",
					"name": "Marque_voiture"
				},
				{
					"label": "Modele:",
					"name": "Modele_voiture"
				},
				{
					"label": "Couleur:",
					"name": "Couleur_voiture"
				},
				{
					"label": "Carburant:",
					"name": "Carburant_voiture"
				},
				{
					"label": "Options:",
					"name": "options_voiture"
				},
				{
					"label": "date:",
					"name": "date_voiture"
				},
				{
					"label": "vignette crit air:",
					"name": "vignette_crit_air_voiture"
				}
			]
		} );
	
		var table = $('#voiture').DataTable( {
			dom: 'Bfrtip',
			ajax: 'php/table.voiture.php',
			columns: [
				{
					"data": "immatriculation_voiture"
				},
				{
					"data": "Marque_voiture"
				},
				{
					"data": "Modele_voiture"
				},
				{
					"data": "Couleur_voiture"
				},
				{
					"data": "Carburant_voiture"
				},
				{
					"data": "options_voiture"
				},
				{
					"data": "date_voiture"
				},
				{
					"data": "vignette_crit_air_voiture"
				}
			],
			select: true,
			lengthChange: false,
			buttons: [
				{ extend: 'create', editor: editor },
				{ extend: 'edit',   editor: editor },
				{ extend: 'remove', editor: editor }
			]
		} );
	} );
	
	}(jQuery));
	
	