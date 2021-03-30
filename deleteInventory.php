<?php
    include('session.php');
    include('headerAdmin.php');
	include('style.php');
	
?>


<!DOCTYPE html>

<html>

<head>
    <title>Delete Product</title>
</head>

<body>

	<div style="font-weight:bold; font-size:28px;" class="a">
		<p>Products</p>
	</div>
	
	<form>
	<div style = "width:700px; border: solid 2px #333333; border-radius:20px; margin-left:100px;">
	
		<div style = "margin:30px" >
					   
			<?php 
				$query = "SELECT * FROM stock ORDER BY itemName ASC";

				echo '<table border="0" cellspacing="6" cellpadding="3"> 
					  <tr>
						  <td><b>No.</b></td> 
						  <td><b>Item Name</font></td> 
						  <td><b>Current Stock</b></td> 
						  <td><b> </b></td> 
					  </tr>';
			
				
				if ($result = mysqli_query($db, $query)) {
					$cc = 1;
					while ($row = $result->fetch_assoc()) {
						$name = $row["itemName"];
						$stock = $row["stockAmount"];
						
						echo '<tr> 
								  <td style="text-align:center">'.$cc.'</td> 
								  <td>'.$name.'</td> 
								  <td>'.$stock.'</td>  
								  <td style="text-align:center"><a href="deleteprocess.php?itemName='.$name.'">Delete</a></td> 
							  </tr>';
						$cc++;
					}
					$result->free();
				} 
			?>
						
		</div>

	</div>
	</form>

</body>

</html>