 <?php
header('Access-Control-Allow-Origin:http://localhost:3000');
include "../connexion.php";
include '../Functions/aplouad_files.php' ;

if(isset($_POST['cne']) && isset($_POST['id_problem']) &&  isset($_FILES['file'])){
    $cne = $_POST['cne'];
    $id_problem = $_POST['id_problem'];
    $File = $_FILES['file'];
    if($files['error']==0){
        $currentDate = new DateTime();
        $date_cur = $currentDate->format('Y-m-d H:i:s');

        $file = insert_file($File , '../Files/') ;
        $sql ="UPDATE  reponse_problem SET date_validation = '$date_cur', Reponse_problem ='$file' where id_problem = $id_problem" ; 
        $res = $pdo->query($sql) ;
        if($res){
            $sql ="SELECT R.Reponse_problem , P.description , P.file ,C.id_comp , C.nom_comp , P.id_problem
            from competition C Natural join problem P LEFT JOIN reponse_problem R ON R.id_problem = P.id_problem ORDER BY date_validation DESC LIMIT 1" ;
            $stm = $pdo->query($sql); 
            if($stm->rowCount()>0){
                $res = $stm->fetch(PDO::FETCH_ASSOC) ; 
                http_response_code(200);
                echo json_encode($res);

            }else{
                http_response_code(400);
                echo json_encode("error");

            }
        }else{
            http_response_code(400);
            echo json_encode("echec");
        } 


    }else{
        http_response_code(400);
        echo json_encode("problem in file importer");
    }

        
}else{
    http_response_code(400);
    echo json_encode("no data found ");
}

 
?>