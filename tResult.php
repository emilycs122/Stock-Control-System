<?php
    include('session.php');
    include('headerAdmin.php');
	include('style.php');
	
		$IC = $_GET['ic'];
	
	if(isset($_POST['submitbtn'])) {
      
		
		//$user = $_SESSION['login_user'];
      
		$terminate_sql = "DELETE FROM user WHERE icNum=$IC";
		$result = mysqli_query($db,$terminate_sql);
		
		if($result) {
			echo "<script type='text/javascript'>alert('Success deleted!! ');</script>";
		}else {
			echo "<script type='text/javascript'>alert('ERROR!! ');</script>";
		}
    }
	
?>

<!DOCTYPE html>

<html>

<head>
    <title>Terminate Result</title>
</head>

<body>

	<div style="font-weight:bold; font-size:28px;" class="a">
		<p>Terminate Account</p>
	</div>

	<div style = "width:850px; border: solid 2px #333333; border-radius:20px; margin-left:100px;">
	
		<div style = "margin:30px" >
					   
			<form action = "#" method = "post">
				<?php 
				
				//$IC = isset($_POST['ic']) ? $_POST['ic'] : "";
			
				
				$query = "SELECT * FROM user WHERE icNum='$IC'";

				echo '<table border="0" cellspacing="6" cellpadding="3"> 
					  <tr>
						  <td><b>User ID</b></td> 
						  <td><b>Username</font></td> 
						  <td><b>Position</b></td> 
						  <td><b>First Name</b></td> 
						  <td><b>Last Name</b></td> 
						  <td><b>IC Number</b></td> 
						  <td><b>Phone Number</b></td> 
						  <td><b>Date Created</b></td> 
					  </tr>';

				if ($result = mysqli_query($db, $query)) {
					while ($row = $result->fetch_assoc()) {
						$id = $row["userID"];
						$uname = $row["username"];
						$pos = $row["position"]; 
						$fn = $row["fName"]; 
						$ln = $row["lName"]; 
						$icnum = $row["icNum"]; 
						$phone = $row["phoneNum"]; 
						$date = $row["dateCreated"]; 

						echo '<tr> 
								  <td style="text-align:center">'.$id.'</td> 
								  <td>'.$uname.'</td> 
								  <td>'.$pos.'</td> 
								  <td>'.$fn.'</td> 
								  <td>'.$ln.'</td> 
								  <td>'.$icnum.'</td> 
								  <td>'.$phone.'</td> 
								  <td>'.$date.'</td> 
								  <td align="right"><input class="btn" type = "submit" name="submitbtn" value = " DELETE "/></td>
							  </tr>';
					}
					$result->free();
				} 
			?>
				
			</form>
						
		</div>

	</div>

</body>

</html>