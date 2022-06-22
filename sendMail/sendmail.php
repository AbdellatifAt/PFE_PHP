<?php

$to= "abdellatifat160599@gmail.com" ; 
$subject = "utilisation de mail avec php depuis Windows" ; 
$message = "Salut , comment ca va ? " ; 
$headers = "Content-Type: text/plain; charset=utf-8\r\n" ;
$headers .= "From : abdellatif16051999@gmail.com\r\n";

if(mail($to , $subject , $message , $headers)){
    echo "Envoye" ; 
}
else{
    echo "Erreur envoi" ;
}
?>