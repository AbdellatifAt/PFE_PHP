<?php 
header('Access-Control-Allow-Origin:http://localhost:3000');
include '../../connexion.php';

 

if( isset($_GET['cin'] )){
    $cin = htmlspecialchars($_GET['cin']); 


    $sql = "SELECT DISTINCT S.id_semester,S.nom FROM semester S NATURAL JOIN module M WHERE M.cin = '$cin'  "; 
    $stm = $pdo->query($sql);
    if($stm->rowCount()>0){
    $res= $stm->fetchAll(PDO::FETCH_ASSOC);
    $semester= array();
    foreach($res as $key => $value){
        $sql1 = "SELECT  id_module,nom_module FROM module Where id_semester=$value[id_semester]"; 
        $stm1 = $pdo->query($sql1);
      
            $res1= $stm1->fetchAll(PDO::FETCH_ASSOC);
            $value['module'] = $res1 ;
            array_push($semester , $value);
        
        } 
         http_response_code(200);
        echo json_encode($semester);
   
       

    }
    else{
        http_response_code(400);
        echo json_encode('no data found');
    }

} 
else{
    http_response_code(400);
    echo json_encode('error');
}


?>
