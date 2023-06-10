<?php
    $userid = $_GET["id"];

    $pass = $_POST["pass"];
    $name = $_POST["name"];
    $email1  = $_POST["email1"];
    $email2  = $_POST["email2"];

    $email = $email1."@".$email2;
          
    $con = mysqli_connect("localhost", "root", "", "dbdbdip");
    $sql    = "select * from members where user_id='$userid'";
    $result = mysqli_query($con, $sql);
    $row    = mysqli_fetch_array($result);

    $user_num = $row['user_num'];

    if(isset($_POST['genre'])){
        $sql = "delete from prefer_genre where user_num = $user_num";
        mysqli_query($con, $sql);

        for ($i = 0; $i < count($_POST['genre']); $i++){
            $genre = $_POST['genre'][$i];
            $sql = "insert into prefer_genre(user_num, genre) values($user_num, '$genre')";
            mysqli_query($con, $sql);  // $sql 에 저장된 명령 실행

            //장르를 집어 넣음
        }
    }
    if(isset($_POST['platform'])){
        $sql = "delete from join_platform where user_num = $user_num";
        mysqli_query($con, $sql);
        
        for ($i = 0; $i < count($_POST['platform']); $i++){
            $platform = $_POST['platform'][$i];
            $sql = "insert into join_platform(user_num, platform) values($user_num, '$platform')";
            mysqli_query($con, $sql);  // $sql 에 저장된 명령 실행
        }
    }   

    mysqli_close($con);     

    echo "
	      <script>
	          location.href = 'index.php';
	      </script>
	  ";
?>

   
