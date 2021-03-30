<?php
    include('session.php');
	include('headerAdmin.php');
	include('style.php');
	
	if(isset($_POST['search_btn'])) {
		
		$date_daily = date('Y-m-d', strtotime($_POST['date']));
		
		header("location: dailyreport.php?date=$date_daily");
    }
?>


<!DOCTYPE html>

<html>

<head>
	<style>
	.a{
		padding-top:50px; 
		padding-left:100px;
	}
	
	table{
		border-collapse: collapse;
		width: 100%;
	}
	
	th, td {
	  padding: 8px;
	  text-align: left;
	  border-bottom: 1px solid #ddd;
	}

	tr:hover {background-color:#f5f5f5;}
	
	.btn {
		border-radius: 50px;
		background: #B7CEEC;
		padding: 5px 10px;
		border: 1px solid #2B3856;
		color: #2B3856;
		font-size:14px;
		font-weight:bold;
		-webkit-transition-property: background,color;
		transition-property: background,color;	
	}
				 
	.btn:hover {
		background-color:#000!important;
		color:#fff!important;
		border: solid 4px #000!important;
	}
	</style>
	
	<title>Daily Report</title>
	
</head>

<body>

	<div style="font-weight:bold; font-size:28px;" class="a">
		<p>Daily Report</p>
		
		<form action = "#" method = "post">
			<a>Date: </a>
			<input type="date" name="date" id="date" required>
			&emsp;
			<button type="submit" id="search_btn" name="search_btn" class="btn">SEARCH</button>
		</form>
	</div>

</body>

</html>