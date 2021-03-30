<?php
    include('session.php');
	include('headerAdmin.php');
	include('style.php');
	
	if(isset($_POST['search_btn'])) {
		
		$start = date('Y-m-d', strtotime($_POST['start']));
		$end = date('Y-m-d', strtotime($_POST['end']));
		
		header("location: monthlyreport.php?start=$start&end=$end");
    }
?>


<!DOCTYPE html>

<html>

<head>
    <title>Monthly Report</title>
</head>

<body>

	<div style="font-weight:bold; font-size:28px;" class="a">
		<p>Monthly Report</p>
		
		<form action = "#" method = "post">
			<a>Start date: </a>
			<input type="date" name="start" id="start" required>
			&emsp;
			
			<a>End date: </a>
			<input type="date" name="end" id="end" required>
			&emsp;
			<button type="submit" id="search_btn" name="search_btn" class="btn">SEARCH</button>
		</form>
	</div>

</body>

</html>