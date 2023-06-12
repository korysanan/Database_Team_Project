<!DOCTYPE html>
<head>
   <meta charset="utf-8">
   <title>Diary For Me</title>
   <link rel="icon" href="./img/favicon.png"/>
   <link rel="stylesheet" type="text/css" href="./css/common1.css">
   <link rel="stylesheet" type="text/css" href="./css/board_list_for_recent.css">
   <link rel="preconnect" href="https://fonts.googleapis.com%22%3E">
   <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
   <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+KR:wght@300;500&display=swap" rel="stylesheet">
   <script src="https://kit.fontawesome.com/331cd420b4.js" crossorigin="anonymous">
   </script>
   <style>
      h3 {
         padding-left: 5px;
         border-left: solid 5px #828DE2;
      }

   </style>
</head>
<body>
   <header>
     <?php include "header.php";?>
  </header> 
  <br>
  <h3 class="title" style ="margin-top: 30px;  padding: 10px; border-bottom: solid 2px #516e7f; font-size: 20px;position: relative; width: 800px; margin: 0 auto;">
    필터링
 </h3> 

 <form method = "POST" action = "contents_list.php" style = "margin-top: 30px;  padding: 10px; border-bottom: solid 2px #516e7f; font-size: 20px;position: relative; width: 800px; margin: 0 auto;" >
   <div class="col1" style = "font-size: 20px;">개봉시기</div>
   <input type = "date" name = "front_date" value =&lt?php echo $v_testDate ?> ~ <input type = "date" name = "back_date" value =&lt?php echo $v_testDate ?>

   <div class="col1" style = "font-size: 20px;"><br>러닝타임</div>
   <input type = "text" name = "front_running" style="width:100px" placeholder="(분)"> ~ <input type = "text" name = "back_running" style="width:100px" placeholder="(분)">

   <div class="col1" style = "font-size: 20px;"><br>장르</div>
   <div class="checkbox-group">
      <label>액션</label>
      <input type="checkbox" name="genre[]" value="액션">
      <label >코미디</label>
      <input type="checkbox" name="genre[]" value="코미디">
      <label >범죄</label>
      <input type="checkbox" name="genre[]" value="범죄">
   </div>

   <div class="col1"></div>
   <div class="checkbox-group">
      <label>판타지</label>
      <input type="checkbox" name="genre[]" value="판타지">
      <label >역사</label>
      <input type="checkbox" name="genre[]" value="역사">
      <label >공포</label>
      <input type="checkbox" name="genre[]" value="공포">
   </div>

   <div class="col1"></div>
   <div class="checkbox-group">
      <label>가족</label>
      <input type="checkbox" name="genre[]" value="가족">
      <label >음악</label>
      <input type="checkbox" name="genre[]" value="음악">
      <label >스릴러</label>
      <input type="checkbox" name="genre[]" value="스릴러">
   </div>

   <div class="col1"></div>
   <div class="checkbox-group">
      <label>로맨스</label>
      <input type="checkbox" name="genre[]" value="로맨스">
      <label >SF</label>
      <input type="checkbox" name="genre[]" value="SF">
      <label >스포츠</label>
      <input type="checkbox" name="genre[]" value="스포츠">
   </div>

   <div class="col1"></div>
   <div class="checkbox-group">
      <label>전쟁</label>
      <input type="checkbox" name="genre[]" value="전쟁">
      <label >서부</label>
      <input type="checkbox" name="genre[]" value="서부">
      <label >애니</label>
      <input type="checkbox" name="genre[]" value="애니">
   </div>

   <div class="col1"></div>
   <div class="checkbox-group">
      <label>드라마</label>
      <input type="checkbox" name="genre[]" value="드라마">
      <label>다큐</label>
      <input type="checkbox" name="genre[]" value="다큐">
   </div>
   <div class="clear"></div>
   <br>
   <div class="form">
     <div class="col1" style = "font-size: 20px;">플랫폼</div>
     <div class="checkbox-group">
      <label>넷플릭스</label>
      <input type="checkbox" name="platform[]" value="넷플릭스">
      <label>티빙</label>
      <input type="checkbox" name="platform[]" value="티빙">
   </div>
   <div class="col1"></div>
   <div class="checkbox-group">
      <label >웨이브</label>
      <input type="checkbox" name="platform[]" value="웨이브">
      <label >디즈니+</label>
      <input type="checkbox" name="platform[]" value="디즈니+">
   </div>
   <input type="submit" value="확인" style="background-color: #828DE2; width: 20%; padding: 8px 14px; border-top-right-radius: 100px; border-top-left-radius: 100px;
                    border-bottom-right-radius: 100px; border-bottom-left-radius: 100px; font-size: 20px; color: white; margin-left: 25px; text-align: center;">
</form>


</body>
</html>

