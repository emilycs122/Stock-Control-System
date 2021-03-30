<?php
    include('session.php');
	include('style.php');
	
    if($user_position == "Admin"){
		include('headerAdmin.php');
	}else{
		include('headerStaff.php');
	}
	
	if($_SERVER["REQUEST_METHOD"] == "POST") {
		date_default_timezone_set("Asia/Kuching");

        // format the datetime
        $dt = date("Y-m-d h:i:sa");
      
		$itemName = mysqli_real_escape_string($db,$_POST['itemName']);
		$amount = mysqli_real_escape_string($db,$_POST['sold']); 
		$user = $_SESSION['login_user'];
      
		$updateStock_sql = "UPDATE stock SET stockAmount=stockAmount-$amount, dateTime='$dt', updatedBy='$user' WHERE itemName='$itemName'";
		$result = mysqli_query($db,$updateStock_sql);
		
		//$sales_check = "SELECT * FROM sales WHERE dateTime=CURRENT_TIMESTAMP and itemName='$itemName'";
		//$check_result = mysqli_query($db, $sales_check);
		//$exist = mysqli_num_rows($check_result);
		
		// checking the stock's record in sales
		/*if($exist>0){
			$sales_update = "UPDATE sales SET sold=sold+$amount, updatedBy='$user' WHERE itemName='$itemName'";
			$ss = mysqli_query($db, $sales_update);
			
			if($result && $ss){
				echo "<script type='text/javascript'>alert('Record sales successfully!');</script>";
			}else{
				$error = "Failed to update!";
			}
		}else{ */
			$sale_sql = "INSERT INTO sales(itemName, sold, dateTime, updatedBy) VALUES ('$itemName','$amount', '$dt','$user')";
			$sale_result = mysqli_query($db, $sale_sql);
			
			if($result && $sale_result) {
				echo "<script type='text/javascript'>alert('Record sales successfully!');</script>";
			}else {
				$error = "Failed to update!";
			}
		//}
		
		
		
		
		
    }
?>

<!DOCTYPE html>

<html>

<head>
    <title>Sales</title>
</head>

<body>

	<div style="font-weight:bold; font-size:28px;" class="a">
		<p>Sales</p>
	</div>

	<div style = "width:600px; border: solid 2px #333333; border-radius:20px; margin-left:100px;">
	
		<div style = "margin:30px" >
					   
			<form action = "#" method = "post">
				<div>
					<label class="f">Item name  :</label>
					<input list="items" name="itemName" id="itemName" style="width: 220px; background-color:transparent;">
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
					<label class="f">Date  :</label>
					<a id="date">
						<script>
						  n =  new Date();
						  y = n.getFullYear();
						  m = n.getMonth() + 1;
						  d = n.getDate();
						  document.getElementById("date").innerHTML = d + "/" + m + "/" + y;
						</script>
					</a>
					<br/><br/>
				</div>
				
				<div>
					<label class="f">Sold  :</label>
					<input type = "number" name = "sold" class = "box"/>
					<label class="f">package(s)</label>
					<br /><br />
				</div>
				
				<p align="right"><input class="btn" type = "submit" name="soldbtn" value = " UPDATE "/></p>
			</form>
						
		</div>

	</div>

</body>

</html>