		<div class="col-md-12">
			<div class="col-md-6">
				<?php
					$query  = "SELECT * FROM UsersForRights WHERE (email is null or fname is null or lname is null or auth is null or depId is null) AND usr_id = '$person' ";
					$run    =  sqlsrv_query($conn,$query);

					while($row = sqlsrv_fetch_array($run)){
						$per  = $row[1];
						$link = '<a href="profile.php?'.$per.'">შეავსე მონაცემები!</a>';

						echo '<div class="col-md-12" id="allert_div">';
						echo '<p>';
						echo '<h4>'.$link.'</h4>';
						echo '</p>';
						echo '</div>';

						
					}
				?>
			</div>
			<div class="col-md-6">
				<?php
					$query2  = "SELECT * FROM UsersForRights WHERE (password1 = '1324' or password2 = '1324') AND usr_id = '$person' ";
					$run2    =  sqlsrv_query($conn,$query2);

					while($row2 = sqlsrv_fetch_array($run2)){
						$per2  = $row2[1];
						$link2 = '<a href="pass.php?'.$per2.'">შეცვალე პაროლი!</a>';

						echo '<div class="col-md-12" id="allert_div">';
						echo '<p>';
						echo '<h4>'.$link2.'</h4>';
						echo '</p>';
						echo '</div>';
					}
				?>
			</div>
		</div>	