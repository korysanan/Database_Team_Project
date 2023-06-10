<?php
    $id   = $_POST["id"];
    $pass = $_POST["pass"];
    $name = $_POST["name"];
    $email1  = $_POST["email1"];
    $email2  = $_POST["email2"];

    $email = $email1."@".$email2;

    $regist_day = date("Y-m-d (H:i)");  // 현재의 '년-월-일-시-분'을 저장

              
    $con = mysqli_connect("localhost", "root", "", "dbdbdip");

	$sql = "insert into members(user_nickname, email, user_id, password, recent_access) ";
	$sql .= "values('$name', '$email', '$id', '$pass', '$regist_day')";

	mysqli_query($con, $sql);  // $sql 에 저장된 명령 실행

    $sql = "select * from members where user_id = '$id'";
    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_array($result);

    $user_num = $row["user_num"];
    // 유저 정보를 가져옴

    if(isset($_POST['genre'])){
        for ($i = 0; $i < count($_POST['genre']); $i++){
            $genre = $_POST['genre'][$i];
            $sql = "insert into prefer_genre(user_num, genre) values($user_num, '$genre')";
            mysqli_query($con, $sql);  // $sql 에 저장된 명령 실행

            //장르를 집어 넣음
        }
    }
    if(isset($_POST['platform'])){
        for ($i = 0; $i < count($_POST['platform']); $i++){
            $platform = $_POST['platform'][$i];
            $sql = "insert into join_platform(user_num, platform) values($user_num, '$platform')";
            mysqli_query($con, $sql);  // $sql 에 저장된 명령 실행

        //장르를 집어 넣음
        }
    }   


    mysqli_close($con);     

    /*echo "
	      <script>
	          location.href = 'index.php';
	      </script>
	  ";*/
?>

   
