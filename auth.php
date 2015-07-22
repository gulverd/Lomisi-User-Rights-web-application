<html>
<head>
<title>Welcome</title>

<script src="jquery-1.9.1.min.js" type="text/javascript"></script>
<script src="jquery.easing.min.js" type="text/javascript"></script>
<link href="css/bootstrap.min.css" rel="stylesheet">
<meta charset="utf-8">
<link rel="stylesheet" type="text/css" href="style.css" />
<?php 
		include 'db.php';
		ob_start();
		$url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"; 
    	$gela  = parse_url($url, PHP_URL_QUERY);
		$person = substr($gela,0,8);

?>
</head>
<body>

<div class="col-md-12">
	<div class="col-md-12">
		<div class="bs-callout bs-callout-info" id="callout-helper-bg-specificity">
			<h4 id="dealing-with-specificity"><b>მომხმარებლის უფლებების გვერდი</b><a class="anchorjs-link" href="#dealing-with-specificity"><span class="anchorjs-icon"></sp></a></h4>
				<p>
				   გთხოვთ აირჩიოთ სასურველი მოდული. 
				</p>
		</div>
	</div>
	<?php include 'menu.php';?>
	<?php include 'alert.php';?>
</div>		

<div class="col-md-12">
	<form action="" method="POST">
	<table class="table table-bordered">
		<tr id="table_cent_tr_header">
			<td><span class="glyphicon glyphicon-check"></td>
			<td>User Name</td>
			<td>Department</td>
			<td>Role Name</td>
			<td>Request date</td>
			<td>DirAuthStatus</td>
			<td>DirAuthID</td>
			<td>Authorize date</td>
			<td>ITAuthStatus</td>
			<td>ITAuthID</td>
			<td>DateTo</td>
			<td>Rejected</td>
		</tr>
		<?php
			$query = "SELECT 
				a.id,a.res_id,c.usr_id, a.depID,d.departName,a.role_id,b.role_name,statuss,DateTo,DirAuthStatus,DirAuthResID,Request_date,Authorized_date,ITAuthStatus,ITAuthResID, Rejected,EndStatus,ActiveDate,InactiveDate
					  FROM ApRights a 
					  JOIN pwrole b on a.role_id = b.role_id
					  JOIN humres c on a.res_id  = c.res_id
					  JOIN DepartmentUser d on a.depID   = d.id
					  WHERE DirAuthStatus = '1' AND statuss = 'A' AND EndStatus = 0";

			$run   = sqlsrv_query($conn,$query);

			while($row = sqlsrv_fetch_array($run)){
				$id 		= $row['id'];
				$user_name  = $row['usr_id'];
				$departName = $row['departName'];
				$role_name  = $row['role_name'];
				$status     = $row['statuss'];
				$DirAuthStatus = $row['DirAuthStatus'];
				$DirAuthID     = $row['DirAuthResID'];
				$Req_date      = $row['Request_date'];
				$Auth_date     = $row['Authorized_date'];
				$ITAuthStatus  = $row['ITAuthStatus'];
				$ITAuthID      = $row['ITAuthResID'];
				$Rejected      = $row['Rejected'];
				$EndStatus     = $row['EndStatus'];
				$ActiveDate    = $row['ActiveDate'];
				$InactiveDate  = $row['InactiveDate'];
				$DateTo 	   = $row['DateTo'];

				$del  = '<span class="glyphicon glyphicon-remove" id="del"></span>';
				$ok   = '<span class="glyphicon glyphicon-ok" id="ok"></span>';
				$info = '<span class="glyphicon glyphicon-info-sign" id="info"></span>';

				if($DirAuthStatus == 0){
					$drStatus = $del;
				}elseif ($DirAuthStatus == 1) {
					$drStatus = $ok;
				}

				if($ITAuthStatus == 0){
					$ITStatus = $del;
				}elseif ($ITAuthStatus == 1) {
					$ITStatus = $ok;
				}

				if($Rejected == 0){
					$rej = 'No';
				}elseif ($Rejected == 1) {
					$rej = $info;
				}

				echo '<tr>
						<td id="cent_td"><input type="checkbox" name="checkboxvar[]" value="'. $id.'" checked></td>';
				echo   '<td>'.$user_name.'</td>';
				echo   '<td id="cent_td">'.$departName.'</td>';
				echo   '<td>'.$role_name.'</td>';
				echo   '<td id="cent_td">'.$Req_date.'</td>';
				echo   '<td id="cent_td">'.$drStatus.'</td>';
				echo   '<td id="cent_td">'.$DirAuthID.'</td>';
				echo   '<td id="cent_td">'.$Auth_date.'</td>';
				echo   '<td id="cent_td">'.$ITStatus.'</td>';
				echo   '<td id="cent_td">'.$ITAuthID.'</td>';
				echo   '<td id="cent_td">'.$DateTo.'</td>';
				echo   '<td id="cent_td">'.$rej.'</td>';
				echo  '</tr>';

			}
		?>
		<tr>
			<td colspan="13">
				<input type="submit" name="submit" class="btn btn-success" value="Process">

				<input type="submit" name="reject" class="btn btn-danger" value="Reject">

				<input type="submit" name="pwa" class="btn btn-primary" value="Process without approval">
			</td>
		</tr>
	</table>
	</form>
