<?php
   header("Access-Control-Allow-Origin: *");
   require_once "db.php";
   //RECOJER LOS DATOS
	  $json = file_get_contents("php://input");
	  $data = json_decode($json,true);
	  $_POST = $data;
	   
	if($_POST == null){
		$res->mensaje = "No llegaron datos al servidor";
	}else{	//else 01
		$rut = $_POST["rut"];
		$duracion = $_POST["duracion"];
		$valor = $duracion["Tiempo"];
					$sql1="UPDATE SERVICIO_TRABAJADOR SET duracion='$valor' WHERE rut_trabajador='$rut'";
					$res=query($sql1);
	  }//fin else 01
  	echo json_encode($res);
 ?>
