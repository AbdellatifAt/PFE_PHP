<?php 
header('Access-Control-Allow-Origin:http://localhost:3000');
include '../../connexion.php';

if( $_GET['id_quest']){
    $id_quest=  $_GET['id_quest'];

    $sql = "DELETE FROM question WHERE id_quest = $id_quest";
    $res= $pdo->query($sql);
    if($res){
        http_response_code(200);
        echo json_encode($id_quest);

    }
    else{
        http_response_code(400);
        echo json_encode('erreur');
    }

}

?>