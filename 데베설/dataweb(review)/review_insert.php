<meta charset="utf-8">
<?php
    session_start();
    if (isset($_SESSION["userid"])) $userid = $_SESSION["userid"];
    else $userid = "";
    if (isset($_SESSION["username"])) $username = $_SESSION["username"];
    else $username = "";
    
    $con = mysqli_connect("localhost", "root", "", "DBDBDIB");

    $title=$_GET["title"];
    $id=$_GET["num"];
    $page=$_GET["page"];
    $reviewContent=$_POST["review_content"];
    $date=date("Y-m-d H:i:s");
    $sql="insert into reviews(user_nickname,contents_title,reviewContent,postDate)";
    $sql .= "values ('$username','$title','$reviewContent','$date')";
    mysqli_query($con,$sql);

	mysqli_close($con);                // DB 연결 끊기

    echo "<script>
         location.href = 'reviews.php?num=$id&page=$page';
    </script>"
?>
