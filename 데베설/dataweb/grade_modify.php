<?php
	$cid=$_GET["cid"];
	$user_num=$_GET["user_num"];
	$grade=$_POST["grade"];

	$con = mysqli_connect("localhost", "root", "", "dbdbdip");
	$sql= "update grade set grade=$grade where Content_ID=$cid and Member_ID=$user_num";
	mysqli_query($con, $sql);
	mysqli_close($con);    
?>
<script>
history.go(-1);</script>