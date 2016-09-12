<?php

function add($n,$m){
	return $n+$m;
}

function checkit($str){
	if ($str=="Instinct") {
		return "Hombre";
	} else {
		return "Payaso";
	}
}

$table = "<table>";
$equip = array("Mystic","Instinct","Valor");
sort($equip);
foreach ($equip as $key => $val) {
	$table .= "<tr><td>$key</td><td>$val</td><td>".checkit($val)."</td></tr>";	
}
unset($key);
unset($val);
$table .= "</table>"

?>

<!DOCTYPE html>
<html lang="en">



<head>
	<meta charset="utf-8">
	<title>PHP</title>
</head>



<body>
	<?php echo $table;?>
	<p> Tan cierto como 2+2 = <?php echo add(2,2);?> </p>
</body>



</html>
