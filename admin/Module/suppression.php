<?php

header('Access-Control-Allow-Origin:http://localhost:3000');
include '../../connexion.php';

if(isset($_GET['id_module'])){

    $id_module = htmlspecialchars($_GET['id_module']);

    $sql = "DELETE from module where id_module= $id_module";
    $res= $pdo->query($sql);

    if($res){
        
        http_response_code(200);
        echo json_encode($id_module);
    }
    else{
        http_response_code(400);
        echo json_encode('impossible de supprimer module');
    }
}

?>