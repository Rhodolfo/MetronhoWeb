<!DOCTYPE html>
<html lang="en">



<head>
	<meta charset="utf-8">
	<title>Javascript</title>
</head>



<body>

<p id="ejemplo" onclick="ejemplo()">Yo cambio.<p>
<p> En esta página he se utiliza el atributo "onclick" para llamar una función de Javascript. </p>

</body>



<script>
function ejemplo() {
	document.getElementById("ejemplo").innerHTML = "Ya cambie!";
}
</script>


</html>
