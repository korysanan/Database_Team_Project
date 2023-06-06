<?php
	$conn = mysqli_connect("localhost", "root", "", "test");

	if(isset($_POST['validate'])){
		$generateid = uniqid();
		$imgData = addslashes(file_get_contents($_FILES['images']['tmp_name']));
		$imgProp = getimagesize($_FILES['images']['tmp_name']);

		$image = "INSERT into images(imageType, imageData, imageId) values ('{$imgProp['mime']}', '{$imgData}', '{$generateid}')";

		$result = mysqli_query($conn, $image);

	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
</head>
<body>
		<form action="" 
            method="post"
            enctype="multipart/form-data">

            <input type="file" name="images">
            <input type="submit" name="validate" value="업로드">
      </form>      
</body>
</html>