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
		function convert($input){
			$encoding = array(

				'À' => 'ა',
				'Á' => 'ბ',
				'Â' => 'გ',
				'Ã' => 'დ',
				'Ä' => 'ე',
				'Å' => 'ვ',
				'Æ' => 'ზ',
				'È' => 'თ',
				'É' => 'ი',
				'Ê' => 'კ',
				'Ë' => 'ლ',
				'Ì' => 'მ',
				'Í' => 'ნ',
				'Ï' => 'ო',
				'Ð' => 'პ',
				'Ñ' => 'ჟ',
				'Ò' => 'რ',
				'Ó' => 'ს',
				'Ô' => 'ტ',
				'Ö' => 'უ',
				'×' => 'ფ',
				'Ø' => 'ქ',
				'Ù' => 'ღ',
				'Ú' => 'ყ',
				'Û' => 'შ',
				'Ü' => 'ჩ',
				'Ý' => 'ც',
				'Þ' => 'ძ',
				'ß' => 'წ',
				'à' => 'ჭ',
				'á' => 'ხ',
				'ã' => 'ჯ',
				'ä' => 'ჰ',
			);

			return str_replace(array_keys($encoding), array_values($encoding), $input);
		}

?>

<?php
		$url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"; 
    	$gela  = parse_url($url, PHP_URL_QUERY);
		$person = substr($gela,0,8);
				date_default_timezone_set("Asia/Tbilisi");
		$datz       = date("Y-m-d");
		$maxDate    = '2020-12-31';
		//echo $person;
