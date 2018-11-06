<?php
   header("Access-Control-Allow-Credentials: true");
   header("Access-Control-Allow-Origin:*");
   header('Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS');
   header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept,Content-Language,Accept-Language');
   


   require_once "db.php";

	  $json = file_get_contents("php://input");
	  $data = json_decode($json,true);
	  $_POST = $data;
	   
	if($_POST == null){
		$res->mensaje = "No llegaron datos al servidor";
	}else{	
		if(($_POST!=null)){
		    $valor = $_POST;			
				$sql="SELECT nombre FROM SERVICIO WHERE nombre ='$valor'";
					$res=select($sql);
		  }

        	else{ $res->mensaje = "Datos incompletos"; }

		  }
  	echo json_encode($res);
 ?>
