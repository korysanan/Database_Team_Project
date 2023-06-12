<?php
	$cid=$_GET["cid"];
	$user_num=$_GET["user_num"];
	$grade=$_POST["grade"];

	$con = mysqli_connect("localhost", "root", "", "dbdbdib");
	$sql= "insert into grade(Content_ID,Member_ID,grade)";
	$sql .= "values($cid, $user_num, $grade)";
	mysqli_query($con, $sql);
	mysqli_close($con);    
?>
<script>
history.go(-1);</script>