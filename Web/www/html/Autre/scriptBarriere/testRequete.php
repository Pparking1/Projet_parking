    <?php

include ("config.php");

$val = $_GET['var'];
//echo $val;
function ouvrirBarriere1(&$IP, $Port)
{
    // $PORT = 8888;
    //echo "afficher25 :".$IP;
    echo "IP : ".$IP;
    echo "  Port : ".$Port;
     $Message = "Ananas";
     $socket = socket_create(AF_INET, SOCK_DGRAM, SOL_UDP);
    socket_bind($socket, $IP, 0);
    socket_sendto($socket, $Message, strlen($Message), 0, $IP, $Port);

    socket_close($socket);
    //echo socket_strerror(socket_last_error($socket)) ;
}

function fermeBarriere1($IP, $Port)
{
    //$adIP = '172.16.151.228';
    //$PORT = 8888;
    
    $Message = "10";
    $socket = socket_create(AF_INET, SOCK_DGRAM, SOL_UDP);
    socket_bind($socket, $IP, 0);
    socket_sendto($socket, $Message, strlen($Message), 0, $IP, $Port);

    socket_close($socket);

}
        function ouvrirBarriere2($IP, $Port)
        {
             //$adIP = '172.16.151.228';
             //$PORT = 8888;
             //echo "afficher : ".$IP." et ".$Port;
            echo 'ouv b2 <br/>';
            echo "l'adresse IP : ".$IP ;
            echo " Le port : ".$Port;
             $Message = "21";
             $socket = socket_create(AF_INET, SOCK_DGRAM, SOL_UDP);
            socket_bind($socket, $IP, 0);
            socket_sendto($socket, $Message, strlen($Message), 0, $IP, $Port);
    
            socket_close($socket);
        }

        function fermeBarriere2($IP, $PORT)
        {
            //echo "l'adresse IP : ".$IP ;
            //echo " Le port : ".$PORT;
           //echo "attention, je rentre dans la fonction";
            $Message = "20";
            $socket = socket_create(AF_INET, SOCK_DGRAM, SOL_UDP);
            socket_bind($socket, $IP, 0);
            socket_sendto($socket, $Message, strlen($Message), 0, $IP, $PORT);
           

            socket_close($socket);
            

        }
        //echo $val;
        //echo "IP :".$adIP;
        //echo " Port : ".$PORT;
       // echo " 2IP : ".$IP;
        switch($val)
        {
            case "1":
                ouvrirBarriere1($adIP, $PORT);
                echo "recu : 1";
            break;
            case "2":
                fermeBarriere1($adIP, $PORT);
                echo "recu : 2";
            break;
            case 3:
                ouvrirBarriere2($adIP, $PORT);
                echo "recu : 3";
            break;
            case "4":
                fermeBarriere2($adIP, $PORT);
                echo "recu : 4";
            break;
        }
     
            
        
            
        //ouvrirBarriere2($adIP, $PORT);
        //fermeBarriere2($adIP, $PORT);
        //ouvrirBarriere1($adIP, $PORT);
        //fermeBarriere1($adIP, $PORT);

    ?>
  
                    
                 
                  