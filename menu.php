

<div class="col-md-12" id="menu_wrapper">
	<p>
		<h4>
			<?php 
				function generateRandomString($length = 30) {
				    $characters = '0123456789';
				    $charactersLength = strlen($characters);
				    $randomString = '';
				    for ($i = 0; $i < $length; $i++) {
				        $randomString .= $characters[rand(0, $charactersLength - 1)];
				    }
				    return $randomString;
				}

			include 'db.php';
			$url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"; 
	    	$gela  = parse_url($url, PHP_URL_QUERY);
			$person = substr($gela,0,8);



			$query  = "SELECT * FROM UsersForRights WHERE res_id = '$person'";
			$result = sqlsrv_query($conn,$query);

			while($row = sqlsrv_fetch_array($result)){
					$user_role = $row['user_role'];


					if($user_role == 'Regular'){
						echo '<a href="main.php?'.$person.generateRandomString().'">მთავარ გვერდზე დაბრუნება</a>';
					}elseif($user_role == 'Admin'){
						echo '<a href="admin.php?'.$person.generateRandomString().'">მთავარ გვერდზე დაბრუნება</a>';
					}elseif($user_role == 'Director'){
						echo '<a href="director.php?'.$person.generateRandomString().'">მთავარ გვერდზე დაბრუნება</a>';
					}
			}
			?>
		</h4>
	</p>
</div>
