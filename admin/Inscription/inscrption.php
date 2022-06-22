<?php
header('Access-Control-Allow-Origin:http://localhost:3000');
include '../../connexion.php';

if(isset($_POST['etudiant']) && isset($_POST['module']) ){

    $etudiant = $_POST['etudiant']; 
    $module = $_POST['module'];

    $sql = "START TRANSACTION" ; 
    $pdo->query($sql); 
    
    $etatTransaction = true ; 
    
    foreach($module as $mod){
        // $currentDate = new Date();
        // $date_cur = $currentDate->format('Y-m-d H:i:s');
        $date = date('Y-m-d');
        $sql = "INSERT INTO inscription values ('$mod' ,'$etudiant' , '$date',0)" ;
        $res = $pdo->query($sql);
        if(!$res){
            $etatTransaction = false ; 
            break ; 
        }
    }
    if($etatTransaction){
        $sql = "commit" ; 
        $pdo->query($sql);
        http_response_code(200);
        echo json_encode($etatTransaction);

    }else{
        $sql = "ROLLBACK" ; 
        $pdo->query($sql);
        http_response_code(400);
        echo json_encode($etatTransaction);
    }

}

?>