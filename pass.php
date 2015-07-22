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
			<h4 id="dealing-with-specificity"><b>მომხმარებლის პაროლის შეცვლა</b><a class="anchorjs-link" href="#dealing-with-specificity"><span class="anchorjs-icon"></span></a></h4>
			<p>
			    გთხოვთ სწორად შეავსოთ ყველა ველი. 
			</p>
		</div>
	</div>
			<?php include 'menu.php';?>
			<?php include 'alert.php';?>
	<div class="col-md-12">
		<?php
			$query = "SELECT * FROM UsersForRights WHERE res_id = '$person'";
			$run   = sqlsrv_query($conn,$query);

			while($row = sqlsrv_fetch_array($run)){
				$old_pass  = $row[5];
			}
		?>
		<form action="" method="POST">
			<div class="form-group">
				<label for="exampleInputEmail1">შეიყვანეთ ძველი პაროლი</label>
				<input type="password" class="form-control" id="exampleInputEmail1" name="old_pass" placeholder="Old Password">
			</div>
			<div class="form-group">
				<label for="exampleInputEmail1">შეიყვანეთ ახალი პაროლი</label>
				<input type="password" class="form-control" id="exampleInputEmail1" name="password1" placeholder="New Password">
			</div>
			<div class="form-group">
				<label for="exampleInputEmail1">გაიმეორეთ ახალი პაროლი</label>
				<input type="password" class="form-control" id="exampleInputEmail1" name="password2" placeholder="Repeat Password">
			</div>
				<div class="form-group">
					<input type="submit" value="დადასტურება" name="submit" class="btn btn-default">
				</div>
		</form>
	</div>
</div>
</body>
</html>

<?php 

	if(isset($_POST['submit'])){
		$password1 = $_POST['password1'];
		$password2 = $_POST['password2'];
		$oldd_pass = $_POST['old_pass'];

		if($oldd_pass == $old_pass AND $password1 == $password2 AND $password1 != 1324 AND $password2 != 1324){
			$query2 = "UPDATE UsersForRights SET password1 = '$password1', password2 = '$password2' WHERE res_id = '$person'";
			$run2   = sqlsrv_query($conn,$query2);
			echo "<script> 
				window.alert('პაროლი შეცვლილია!');
		 	  </script>"; 
		}else{
			echo "Bad old password! or Password1 does not equal Password2";
		}
	}

?>