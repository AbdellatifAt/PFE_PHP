<?php 
header('Access-Control-Allow-Origin:http://localhost:3000');
include '../../connexion.php';

if(isset($_GET['id_comp']) ){
    $id_comp=  $_GET['id_comp'];

            $sql = "SELECT * from problem  where id_comp = $id_comp " ; 
            $stm = $pdo->query($sql);
            if($stm->rowCount()>0){
                $res = $stm->fetchAll(PDO::FETCH_ASSOC);
                http_response_code(200);
                echo json_encode($res);
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