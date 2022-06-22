<?php 
header('Access-Control-Allow-Origin:http://localhost:3000');
include '../../connexion.php';


if( $_GET['id_test']){
    $id_test=  $_GET['id_test'];

    $sql = "SELECT * from question WHERE id_test= $id_test" ; 
    $stm = $pdo->query($sql);
    if($stm->rowCount()>0){
        $res =$stm->fetchAll(PDO::FETCH_ASSOC);
        $QUES = [] ; 
        foreach($res as $r ){
            $sql1 = "select * from choix where id_quest = $r[id_quest] ";
            $stm1 = $pdo->query($sql1);
            $res1 = $stm1->fetchAll(PDO::FETCH_ASSOC);
            $r['choix'] = $res1 ;
            array_push($QUES , $r);
        }
        http_response_code(200);
        echo json_encode($QUES);
    }else{
        http_response_code(400);
        echo json_encode('no data found');
    }
}


// if( $_GET['id_test']){
//     $id_test=  $_GET['id_test'];

//     $sql = "SELECT C.id_quest , C.choix , C.id_choix , Q.quest , C.choix_correct , Q.id_test from Choix C Natural join question Q WHERE id_test= $id_test" ; 
//     $stm = $pdo->query($sql);
//     if($stm->rowCount()>0){
//         $res =$stm->fetchAll(PDO::FETCH_ASSOC);
//         http_response_code(200);
//         echo json_encode($res);
//     }else{
//         http_response_code(400);
//         echo json_encode('no data found');
//     }
// }

?>