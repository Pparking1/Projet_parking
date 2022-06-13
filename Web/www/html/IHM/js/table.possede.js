
/*
 * Editor client script for DB table possede
 * Created by http://editor.datatables.net/generator
 */

(function($){

	$(document).ready(function() {
		var editor = new $.fn.dataTable.Editor( {
			ajax: 'php/table.possede.php',
			table: '#possede',
			fields: [
				{
					"label": "Immatriculation:",
					"name": "possede.IDplaque",
					"type": "select"
				},
				{
					"label": "Utilisateur:",
					"name": "possede.IDutilisateur",
					"type": "select"
				}
			]
		} );
	
		var table = $('#possede').DataTable( {
			dom: 'Bfrtip',
			ajax: 'php/table.possede.php',
			columns: [
				{ data: null, render: function ( data, type, row ) {
					return data.utilisateur.Nom_utilisateur+' '+data.utilisateur.Prenom_utilisateur;
				} },
				{ data: 'possede.IDplaque' },
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
	
	