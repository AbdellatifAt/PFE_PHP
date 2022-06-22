<?php
  header('Access-Control-Allow-Origin:http://localhost:3000');
  include '../connexion.php';
  
  
  if( isset($_GET['id_chap']) and isset($_GET['cne'])  ){
      $id_chap=  $_GET['id_chap'];
      $cne=  $_GET['cne'];
     
      $sql1="SELECT id_test from test  where id_chap=$id_chap";
      $stm1=$pdo->query($sql1);
      if($stm1->rowCount()>0){
          $res1=$stm1->fetch(PDO::FETCH_ASSOC);
          $currentDate = new DateTime();
          $date_cur = $currentDate->format('Y-m-d H:i:s');
          $sql2="update test_passer set date_validation= '$date_cur' where id_test=$res1[id_test]";
          $res2=$pdo->query($sql2);
          if( $res2){
            $sql3="SELECT count(DISTINCT R.id_quest) somme  from question Q NATURAL join reponses R where cne ='$cne' and Q.id_test = $res1[id_test] and R.score = 1";
            $stm3=$pdo->query($sql3);
            if($stm3->rowCount()>0){
                $res3=$stm3->fetch(PDO::FETCH_ASSOC);
                $sql4="SELECT id_module from chapitre  where id_chap=$id_chap";
                $stm4=$pdo->query($sql4);
                        if($stm4->rowCount()>0){
                            $res4=$stm4->fetch(PDO::FETCH_ASSOC);
                        $sql5="UPDATE inscription set score=score+$res3[somme] where id_module=$res4[id_module] and cne='$cne' ";
                        $res5=$pdo->query($sql5);
                                    if($res5){

                                                                            
                                        $sql6="SELECT count(*)  nb_quest from question where id_test = $res1[id_test]";
                                        $stm6=$pdo->query($sql6);
                                        $res6 = $stm6->fetch(PDO::FETCH_ASSOC) ; 
                                        $nb_question = $res6['nb_quest'] ; 
                                        $nb_rep_correct = $res3['somme'];

                                        $note =number_format(($nb_rep_correct * 20 ) /$nb_question, 2)  ; 
                                        $sql7 = "UPDATE test_passer set note = $note where id_test = $res1[id_test] and cne ='$cne'" ;
                                        $res7 = $pdo->query($sql7) ; 
                                        if($res7){
                                            http_response_code(200);
                                            echo json_encode($res4['id_module']) ;

                                        }else{
                                            http_response_code(400);
                                            echo json_encode("echec 7 ") ;
                                        }

                                    } else {
                                        http_response_code(400);
                                        echo json_encode("eche5") ;
                                    }
                        }else{
                            http_response_code(400);
                            echo json_encode("echec 4") ;
                        }
            }else{
                http_response_code(400);
                echo json_encode("echec 3") ;
            }
            
          }
          else{
            http_response_code(400);
            echo json_encode("echec 2") ;
          }
         

          
      }else{
          http_response_code(400);
          echo json_encode("no data found") ;
      }
  
      
  }
  else{
      http_response_code(400);
      echo json_encode("erreur");
  }
?>