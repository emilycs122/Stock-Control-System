<?php
    include('session.php');
	include('style.php');
	
	if($user_position == "Admin"){
		include('headerAdmin.php');
	}else{
		include('headerStaff.php');
	}
?>


<!DOCTYPE html>

<html>

<head>
    <title>Stock View</title>
</head>

<body>

	<div style="font-weight:bold; font-size:28px;" class="a">
		<p>All Stocks</p>
	</div>

	<div style = "width:80%; border: solid 2px #333333; border-radius:20px; margin-left:100px;">
	
		<div style = "margin:30px" >
					   
			<?php 
				$query = "SELECT * FROM stock ORDER BY itemName ASC";

				echo '<table border="0" cellspacing="6" cellpadding="3"> 
					  <tr>
						  <td><b>Item Name</font></td> 
						  <td><b>Current Stock</b></td> 
						  <td><b>Last updated by</b></td>
						  <td><b>Last updated on</b></td>
					  </tr>';

				if ($result = mysqli_query($db, $query)) {
					while ($row = $result->fetch_assoc()) {
						$name = $row["itemName"];
						$samount = $row["stockAmount"];
						$lastupdated = $row["updatedBy"];
						$datetime = $row["dateTime"];

						echo '<tr> 
								  <td>'.$name.'</td> 
								  <td>'.$samount.'</td> 
								  <td>'.$lastupdated.'</td> 
								  <td>'.$datetime.'</td>
							  </tr>';
					}
					$result->free();
				} 
			?>
						
		</div>

	</div>

</body>

</html>