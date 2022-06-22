<?php
  
  try{
    $pdo=new PDO('mysql:host=localhost;dbname=plateforme_db2','root','root'); 
   // echo "succes connection"; 
  }catch(Exception $e){
      echo $e->getMessage();
  }
    
    
?>