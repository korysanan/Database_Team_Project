<?php

    $postNumber=$_GET["postNumber"];
    $id=$_GET["num"];
    $page=$_GET["page"];
    $con = mysqli_connect("localhost", "root", "", "dbdbdib");
    $sql = "delete from reviews where postNumber=$postNumber";
    mysqli_query($con, $sql);
    mysqli_close($con);

    echo "
	     <script>
	         location.href = 'reviews.php?num=$id&page=$page';
	     </script>
	   ";
?>

