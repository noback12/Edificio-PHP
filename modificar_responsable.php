<?php 
	$cn = mysqli_connect("localhost", "root", "", "edificio"); 

	if(!isset($_GET["depart"])) die("error depart1");
	if(empty($_GET["depart"])) die("error depart vacio");
	if(!ctype_digit($_GET["depart"]))die ("error depart2");
	$id = $_GET["depart"] ;

	$todos = mysqli_query($cn, "SELECT *
						FROM departamentos
						WHERE  id_departamento = $id
						LIMIT 1
						 "  );  
		if(mysqli_num_rows($todos)!=1) die ("error encontrar departamento"); 
	
	if(!isset($_GET['nombre']))die("error isset "); //Existe
	if(empty($_GET['nombre']))die("error empty "); 
	if(strlen($_GET['nombre'])<2)die("error tamaño min");//caracteres min
	if(strlen($_GET['nombre'])>50)die("error tamaño max");//caracteres max
	$_GET['nombre']= mysqli_real_escape_string($cn , $_GET['nombre']);//escapo las comillas 
	$responsable = $_GET['nombre'];

	mysqli_query($cn , "UPDATE departamentos
						SET 
						    responsable = '$responsable'
						WHERE
						    id_departamento = $id
				"); //Actualizo el responsable en el id correspondiente


?>

<!DOCTYPE html>
<html lang ="es">
<head >
	<meta charset="utf-8">
	<title>Modificar</title>


</head>
<body>
	<h1>Modificar</h1>	

	
		<p> el nuevo responsable para el departamento id <?=$id ?> es  <?=$responsable ?> </p>

		

</body>
</html>