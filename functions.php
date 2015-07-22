<?php
	function test(){

	include 'db.php';

	$query  = "SELECT TOP 500 it.ItemCode AS ItemCode, it.Description_1 AS Description FROM Items it
			 LEFT JOIN voorrd vrd ON vrd.artcode = it.ItemCode AND vrd.artcode IS NOT NULL AND it.ItemCode IS NOT NULL AND vrd.magcode = '002'
			 WHERE (vrd.artcode IS NOT NULL AND NOT it.Type IN ('P','L','M', 'R') AND it.Condition = 'A') 
			 ORDER BY it.ItemCode";
	$run    = sqlsrv_query($conn,$query);

	while ($row = sqlsrv_fetch_array($run)){
			$ItemCode 	 = $row[0];
			$Description = $row[1];
			echo '<tr><td>'.$ItemCode.'</td><td>'.$Description.'</td></tr>';
		}
	}

	function Hello(){
		echo 'Hello wolrd!';
	}
?>
