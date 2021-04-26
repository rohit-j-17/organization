<?php
include_once 'config.php';
$sql = "DELETE FROM users WHERE id='" . $_GET["id"] . "'";
if (mysqli_query($db, $sql)) {
      echo '<script>alert(" Record Deleted SuccessFully")</script>'; 
     
      echo '<script>window.location.href = "add_new_emp.php";</script>';
       
} else {
    echo "Error deleting record: " . mysqli_error($conn);
}
mysqli_close($conn);
?>