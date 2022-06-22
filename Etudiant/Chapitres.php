<?php 
header('Access-Control-Allow-Origin:http://localhost:3000');
include "../connexion.php";

if(isset($_GET['id_module'])){
    $id_module = $_GET['id_module'];

    $sql ="SELECT * from chapitre where id_module = '$id_module'";

    $stm = $pdo->query($sql);
    if($stm->rowCount()>0){
        $res = $stm->fetchAll(PDO::FETCH_ASSOC);
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