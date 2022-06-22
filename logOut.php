<?php
header('Access-Control-Allow-Origin:http://localhost:3000');
  
  // Détruire la session.
  if (isset($_POST['idSession'])) {
    $idSession = $_POST['idSession'];
 
    session_id($idSession);
    session_start();
 
    if (session_destroy()) {
       echo json_encode("ok");
    } else {
       http_response_code(400);
    }
 } else {
    http_response_code(400);
 }
  ?>
  