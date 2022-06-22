<?php 
header('Access-Control-Allow-Origin:http://localhost:3000');
include "../connexion.php";

if(isset($_GET['id_semester']) && isset($_GET['cne'])){
    $id_semester = $_GET['id_semester'];
    $cne = $_GET['cne'] ;

    $sql ="SELECT M.* from MOdule M Natural join inscription I where M.id_semester = '$id_semester' and I.cne = '$cne'  ";

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