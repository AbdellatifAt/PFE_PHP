<?php 
header('Access-Control-Allow-Origin:http://localhost:3000');
include '../../connexion.php';

if(isset($_GET['cin'])){
    $cin = $_GET['cin']; 

    $sql ="SELECT count(DISTINCT cne) nb_etud,M.nom_module FROM inscription I 
    RIGHT JOIN module M on M.id_module = I.id_module WHERE cin = '$cin'
     GROUP BY M.id_module ,M.nom_module" ; 
    $stm = $pdo->query($sql) ; 
    $res = $stm->fetchAll(PDO::FETCH_ASSOC) ; 
    http_response_code(200) ; 
    echo json_encode($res);
   
}

?>