<?php
	function conecta(){
		$cs=mysqli_connect("localhost","root","");
		$cbd=mysqli_select_db($cs,"ejemplo_pirineos");
		return $cs;
	}

	function msg($mensaje,$color){
		echo "<br><br><br>";
		echo "<table border='3' cellspacing='5' width='80%'>";
			echo "<tr align='center'>";
				if ($color=='rojo') echo "<td bgcolor='red'>";
				if ($color=='verde') echo "<td bgcolor='green'>";
				if ($color=='gris') echo "<td bgcolor='gray'>";
					echo "<p class='titutlo36' id='titulo24' style='color:white'>".$mensaje."</p>";
				echo "</td>";
			echo "</tr>";
			echo "<tr align='center'>";
				echo "<td>";
					echo "<p class='titulo36' id='titulo18'> Seleccione las opciones del menú superior para continuar </p>";
				echo "</td>";
			echo "</tr>";
		echo "</table> <br><br><br><br><br>";	
	}

?>