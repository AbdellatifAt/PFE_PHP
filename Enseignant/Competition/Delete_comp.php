<?php 
header('Access-Control-Allow-Origin:http://localhost:3000');
include '../../connexion.php';

if(isset($_GET['id_comp']) ){
    $id_comp=  $_GET['id_comp'];

            $sql = "DELETE from competition where id_comp= $id_comp" ; 
            $res = $pdo->query($sql);
            if($res){
                http_response_code(200);
                echo json_encode($id_comp);
            }
            else{
                http_response_code(400);
                echo json_encode(false);
            }

 }else {
    http_response_code(400);
    echo json_encode('erreur');
 }
?>