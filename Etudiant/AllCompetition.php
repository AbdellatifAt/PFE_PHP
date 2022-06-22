<?php 
header('Access-Control-Allow-Origin:http://localhost:3000');
include "../connexion.php";

if(isset($_GET['cne'])){
    $cne = $_GET['cne'];

    $sql ="SELECT DISTINCT C.id_comp , C.nom_comp ,O.date_comp , O.date_exp from organise_competition O NATURAL JOIN inscription NATURAL
     JOIN competition C WHERE cne ='$cne' and id_comp not in (select id_comp from condidateur where cne= '$cne') ";

    $stm = $pdo->query($sql);
    if($stm->rowCount()>0){
        $res = $stm->fetchAll(PDO::FETCH_ASSOC);
        $COMP =[] ; 
        foreach($res as $element){
            $sql ="SELECT M.nom_module FROM module M NATURAL JOIN organise_competition O WHERE O.id_comp =$element[id_comp]" ; 
            $stm = $pdo->query($sql) ; 
            $res2 = $stm->fetchAll(PDO::FETCH_ASSOC) ;
            $element['module'] = $res2 ;
            array_push($COMP , $element) ; 
        }
        http_response_code(200);
        echo json_encode($COMP);
    }
    else{
        http_response_code(400);
        echo json_encode("no data found");
        
    }
}
else{
    http_response_code(400);
    echo json_encode("erreur");
}
 
?>