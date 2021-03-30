<?php
    include('session.php');
	include('style.php');
	
    if($user_position == "Admin"){
		include('headerAdmin.php');
	}else{
		include('headerStaff.php');
	}
	
	if($_SERVER["REQUEST_METHOD"] == "POST") {
		// add new user information into database
      
		$userName = mysqli_real_escape_string($db,$_POST['newUser']);
		$pwd = mysqli_real_escape_string($db,$_POST['password']);
		$pwd2 = mysqli_real_escape_string($db,$_POST['password2']);
		$fName = mysqli_real_escape_string($db,$_POST['newfName']);
		$lName = mysqli_real_escape_string($db,$_POST['newlName']);
		$IC = mysqli_real_escape_string($db,$_POST['newIC']);
		$phone = mysqli_real_escape_string($db,$_POST['newPhone']);
		$position = mysqli_real_escape_string($db,$_POST['newPosition']);
		
		if($pwd == $pwd2){
			$password = md5($pwd);
			$newUser_sql = "INSERT INTO user(username, password, position, fName, lName, icNum, phoneNum, dateCreated) 
						VALUES ('$userName', '$password', '$position', '$fName', '$lName', '$IC', '$phone', CURRENT_TIMESTAMP)";
			$result = mysqli_query($db,$newUser_sql);
			
			if($result) {
				//show successful update message
				echo "<script type='text/javascript'>alert('Register successfully!');</script>";
			}else {
				echo "<script type='text/javascript'>alert('Failed to create! ');</script>";
			}
			
		}else{
			echo "<script type='text/javascript'>alert('Confirm Password is does not match! Please try again! ');</script>";
		}
    }
	
?>

<!DOCTYPE html>

<html>

<head>
    <title>Register New Account</title>
</head>

<body>

	<div style="font-weight:bold; font-size:28px;" class="a">
		<p>Register New User</p>
	</div>

	<div style = "width:80%; border: solid 2px #333333; border-radius:20px; margin-left:100px;">
	
		<div style = "margin:30px" >
					   
			<form action = "#" method = "post">
				<div>
					<label class="f">Username  :</label>
					<input type="text" id="newUser" name="newUser" class="box"/>
					<br /><br />
				</div>
				
				<div>
					<label class="f">Password  :</label>
					<input type="password" id="password" name="password" class="box"/>
					
					&emsp; &emsp; &emsp; &nbsp;
					
					<label class="f">Confirm Password  :</label>
					<input type="password" id="password2" name="password2" class="box"/>
					<br /><br />
				</div>
				
				<div>
					<label class="f">First Name  :</label>
					<input type="text" id="newfName" name="newfName" class="box"/>
					
					&emsp; &emsp; &emsp;
					
					<label class="f">Last Name  :</label>
					<input type="text" id="newlName" name="newlName" class="box"/>
					<br /><br />
				</div>
				
				<div>
					<label class="f">IC Number  :</label>
					<input type="text" id="newIC" name="newIC" class="box"/>
					
					&emsp;
					&emsp;
					&emsp;
					
					<label class="f">Phone Number  :</label>
					<input type="text" id="newPhone" name="newPhone" class="box"/>
					<br /><br />
				</div>
				
				<br/><br/>
				
				<div>
					<label class="f">Position  :</label>
					<select id="newPosition" name="newPosition" style="background:transparent">
						<option value="Admin">Admin</option>
						<option value="Staff">Staff</option>
					</select>
					<br /><br />
				</div>
				
				
				<p align="right"><input class="btn" type = "submit" name="submitbtn" value = " REGISTER "/></p>
				
			</form>
						
		</div>

	</div>

</body>

</html>