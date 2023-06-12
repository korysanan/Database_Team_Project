<?php
    session_start();
    $userid = $_SESSION['userid'];

    $pass = $_POST["pass"];
          
    $con = mysqli_connect("localhost", "root", "", "dbdbdib");
    $sql    = "select * from members where user_id='$userid'";
    $result = mysqli_query($con, $sql);
    $row    = mysqli_fetch_array($result);

    if($pass == $row["password"]){
        $user_num = $row['user_num'];
        $sql   = "select * from prefer_genre where user_num = $user_num";
        $result = mysqli_query($con, $sql);
        $num_genre = mysqli_num_rows($result);

        if($num_genre){
            $sql = "delete from prefer_genre where user_num = $user_num";
            mysqli_query($con, $sql);
        }

        $sql   = "select * from join_platform where user_num = $user_num";
        $result = mysqli_query($con, $sql);
        $num_platform = mysqli_num_rows($result);

        if($num_genre){
        $sql   = "select * from join_platform where user_num = $user_num";
        $result2 = mysqli_query($con, $sql);
        $num_platform = mysqli_num_rows($result2);

        $sql = "delete from join_platform where user_num = $user_num";
        mysqli_query($con, $sql);
       }

        $sql = "delete from members where user_num = $user_num";
        mysqli_query($con, $sql);
        mysqli_close($con);    

        unset($_SESSION["userid"]);
        unset($_SESSION["username"]);

        echo "
    	      <script>
                  alert('회원탈퇴가 완료되었습니다!');
    	          location.href = 'index.php';
    	      </script>
    	  ";
    }
    else{
        echo("<script>
                alert('비밀번호가 다릅니다!!');
                history.go(-1);
                </script>
            ");
        exit;
    }
?>

   
