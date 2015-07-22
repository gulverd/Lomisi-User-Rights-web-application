<table>
<tr>
	<td>check</td>
	<td>Name</td>
</tr>
<form action="" method="post">
<?php
	$conn = mysqli_connect('localhost','root','','test');
	$query  = "SELECT * FROM test";
	$run    = mysqli_query($conn,$query);
	while($row = mysqli_fetch_array($run)){
			$name = $row['name'];
			echo '<tr>'; 
			echo '<td>'.'<input type="checkbox" name="checkboxvar[]" value="'; echo $name; echo '">'.'</td>';
			echo '<td>'.$name.'</td>';
			echo '</tr>';
	}
?>
<tr>
	<td><input type="submit" name="submit" value="submit"></td>
</tr>
</form>
</table>

<?php

	if(isset($_POST['submit'])){
		$rolez = $_POST['checkboxvar'];

		foreach ($rolez as $value) {
		    echo gettype($value), "\n";
		    $query2 = "INSERT INTO test (name) VALUES('$value')";
		    $run2   = mysqli_query($conn,$query2);
		    echo $value;

		}

	}