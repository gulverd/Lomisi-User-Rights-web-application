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
			<h4 id="dealing-with-specificity"><b>მომხმარებლის პირადი ინფორმაციის გვერდი</b><a class="anchorjs-link" href="#dealing-with-specificity"><span class="anchorjs-icon"></span></a></h4>
			<p>
			    გთხოვთ სწორად შეავსოთ ყველა ველი. 
			</p>
		</div>		
	</div>
		<?php include 'menu.php';?>
		<?php include 'alert.php';?>
	<div class="col-md-12">
		<?php
			$query3 = "SELECT * FROM UsersForRights WHERE usr_id = '$person'";
				$run3   = sqlsrv_query($conn,$query3);

				while($row3 = sqlsrv_fetch_array($run3)){
					$id     =  $row3[1];
					$usname =  $row3[2];
					$email1  =  $row3[3];
					$fname1  =  $row3[6];
					$lname1  =  $row3[7];
					$direc  =  $row3[8];

					//echo $id . " " . $usname  . " " . $email  . " " . $fname . " " . $lname  . " " . $direc; 
			?>	
		<form action="" method="POST">
				<div class="form-group">
				    <label for="exampleInputEmail1">Exact ID</label>
				    <input type="text" class="form-control" id="exampleInputEmail1" name="exactId" value="<?php echo $id?>" placeholder="მაგ: 10000100" readonly>
				</div>
				<div class="form-group">
				    <label for="exampleInputEmail1">Exact Name</label>
				    <input type="text" class="form-control" id="exampleInputEmail1" name="uname" value="<?php echo $usname?>" placeholder="მაგ: G.MAISURADZE" readonly>
				</div>				 
				<div class="form-group">
				    <label for="exampleInputEmail1">სახელი</label>
				    <input type="text" class="form-control" id="exampleInputEmail1"  name="fname" value="<?php echo $fname1?>" placeholder="მაგ: გიორგი">
				</div>
				<div class="form-group">
				    <label for="exampleInputEmail1">გვარი</label>
				    <input type="text" class="form-control" id="exampleInputEmail1" name="lname" value="<?php echo $lname1?>" placeholder="მაგ: მაისურაძე">
				</div>
				<div class="form-group">
				    <label for="exampleInputEmail1">თქვენი Email</label>
				    <input type="email" class="form-control" id="exampleInputEmail1" name="email" value="<?php echo $email1?>" placeholder="giorgi.maisuradze@ge.anadoluefes.com">
				</div>
				<div class="form-group">
				    <label for="exampleInputEmail1">დამავტროიზებელი პირის Email</label>
				    <input type="email" class="form-control" id="exampleInputEmail1" name="memail" value="<?php echo $direc?>" placeholder="giorgi.mshvildadze@ge.anadoluefes.com">
				</div>
				<div class="form-group">
				    <label for="exampleInputEmail1">აირჩიეთ თქვენი დეპარტამენტი</label>
				    <select class="form-control" name="department">	
					    <?php
					    	$query5 = "SELECT departName FROM DepartmentUser";
					    	$run5   = sqlsrv_query($conn,$query5);
					    	while($row5 = sqlsrv_fetch_array($run5)){
					    		$depName = $row5['departName'];
					    		echo '<option>'.$depName.'</option>';
					    	}
					    ?>
				    </select>
				</div>			
	<?php
		}
	?>
				<div class="form-group">
					<input type="submit" value="დადასტურება" name="submit" class="btn btn-default">
				</div>
		</form>
	</div>
	<div class="col-md-12">
		<a href="<?php echo 'pass.php?'.$person?>">პაროლის შეცვლა</a>
	</div>	
</div>
</body>
</html>


<?php

	if(isset($_POST['submit'])){
		 $firstName = $_POST['fname'];
		 $lastName  = $_POST['lname'];
		 $emmail    = $_POST['email'];
		 $mmeamil   = $_POST['memail'];
		 $department  = $_POST['department'];


		$query6 = "SELECT * FROM DepartmentUser WHERE departName = '$department' ";
		$run6   = sqlsrv_query($conn,$query6);

		while($row6 = sqlsrv_fetch_array($run6)){
			$depsName = $row6['departName'];
			$depID    = $row6['id'];
			$dirMail  = $row6['directorMail'];

		}

			echo $depID. " " . $depsName. " " . $dirMail;


		 $query4    = "UPDATE UsersForRights SET email = '$emmail', fname = '$firstName', lname = '$lastName', auth ='$mmeamil',depId = '$depID' where usr_id = '$person'";
		 $run4	   = sqlsrv_query($conn,$query4);

		echo "<script> 
				window.alert('მონაცემები შეცვლილია!');
		  	  </script>";	
		
	}  