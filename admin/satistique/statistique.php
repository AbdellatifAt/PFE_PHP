<?php 
header('Access-Control-Allow-Origin:http://localhost:3000');
include '../../connexion.php';
$etud = 0 ; 
$ens = 0 ; 
$test = 0 ; 
$arr = array();
$sql1 = "SELECT count(*)  nb_etud from etudiant " ; 
$stm1 = $pdo->query($sql1); 
$etud = $stm1->fetch(PDO::FETCH_ASSOC);
 array_push($arr , $etud);

$sql2 = "SELECT count(*) nb_ens from enseignant " ; 
$stm2 = $pdo->query($sql2); 
$ens = $stm2->fetch(PDO::FETCH_ASSOC);
array_push($arr , $ens);

$sql3 = "SELECT count(*) nb_test from test " ; 
$stm3 = $pdo->query($sql3); 
$test = $stm3->fetch(PDO::FETCH_ASSOC);
array_push($arr , $test);

http_response_code(200) ; 
echo json_encode($arr);





?>