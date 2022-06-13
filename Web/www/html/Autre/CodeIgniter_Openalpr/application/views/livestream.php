<?php 
	defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>livestream test</title>
        <meta name="author" content="Ralph Hughes">
        <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,minimum-scale=1,user-scalable=no" />
        <meta name="apple-mobile-web-app-capable" content="yes" />
	<!---oui-->
    </head>
    <body>



    <div id="group" style="position: absolute; left:0px; top:0px; height: 640px; width: 480px">
        <video id="widget" width="640" height="480" controls>
            <source id="vidSource" type="video/mp4">
        </video>
    </div>


<script>
	var widgetID = document.getElementById('widget');
        var camCanvas = document.getElementById("group");
	var vidSource = document.getElementById("vidSource");
            
            widgetID.controls = true;
            vidSource.src = "http://172.16.151.180:3000/";        // live stream
            widgetID.load();
            widgetID.play();
</script>
</body>
</html>
