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
			    <h4 id="dealing-with-specificity"><b>მომხმარებლისთვის დირექტორის სტატუსის მინიჭება</b><a class="anchorjs-link" href="#dealing-with-specificity"><span class="anchorjs-icon"></span></a></h4>
			    <p>
			    	გთხოვთ ჩაწეროთ მომხმარებლის კოდი, აირჩიოთ დეპარტამენტი და დააჭიროთ ღილაკს "დადასტურება".
			    </p>
			</div>
		</div>
		<?php include 'alert.php';?>
		<?php include 'menu.php';?>
	
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