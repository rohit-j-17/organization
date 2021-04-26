<?php

ini_set('error_reporting', E_ALL);
ini_set('display_errors', true);

require_once __DIR__.'/../src/SimpleXLSX.php';

echo '<h1>rows() and rowsEx()</h1>';
if ( $xlsx = SimpleXLSX::parse('hospital.xlsx')) {

		

		$dim = $xlsx->dimension();
		$cols = $dim[0];
$f = 0;
		foreach ( $xlsx->rows() as $k => $r ) {
			//		if ($k == 0) continue; // skip first row
			//echo '<tr>';
			if ($f == 0) {
                 $f++;
                 continue;
             }
			for ( $i = 0; $i < $cols; $i ++ ) {

				if($i == 3)
				{
					echo $r[ $i ]; 
				}
				else if($i == 7)
				{
					echo "\t".$r[ $i ];
				}
				else if($i == 9)
				{
					echo "\t".$r[ $i ];
				}
				else if($i == 11)
				{
					 echo "\t".$r[ $i ];
				}
				
			}
			echo "<br>";
		}
		//echo '</table>';
 

} else {
	echo SimpleXLSX::parseError();
}