<?php 
	$pago = false ; 
	$cn = mysqli_connect("localhost", "root", "", "edificio"); //conexion con la base de datos

	if(count($_POST)>0){ //segunda ejecucion

		//Validando el Piso
		if(!isset($_POST["piso"])) die("error piso1");
		if(!ctype_digit($_POST["piso"]))die ("error piso2");
		//if($_POST["piso"]<0) die ("error piso negativo"); ctype_digit ya chequea que no sea negativo 
		if($_POST["piso"]>10)die ("error piso mayor a 10");
		$piso = $_POST['piso'];

		//Validando la Letra
		if(!isset($_POST["dpto"])) die("error letra1");
		if(strlen($_POST["dpto"]) !=1  )die("error letra2");
		$letra = $_POST['dpto'];
		
		//Encontrando el ID
		$todos = mysqli_query($cn, "SELECT *
						FROM departamentos
						WHERE piso = $piso AND letra ='$letra' 
						LIMIT 1 "  );  //Uso la letra y piso para encontrar el ID 
		if(mysqli_num_rows($todos)!=1) die ("error al encontrar departamento"); 
		$fila= mysqli_fetch_assoc($todos); // obtengo la fila entera del departamento 
		$dpto_id= $fila["id_departamento"]; // me guardo el Id del departamento 
		//echo "$dpto_id";

		//Validando fecha 
		//var_dump($_POST["fecha"]); Para ver el formato que recibo la fecha 
		$fecha = $_POST["fecha"] ; //Guardo la fecha entera  
		$anio = substr($fecha , 0,4); // Separo el año 
		$mes = substr($fecha , 5,2) ; // mes 
		$dia = substr($fecha ,8,2) ; // Dia 
		//echo "dia " . $dia . " Mes " . $mes . " año: " . $anio ;
		if (!checkdate($mes,$dia,$anio) or $anio < 2010){ //El ejercicio no tiene restricciones de fecha pero le puse años posteriores a 2009 para probar 
			die("error fecha invalida");
		}

		//Validando monto 
		if(!isset($_POST["monto"]))die("error monto1");
		if(!is_numeric($_POST["monto"]))die("error monto2");
		if($_POST["monto"]<= 0)die("error monto3");
		$monto = $_POST["monto"];
		mysqli_query($cn, "INSERT INTO pagos 
							(id_departamento , fecha ,monto)
							VALUES
							($dpto_id , '$anio-$mes-$dia' , $monto )"
					);

		$pago = true ; 
	}


	$res = mysqli_query($cn, "SELECT *
						FROM departamentos"); // la tabla departamentos
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Alta pagos del edificio</title>
</head>
<body>
	<h1>Alta de pagos</h1>
	
	<form action="" method="post">

		<p><label for="piso">Piso:</label><input type="text" name="piso"></p>
		<p><label for="Letra">Letra:</label> <input type="text" name="dpto"></p>
		<p><label for="fecha">Fecha<input type="date" name="fecha"></p> 
		<p><label for="monto">Monto:<input type="number" name="monto"></p>
		
		<input type="submit" value="enviar pago" />
	<?php
		if ($pago){
			echo "<h2> Pago realizado </h2>";
		}

	  ?>

	</form>
</body>
</html>