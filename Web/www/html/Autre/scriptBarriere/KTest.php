<?php

   //include "testRequete.php";
   function ouvrirBarriere2()
   {
        $adIP = '172.16.151.189';
        //$adIP = '127.0.0.1';
       // $Port = 1234;
        $Port = 5000;
        //echo "afficher : ".$IP." et ".$Port;
       echo 'ouv b2 <br/>';
       echo "L'adresse IP : ".$adIP ;
       echo " Le port : ".$Port;
        $Message = "Ananas";
        $socket = socket_create(AF_INET, SOCK_DGRAM, SOL_UDP);
       
        if(!($socket = socket_create(AF_INET, SOCK_DGRAM, SOL_UDP)))
{
	$errorcode = socket_last_error();
    $errormsg = socket_strerror($errorcode);
    
    die("Couldn't create socket: [$errorcode] $errormsg \n");
}

echo "Socket created \n";
echo"<br/>";
       
        socket_bind($socket, $adIP, 0);

      

       socket_sendto($socket, $Message, strlen($Message), 0, $adIP, $Port);
       
       if( !socket_bind($socket, $adIP) )
       {
         $errorcode = socket_last_error();
           $errormsg = socket_strerror($errorcode);
           
           die("Could not bind socket : [$errorcode] $errormsg \n");
       }

       socket_close($socket);
      
   }

   ouvrirBarriere2();
  //fermeBarriere2($adIP, $PORT);
        
            
?>
            