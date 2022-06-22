<?php 
header('Access-Control-Allow-Origin:http://localhost:3000');
include '../../connexion.php';



if( $_GET['id_chap']){
    $id_chap =  $_GET['id_chap'];

    $sql = "SELECT * from test WHERE id_chap = $id_chap" ; 
    $stm = $pdo->query($sql);
    if($stm->rowCount()>0){
        $res =$stm->fetch(PDO::FETCH_ASSOC);
        http_response_code(200);
        echo json_encode($res['id_test']);
    }else{
        $sql = "INSERT INTO test(id_chap) values($id_chap)" ; 
        $res = $pdo->query($sql);
        if($res){
            $sql2 = "SELECT * from test WHERE id_chap = $id_chap " ; 
            $stm2 = $pdo->query($sql2);
            $res2 = $stm2->fetch(PDO::FETCH_ASSOC);
            http_response_code(200);
            echo json_encode($res2['id_test']);

        }
        else{
            http_response_code(400);
            echo json_encode('error de creation test');
        }
    }

}else{
    http_response_code(400);
    echo json_encode('no id chap ');
}

?>