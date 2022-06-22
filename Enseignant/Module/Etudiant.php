<?php 
header('Access-Control-Allow-Origin:http://localhost:3000');
include "../../connexion.php";

if( $_GET['id_module']){
    $id_module =  $_GET['id_module'];

    $sql = "SELECT E.* , I.score FROM inscription I Natural join etudiant E where id_module = '$id_module'";
    $stm = $pdo->query($sql);
    $res = $stm->fetchAll(PDO::FETCH_ASSOC);
    if($res){
        http_response_code(200);
        echo json_encode($res);

    }
    else{
        http_response_code(400);
        echo json_encode("no data found");
    }
}
else{
    http_response_code(400);
    echo json_encode("erreur");
}

?>