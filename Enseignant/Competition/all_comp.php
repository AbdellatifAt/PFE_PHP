<?php 
header('Access-Control-Allow-Origin:http://localhost:3000');
include '../../connexion.php';

if(isset($_GET['cin']) ){
    $cin=  $_GET['cin'];

            $sql = "SELECT * from competition NATURAL JOIN organise_competition where cin ='$cin' " ; 
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