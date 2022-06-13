
/*
 * Editor client script for DB table utilisateur
 * Created by http://editor.datatables.net/generator
 */

(function($){

$(document).ready(function() {
	var editor = new $.fn.dataTable.Editor( {
		ajax: 'php/table.utilisateur.php',
		table: '#utilisateur',
		fields: [
			{
				"label": "Prenom:",
				"name": "Prenom_utilisateur"
			},
			{
				"label": "Nom:",
				"name": "Nom_utilisateur"
			},
			{
				"label": "Adresse:",
				"name": "adresse_utilisateur"
			},
			{
				"label": "Ville:",
				"name": "ville_utilisateur"
			},
			{
				"label": "Num&eacute;ro de t&eacute;l&eacute;phone:",
				"name": "Numero_de_telephone_utilisateur"
			},
			{
				"label": "E-mail:",
				"name": "E_mail_utilisateur"
			},
			{
				"label": "Metier:",
				"name": "metier_utilisateur"
			},
			{
				"label": "Age:",
				"name": "age"
			}
		]
	} );

	var table = $('#utilisateur').DataTable( {
		dom: 'Bfrtip',
		ajax: 'php/table.utilisateur.php',
		columns: [
			{
				"data": "Prenom_utilisateur"
			},
			{
				"data": "Nom_utilisateur"
			},
			{
				"data": "adresse_utilisateur"
			},
			{
				"data": "ville_utilisateur"
			},
			{
				"data": "Numero_de_telephone_utilisateur"
			},
			{
				"data": "E_mail_utilisateur"
			},
			{
				"data": "metier_utilisateur"
			},
			{
				"data": "age"
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

