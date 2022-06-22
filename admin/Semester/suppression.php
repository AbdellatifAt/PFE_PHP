<?php
header('Access-Control-Allow-Origin:http://localhost:3000');
include '../../connexion.php';

if(isset($_GET['id_semester'])){

    $id_semester = htmlspecialchars($_GET['id_semester']);

    $sql = "DELETE from semester where id_semester= $id_semester";
    $res= $pdo->query($sql);

    if($res){
        
        http_response_code(200);
        echo json_encode($res);
    }
    else{
        http_response_code(400);
        echo json_encode('impossible de supprimer semester');
    }

}

?>