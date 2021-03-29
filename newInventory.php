<?php
    include('session.php');
    include('headerAdmin.php');
	include('style.php');
	
	if($_SERVER["REQUEST_METHOD"] == "POST") {
	    
	    date_default_timezone_set("Asia/Kuching");

        // format the datetime
        $dt = date("Y-m-d h:i:sa");
      
		$itemName = mysqli_real_escape_string($db,$_POST['newItem']);
		$current_stock = mysqli_real_escape_string($db,$_POST['cstock']);
		$user = $_SESSION['login_user'];
		
		if($current_stock < 0){
			echo "<script type='text/javascript'>alert('Current stock must be positive value! ');</script>";
		}else{
		    $check_exist = mysqli_query($db,"SELECT * FROM stock WHERE itemName='$itemName'");
		    $exist = mysqli_num_rows($check_exist);
		    
		    if($exist > 0){
				echo "<script type='text/javascript'>alert('Item existed already! ');</script>";
			}else{
				$newItem_sql = "INSERT INTO stock(itemName, dateTime, stockAmount, updatedBy) VALUES ('$itemName', '$dt', '$current_stock', '$user')";
			    $result = mysqli_query($db,$newItem_sql);
			        
			    if($result) {			
        			echo "<script type='text/javascript'>alert('Created successfully');</script>";
        		}else {
        			echo "<script type='text/javascript'>alert('Failed to create! ');</script>";
        		}		
		    }
		    
		}
      
    }
?>

<!DOCTYPE html>

<html>

<head>
	<title>Add New Product</title>
</head>

<body>

	<div style="font-weight:bold; font-size:28px;" class="a">
		<p>New Product</p>
	</div>

	<div style = "width:600px; border: solid 2px #333333; border-radius:20px; margin-left:100px;">
	
		<div style = "margin:30px" >
					   
			<form action = "#" method = "post">
				<div>
					<label class="f">Item name  :</label>
					<input type="text" id="newItem" name="newItem" class="box"/>
					<br /><br />
				</div>
				
				<div>
					<label class="f">Current stock  :</label>
					<input type="number" id="cstock" name="cstock" class="box"/>
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
				
				<p align="right"><input class="btn" type = "submit" name="submitbtn" value = " SUBMIT "/></p>
			</form>
						
		</div>

	</div>

</body>

</html>