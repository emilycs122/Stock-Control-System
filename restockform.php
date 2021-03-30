<?php
    include('session.php');
	include('style.php');
	
    if($user_position == "Admin"){
		include('headerAdmin.php');
	}else{
		include('headerStaff.php');
	}
	
	$num = $_GET["num"];
	
	if($_SERVER["REQUEST_METHOD"] == "POST") {
		$loop = 0;
		$itemName = $_POST['itemName'];
		$amount = $_POST['newStock'];
		
		date_default_timezone_set("Asia/Kuching");

        // format the datetime
        $dt = date("Y-m-d h:i:sa");
		
		while($loop < $num){
			
			$iN = $itemName[$loop];
			$amt = $amount[$loop];
			
			$user = $_SESSION['login_user'];
			
			if(strlen($iN)==0){
				echo "<script type='text/javascript'>alert('Item Name cannot be null! ');</script>";
			}else{
				if(strlen($amt)==0){
					echo "<script type='text/javascript'>alert('Amount cannot be null! ');</script>";
				}else{
					if($amt < 0){
						echo "<script type='text/javascript'>alert('Amount must be posititve value! ');</script>";
					}else{
						$updateStock_sql = "UPDATE stock SET stockAmount=stockAmount+$amt, dateTime='$dt', updatedBy='$user' WHERE itemName='$iN'";
						$result = mysqli_query($db,$updateStock_sql);
						
						//$restock_check = "SELECT * FROM stockin WHERE dateTime=CURDATE() and itemName='$itemName'";
						//$check_restock = mysqli_query($db, $restock_check);
						//$exist = mysqli_num_rows($check_restock);
						
						// checking the stock's record in stockin
						/*if($exist>0){
							$stockIn_update = "UPDATE stockin SET restock=restock+$amount, updatedBy='$user' WHERE itemName='$itemName'";
							$rs = mysqli_query($db, $stockIn_update);
							
							if($result && $rs){
								echo "<script type='text/javascript'>alert('Restock successfully!');</script>";
							}else{
								$error = "Failed to update!";
							}
						}else{ */
							$sale_sql = "INSERT INTO stockin(itemName, restock, dateTime, updatedBy) VALUES ('$iN','$amt', '$dt','$user')";
							$sale_result = mysqli_query($db, $sale_sql);
							
							if($result && $sale_result) {
								echo "<script type='text/javascript'>alert('".$iN." restock  successfully!');</script>";
							}else {
								$error = "Failed to update!";
							}
						//}
					}
					
				}
			}
			
			$loop++;
		}
      
		
      
		
    }
?>

<!DOCTYPE html>

<html>

<head>
    <title>Re-stock</title>
</head>

<body>

	<div style="font-weight:bold; font-size:28px;" class="a">
		<p>Re-Stock</p>
	</div>

	<div style = "width:600px; border: solid 2px #333333; border-radius:20px; margin-left:100px;">
	
		<div style = "margin:30px" >
					   
			<form action = "#" method = "post">
			
				<?php
				
				
				for($i=0; $i<$num; $i++){ ?>
					<div>
					<label class="f">Item name  :</label>
					<input list="items" name="itemName[]" id="itemName[]" style="width: 220px; background-color:transparent;">
						<datalist id="items">
							<?php 
							$sql = mysqli_query($db, "SELECT itemName FROM stock ORDER BY itemName ASC");

							while ($row = $sql->fetch_assoc()){

							?>
							<option><?php echo $row['itemName']; ?></option>

							<?php
							// close while loop 
							}
							?>
						</datalist>						
					
					<br /><br />
				</div>
				
				
				<div>
					<label class="f">Re-stock  :</label>
					<input type = "number" name = "newStock[]" class = "box"/>
					<label class="f">package(s)</label>
					<br /><br /><br /><br /><br />
				</div>
				<?php
				}
				?>
			
				<p align="right"><input class="btn" type = "submit" name="submitbtn" value = " UPDATE "/></p>
			</form>
						
		</div>

	</div>

</body>

</html>