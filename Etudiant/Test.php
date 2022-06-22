<?php 
header('Access-Control-Allow-Origin:http://localhost:3000');
include '../connexion.php';

if( isset($_GET['id_chap']) && isset($_GET['cne']) ){
    $id_chap=  $_GET['id_chap'];
    $cne = $_GET['cne'];

    $currentDate = new DateTime();
    $date_cur = $currentDate->format('Y-m-d H:i:s');

    
            $sql = "SELECT id_test from test where id_chap =$id_chap AND date_debut is not null and now() < date_exp " ; 
            $stm = $pdo->query($sql);
            if($stm->rowCount()>0){
                $res = $stm->fetch(PDO::FETCH_ASSOC);
                $id_test = $res['id_test'];
        
                $sql = "SELECT * from question WHERE id_test= $id_test and id_quest not in(select id_quest from reponses WHERE cne ='$cne')" ; 
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
            else{
                echo json_encode(false);
            }

 }
      