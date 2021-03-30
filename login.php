<?php
    include("config.php");
    include("style.php");
    session_start();
   
    if(isset($_POST['login_btn'])) {
    // username and password sent from the input form
      
		$myusername = mysqli_real_escape_string($db,$_POST['username']);
		$mypassword = mysqli_real_escape_string($db,$_POST['pass']); 
		  
		$d = md5($mypassword);
		  
		$user_sql = "SELECT * FROM user WHERE username = '$myusername' AND password='$d'";
		$result = mysqli_query($db, $user_sql);		
		
		$c = mysqli_num_rows($result);
		  
				
		if ($c == 1){
			$_SESSION['login_user'] = $myusername;
					
			// The password is correct.
			echo "Login Success";
			header("location: welcome.php");
		}else{
			echo "<script type='text/javascript'>alert('Your Usernsame or Password is invalid! ');</script>";
		}
				
		$result->free();
	  
    }
		

?>

<!DOCTYPE html>

<html>

    <head>
        <meta charset="UTF-8">
        <title>Sarikei Jakar Shumai Sdn Bhd</title>
		
    </head>
	
    <body bgcolor = "#FFFFFF">
        <h1 style="text-align:  center; background-color: #c9cfdc;">Sarikei Jakar Shumai Sdn Bhd</h1>
		<br/>
		<br/>
		<br/>
		
		<div class="notification">
			<a style="color:#800517;">Out of Stock Announcement 缺货通告</a>
			<a id="date" style="color:#800517;">
				<script>
				  n =  new Date();
				  y = n.getFullYear();
				  m = n.getMonth() + 1;
				  d = n.getDate();
				  document.getElementById("date").innerHTML = d + "/" + m + "/" + y;
				</script>
			</a>
			
			
			<?php
			$announce_sql = "SELECT * FROM stock WHERE stockAmount<=15";
			
			if ($announce_result = mysqli_query($db, $announce_sql)) {
					while ($r = $announce_result->fetch_assoc()) {
						$item = $r["itemName"];
						$amount = $r["stockAmount"];
						
						echo '<p>'.$item.'&emsp;/&emsp;'.$amount.' packages. </p>';
					}
					//$result->free();
				} 
			?>
			
		</div>

	
		<div align = "center" style = "float:right; padding-right:10%">
			<div style = "width:300px; border: solid 2px #333333; border-radius:20px; " align = "left">
				<div style = "background-color:#2B3856; color:#FFFFFF; padding:10px; border-top-left-radius:18px; border-top-right-radius:18px;">
					<!---<img src="images/person.png" width="20px" height="20px">--->
					<b>Login</b>
				</div>
					
				<div style = "margin:30px">
				   
				   <form action = "" method = "post">
						<label style = "font-family:Palatino, URW Palladio L, serif">Username  :</label>
							<br/>
							<input type = "text" name = "username" class = "box"/><br /><br />
						<label style = "font-family:Palatino, URW Palladio L, serif">Password  :</label>
							<br/>
							<input type = "password" name = "pass" class = "box" /><br/><br />
					
						<p align="right"><input class="btn" name="login_btn" type="submit" value = " SIGN IN "/></p>
				   </form>
				</div>
			</div>
				
		</div>
        
    </body>
    
</html>
