<?php 
header('Access-Control-Allow-Origin:http://localhost:3000');
include '../../connexion.php';

if(isset($_GET['cin'])){
    $cin = $_GET['cin']; 
    $arr=array();
    $sql ="SELECT count(distinct cne) nb_etud_total FROM inscription I natural JOIN module M 
    WHERE cin = '$cin' " ; 
    $stm = $pdo->query($sql) ; 
    $res = $stm->fetch(PDO::FETCH_ASSOC) ; 
    $arr['nb_total_etud']=$res['nb_etud_total'];

    $sql2 ="SELECT count(*) nb_total_test from chapitre natural join test natural join module where cin='$cin'" ; 
    $stm2 = $pdo->query($sql2) ; 
    $res2 = $stm2->fetch(PDO::FETCH_ASSOC) ; 
    $arr['nb_total_test']=$res2['nb_total_test'];
    

    $sql4 ="select count(*) nb_module from module where cin = '$cin'" ; 
    $stm4 = $pdo->query($sql4) ; 
    $res4 = $stm4->fetch(PDO::FETCH_ASSOC) ; 
    $arr['nb_module_ens']=$res4['nb_module'];


    // $currentDate = new DateTime();
    // $date_cur = $currentDate->format('Y-m-d H:i:s');
    $sql3 ="SELECT test.date_exp, chapitre.nom_chap from chapitre natural join test natural join module 
    where cin='$cin' and date_exp is not null and date_exp > now() order by test.date_exp limit 1" ; 
    $stm3 = $pdo->query($sql3) ;
    if($stm->rowCount()>0) {
        $res3 = $stm3->fetch(PDO::FETCH_ASSOC) ; 
        $arr['test']=$res3;

    }else 
    $arr['test']=null;

    http_response_code(200) ; 
    echo json_encode($arr);
   
}

?>