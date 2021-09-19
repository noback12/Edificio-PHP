<?php 
	$cn = mysqli_connect("localhost", "root", "", "edificio"); //conexion con la base de datos

	if(!isset($_GET['resp']))die("error isset "); //Existe
	if(empty($_GET['resp']))die("error empty "); 
	if(strlen($_GET['resp'])<2)die("error tamaño min");//caracteres min
	if(strlen($_GET['resp'])>50)die("error tamaño max");//caracteres max
	$_GET['resp']= mysqli_real_escape_string($cn , $_GET['resp']);//escapo las comillas 
	$_GET['resp']= str_replace("%" , "\%",$_GET['resp'] );//comodin para la busqueda
	$_GET['resp']= str_replace("_" , "\_",$_GET['resp'] );//comodin para la busqueda 2

	$resp=$_GET['resp'];
	
	$dpts = mysqli_query($cn, "SELECT *
						FROM departamentos
						WHERE responsable LIKE '%$resp%'

						"); // la tabla departamentos

	$result = mysqli_num_rows($dpts) ;
?>

<!DOCTYPE html>
<html lang ="es">
<head >
	<meta charset="utf-8">
	<title>Responsables</title>

	<style >
		table th, table td {
			border : 1px solid black ;
		}

		a:link, a:visited  {
			background-color: lightblue;
			color: black;
			padding: 14px 25px;
			text-align: center;
			text-decoration: none;
			display: inline-block;
		}
		a:hover{
			 color: grey;
		}
	</style>
</head>
<body>
	<h1>Resultados:</h1>	
<?php if($result == 0){?>
	<p> No se encontro a " <?= $_GET['resp'] ?> " entre los responsables </p>


<?php }else if ($result == 1){ ?>
		<p>1 </p>
<?php }else if ($result > 1) { ?>
	<?= $result ?> resultados: <br>

	<?php while($fila = mysqli_fetch_assoc($dpts)){?>
		<p><a href="responsable.php?e=<?= $fila["responsable"] ?>">  <?= $fila["responsable"] ?> </a>  </p>

	<?php }	?>


<?php } ?>
	<a href="buscar_responsable.php">Buscador</a>
</body>
</html>