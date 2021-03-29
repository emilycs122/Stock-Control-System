<?php
    include('session.php');
	include('style.php');
	
	if($user_position == "Admin"){
		include('headerAdmin.php');
	}else{
		include('headerStaff.php');
	}
	
	$start = $_GET["start"];
    $end = $_GET["end"];
?>


<!DOCTYPE html>

<html>

<head>
    <title>Monthly Report</title>
</head>

<body>

	<div style="font-weight:bold; font-size:28px;" class="a">
		<p>Monthly Report</p>
		<p id="date">
			<?php echo $_GET["start"].'  until  '.$_GET["end"]; ?>
		</p>
	</div>

	
	<div style = "width:80%;margin-left:100px;">
	
		<div style = "margin:30px" >
					   
			<?php 
				$query = "SELECT * FROM stock ORDER BY itemName ASC";
				
				echo '<table cellspacing="10" cellpadding="4"> 
					<tr>
						<td><b>No.</font></td>
						<td><b>Item Name</font></td>
						<td><b>Stock In</font></td>
						<td><b>Stock Out</b></td> 
						<td><b>Current Stock</b></td> 
					</tr>';

				if ($result = mysqli_query($db, $query)) {
					
					$c = 1;
					$sin = 0;
					$sout = 0;
					$cstock = 0;
					while ($row = $result->fetch_assoc()) {
						$item = $row["itemName"];
						$current_stock = $row["stockAmount"]; 

						echo '<tr> 
							<td>'.$c.'</td>
							<td>'.$item.'</td>';
									
							
							$restock = "SELECT * FROM stockin WHERE (dateTime BETWEEN '$start' AND '$end') and itemName='$item'";
							if ($stockin = mysqli_query($db, $restock)){
								$count_in = mysqli_num_rows($stockin);
										
								if($count_in == 0){
									echo '<td style="text-align:center">0</td>';
								}else{
									$si = mysqli_fetch_array($stockin,MYSQLI_ASSOC);
									$in = $si["restock"];
									$sin += $in;
									$i = $sin;
												
									echo '<td style="text-align:center">'.$in.'</td>';
								}
										
							}	
									
							$sell = "SELECT * FROM sales WHERE (dateTime BETWEEN '$start' AND '$end') and itemName='$item'";
							if ($sold_stock = mysqli_query($db, $sell)){
							$count_sold = mysqli_num_rows($sold_stock);
										
								if($count_sold==0){
									echo '<td style="text-align:center">0</td>';
								}else{
									$s = mysqli_fetch_array($sold_stock,MYSQLI_ASSOC);
									$out = $s["sold"];
									$sout += $out;
									$s = $sout;
													
									echo '<td style="text-align:center">'.$out.'</td>';
								}
										
							}	
							
							if($current_stock <= 15){
								echo '<td style="text-align:center; color:#C04000"><b>'.$current_stock.'</b></td> 
								  </tr>';
							}else{
								echo '<td style="text-align:center;">'.$current_stock.'</td> 
								  </tr>';
							}							
							
							$cstock += $current_stock;
							$cs = $cstock;							
								  
							$c++;
					}
					 $result->free();
				}

				echo '<tr>
						<td colspan="2"><b>Total</font></td>
						<td style="text-align:center"><b>'.$i.'</font></td>
						<td style="text-align:center"><b>'.$s.'</b></td> 
						<td style="text-align:center"><b>'.$cs.'</b></td> 
					</tr>';				
			?>
						
		</div>

	</div>

</body>

</html>