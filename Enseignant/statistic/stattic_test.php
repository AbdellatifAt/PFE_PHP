<?php 
header('Access-Control-Allow-Origin:http://localhost:3000');
include '../../connexion.php';

if(isset($_GET['cin']) && isset($_GET['id_chap']) && isset($_GET['id_test'])){
    $cin = $_GET['cin']; 
    $id_chap=$_GET['id_chap'];
    $id_test=$_GET['id_test'];

    $arr=array();

    $sql ="SELECT count(DISTINCT cne) nb_total, c.nom_chap from module natural join inscription
     natural join chapitre c WHERE cin= '$cin' and id_chap=$id_chap group by c.nom_chap" ; 
    $stm = $pdo->query($sql) ; 
    $nombre_total_etudiant = $stm->fetch(PDO::FETCH_ASSOC) ; 
    array_push($arr,$nombre_total_etudiant);

    $sql1="SELECT count(DISTINCT cne) nb_etud_valide from test_passer where id_test=$id_test and note>=10";
    $stm1 = $pdo->query($sql1) ; 
    $nombre_valide = $stm1->fetch(PDO::FETCH_ASSOC);
    array_push($arr,$nombre_valide);

    $sql2="SELECT count(DISTINCT cne) nb_etud_non_valide from test_passer where id_test=$id_test and note<10";
    $stm2 = $pdo->query($sql2) ; 
    $nombre_non_valide = $stm2->fetch(PDO::FETCH_ASSOC);
    array_push($arr,$nombre_non_valide);

    http_response_code(200) ; 
    echo json_encode($arr);  
}else{
    http_response_code(400) ; 
    echo json_encode("erreur");  
    }
  

?>