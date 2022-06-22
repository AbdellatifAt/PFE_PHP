<?php 
header('Access-Control-Allow-Origin:http://localhost:3000');
include '../../connexion.php';

if(isset($_GET['id_problem']) ){
    $id_problem=  $_GET['id_problem'];

            $sql = "DELETE from problem where id_problem= $id_problem" ; 
            $res = $pdo->query($sql);
            if($res){
                http_response_code(200);
                echo json_encode($id_problem);
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