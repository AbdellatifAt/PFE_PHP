<?php 
header('Access-Control-Allow-Origin:http://localhost:3000');
include '../connexion.php';

if(isset($_GET['cne'])){
    $cne = $_GET['cne'];
   
        $sql = "SELECT * FROM Etudiant where cne ='$cne'";
        $stm = $pdo->query($sql);
        if($stm->rowCount()>0){
            $res= $stm->fetch(PDO::FETCH_ASSOC);
            if($res){
                http_response_code(200) ; 
                echo json_encode($res) ; 
            
            }
            else{
                http_response_code(400);
                echo json_encode("feild to fetch");
            }
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