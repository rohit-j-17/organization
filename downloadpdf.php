<?php 
  
 header("Content-Type: application/pdf");
  
$file = $_GET["file"]  . ".pdf"; 
  
header("Content-Disposition: attachment; filename=" . urlencode($file));    
header("Content-Type: application/download"); 
header("Content-Description: File Transfer");             
header("Content-Length: " . filesize($file)); 
header('Accept-Ranges: bytes');
  
flush(); // This doesn't really matter. 
  
$fp = fopen($file, "r"); 
while (!feof($fp)) { 
 echo fread($fp, filesize($file)); 
    flush(); // This is essential for large downloads 
}  
  
fclose($fp);  
?>