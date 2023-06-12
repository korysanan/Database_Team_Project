<?php
  session_start();
  unset($_SESSION["userid"]);
  unset($_SESSION["username"]);
  
  echo("
       <script>
        alert('정상적으로 로그아웃 하였습니다!');
          location.href = 'index.php';
         </script>
       ");
?>
