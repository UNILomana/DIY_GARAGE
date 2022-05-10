<?php
	/*Datu Basearekin konektatzeko, localhost-ean dago root erabiltzailearekin*/ 
	function connectDataBase()
		{
			if (!($connection=mysqli_connect("192.168.72.76","Administrador","admin123"))) //Zerbitzaria erabiltzean aldatu egin behar da
			{
				echo "There is an error connecting the DB.";
				exit();
			}
			/*Datu Baseko taula konexioa*/
			if (!mysqli_select_db($connection,"db_garage"))
			{
				echo "There is an error selecting the DB.";
				exit();
			}
			return $connection;
		}
	?>
