<?php 
	
		$serverName = "reports";
		$connectionInfo = array("Database"=>"901", "UID"=>"sa", "PWD"=>"alkatras/*1324");
		$conn = sqlsrv_connect($serverName,$connectionInfo);
	
		if($conn){
			//echo 'ok';
		}else{
			echo print_r(sqlsrv_errors());
		}

?>	