<?php
   header("Access-Control-Allow-Origin: *");
   header('Content-Type: application/json');
   require_once "db.php";
   $json = file_get_contents("php://input");
   $data = json_decode($json,true);
   $_POST = $data;
    

   if($_POST != null){
    
    $sql = "SELECT st.duracion , st.rut_trabajador , t.nombre FROM SERVICIO_TRABAJADOR st, TRABAJADOR t WHERE cod_servicio = '$_POST' AND st.rut_trabajador=t.rut_trabajador";
    $resultado = select($sql);
   }
   
   echo json_encode($resultado);
 ?>