</div>	
<div class="col-md-12">
	<form action="" method="POST">
	<table class="table table-bordered">
		<tr>
			<td colspan="13">მოთხოვნა საწყობების უფლებებზე</td>
		</tr>
		<tr id="table_cent_tr_header">
			<td><span class="glyphicon glyphicon-check"></td>
			<td>User Name</td>
			<td>Department</td>
			<td>Role Name</td>
			<td>Request date</td>
			<td>DirAuthStatus</td>
			<td>DirAuthID</td>
			<td>Authorize date</td>
			<td>ITAuthStatus</td>
			<td>ITAuthID</td>
			<td>Date To</td>
			<td>Rejected</td>
		</tr>
		<?php
			$query1 = "SELECT *
					  FROM ApWhs a 
					  JOIN humres c on a.res_id  = c.res_id
					  JOIN DepartmentUser d on a.depID   = d.id
					  WHERE DirAuthStatus = '1' AND statuss = 'A' AND EndStatus = 0";

			$run1   = sqlsrv_query($conn,$query1);

			while($row1 = sqlsrv_fetch_array($run1)){
				$id1 		 	= $row1[0];
				$user_name1  	= $row1['usr_id'];
				$departName1 	= $row1['departName'];
				$role_name1  	= $row1['role_id'];
				$Req_date1      = $row1['Request_date'];
				$status1     	= $row1['statuss'];
				$DateTo1 		= $row1['DateTo'];
				$DirAuthStatus1 = $row1['DirAuthStatus'];
				$DirAuthID1     = $row1['DirAuthResID'];
				$Auth_date1     = $row1['Authorized_date'];
				$ITAuthStatus1  = $row1['ITAuthStatus'];
				$ITAuthID1      = $row1['ITAuthResID'];
				$Rejected1      = $row1['Rejected'];
				$EndStatus1     = $row1['EndStatus'];
				$ActiveDate1    = $row1['ActiveDate'];
				$InactiveDate1  = $row1['InactiveDate'];

				$del1  = '<span class="glyphicon glyphicon-remove" id="del"></span>';
				$ok1   = '<span class="glyphicon glyphicon-ok" id="ok"></span>';
				$info1 = '<span class="glyphicon glyphicon-info-sign" id="info"></span>';

				if($DirAuthStatus1 == 0){
					$drStatus1 = $del1;
				}elseif ($DirAuthStatus1 == 1) {
					$drStatus1 = $ok1;
				}

				if($ITAuthStatus1 == 0){
					$ITStatus1 = $del1;
				}elseif ($ITAuthStatus1 == 1) {
					$ITStatus1 = $ok1;
				}

				if($Rejected1 == 0){
					$rej1 = 'No';
				}elseif ($Rejected1 == 1) {
					$rej1 = $info1;
				}

				echo '<tr>
						<td id="cent_td"><input type="checkbox" name="checkboxv[]" value="'. $id1.'" checked></td>';
				echo   '<td>'.$user_name1.'</td>';
				echo   '<td id="cent_td">'.$departName1.'</td>';
				echo   '<td>'.$role_name1.'</td>';
				echo   '<td id="cent_td">'.$Req_date1.'</td>';
				echo   '<td id="cent_td">'.$drStatus1.'</td>';
				echo   '<td id="cent_td">'.$DirAuthID1.'</td>';
				echo   '<td id="cent_td">'.$Auth_date1.'</td>';
				echo   '<td id="cent_td">'.$ITStatus1.'</td>';
				echo   '<td id="cent_td">'.$ITAuthID1.'</td>';
				echo   '<td id="cent_td">'.$DateTo1.'</td>';
				echo   '<td id="cent_td">'.$rej1.'</td>';
				echo  '</tr>';

			}
		?>
		<tr>
			<td colspan="13">
				<input type="submit" name="submit1" class="btn btn-success" value="Process">

				<input type="submit" name="reject1" class="btn btn-danger" value="Reject">

				<input type="submit" name="pwa1" class="btn btn-primary" value="Process without approval">
			</td>
		</tr>
	</table>
	</form>
