<?php
   header("Access-Control-Allow-Origin: *");
   header('Content-Type: application/json');
   require_once "db.php";
   $json = file_get_contents("php://input");
   $data = json_decode($json,true);
   $sql ="SELECT * FROM INFORMACION";  
   $resultado = select($sql);
   echo json_encode($resultado);
 ?>


