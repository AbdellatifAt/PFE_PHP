<?php 
header('Access-Control-Allow-Origin:http://localhost:3000');
include '../connexion.php';


if( isset($_POST['cne']) && isset($_POST['testChoix']) && isset($_POST['id_quest'])){
    $cne=  $_POST['cne'];
    $id_quest=  $_POST['id_quest'];
    $testChoix=  $_POST['testChoix'];
    $score=0;
    $sql1="SELECT id_choix ,id_test from question NATURAL JOIN choix where id_quest=$id_quest and choix_correct=1";
    $stm1=$pdo->query($sql1);

    if($stm1->rowCount()>0){
        $res1=$stm1->fetchAll(PDO::FETCH_ASSOC);
        $count=0;

        foreach($res1 as $val){
            if(in_array($val['id_choix'],$testChoix)){
                $count++;
            }
        }
        
        if($count==count($res1) && count($res1)==count($testChoix)) {
              $score= 1;
        }
        foreach($testChoix as $element){
            $sql = "INSERT INTO reponses VALUES($id_quest , '$cne' , $element,$score)";
            $res = $pdo->query($sql); 
    
        }
        http_response_code(200);
        echo json_encode($id_quest) ; 
    
        
    }else{
        http_response_code(400);
        echo json_encode("no data found") ;
    }


   

    
}
else{
    http_response_code(400);
    echo json_encode(400);
}