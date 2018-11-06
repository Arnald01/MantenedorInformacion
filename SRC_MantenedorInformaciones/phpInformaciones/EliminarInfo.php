<?php
   header("Access-Control-Allow-Origin: *");
   header('Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS');
   header('Access-Control-Allow-Headers: Origin, Content-Type');
   require_once "db.php";
    $json = file_get_contents("php://input");
    $data = json_decode($json,true);
    $_POST = $data;
        if($_POST == NULL){
            $res -> mensaje = "No llegaron datos";
        }else{
               if($_POST!= NULL){
                  $codigo = $_POST;	
                  $sql = "UPDATE INFORMACION SET estado='I' WHERE cod_info '$codigo' ";
                  $resultado = query($sql);   
                 }
              }

        echo json_encode($resultado);
?>