</div>	

</body>
</html>

<?php
	date_default_timezone_set("Asia/Tbilisi");
		$datt       = date("F j, Y, g:i a");
	if(isset($_POST['submit'])){
		$check_id = $_POST['checkboxvar'];
	
		foreach ($check_id as $value) {
			$query2 = "UPDATE ApRights SET ITAuthStatus = '1',ITAuthResID = '$person', Rejected = '0',EndStatus = '1',ActiveDate = '$datt' WHERE id = '$value'";
			sqlsrv_query($conn,$query2);
			header( "refresh:0;" );
		}

	}

	if(isset($_POST['reject'])){
		$check_id = $_POST['checkboxvar'];
	
		foreach ($check_id as $value) {
			$query3 = "UPDATE ApRights SET ITAuthResID = '$person', DirAuthStatus = '0', DirAuthResID = 'N/A', Rejected = '1' WHERE id = '$value'";
			sqlsrv_query($conn,$query3);
			header( "refresh:0;" );
		}

	}

	if(isset($_POST['pwa'])){
		$check_id = $_POST['checkboxvar'];

			foreach ($check_id as $value) {
			$query111 = "UPDATE ApRights SET ITAuthStatus = '1',ITAuthResID = '$person', Rejected = '1', EndStatus = '1', ActiveDate = '$datt' WHERE id = '$value'";
			sqlsrv_query($conn,$query111);
			header( "refresh:0;" );
		}

	}

	if(isset($_POST['submit1'])){
		$check_id1 = $_POST['checkboxv'];
	
		foreach ($check_id1 as $value1) {
			$query8 = "UPDATE ApWhs SET ITAuthStatus = '1',ITAuthResID = '$person', Rejected = '0',EndStatus = '1',ActiveDate = '$datt' WHERE id = '$value1'";
			sqlsrv_query($conn,$query8);
			header( "refresh:0;" );
		}

	}

	if(isset($_POST['reject1'])){
		$check_id1 = $_POST['checkboxv'];
	
		foreach ($check_id1 as $value1) {
			$query9 = "UPDATE ApWhs SET ITAuthResID = '$person', DirAuthStatus = '0', DirAuthResID = 'N/A', Rejected = '1' WHERE id = '$value1'";
			sqlsrv_query($conn,$query9);
			header( "refresh:0;" );
		}

	}

	if(isset($_POST['pwa1'])){
		$check_id1 = $_POST['checkboxv'];

			foreach ($check_id1 as $value1) {
			$query112 = "UPDATE ApWhs SET ITAuthStatus = '1',ITAuthResID = '$person', Rejected = '1', EndStatus = '1', ActiveDate = '$datt' WHERE id = '$value1'";
			sqlsrv_query($conn,$query112);
			header( "refresh:0;" );
		}

	}