?>
<div class="col-md-12">
	<div class="container">
		<div class="col-md-12">
			<div class="bs-callout bs-callout-info" id="callout-helper-bg-specificity">
			    <h4 id="dealing-with-specificity"><b>მომხმარებლის უფლებების ფორმა</b><a class="anchorjs-link" href="#dealing-with-specificity"><span class="anchorjs-icon"></span></a></h4>
			    <p>
			    	გთხოვთ მონიშნოთ სასურველი უფლება(ები), შეავსოთ ყველა ველი (სახელი,გვარი,email,დეპარტამენტის დირექტორის email) და დააჭიროთ ღილაკს "დადასტურება".
			    </p>
			</div>
		</div>
			<?php include 'menu.php';?>
			<?php include 'alert.php';?>
		<div class="col-md-12">
				<div class="col-md-4">
					<h4><b>არსებული უფლებები</b></h4>
				</div>
				<div class="col-md-4">
					<h4><b>სხვა უფლებები</b></h4>
				</div>
				<div class="col-md-4">
					<h4><b>Personal Information</b></h4>
				</div>
			<div class="col-md-4">
					<table class="table">
						<tr>
							<td><span class="glyphicon glyphicon-qrcode"></span></td>
							<td><i>Warehouse Name</i></td>
						</tr>
							<?php

								$query1 = "SELECT pwmagaz.magcode, magaz.naam
										   FROM pwmagaz 
										   INNER JOIN magaz ON magaz.magcode=pwmagaz.magcode 
										   WHERE pwmagaz.res_id= $person";
								$run1   =  sqlsrv_query($conn,$query1);

								while($row1 = sqlsrv_fetch_array($run1)){
									$role_id     = $row1[0];
									$role_name   = $row1[1];

									echo '<tr>';
									echo '<td>'.$role_id.'</td>';
									echo '<td>'.substr($role_name, strpos($role_name, "/") + 1).'</td>';
									echo '</tr>';
								}

							?>
					</table>
			</div>	
			<div class="col-md-4">
				  <form action="" method="POST">
					<table class="table">
						<tr>
							<td><span class="glyphicon glyphicon-ok"></span></td>
							<td><span class="glyphicon glyphicon-qrcode"></span></td>
							<td><i>Warehouse Name</i></td>
						</tr>			
					<?php
						$query2   ="SELECT distinct magaz.magcode, magaz.naam
									FROM magaz
									JOIN pwmagaz ON magaz.magcode = pwmagaz.magcode
									WHERE pwmagaz.res_id != $person
									EXCEPT
									SELECT distinct magaz.magcode, magaz.naam
									FROM magaz
									JOIN pwmagaz ON magaz.magcode = pwmagaz.magcode
									WHERE pwmagaz.res_id = $person";

						$run2     = sqlsrv_query($conn,$query2);

						while      ($row2 = sqlsrv_fetch_array($run2)){
										$role_name_2 = $row2[0];
										$role_id_2   = $row2[1];

										echo '<tr>';
										echo '<td>'.'<input type="checkbox" name="checkboxvar[]" value="'; echo $role_name_2; echo '">'.'</td>';
										echo '<td>'.$role_name_2.'</td>';
										echo '<td>'.substr($role_id_2, strpos($role_id_2, "/") + 1).'</td>';
										echo '</tr>';
									}
					?>
				</table>
			</div>
			<div class="col-md-4">
			<div class="col-md-12" id="bgogo">
			<?php
				$query3 = "SELECT * FROM UsersForRights WHERE res_id = '$person'";
				$run3   = sqlsrv_query($conn,$query3);

				while($row3 = sqlsrv_fetch_array($run3)){
					$id     =  $row3[1];
					$usname =  $row3[2];
					$email1  =  $row3[3];
					$fname1  =  $row3[6];
					$lname1  =  $row3[7];
					$direc  =  $row3[8];
					$depID  = $row3['depId'];


					$query6 = "SELECT * FROM DepartmentUser WHERE id = '$depID'";
					$run6   = sqlsrv_query($conn,$query6);
					while($row6 = sqlsrv_fetch_array($run6)){
						$depName 	  = $row6['departName'];
						$directorMail = $row6['directorMail'];
						$depidd       = $row6['id'];
					}



					//echo $id . " " . $usname  . " " . $email  . " " . $fname . " " . $lname  . " " . $direc; 
			?>	
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
				    <input type="text" class="form-control" id="exampleInputEmail1"  name="fname" value="<?php echo $fname1?>" placeholder="მაგ: გიორგი" readonly>
				 </div>
				<div class="form-group">
				    <label for="exampleInputEmail1">გვარი</label>
				    <input type="text" class="form-control" id="exampleInputEmail1" name="lname" value="<?php echo $lname1?>" placeholder="მაგ: მაისურაძე" readonly>
				 </div>
				<div class="form-group">
				    <label for="exampleInputEmail1">თქვენი Email</label>
				    <input type="email" class="form-control" id="exampleInputEmail1" name="email" value="<?php echo $email1?>" placeholder="giorgi.maisuradze@ge.anadoluefes.com" readonly>
				 </div>
				<div class="form-group">
				    <label for="exampleInputEmail1">დეპარტამენტი</label>
				    <input type="text" class="form-control" id="exampleInputEmail1" name="depName" value="<?php echo $depName?>" placeholder="finance" readonly>
				</div>	
				<div class="form-group">
				    <label for="exampleInputEmail1">თქვენი დეპარტამენტის დირექტორის Email</label>
				    <input type="email" class="form-control" id="exampleInputEmail1" name="dirMail" value="<?php echo $directorMail;?>" placeholder="" readonly>
				 </div>			
				<?php
					}
				?>
				  <div class="form-group">
					<input type="submit" value="Submit" name="submit" class="btn btn-default" id="submit1">
				  </div>	
				
			</div>
			
			<div class="col-md-12">
					<h4><b>Temporary Rights Form</b></h4>
				</div>
				<div class="col-md-12" id="bgogo">	
 					<div class="form-group">
				    	<label for="exampleInputEmail1"><span class="glyphicon glyphicon-th-large"></span> Number Of Warehouse</label>
						<input type="text" class="form-control" name="tempName" placeholder="Please entry number of warehouse ">
					</div>
					<div class="form-group">
				    	<label for="exampleInputEmail1"><span class="glyphicon glyphicon-calendar"></span> Date To</label>	
						<input type="date" name="DateTo"  class="form-control" min="<?php echo $datz;?>" max="<?php echo $maxDate;?>" value="<?php echo $datz;?>">
					</div>
					<div class="form-group">
						<input type="submit" value="Submit" name="submit2" class="btn btn-success" id="submit2">
					</div>
				</form>
				</div>
			</div>
	</div>
</div>
</body>
</html>


