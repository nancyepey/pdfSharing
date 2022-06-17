<?php 

// reading a pdf file

// get file
if(!isset($_GET['file'])){
    header('location:../login.php');
 } else {
     $file = $_GET['file'];
 }
 
$file_location = '../uploads/pdfs/'.$file;

header('Content-type:application/pdf');
header('Content-Description:inline;filename"'.$file_location.'"');
header('Content-Transfer-Encoding:binary');
header('Accept-Ranges:bytes');
@readfile($file_location);
            
?>