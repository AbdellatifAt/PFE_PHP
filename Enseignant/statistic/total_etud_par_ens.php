<?php 
header('Access-Control-Allow-Origin:http://localhost:3000');
include '../../connexion.php';

if(isset($_GET['cin'])){
    $cin = $_GET['cin']; 

    $sql ="SELECT count(cne) nb_etud FROM inscription I natural JOIN module M 
    WHERE cin = '$cin' " ; 
    $stm = $pdo->query($sql) ; 
    $res = $stm->fetch(PDO::FETCH_ASSOC) ; 
    http_response_code(200) ; 
    echo json_encode($res);
   
}

?>