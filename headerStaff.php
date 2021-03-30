<!DOCTYPE html>

<html>

<head>
</head>

<body bgcolor = "#FFFFFF">
        <h1 style="text-align:  center; background-color: #c9cfdc;">Sarikei Jakar Shumai Sdn Bhd</h1>
		
		<div style="float:left;" class="dropdown">
			<button class="dropbtn">Stock</button>
			<div class="dropdown-content">
				<a href="stockview.php">View</a>
				<a href="restock.php">Re-stock</a>
				<a href="stocksold.php">Sales</a>
			</div>
		</div>
		
		<div style="float:left;" class="dropdown">
			<button class="dropbtn">Account</button>
			<div class="dropdown-content">
				<a href="user.php"><?php echo $login_session; ?></a>
			</div>
		</div>
		
		<div style="float:right;" class="nav">
			<a>Welcome <?php echo $login_session; ?></a>
			<a class="h" href = "logout.php">(Sign Out)</a>
		</div>
</body>

</html>