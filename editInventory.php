<?php
    include('session.php');
    include('headerAdmin.php');
	include('style.php');
	
	if($_SERVER["REQUEST_METHOD"] == "POST") {
		// update stock information sent from the input form
      
		$itemName = mysqli_real_escape_string($db,$_POST['itemName']);
		$newName = mysqli_real_escape_string($db,$_POST['newName']);
		$stock = mysqli_real_escape_string($db,$_POST['cStock']);
		$user = $_SESSION['login_user'];
		
		if(strlen($newName) == 0){
		    $nName = $itemName;
		}else{
		    $nName = $newName;
		}
		
		date_default_timezone_set("Asia/Kuching");

        // format the datetime
        $dt = date("Y-m-d h:i:sa");
      
		// check new itemName existed or not
		$check_sql = "SELECT * FROM stock WHERE itemName='$newName'";
		$check = mysqli_query($db, $check_sql);
		
		$c = mysqli_num_rows($check);
		
		// if existed show error message
		if($c == 1){
			echo "<script type='text/javascript'>alert('The item is already existed! Please enter a new name for the item. ');</script>";
		}else{
			$updateStock_sql = "UPDATE stock SET itemName='$nName', stockAmount='$stock', dateTime='$dt', updatedBy='$user' WHERE itemName='$itemName'";
			$result = mysqli_query($db, $updateStock_sql);
		
			if($result) {
				//show successful update message
				$date = date("Y/m/d");
				
				echo "<script type='text/javascript'>
					alert('Updated successfully!! ');
					</script>";
			}else {
				echo "<script type='text/javascript'>alert('Failed to update! ');</script>";
			}
		}
		
		
    }
?>

<!DOCTYPE html>

<html>

<head>
    <title>Edit Product's Details</title>
</head>

<body>

	<div style="font-weight:bold; font-size:28px;" class="a">
		<p>Edit Product</p>
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
					<label class="f">Re-name  :</label>
					<input type = "text" name = "newName" class = "box"/>
					<br /><br />
				</div>
				
				<div>
					<label class="f">Current Stock  :</label>
					<input type = "text" name = "cStock" class = "box"/>
					<br /><br />
				</div>
				
				<p align="right"><input class="btn" type = "submit" name="submitbtn" value = " CONFIRM "/></p>
			</form>
						
		</div>

	</div>

</body>

</html>