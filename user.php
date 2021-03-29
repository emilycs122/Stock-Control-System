<?php
    include('session.php');
	include('style.php');
	
    if($user_position == "Admin"){
		include('headerAdmin.php');
	}else{
		include('headerStaff.php');
	}
	
	if(isset($_POST['submitbtn'])){
		
		$fname = $_POST['fname'];
		$lname = $_POST['lname'];
		$ic = $_POST['ic'];
		$phone = $_POST['phone'];
		
		$update_user = "UPDATE user SET fName='$fname', lName='$lname', icNum='$ic', phoneNum='$phone' WHERE username = '$user_check'";
		$execute_update = mysqli_query($db,$update_user);
		
		if($execute_update){
			echo "<script type='text/javascript'>alert('Updated successfully! ')</script>";
		}else{
			echo "<script type='text/javascript'>alert('Failed to update! Please try again later');</script>";
		}
	}
	
?>

<!DOCTYPE html>

<html>

<head>
    <title><?php echo $login_session; ?></title>
</head>

<body>

	<div style="font-weight:bold; font-size:28px;" class="a">
		<p>User's Details</p>
	</div>

	<div style = "width:80%; border: solid 2px #333333; border-radius:20px; margin-left:100px;">
	
		<div style = "margin:30px" >
					   
			<form method = "post">
				<div>
					<label class="f">Username  :</label>
					<?php echo $login_session; ?>
					<br /><br />
				</div>
				
				<div>
					<label class="f">First Name  :</label>
					<input type="text" class="box" name="fname" value="<?php echo $user_fName; ?>" >
					
					&emsp; &emsp; &emsp; &emsp; &emsp; &emsp; &nbsp;
					
					<label class="f">Last Name  :</label>
					<input type="text" class="box" name="lname" value="<?php echo $user_lName; ?>" >
					<br /><br />
				</div>
				
				<div>
					<label class="f">IC Number  :</label>
					<input type="text" class="box" name="ic" value="<?php echo $user_IC; ?>" >
					
					&emsp;
					&emsp;
					&emsp;
					
					<label class="f">Phone Number  :</label>
					<input type="text" class="box" name="phone" value="<?php echo $user_phone; ?>" >
					<br /><br />
				</div>
				
				<br/><br/>
				
				<div>
					<label class="f">Position  :</label>
					<?php echo $user_position; ?>
					<br /><br />
				</div>
				
				<div>
					<label class="f">Date created:</label>
					<?php echo $user_date; ?>
					<br/><br/>
				</div>
				
				<p align="right"><input class="btn" type = "submit" name="submitbtn" value = " EDIT "/></p>
				
			</form>
						
		</div>

	</div>

</body>

</html>