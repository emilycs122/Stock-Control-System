<?php
    include('session.php');
	include('style.php');
	
    if($user_position == "Admin"){
		include('headerAdmin.php');
	}else{
		include('headerStaff.php');
	}
	
	if($_SERVER["REQUEST_METHOD"] == "POST") {
		$n = mysqli_real_escape_string($db,$_POST['num']); 
		
		if($n < 0){
			echo "<script type='text/javascript'>alert('Amount must be posititve value! ');</script>";
		}else{
			header("location: restockform.php?num=$n");
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
				<div>
					<label class="f">How many items need to be restocked?  :</label>
					<input type="number" name="num" id="num" style="width: 220px; background-color:transparent;">
					<br /><br />
				</div>
				
				
				<p align="right"><input class="btn" type = "submit" name="submitbtn" value = " NEXT "/></p>
			</form>
						
		</div>

	</div>

</body>

</html>