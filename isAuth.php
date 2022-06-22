<?php
header("Access-Control-Allow-Origin: *");
header("content-type: application/json");


include './connexion.php';


if (isset($_POST['idSession'])) {
   $idSession = $_POST['idSession'];

   session_id($idSession);
   session_start();

   if ($_SESSION['id_user']) {

      $idUtilisateur = $_SESSION['id_user'];
      $type = $_SESSION['type'];

      if ($type === 'etudiant') {


         try {
            $sql ="SELECT * from etudiant where cne= '$idUtilisateur'" ; 
            $stm = $pdo->query($sql) ;
            $user = $stm->fetch(PDO::FETCH_ASSOC);

            if ($user) {
               echo json_encode(array(
                  "userInfos" => array(
                        'id'=> $idUtilisateur
                  ),
                  "type" => "etudiant"
               ));
            } else {
               throw new Exception();
            }
         } catch (Exception $e) {
            http_response_code(400);
            echo json_encode('false');
         }
      } else if ($type === "admin") {
               echo json_encode(array(
                  "userInfos" => array(
                        'id'=> $idUtilisateur
                  ),
                  "type" => "admin"
               ));
       
      } else if ($type ==="enseignant") {
         try {
            $sql ="SELECT * from enseignant where cin= '$idUtilisateur'" ; 
            $stm = $pdo->query($sql) ;
            $user = $stm->fetch(PDO::FETCH_ASSOC);

            if ($user) {
               echo json_encode(array(
                  "userInfos" => array(
                        'id'=> $idUtilisateur
                  ),
                  "type" => "enseignant"
               ));
            } else {
               throw new Exception();
            }
         } catch (Exception $e) {
            http_response_code(400);
            echo json_encode('false');
         }
      }
   } else {
      http_response_code(400);
      echo json_encode('false');
   }
} else {

   http_response_code(400);
}