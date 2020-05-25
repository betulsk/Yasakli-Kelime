<?php
$TxtForbiddenWord = $_POST['TxtForbiddenWord'];
$TxtParagraph = $_POST['TxtParagraph'];
$ForbiddenList = $_POST['ForbiddenList'];
    $star="";
   foreach($ForbiddenList as $forbiddenWord){  
      if (strpos( $TxtParagraph, $forbiddenWord) !== false) {
     
         for ($i = 1; $i <= strlen($forbiddenWord); $i++) {
          $star .="*";
        } 
         $TxtParagraph = str_replace($forbiddenWord,$star,$TxtParagraph);         
         echo "$TxtParagraph  ";
     }
      
   }

  
?>
