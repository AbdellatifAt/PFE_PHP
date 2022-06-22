<?php
header('Access-Control-Allow-Origin:http://localhost:3000');
include '../connexion.php';

		if(isset($_FILES['excel']) && isset($_POST['id_test'])){
			$fileName = $_FILES["excel"]["name"];
			$fileExtension = explode('.', $fileName);
            $fileExtension = strtolower(end($fileExtension));
			$newFileName = date("Y.m.d") . " - " . date("h.i.sa") . "." . $fileExtension;
            $id_test = $_POST['id_test'] ; 

			$targetDirectory = "uploads/" . $newFileName;
			move_uploaded_file($_FILES['excel']['tmp_name'], $targetDirectory);

			error_reporting(0);
			ini_set('display_errors', 0);

			require './exelReader/excel_reader2.php';
			require './exelReader/SpreadsheetReader.php';

			$reader = new SpreadsheetReader($targetDirectory);

			$sql =  "START TRANSACTION";
			$res = $pdo->query($sql);
            $All_question = [] ;
			foreach($reader as $key => $row){

				$question =$row[0];
				$choix = $row[1];

                $choix_corr = explode('_',$row[2]); 

                $tab_choix = explode("|",$choix) ;

                $sql =  "INSERT into question values (null, '$question' , $id_test) ";
			    $res = $pdo->query($sql);
                //

                if($res){
                    $sql2 =  "SELECT * FROM question ORDER BY id_quest DESC limit 1";
                    $stm2 = $pdo->query($sql2);
                    $res2= $stm2->fetch(PDO::FETCH_ASSOC) ; 
                    foreach($tab_choix as $k => $ch){
                        $is_correct = 0 ; 
                         if(in_array($k+1 ,$choix_corr) ){
                            $is_correct =1 ; 
                         }
                        $sql3 =  "INSERT into choix values (null, '$ch', $is_correct ,$res2[id_quest]) ";
                        $res3 = $pdo->query($sql3);
                    }
                    $sql4 = "select * from choix where id_quest = $res2[id_quest] ";
                    $stm4 = $pdo->query($sql4);
                    $res4 = $stm4->fetchAll(PDO::FETCH_ASSOC);
                    $res2['choix'] = $res4 ;
                        
                    array_push($All_question ,$res2);
                        

                }else{
                    $sql5 =  "ROLLBACK";
                     $res5 = $pdo->query($sql5);
                    http_response_code(400) ; 
                    echo json_encode("echec 2") ; 
                }
			}
            
             $sql5 =  "Commit";
             $res5 = $pdo->query($sql5);
            http_response_code(200) ; 
            echo json_encode($All_question) ;
                //echo json_encode($tab_choix) ;
                
			
		}
		else{
            $sql5 =  "ROLLBACK";
            $res5 = $pdo->query($sql5);
            http_response_code(400);
			echo json_encode("error");
		}
?>