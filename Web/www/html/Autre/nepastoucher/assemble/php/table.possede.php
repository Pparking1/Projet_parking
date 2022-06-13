<?php

/*
 * Editor server script for DB table possede
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
$db->sql( "CREATE TABLE IF NOT EXISTS `possede` (
	`IDutilisateur` int(10) NOT NULL auto_increment,
	`IDplaque` varchar(255),
	PRIMARY KEY( `IDutilisateur`,`IDplaque` )
);" );


Editor::inst( $db, 'possede', array('IDutilisateur', 'IDplaque') )
->debug( true )
->field(
	Field::inst( 'possede.IDutilisateur' )
		->options( Options::inst()
			->table( 'utilisateur' )
			->value( 'id_utilisateur_utilisateur' )
			->label( array('Nom_utilisateur', 'Prenom_utilisateur') )
		)
		->validator( Validate::dbValues() ),
	Field::inst( 'possede.IDplaque' )
		->options( Options::inst()
			->table( 'voiture' )
			->value( 'immatriculation_voiture' )
			->label( 'immatriculation_voiture' )
		)
		->validator( Validate::dbValues() ),
	Field::inst( 'voiture.immatriculation_voiture' )
		->set( false ),
	Field::inst( 'utilisateur.Nom_utilisateur' )
		->set( false ),
	Field::inst( 'utilisateur.Prenom_utilisateur' )
		->set( false )
)
->leftJoin( 'voiture', 'possede.IDplaque', '=', 'voiture.immatriculation_voiture' )
->leftJoin( 'utilisateur', 'possede.IDutilisateur', '=', 'utilisateur.id_utilisateur_utilisateur' )
->validator( function ($editor, $action, $data) {
	if ( $action == Editor::ACTION_CREATE ) {
		// Detect duplicates on create
		foreach ($data['data'] as $key => $values) {
			// Are there any rows that conflict?
			$any = $editor->db()->any( 'possede', function ($q) use ($values) {
				$q->where( 'IDutilisateur', $values['possede']['IDutilisateur']);
				$q->where( 'IDplaque', $values['possede']['IDplaque'] );
			} );

			// If there was a matching row, then report an error
			if ( $any ) {
				return 'La relation est déjà réalisé.';
			}
		}
	}
	else if ( $action == Editor::ACTION_EDIT ) {
		// Detect duplicates on edit
		foreach ($data['data'] as $key => $values) {
			// Get the row's primary key components
			$pkey = $editor->pkeyToArray( $key );

			// Discount the row being edited
			if ( $pkey['possede']['IDutilisateur'] != $values['possede']['IDutilisateur'] ||
				 $pkey['possede']['IDplaque'] != $values['possede']['IDplaque'] )
			{
				// Are there any rows that conflict?
				$any = $editor->db()->any( 'possede', function ($q) use ($pkey, $values) {
					$q->where( 'IDutilisateur', $values['possede']['IDutilisateur']);
					$q->where( 'IDplaque', $values['possede']['IDplaque'] );
				} );

				// If there was a matching row, then report an error
				if ( $any ) {
					return 'La relation est déjà réalisé.';
				}
			}
		}
	}
} )
->process($_POST)
->json();