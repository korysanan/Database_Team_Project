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
<h3>평점 주기</h3>
<p>
<?php
   $cid = $_GET["cid"];
   $mid = $_GET["mid"];

   if(!$mid) 
   {
      echo("<li>회원만 평점을 줄 수 있어요!</li>");
   }
   else
   {
      $con = mysqli_connect("localhost", "root", "", "dbdbdip");

      $sql = "select user_num from members where user_id='$mid'";
      $result = mysqli_query($con, $sql);
      $row=mysqli_fetch_array($result);
      $user_num=$row["user_num"];

      $sql = "select * from grade where Content_ID=$cid and Member_ID=$user_num";
      $result = mysqli_query($con, $sql);
      if($row=mysqli_fetch_array($result))
      {
         $grade = $row["grade"];
?>
         <form  method="post" action="grade_modify.php?user_num=<?=$user_num?>&cid=<?=$cid?>">
         <input type = "range" name="grade" min="1" max="10" value="<?=$grade?>" step="1" oninput="result.value=parseInt(grade.value)">
         <output name="result" for="grade"></output>
         <input type = "submit" value="확인">
         </form>
<?php
      }
      else
      {
?>
         <form  method="post" action="grade_insert.php?user_num=<?=$user_num?>&cid=<?=$cid?>" oninput="result.value=parseInt(grade.value)">
         <input type = "range" name="grade" min="1" max="10" value="5" step="0.5">
         <output name="result" for="grade"></output>
         <input type = "submit" value="확인">
         </form>
<?php
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