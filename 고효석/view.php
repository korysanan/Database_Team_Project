<?php
	$conn = mysqli_connect("localhost", "root", "", "test");

	if(isset($_GET['image_id'])){
		$id = $_GET['image_id'];

		$sql = "select * from images where id = '$id'";
		$result = mysqli_query($conn, $sql);
		$row = mysqli_fetch_array($result);
		$type = $row['imageType'];
		

		echo '<img src="data:image/jpeg;base64,'.base64_encode($row['imageData']).'"/>';
		echo "안녕";


	}
?>