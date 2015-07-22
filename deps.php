<html>
<head>
<title>Welcome</title>

<script src="jquery-1.9.1.min.js" type="text/javascript"></script>
<script src="jquery.easing.min.js" type="text/javascript"></script>
<link href="css/bootstrap.min.css" rel="stylesheet">
<meta charset="utf-8">
<link rel="stylesheet" type="text/css" href="style.css" />
<?php include 'db.php';?>
</head>
<body>
<?php
		$url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"; 
    	$gela  = parse_url($url, PHP_URL_QUERY);
		$person = substr($gela,0,8);
?>
	<div class="container">
		<div class="col-md-12">
			<div class="bs-callout bs-callout-info" id="callout-helper-bg-specificity">
			    <h4 id="dealing-with-specificity"><b>მომხმარებლის უფლებების გვერდი</b><a class="anchorjs-link" href="#dealing-with-specificity"><span class="anchorjs-icon"></span></a></h4>
			    <p>
			    	გთხოვთ აირჩიოთ სასურველი მოდული. 
			    </p>
			</div>
		</div>
		<?php include 'alert.php';?>
		<?php include 'menu.php';?>
		<div class="col-md-12" id="nwdpa">
				<span class="glyphicon glyphicon-plus"></span>    ახალი დეპარტამენტის დამატება
		</div>
		<div class="col-md-12">
			<table class="table table-bordered">
					<tr id="table_cent_tr_header">
						<td>d</td>
						<td>Department Name</td>
						<td>Department Director Mail</td>
						<td>DirectorResId</td>
						<td>DirectorName</td>					
					</tr>
				<?php 

					$query = "SELECT a.res_id,a.usr_name,a.email,b.departName FROM UsersForRights a
								JOIN DepartmentUser b on a.depId = b.id
								where a.user_role = 'Director'";
					$run   = sqlsrv_query($conn,$query);

					while($row = sqlsrv_fetch_array($run)){
						   $res_id 	  = $row['res_id'];
						   $usr_name  = $row['usr_name'];
						   $depDir    = $row['email'];
						   $depName   = $row['departName'];

						   echo "<tr>";
						   	   echo "<td id='cent_td'>";
						   	   		echo 'a';
						   	   echo "</td>";
							   echo "<td id='cent_td'>";
							   		echo $depName;
							   echo "</td>";
							   echo "<td id='cent_td'>";
							   		echo $depDir;
							   echo "</td>";
							   echo "<td id='cent_td'>";
							   		echo $res_id;
							   echo "</td>";
							   echo "<td id='cent_td'>";
							   		echo $usr_name;
							   echo "</td>";
						   echo "</tr>";
					}
				?>
			</table>
		</div>
		<div class="col-md-12" id="nwdpa">
			<span class="glyphicon glyphicon-user"></span>   მომხმარებლისთვის დირექტორის სტატუსი მინიჭება
		</div>
		<div class="col-md-12">
			<form method="post">
				<table class="table table-bordered">
					<tr>
						<td id='cent_td'>ჩაწერეთ მომხმარებლის კოდი</td>
						<td id='cent_td'><input type="text" name="dircode" value="" class="form-control" placeholder="მაგ: 10000100"></td>
						<td id='cent_td'>აირჩიეთ დეპარტამენტი</td>
						<td id='cent_td'>
							<select name="dpnm" class="form-control">
							<?php 
								$query2 = "SELECT * FROM DepartmentUser";
								$run2   = sqlsrv_query($conn,$query2);

								while($row2 = sqlsrv_fetch_array($run2)){
									$dprtnm   = $row2['departName'];
									echo '<option>'.$dprtnm.'</option>';
								}
							?>	
							</select>
						</td>
						<td id='cent_td'>
							<input type="submit" name="submit" value="დადასტურება" class="btn btn-success">
						</td>
					</tr>
			</form>
		</div>
		
		
	</div>
</html>



<?php
	if(isset($_POST['submit'])){
		$dircode = $_POST['dircode'];
		$dpnm    = $_POST['dpnm'];




		$query3  = "SELECT * FROM UsersForRights WHERE res_id = '$dircode'";
		$run3    = sqlsrv_query($conn,$query3);

		while($row3 = sqlsrv_fetch_array($run3)){
			$mmail  = $row3['email'];
			$usname = $row3['usr_name'];
			$rsid   = $row3['res_id'];
			$dpid   = $row3['depId'];

			//echo $dpid;

			$query4 = "UPDATE UsersForRights SET user_role = 'Regular' where depId = '$dpid' AND user_role != 'Admin'";
			$run4   = sqlsrv_query($conn,$query4);

			$query7 = "SELECT * FROM DepartmentUser where departName = '$dpnm'";
			$run7   = sqlsrv_query($conn,$query7);

			while($row7 = sqlsrv_fetch_array($run7)){
				$iddd = $row7['id'];

				$query8 = "UPDATE DepartmentUser SET directorMail = '$mmail' where id = '$iddd'";
				$run8   = sqlsrv_query($conn,$query8);

				$query9 = "UPDATE UsersForRights SET user_role = 'Regular' where depId = '$iddd'";
				$run9   = sqlsrv_query($conn,$query9);

				$query10 = "UPDATE UsersForRights SET depId = '$iddd' where res_id = '$dircode'";
				$run10   = sqlsrv_query($conn,$query10);

			}

			$query5 = "UPDATE DepartmentUser SET directorMail = '$mmail' where id = '$dpid'";
			$run5   = sqlsrv_query($conn,$query5);

			$query6 = "UPDATE UsersForRights SET user_role = 'Director' where res_id = '$dircode'";
			$run6   = sqlsrv_query($conn,$query6);


			//header( "refresh:1;" );

		}  
	}