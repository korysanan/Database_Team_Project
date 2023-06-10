<!DOCTYPE html>
<head>
<meta charset="utf-8">
<title>Diary For Me</title>
<link rel="icon" href="./img/favicon.png"/>
<style>
h3 {
   padding-left: 5px;
   border-left: solid 5px #828DE2;
}
#close {
   width: 200px;
   height: 50px;
   margin:20px 0 0 80px;
   cursor:pointer;
}

#close button{
   width: 100px;
   
   border-top-right-radius: 5px;
   border-top-left-radius: 5px;
   border-bottom-right-radius: 5px;
   border-bottom-left-radius: 5px;
   background-color: #828DE2;
   border: 1px solid #828DE2;
   color: white; 
   font-size: 15px;
}

#close button:hover { 
   background-color: white;
   border: 1px solid #828DE2;
   color: #828DE2;
   }
</style>
</head>
<body>
<h3>아이디 중복체크</h3>
<p>
<?php
   $id = $_GET["id"];

   if(!$id) 
   {
      echo("<li>아이디를 입력해 주세요!</li>");
   }
   else
   {
      $con = mysqli_connect("localhost", "root", "", "DM");

 
      $sql = "select * from members where id='$id'";
      $result = mysqli_query($con, $sql);

      $num_record = mysqli_num_rows($result);

      if ($num_record)
      {
         echo "<li>".$id." 아이디는 중복됩니다.</li>";
         echo "<li>다른 아이디를 사용해 주세요!</li>";
      }
      else
      {
         echo "<li>".$id." 아이디는 사용 가능합니다.</li>";
      }
    
      mysqli_close($con);
   }

?>
</p>
<div id="close">
   <button onclick="javascript:self.close()">닫기</button>
</div>
</body>
</html>

