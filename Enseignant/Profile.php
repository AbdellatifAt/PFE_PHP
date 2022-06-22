<?php 
header('Access-Control-Allow-Origin:http://localhost:3000');
include '../connexion.php';

if(isset($_GET['cin'])){
    $cin = $_GET['cin'];
   
        $sql = "SELECT * FROM enseignant where cin ='$cin'";
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