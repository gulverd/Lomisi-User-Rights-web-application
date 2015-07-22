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
			<div class="bs-callout bs-callout-info" id="callout-helper-bg-specificity">
			    <h4 id="dealing-with-specificity"><b>ავტორიზაციის ფორმა</b><a class="anchorjs-link" href="#dealing-with-specificity"><span class="anchorjs-icon"></span></a></h4>
			    <p>
			    	გთხოვთ შეიყვანოთ თქვენი Exact- ის მომხმარებლის რვა ციფრიანი კოდი ან Exact- ის Username , პაროლი და დააჭირეთ ღილაკს "ავტორიზაცია".
			    </p>
			</div>
		</div>
		<div class="col-md-12">
			<form action="" method="POST">
				<div class="form-group">
				    <label for="exampleInputEmail1">მომხარებლის კოდი</label>
				    <input type="text" class="form-control" id="exampleInputEmail1"  name="username" placeholder="მაგ: 10000145 ან G.Maisuradze">
				 </div>
				<div class="form-group">
				    <label for="exampleInputEmail1">პაროლი</label>
				    <input type="password" class="form-control" id="exampleInputEmail1"  name="password" placeholder="მაგ: 1324">
				 </div>
				<div class="form-group">
					<input type="submit" value="ავტორიზაცია" name="submit" class="btn btn-default">					
				 </div>
			</form>
		</div>
	</div>
</body>
</html>

<?php

	if(isset($_POST['submit'])){
		

		$usr_id   = $_POST['username'];
		$password = $_POST['password'];

		
		
		if(empty($usr_id) or empty($password)){
			echo "შეიყვანეთ მონაცემები!";
		}else{
			$query  = "SELECT * FROM UsersForRights WHERE (res_id = '$usr_id' or usr_name = '$usr_id') AND password1 = '$password'";
			$result = sqlsrv_query($conn,$query);
			while($row = sqlsrv_fetch_array($result)){
				$user_id   = $row[1];
				$user_name = $row[2];
				$email     = $row[3];
				$pass      = $row[4];

				session_start();

				function generateRandomString($length = 30) {
				  	$characters = '0123456789';
				  	$charactersLength = strlen($characters);
				  	$randomString = '';
				  	for ($i = 0; $i < $length; $i++) {
				      	$randomString .= $characters[rand(0, $charactersLength - 1)];
				  	}
				  	return $randomString;
				}
				header('location:hdrtmp.php?'.$user_id.generateRandomString());
			}
		}
	
	}
?>