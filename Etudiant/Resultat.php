<?php 
header('Access-Control-Allow-Origin:http://localhost:3000');
include "../connexion.php";

if( $_GET['id_chap'] && $_GET['cne']){
    $id_chap =  $_GET['id_chap'];
    $cne =  $_GET['cne'];


    $sql = "SELECT id_test from test where id_chap=$id_chap  ";
    $stm = $pdo->query($sql);
    if($stm->rowCount()>0){
        $res = $stm->fetch(PDO::FETCH_ASSOC);
        $sql2 = "SELECT * from question WHERE id_test= $res[id_test]" ; 

        $stm2 = $pdo->query($sql2);
        if($stm2->rowCount()>0){
            $res2 =$stm2->fetchAll(PDO::FETCH_ASSOC);
            $QUES = [] ; 
            foreach($res2 as $r ){
                $sql4 = "select C.id_choix from choix C left JOIN reponses R ON C.id_choix = R.id_choix where C.id_quest= $r[id_quest] 
                and cne ='$cne'";
                $stm4 = $pdo->query($sql4);
                $res4 = $stm4->fetchAll(PDO::FETCH_ASSOC);
                $r['rep_etud'] = $res4 ;

                $sql3 = "select * from choix where id_quest = $r[id_quest]";
                $stm3 = $pdo->query($sql3);
                $res3 = $stm3->fetchAll(PDO::FETCH_ASSOC);
                $r['choix'] = $res3 ;
               // array_push($QUES , $r);

                // $sql4 = "SELECT * from question Q NaTURAL JOIN reponses NATURAL JOIN choix where Q.id_quest =$r[id_quest]" ; 
                // $stm4 = $pdo->query($sql4);
                // $res4 = $stm4->fetchAll(PDO::FETCH_ASSOC);
                // $r['rep_etud'] = $res4 ;
                array_push($QUES , $r);
               

            }

            http_response_code(200);
            echo json_encode($QUES);
        }else{
            http_response_code(400);
            echo json_encode('no data found');
        }

    }
    else{
        http_response_code(400);
        echo json_encode(false);
    }
}
else{
    http_response_code(400);
    echo json_encode("erreur");
}

?>