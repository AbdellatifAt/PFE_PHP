<?php
header('Access-Control-Allow-Origin:http://localhost:3000');
include '../../connexion.php';

$sql =  "SELECT S.id_semester , E.cin, M.nom_module , M.id_module , E.nom nom_ens , E.prenom , E.email , S.nom nom_semester
 from module M left join enseignant E ON M.cin = E.cin join semester S on M.id_semester = S.id_semester "; 

$stm = $pdo->query($sql);

$res = $stm->fetchAll(PDO::FETCH_ASSOC);

if($res){
    http_response_code(200);
    echo json_encode($res);
}
else{
    http_response_code(400);
    echo json_encode("erreur ");
}


?>