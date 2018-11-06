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
		//INSERCION DE DATOS TABLA INFORMACIONES
		$correo=$_POST["correo"];
		$tipo=$_POST["tipo_info"];
		$descr=$_POST["Descripcion"];
		$precio=$_POST["Precio"];
		$codigoServicio=$_POST["cod_servicio"];
		$fechaPublicacion=$_POST["fecha_public"];
		$estado = $_POST["estado"];
			$sql="INSERT INTO INFORMACION (cod_servicio_asoc,correo,descripcion,tipo_info,fecha_publicacion,
			estado,precio) VALUES ('$codigoServicio','$correo','$descr','$tipo','$fechaPublicacion','$estado','$precio')";
		    $res=query($sql);	
		  }
  	echo json_encode($res);
 ?>					
