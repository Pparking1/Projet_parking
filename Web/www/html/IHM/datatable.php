<?php
   // Database Connection
   include 'connection.php';

   // Reading value
   $draw = $_POST['draw'];
   $row = $_POST['start'];
   $rowperpage = $_POST['length']; // Rows display per page
   $columnIndex = $_POST['order'][0]['column']; // Column index
   $columnName = $_POST['columns'][$columnIndex]['data']; // Column name
   $columnSortOrder = $_POST['order'][0]['dir']; // asc or desc
   $searchValue = $_POST['search']['value']; // Search value

   $searchArray = array();

   // Search
   $searchQuery = " ";
   if($searchValue != ''){
      $searchQuery = " AND (Id_parking_parking LIKE :Id_parking_parking OR 
           immatriculation_voiture LIKE :immatriculation_voiture OR
           date_arrivee_est_garer LIKE :date_arrivee_est_garer OR 
           date_sortie_est_garer LIKE :date_sortie_est_garer ) ";
      $searchArray = array( 
           'Id_parking_parking'=>"%$searchValue%",
           'immatriculation_voiture'=>"%$searchValue%",
           'date_arrivee_est_garer'=>"%$searchValue%",
           'date_sortie_est_garer'=>"%$searchValue%"
      );
   }

   // Total number of records without filtering
   $stmt = $conn->prepare("SELECT COUNT(*) AS allcount FROM est_garer ");
   $stmt->execute();
   $records = $stmt->fetch();
   $totalRecords = $records['allcount'];

   // Total number of records with filtering
   $stmt = $conn->prepare("SELECT COUNT(*) AS allcount FROM est_garer WHERE 1 ".$searchQuery);
   $stmt->execute($searchArray);
   $records = $stmt->fetch();
   $totalRecordwithFilter = $records['allcount'];

   // Fetch records
   $stmt = $conn->prepare("SELECT * FROM est_garer WHERE 1 ".$searchQuery." ORDER BY ".$columnName." ".$columnSortOrder." LIMIT :limit,:offset");

   // Bind values
   foreach ($searchArray as $key=>$search) {
      $stmt->bindValue(':'.$key, $search,PDO::PARAM_STR);
   }

   $stmt->bindValue(':limit', (int)$row, PDO::PARAM_INT);
   $stmt->bindValue(':offset', (int)$rowperpage, PDO::PARAM_INT);
   $stmt->execute();
   $empRecords = $stmt->fetchAll();

   $data = array();

   foreach ($empRecords as $row) {
      $data[] = array(
         "Id_parking_parking"=>$row['Id_parking_parking'],
         "immatriculation_voiture"=>$row['immatriculation_voiture'],
         "date_arrivee_est_garer"=>$row['date_arrivee_est_garer'],
         "date_sortie_est_garer"=>$row['date_sortie_est_garer']
      );
   }

   // Response
   $response = array(
      "draw" => intval($draw),
      "iTotalRecords" => $totalRecords,
      "iTotalDisplayRecords" => $totalRecordwithFilter,
      "aaData" => $data
   );

   echo json_encode($response);