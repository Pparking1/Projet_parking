<html>
<head>
	<title> Commande Barriere</title>
	<meta charset='UTF-8'>

</head>
<body>
<p> Ouvrir Barriere 1 :  
<button onclick="ouvB1()"> Click </button>
</p>

<p> Fermée Barriere 1 :  
<button onclick="fermB1()"> Click </button>
</p>

<p> Ouvrir Barriere 2 :  
<button onclick="ouvB2()"> Click </button>
</p>

<p> Fermée Barriere 2 :  
<button onclick="fermB2()"> Click </button>
</p>

<script>

function ouvB1() {
    //var params = 1;
    request = new XMLHttpRequest(); // création (intanciation de l'objet XMLHttpRequest). Attention ne fonctionne pas sur IE
    request.open("GET", "http://172.16.151.221/scriptBarriere/testRequete.php?var=1", true); // préparation de la requête
    
    request.send(); // envoie de la requête
}
document.onload = ouvB1();

function fermB1() {
    //var params = "3";
    request = new XMLHttpRequest(); // création (intanciation de l'objet XMLHttpRequest). Attention ne fonctionne pas sur IE
    request.open("GET", "http://172.16.151.221/scriptBarriere/testRequete.php?var=2", true); // préparation de la requête
    
    request.send(); // envoie de la requête
}
document.onload = fermB1();

function ouvB2() {
    //var params = "3";
    request = new XMLHttpRequest(); // création (intanciation de l'objet XMLHttpRequest). Attention ne fonctionne pas sur IE
    request.open("GET", "http://172.16.151.221/scriptBarriere/testRequete.php?var=3", true); // préparation de la requête
    
    request.send(); // envoie de la requête
}
document.onload = ouvB2();

function fermB2() {
    //var params = "3";
    request = new XMLHttpRequest(); // création (intanciation de l'objet XMLHttpRequest). Attention ne fonctionne pas sur IE
    request.open("GET", "http://172.16.151.221/scriptBarriere/testRequete.php?var=4", true); // préparation de la requête
    
    request.send(); // envoie de la requête
}
document.onload = fermB2();

</script>
</body>
</html>