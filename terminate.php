<?php
    include('session.php');
    include('headerAdmin.php');
	include('style.php');
	
	if(isset($_POST['submitbtn'])) {
      
		$IC = mysqli_real_escape_string($db,$_POST['ic']);
		$user = $_SESSION['login_user'];
      
		$newItem_sql = "SELECT * FROM user WHERE icNum='$IC'";
		$result = mysqli_query($db,$newItem_sql);
		
		$check = mysqli_num_rows($result);
		
		if($check > 0) {
			header("location: tResult.php?ic=$IC");
		}else {
			echo "<script type='text/javascript'>alert('ERROR! Record no found!! ');</script>";
		}
    }
?>

<!DOCTYPE html>

<html>

<head>
    <title>Terminate Account</title>
</head>

<body>

	<div style="font-weight:bold; font-size:28px;" class="a">
		<p>Terminate Account</p>
	</div>

	<div style = "width:600px; border: solid 2px #333333; border-radius:20px; margin-left:100px;">
	
		<div style = "margin:30px" >
					   
			<form action = "#" method = "post">
				<div>
					<label class="f">IC Number  :</label>
					<input type="text" id="ic" name="ic" class="box"/>
					<br /><br />
				</div>
				
				<p align="right"><input class="btn" type = "submit" name="submitbtn" value = " SEARCH "/></p>
			</form>
						
		</div>

	</div>

</body>

</html>