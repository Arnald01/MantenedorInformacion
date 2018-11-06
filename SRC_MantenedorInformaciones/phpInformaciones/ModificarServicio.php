 <?php
   header("Access-Control-Allow-Origin: *");
   require_once "db.php";
   
	  $json = file_get_contents("php://input");
	  $data = json_decode($json,true);
	  $_POST = $data;
	   
	if($_POST == null){
		$res->mensaje = "No llegaron datos al servidor";
	}else{	//else 01
		$nombre = $_POST["Nombre"];
		$tipo = $_POST["TipoServicio"];
		$desc = $_POST["Descripcion"];
		$precio = $_POST["Precio"];
		$origin = $_POST["original"];
		//$sql = "UPDATE SERVICIO SET nombre='$nombre' , tipo_servicio='$tipo' , descripcion='$desc' , precio='$precio' WHERE nombre='$origin'";
		//$res = query($sql);

			//UPDATE DE LA CUENTA PARA VERIFICAR SI HAY ERROR DE DUPLICIDAD DE CORREO
		 	if($origin != $nombre){	 		
				$link = conectar();
				$sql = "SELECT precio FROM SERVICIO WHERE nombre = '$nombre'";
				$total = mysqli_num_rows(mysqli_query($link,$sql));
					if($total == 0){
						$res->mensaje="Exito";
						$sql = "UPDATE SERVICIO SET nombre='$nombre' , tipo_servicio='$tipo' , descripcion='$desc' , precio='$precio' WHERE nombre='$nombre'";
						$respuesta=query($sql);
					}else{//SINO ES ASI , QUIERE DECIR QUE EXISTE EL NOMBRE
						$res ->mensaje = "Existe";//MENSAJE DE ERROR, YA EXISTE ESTE NOMBRE
						}
					
			}else{	//SI EL NOMBRE ORIGINAL ES IGUAL AL NUEVO INGRESADO (ESTO RETORNA 0 IGUALMENTE PERO ES VALIDO EL UPDATE)
						$res ->mensaje = "Exito";
						$sql = "UPDATE SERVICIO SET nombre='$nombre' , tipo_servicio='$tipo' , descripcion='$desc' , precio='$precio' WHERE nombre='$nombre'";
						$respuesta=query($sql);
				}

		  }//fin else 01
  	echo json_encode($res);
 ?>

