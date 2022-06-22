<?php 
header('Access-Control-Allow-Origin:http://localhost:3000');
include "../connexion.php";

if(isset($_GET['cne'])){
    $cne = $_GET['cne'] ; 

    $sql ="SELECT DISTINCT S.id_semester , S.nom from inscription I, Module M , semester S
     where I.id_module= M.id_module AND M.id_semester = S.id_semester And I.cne = '$cne'"  ;
    
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