<?php 
header('Access-Control-Allow-Origin:http://localhost:3000');
include '../../connexion.php';
$nombre_etud_semesetr=0;
$sql1 = "SELECT count(DISTINCT(i.cne)) nb_etud , s.nom FROM `semester` s left OUTER join module m on s.id_semester=m.id_semester 
left join inscription i on m.id_module=i.id_module GROUP by s.id_semester , s.nom " ; 
$stm1 = $pdo->query($sql1); 
$nombre_etud_semesetr = $stm1->fetchAll(PDO::FETCH_ASSOC);


http_response_code(200) ; 
echo json_encode($nombre_etud_semesetr);





?>