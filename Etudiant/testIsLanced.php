<?php 
header('Access-Control-Allow-Origin:http://localhost:3000');
include '../connexion.php';

if( $_GET['id_chap']){
    $id_chap=  $_GET['id_chap'];
    
    $sql = "SELECT date_debut from test WHERE id_chap= $id_chap and date_debut is NOT NULL " ; 
        $stm = $pdo->query($sql);
        if($stm->rowCount()>0){
            
           
                http_response_code(200);
                echo json_encode(true);
        } 
        else{
                http_response_code(200);
                echo json_encode(false);

        }
        
}else{
    http_response_code(400);
    echo json_encode("error");
}