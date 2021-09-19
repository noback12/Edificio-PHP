
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Buscar Responsable</title>
	<style >
		

		input[type=submit]{
			background-color: lightblue;
			color: black;
			padding: 14px 25px;
			text-align: center;
			text-decoration: none;
			display: inline-block;
		}
		
	</style>

</head>
<body>
	<h1>Buscar Responsable</h1>
	
	<form action="resultados_responsables.php" method="GET">

		<p><label for="resp">Responsable:</label><input type="text" name="resp"></p>
				
		<input type="submit" value="Buscar" />

	</form>
</body>
</html>