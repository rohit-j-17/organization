<?php
ob_start();
session_start(); 


require_once  'library/simplexlsx/src/SimpleXLSX.php';
include "config.php" ;

$xlxsfile = 'xlxsfile';

if($_FILES[$xlxsfile]['size']> 0)
{

	if ( $xlsx = SimpleXLSX::parse($_FILES[$xlxsfile]['tmp_name'] )) {

		$dim = $xlsx->dimension();
		$cols = $dim[0];


		foreach ( $xlsx->rows() as $k => $r ) {
			if ( $k === 0 ) {
			$header_values = $r;
			continue;
		}
			$id = mysqli_real_escape_string($db,$r[0]);
			$firstname = mysqli_real_escape_string($db,$r[1]);
            $lastname = mysqli_real_escape_string($db,$r[2]);
        	$name = mysqli_real_escape_string($db,$r[3]);
        	$parent = mysqli_real_escape_string($db,$r[4]);

        	$user_type = mysqli_real_escape_string($db,$r[5]);
        	$company_name = mysqli_real_escape_string($db,$r[6]);
        	$address = mysqli_real_escape_string($db,$r[7]);
        	$joining_date = mysqli_real_escape_string($db,$r[8]);
        	$dob = mysqli_real_escape_string($db,$r[9]);
        	$qualification = mysqli_real_escape_string($db,$r[10]);
        	$mobile = mysqli_real_escape_string($db,$r[11]);
        	$year_of_experience = mysqli_real_escape_string($db,$r[12]);
        	$department = mysqli_real_escape_string($db,$r[13]);

        
        	$current_ctc = mysqli_real_escape_string($db,$r[14]);
        	$previous_ctc = mysqli_real_escape_string($db,$r[15]);
        	$previous_department = mysqli_real_escape_string($db,$r[16]);
        	$previous_location = mysqli_real_escape_string($db,$r[17]);
        	$date_of_last_increament = mysqli_real_escape_string($db,$r[18]);





            
$qry = "INSERT INTO `org_data` (`id`,`firstname`,`lastname`,`name`,`parent`,`user_type`,`company_name`,`address`,`joining_date`,`dob`,`qualification`,`mobile`,`year_of_experience`,`department`,`current_ctc`,`previous_ctc`,`previous_department`,`previous_location`,`date_of_last_increament`) 
VALUES 
('$id','$firstname','$lastname','$name','$parent','$user_type','$company_name','$address','$joining_date','$dob',
	'$qualification','$mobile','$year_of_experience','$department','$current_ctc','$previous_ctc',
	'$previous_department','$previous_location','$date_of_last_increament')";
				$result2= mysqli_query($db,$qry);
				
			
		}
		echo "<script>alert('Emp Uploaded Successfully');window.location ='upload.php'</script>";
		exit;
 

	} else {
		echo "<script>alert('Something went wrong try again.');window.location ='upload.php'</script>";
		exit;
	}
}	
?>
