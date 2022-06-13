<?php

/*
 * Editor server script for DB table voiture
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
$db->sql( "CREATE TABLE IF NOT EXISTS `voiture` (
	`immatriculation_voiture` int(10) NOT NULL auto_increment,
	`Marque_voiture` varchar(255),
	`Modele_voiture` varchar(255),
	`Couleur_voiture` varchar(255),
	`Carburant_voiture` varchar(255),
	`options_voiture` varchar(255),
	`date_voiture` varchar(255),
	`vignette_crit_air_voiture` varchar(255),
	PRIMARY KEY( `immatriculation_voiture` )
);" );

// Build our Editor instance and process the data coming from _POST
Editor::inst( $db, 'voiture', 'immatriculation_voiture' )
	->fields(
		Field::inst( 'immatriculation_voiture' ),
		Field::inst( 'Marque_voiture' ),
		Field::inst( 'Modele_voiture' ),
		Field::inst( 'Couleur_voiture' ),
		Field::inst( 'Carburant_voiture' ),
		Field::inst( 'options_voiture' ),
		Field::inst( 'date_voiture' ),
		Field::inst( 'vignette_crit_air_voiture' )
	)
	->process( $_POST )
	->json();
