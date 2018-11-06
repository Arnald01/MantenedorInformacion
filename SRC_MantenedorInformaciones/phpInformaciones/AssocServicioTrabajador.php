<?php
   header("Access-Control-Allow-Origin: *");
   header('Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS');
   header('Access-Control-Allow-Headers: Origin, Content-Type');
   require_once "db.php";

	  $json = file_get_contents("php://input");
	  $data = json_decode($json,true);
	  $_POST = $data;
	   
	if($_POST == null){
		$res->mensaje = "No llegaron datos al servidor";
	}else{	
		//INSERCION DE DATOS TABLA SERVICIO	
		$nombre=$_POST["Nombre"];
		$tipo=$_POST["TipoServicio"];
		$descr=$_POST["Descripcion"];
		$precio=$_POST["Precio"];
			$link = conectar();
			$sql="INSERT INTO SERVICIO (tipo_servicio,nombre,descripcion,precio) VALUES ('$tipo','$nombre','$descr','$precio')";
		    mysqli_query($link, $sql);	
			$codservicio=mysqli_insert_id($link);
			$res1 -> mensaje = "exitoso!";
		//SI REGISTRO A ALGUN TRABAJADOR ENTONCES INSERTARLO EN TABLA SERVICIO-TRABAJADOR
		if($_POST["rut_trabajador"]!=null){
			$Duracion =$_POST["Tiempo"];
			$i=count($_POST["rut_trabajador"],0);
				for($j=0;$j<$i;$j++){
					$rut=$_POST["rut_trabajador"][$j];
					$sql1="INSERT INTO SERVICIO_TRABAJADOR (cod_servicio , rut_trabajador , duracion) VALUES 
					('$codservicio','$rut','$Duracion')";
					$res1=query($sql1);
				}//FIN DEL CICLO FOR
      		       }
	
		  }
  	echo json_encode($res1);
 ?>					
