<?php 
header('Access-Control-Allow-Origin:http://localhost:3000');
include '../../connexion.php';

if(isset($_GET['cin'])){
    $cin = $_GET['cin']; 
    $arr=array();
     $sql="SELECT count(*) as etud_non_v from module natural join inscription natural join chapitre 
     natural join test natural join test_passer where module.cin='$cin' and note<10";
    $stm = $pdo->query($sql) ; 
    $non_valide_general = $stm->fetch(PDO::FETCH_ASSOC) ; 
    $arr['non_valide']=$non_valide_general['etud_non_v'];
    // array_push($arr,$non_valide_general);
    //
    $sql1="SELECT count(*) as etud_valide from module natural join inscription natural join chapitre 
    natural join test natural join test_passer where module.cin='$cin' and note>=10";
   $stm1 = $pdo->query($sql1) ; 
   $valide_general = $stm1->fetch(PDO::FETCH_ASSOC) ; 
   
//    array_push($arr,$valide_general);
   $arr['valide']=$valide_general['etud_valide'];
   $arr['total']=$valide_general['etud_valide']+$non_valide_general['etud_non_v'];
   //array_push($arr,$arr1);

   // 
   http_response_code(200) ; 
    echo json_encode($arr);
   
}else{
    http_response_code(400) ; 
    echo json_encode(null);
}

?>