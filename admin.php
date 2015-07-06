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
<div class="container">
	<div class="col-md-12">
		<form action="" method="POST">
			<div class="form-group">
				<label for="exampleInputEmail1">ძებნა</label>
				<input type="text" class="form-control" name="search" placeholder="მაგ: 10000100">
			</div>	
			<div class="form-group">
				<input type="submit" value="დადასტურება" name="submit" class="btn btn-default">
			</div>
		</form>
	</div>
</div>
	<div class="col-md-12">
			<?php

				if(isset($_POST['submit'])){
					$ID = $_POST['search'];

					$query = "SELECT * FROM ApRights WHERE usr_id = '$ID'";
					$run   =  sqlsrv_query($conn,$query);

								echo '		<table class="table">
										<tr>
											<td>UserId</td>
											<td>Department</td>
											<td id="roles">Roles</td>
											<td>Status</td>
											<td>Active Date</td>
											<td>Inactive Date</td>
										</tr>';
					while($row = sqlsrv_fetch_array($run)){
						$usr_id = $row['usr_id'];
						$dep_id = $row['depID'];
						$roles  = $row['role_name'];
						$stat   = $row['statuss'];
						$Adate  = $row['ActiveDate'];
						$Idate  = $row['InavtiveDate'];
			
						echo '<tr>';
							echo '<td>';
								echo $usr_id;
							echo '</td>';
							echo '<td>';
								echo $dep_id;
							echo '</td>';
							echo '<td id="roles">';
								echo $roles;
							echo '</td>';
							echo '<td>';
								echo $stat;
							echo '</td>';
							echo '<td>';
								echo $Adate;
							echo '</td>';
							echo '<td>';
								echo $Idate;
							echo '</td>';
						echo '</tr>';		

					}
				}
			?>
		</table>
	</div>
</body>
</html>


