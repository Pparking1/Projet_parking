<?php

/*
 * Editor server script for DB table utilisateur
 * Created by http://editor.datatables.net/generator
 */

// DataTables PHP library and database connection
include( "lib/DataTables.php" );

// Alias Editor classes so they are easy to use
use
	DataTables\Editor,
	DataTables\Editor\Field,
	DataTables\Editor\Format,
	DataTables\Editor\Mjoin,
	DataTables\Editor\Options,
	DataTables\Editor\Upload,
	DataTables\Editor\Validate,
	DataTables\Editor\ValidateOptions;

// The following statement can be removed after the first run (i.e. the database
// table has been created). It is a good idea to do this to help improve
// performance.
$db->sql( "CREATE TABLE IF NOT EXISTS `utilisateur` (
	`id_utilisateur_utilisateur` int(10) NOT NULL auto_increment,
	`Prenom_utilisateur` varchar(255),
	`Nom_utilisateur` varchar(255),
	`adresse_utilisateur` varchar(255),
	`ville_utilisateur` varchar(255),
	`Numero_de_telephone_utilisateur` varchar(255),
	`E_mail_utilisateur` varchar(255),
	`metier_utilisateur` varchar(255),
	`age` varchar(255),
	PRIMARY KEY( `id_utilisateur_utilisateur` )
);" );

// Build our Editor instance and process the data coming from _POST
Editor::inst( $db, 'utilisateur', 'id_utilisateur_utilisateur' )
	->fields(
		Field::inst( 'Prenom_utilisateur' ),
		Field::inst( 'Nom_utilisateur' ),
		Field::inst( 'adresse_utilisateur' ),
		Field::inst( 'ville_utilisateur' ),
		Field::inst( 'Numero_de_telephone_utilisateur' ),
		Field::inst( 'E_mail_utilisateur' ),
		Field::inst( 'metier_utilisateur' ),
		Field::inst( 'age' )
	)
	->process( $_POST )
	->json();
