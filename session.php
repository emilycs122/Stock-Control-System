<?php
   include('config.php');
   session_start();
   
   $user_check = $_SESSION['login_user'];
   
   $ses_sql = mysqli_query($db,"SELECT * FROM user where username = '$user_check' ");
   
   $row = mysqli_fetch_array($ses_sql,MYSQLI_ASSOC);
   
   $login_session = $row['username'];
   $user_position = $row['position'];
   $user_fName = $row['fName'];
   $user_lName = $row['lName'];
   $user_date = $row['dateCreated'];
   $user_IC = $row['icNum'];
   $user_phone = $row['phoneNum'];
   
   if(!isset($_SESSION['login_user'])){
      header("location:login.php");
   }
?>