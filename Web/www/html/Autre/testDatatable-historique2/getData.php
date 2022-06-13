<?php 
// Database connection info 
$dbDetails = array( 
    'host' => 'localhost', 
    'user' => 'openalpr', 
    'pass' => 'openalpr', 
    'db'   => 'projet_parking' 
); 
 
// DB table to use 
$table = 'est_garer'; 
 
// Table's primary key 
$primaryKey = 'Id_parking_parking'; 
 
// Array of database columns which should be read and sent back to DataTables. 
// The `db` parameter represents the column name in the database.  
// The `dt` parameter represents the DataTables column identifier. 
$columns = array( 
    array( 'db' => 'Id_parking_parking', 'dt' => 0 ), 
    array( 'db' => 'immatriculation_voiture',  'dt' => 1 ), 
    array( 'db' => 'date_arrivée_est_garer',      'dt' => 2 ), 
    array( 'db' => 'date_sortie_est_garer',     'dt' => 3 ), 
    array( 'db' => 'autorise',    'dt' => 4 ), 
    array( 
        'db'        => 'created', 
        'dt'        => 5, 
        'formatter' => function( $d, $row ) { 
            return date( 'jS M Y', strtotime($d)); 
        } 
    ), 
    array( 
        'db'        => 'status', 
        'dt'        => 6, 
        'formatter' => function( $d, $row ) { 
            return ($d == 1)?'Active':'Inactive'; 
        } 
    ) 
); 
 
// Include SQL query processing class 
require 'ssp.class.php'; 
 
// Output data as json format 
echo json_encode( 
    SSP::simple( $_GET, $dbDetails, $table, $primaryKey, $columns ) 
);