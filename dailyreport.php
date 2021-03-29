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
    <title>Daily Report</title>
</head>

<body>

	<div style="font-weight:bold; font-size:28px;" class="a">
		<p>Daily Report</p>
		<p id="date">
			<?php echo $_GET["date"]; ?>
		</p>
	</div>

	<div style = "width:80%; margin-left:100px;">
	
		<div style = "margin:30px" >
					   
			<?php 
				$query = "SELECT * FROM stock ORDER BY itemName ASC";
				
				echo '<table cellspacing="6" cellpadding="3"> 
					<tr>
						<td><b>No.</font></td>
						<td><b>Item Name</font></td>
						<td><b>Stock In</font></td>
						<td><b>Stock Out</b></td> 
						<td><b>Current Stock</b></td> 
					</tr>';

				if ($result = mysqli_query($db, $query)) {
					$c = 1;
					while ($row = $result->fetch_assoc()) {
						$item = $row["itemName"];
						$current_stock = $row["stockAmount"]; 

						echo '<tr> 
							<td>'.$c.'</td>
							<td>'.$item.'</td>';
									
							$daily = $_GET["date"];
							$restock = "SELECT * FROM stockin WHERE dateTime='$daily' and itemName='$item'";
							if ($stockin = mysqli_query($db, $restock)){
								$count_in = mysqli_num_rows($stockin);
										
								if($count_in == 0){
									echo '<td>0</td>';
								}else{
									$si = mysqli_fetch_array($stockin,MYSQLI_ASSOC);
									$in = $si["restock"];
												
									echo '<td>'.$in.'</td>';
								}
										
							}	
									
							$sell = "SELECT * FROM sales WHERE dateTime='$daily' and itemName='$item'";
							if ($sold_stock = mysqli_query($db, $sell)){
								$count_sold = mysqli_num_rows($sold_stock);
										
								if($count_sold==0){
									echo '<td>0</td>';
								}else{
									$s = mysqli_fetch_array($sold_stock,MYSQLI_ASSOC);
									$out = $s["sold"];
												
									echo '<td>'.$out.'</td>';
								}
										
							}	
									
									
							if($current_stock <= 15){
								echo '<td style="color:#C04000"><b>'.$current_stock.'</b></td> 
								  </tr>';
							}else{
								echo '<td>'.$current_stock.'</td> 
								  </tr>';
							}	
								
							$c++;
						}
						$result->free();
				} 
			?>
						
		</div>

	</div>

</body>

</html>