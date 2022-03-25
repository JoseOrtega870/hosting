<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="estilos.css">
	<link rel="shortcut icon" type="image/png" href="imagenes/logo_pirineos.png">
	<script type="text/javascript" src="productos.js"></script>
	<title>Pirineos</title>
</head>
<body>
	<center>
		<?php
			include 'utilerias.php';
			$op=$_GET['op'];
			if ($op==0) formulario();
			if ($op==1) altas();
			if ($op==2) bajas();
			if ($op==3) Consultas();
			if ($op==4) cambios();

			function tomar_datos(){
				global $cve_prod, $nom_prod, $tipo_prod, $presenta_prod;
				$cve_prod=$_GET['cve_prod'];
				$nom_prod=$_GET['nom_prod'];
				$tipo_prod=$_GET['tipo_prod'];
				$presenta_prod=$_GET['presenta_prod'];
			}

			function altas(){
				global $cve_prod, $nom_prod, $tipo_prod, $presenta_prod;
				tomar_datos();
				$cs=conecta();
				$query="SELECT * FROM productos WHERE cve_prod='$cve_prod'";
				$sql=mysqli_query($cs,$query);
				$reg=mysqli_fetch_object($sql);
				if ($reg!=mysqli_fetch_array($sql)){
					msg("Error, clave de producto se duplica en la base de datos","rojo");
				}
				else{
					$query="SELECT * FROM tipos WHERE cve_tipo='$tipo_prod'";
					$sql=mysqli_query($cs,$query);
					$reg=mysqli_fetch_object($sql);
					if ($reg==mysqli_fetch_array($sql)){
						msg("Error, el tipo de producto no existe en la base de datos","rojo");
					}
					else{
						$query="INSERT INTO productos VALUES ('$cve_prod','$nom_prod','$tipo_prod','$presenta_prod')";
						$sql=mysqli_query($cs,$query);
						msg("El registro ha sido grabado correctamente","verde");
					}
				}
			}

			function bajas(){
				global $cve_prod, $nom_prod, $tipo_prod, $presenta_prod;
				Consultas();
				$cs=conecta();
				$query="DELETE FROM productos WHERE cve_prod='$cve_prod'";
				$sql=mysqli_query($cs,$query);
				if (mysqli_affected_rows($cs)!=0) {
					msg("El registro a sido ELIMINADO","verde");
				}
			}

			function Consultas(){
				global $cve_prod, $nom_prod, $tipo_prod, $presenta_prod;
				tomar_datos();
				// echo "cve_prod="+$cve_prod;
				$cs=conecta();
				$query="SELECT * FROM productos WHERE cve_prod='$cve_prod'";
				$sql=mysqli_query($cs,$query);
				$reg=mysqli_fetch_object($sql);
				if ($reg==mysqli_fetch_array($sql)){
					msg("Error, clave de producto inexistente en base de datos","rojo");
				}
				else{
					$nom_prod=$reg->nom_prod;
					$tipo_prod=$reg->tipo_prod;
					$presenta_prod=$reg->presenta_prod;
					formulario();
				}
			}

			function cambios(){
				global $cve_prod, $nom_prod, $tipo_prod, $presenta_prod;
				tomar_datos();
				$cs=conecta();
				$query="SELECT * FROM productos WHERE cve_prod='$cve_prod'";
				$sql=mysqli_query($cs,$query);
				$reg=mysqli_fetch_object($sql);
				if($reg==mysqli_fetch_array($sql)){
					msg("Error clave de producto inexistente en la base de datos","rojo");
				}
				else{
					if((strlen($presenta_prod)!=0) && ($presenta_prod!=$reg->presenta_prod)){
						$query="UPDATE productos SET presenta_prod='$presenta_prod' WHERE cve_prod='$cve_prod'";
						$sql=mysqli_query($cs,$query);
						msg("El cambio a sido realizado correctamente","verde");
					}
				}
			}

			function formulario(){
			global $cve_prod, $nom_prod, $tipo_prod, $presenta_prod;
			echo "<br> <br>";
			echo "
			<form name='f_productos'>
				<table border='10%'width='80%'>
					<tr align='center'>
						<td><p>Clave del Producto</p></td>
						<td><input name='cve_prod' type='text' class='campo' maxlength='5' value='$cve_prod'></td>
					</tr>
					<tr align='center'>
						<td><p>Nombre del Producto</p></td>
						<td><input name='nom_prod' type='text' class='campo' maxlength='50' value='$nom_prod'></td>
					</tr>
					<tr align='center'>
						<td><p>Clave del Tipo del Producto</p></td>
						<td><input name='tipo_prod' type='text' class='campo' maxlength='5' value='$tipo_prod'></td>
					</tr>
					<tr align='center'>
						<td><p>Presentación del Producto</p></td>
						<td><input name='presenta_prod' type='text' class='campo' maxlength='50' value='$presenta_prod'></td>
					</tr>
					<tr align='center'>
						<td colspan='2'>
							<table width='100%'>
								<tr align='center'>
									<td><input name='b_altas' type='button' class='boton' value='Altas' onclick='altas()'>
									</td>
									<td><input name='b_bajas' type='button' class='boton' value='Bajas' onclick='bajas()'>
									</td>
									<td><input name='b_consultas' type='button' class='boton' value='Consultas' onclick='Consultas()'>
									</td>
									<td><input name='b_cambios' type='button' class='boton' value='Cambios' onclick='cambios()'>
									</td>
									<td><input name='b_reset' type='reset' class='boton' value='Reiniciar' id='rojo'>
									</td>
								</tr>
							</table>
						</td>
					</tr>
				</table>
			</form>
			";
			}
		?>
	</table>
	</center>
</body>
</html>