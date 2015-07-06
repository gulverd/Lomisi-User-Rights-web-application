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
		<div class="col-md-12">
			<a href="<?php echo 'rights.php?'.$person?>"><button type="button" class="btn btn-primary btn-lg btn-block" id="exact">უფლებები Exact-ში</button></a>
			<a href="<?php echo 'whs.php?'.$person;?>"><button type="button" class="btn btn-primary btn-lg btn-block" id="whs">უფლებები საწყობებზე</button></a>
			<a href="<?php echo 'profile.php?'.$person?>"><button type="button" class="btn btn-default btn-lg btn-block"><span class="glyphicon glyphicon-user"></span> პირადი ინფორმაცია</button></a>
		</div>	
	</div>
</body>
</html>
