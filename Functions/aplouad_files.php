<?php 
function insert_file(array $files , string $fichier_applode):string {

    $size=$files['size'];
    $tmp_name=$files['tmp_name'];
    $ereur=$files['error'];
    $type=$files['type'];
    $name=$files['name'];
    
    $tab=explode('.',$name);
    $extension=end($tab);
    $tab1=["pdf"];
    if(in_array($extension,$tab1)){
        if($size<500000){
            $upload= $fichier_applode;
            $new_name=uniqid();
            $new_name.= ".".$extension;
            $upload.=$new_name;
            move_uploaded_file($tmp_name,$upload);
            return "/Files/$new_name";
        }
        else{
           
            return null;
        }
    }else{
        
        return null;
    }
}
?>