<?php
	date_default_timezone_set("Asia/Tbilisi");

	if (isset($_POST['submit'])){
		$exact   	= $_POST['exactId'];
		$username11 = $_POST['uname'];
		$fname   	= $_POST['fname'];
		$lname   	= $_POST['lname'];
		$email   	= $_POST['email'];
		//$memail  	= $_POST['memail'];
		$dirMail    = $_POST['dirMail'];
		$role    	= $_POST['checkboxvar'];
	//	$roles    	= trim(implode(',', $_POST['checkboxvar']));
		$datt       = date("F j, Y, g:i a");

		foreach ($role as $value) {


			/*$query8     = "UPDATE ApRights SET statuss = 'I',InavtiveDate = '$datt' WHERE res_id = '$exact' AND statuss = 'A'";
			$run8       = sqlsrv_query($conn,$query8);
*/
			$query7     = "INSERT INTO ApWhs (res_id,depID,role_id,Request_date,statuss,DateTo,DirAuthStatus,DirAuthResID,Authorized_date,ITAuthStatus,ITAuthResID,Rejected,EndStatus,ActiveDate,InactiveDate) VALUES ('$exact','$depidd','$value','$datt','A','$maxDate','0','N/A','N/A','0','N/A','0','0','N/A','N/A')";
			$run7       = sqlsrv_query($conn,$query7);
			 //echo $value;

		}

        $message = 'FROM:'. " " . $fname . " " . $lname .'</br>' .'Exact ID:'. $exact .'</br>'. 'Username:'. $username11 .'</br>'. 'გთხოვთ ჩამირთოთ შემდეგ საწყობებზე უფლებები:'.'</br>'. implode('</br>',$role);

		$query11 = "SELECT pwmagaz.magcode, magaz.naam
					FROM pwmagaz 
					INNER JOIN magaz ON magaz.magcode=pwmagaz.magcode 
					WHERE pwmagaz.res_id= $person";

		$run11   =  sqlsrv_query($conn,$query11);

/*		require "phpmailer/class.phpmailer.php"; //include phpmailer class
          
        // Instantiate Class  
        $mail = new PHPMailer();  
          
        // Set up SMTP  
        $mail->IsSMTP();                // Sets up a SMTP connection  
        $mail->SMTPAuth = true;         // Connection with the SMTP does require authorization    
        $mail->SMTPSecure = "ssl";      // Connect using a TLS connection  
        $mail->Host = "smtp.gmail.com";  //Gmail SMTP server address
        $mail->Port = 465;  //Gmail SMTP port
        $mail->Encoding = '7bit';
        $mail->CharSet = "UTF-8";
        
        // Authentication  
        $mail->Username   = "anadoluefesmailer@gmail.com"; // Your full Gmail address
        $mail->Password   = "vaxopataraia"; // Your Gmail password
           
        // Composey
        $mail->SetFrom($_POST['email']);
        $mail->AddReplyTo($_POST['email']);
        $mail->Subject = "User rights uptate!";      // Subject (which isn't required)  
        $mail->MsgHTML($message);

        $too = 'vakhtang.pataraia@ge.anadoluefes.com';
       // $cc  = $memail;
        $me  = $email;
        $dir = $dirMail;
        // Send To  
        $mail->AddAddress($too,$too ); // Where to send it - Recipient
        $mail->AddAddress($me,$me );
        //$mail->AddCC($cc, $cc);
 		$mail->AddCC($dir, $dir);

        $result = $mail->Send();    // Send!  
        $message = $result ? 'წარმატებით გაიგზავნა!' : 'გაგზავნა ვერ მოხერხდა!';      
        unset($mail);

       	if($message){
       		echo "<script> 
       			window.alert('შეტყობინება წარმატებით გაიგზავნა!');
		  	  </script>";
       	}else{
       		echo "<script> 
       			window.alert('შეტყობინების გაიგზავნა ვერ მოხერხდა!');
		 		window.location.assign('index.php')
		  	  </script>";
       	}*/

    }

   		if(isset($_POST['submit2'])){
			$exact   	= $_POST['exactId'];
			$username11 = $_POST['uname'];
			$fname   	= $_POST['fname'];
			$lname   	= $_POST['lname'];
			$email   	= $_POST['email'];
			$dirMail    = $_POST['dirMail'];

			$datt       = date("F j, Y, g:i a");
			$tempName   = $_POST['tempName'];
			$DateTo     = $_POST['DateTo'];

			$query444   = "SELECT distinct magaz.magcode, magaz.naam
							FROM magaz
							JOIN pwmagaz ON magaz.magcode = pwmagaz.magcode
							WHERE pwmagaz.res_id != '$person'
							EXCEPT
							SELECT distinct magaz.magcode, magaz.naam
							FROM magaz
							JOIN pwmagaz ON magaz.magcode = pwmagaz.magcode
							WHERE pwmagaz.res_id = '$person'";
			$run444     =  sqlsrv_query($conn,$query444);

			while($row444 = sqlsrv_fetch_array($run444)){
				$checker  = $row444['magcode'];

				if(strcmp($tempName ,trim($checker)) == 0){
					$query123   = "INSERT INTO ApWhs (res_id,depID,role_id,Request_date,statuss,DateTo,DirAuthStatus,DirAuthResID,Authorized_date,ITAuthStatus,ITAuthResID,Rejected,EndStatus,ActiveDate,InactiveDate) 
									VALUES ('$exact','$depidd','$tempName','$datt','A','$DateTo','0','N/A','N/A','0','N/A','0','0','N/A','N/A')";
					$run123     = sqlsrv_query($conn,$query123);

				}else{
					echo "<script>
							window.alert('".$tempName." Is already Exsists or it is incorrect!.');
						</script>";
					header( "refresh:0;" );
				}
			}			
		}
    ?>

