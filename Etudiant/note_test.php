<?php 
header('Access-Control-Allow-Origin:http://localhost:3000');
include '../connexion.php';


if( isset($_POST['cne']) && isset($_POST['id_test'])){
    $cne=  $_POST['cne'];
    $id_test=  $_POST['id_test'];
   
   
    $sql1="SELECT count(*) as nb_quest from question where id_test = $id_test";
    $stm1=$pdo->query($sql1);

    if($stm1->rowCount()>0){
        $nb_question = $stm1->fetch(PDO::FETCH_ASSOC) ; 
        $sql2="SELECT count(DISTINCT R.id_quest) nb_rep_corr from question Q NATURAL join reponses R where cne = 'D148595' and Q.id_test = 3 and R.score = 1 ";
        $stm2=$pdo->query($sql2);
        if($stm2->rowCount()>0){
            $nb_reponse_corr = $stm2->fetch(PDO::FETCH_ASSOC) ; 

            $total = ($nb_reponse_corr * 20 ) /$nb_question ; 
            http_response_code(200);
            echo json_encode($total); 
        }

    }else{
        http_response_code(400);
        echo json_encode("no data found") ;
    }


   

    
}
else{
    http_response_code(400);
    echo json_encode(400);
}