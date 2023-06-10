<!DOCTYPE html>
<html>
<head> 
<meta charset="utf-8">
<title>Diary For Me</title>
<link rel="icon" href="./img/favicon.png"/>
<link rel="stylesheet" type="text/css" href="./css/common.css">
<link rel="stylesheet" type="text/css" href="./css/board_form.css">
<link rel="preconnect" href="https://fonts.googleapis.com%22%3E">
<link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Noto+Sans+KR:wght@300;500&display=swap" rel="stylesheet">
<script src="https://kit.fontawesome.com/331cd420b4.js" crossorigin="anonymous"></script>
<script>
  function check_input() {
      if (!document.board_form.subject.value)
      {
          alert("제목을 입력하세요!");
          document.board_form.subject.focus();
          return;
      }
      if (!document.board_form.content.value)
      {
          alert("내용을 입력하세요!");    
          document.board_form.content.focus();
          return;
      }
      document.board_form.submit();
   }

   function readURL(input) {
  			if (input.files && input.files[0]) {
    				var reader = new FileReader();
    				if (input.files[0].type.match('image.*')) { // 이미지 파일인지 확인
      					reader.onload = function(e) {
        				document.getElementById('preview').src = e.target.result;
      			};
     						reader.readAsDataURL(input.files[0]);
   			} 
    				else {
      					alert("이미지 파일만 업로드할 수 있습니다."); // 이미지 파일이 아닌 경우 경고 메시지 표시
      					input.value = ""; // 파일 입력 값 초기화
      					document.getElementById('preview').src = "";
    				}
  			} 		
  			else {
    				document.getElementById('preview').src = "";
  			}
	}
</script>
</head>
<body> 
<header>
    <?php include "header.php";?>
</header> 
<?php
	if (!$userid )
	{
		echo("<script>
				alert('일기쓰기는 로그인 후 이용해주세요!');
				history.go(-1);
				</script>
			");
		exit;
	}
?> 
<section>
   	<div id="board_box">
	    <h3 id="board_title">
	    		일기 쓰기
		</h3>
	    <form  name="board_form" method="post" action="board_insert.php" enctype="multipart/form-data">
	    	 <ul id="board_form">
	    		<li>
	    			<span class="col2"><input name="subject" type="text" placeholder="제목"></span>
	    		</li>	    	
	    		<li id="text_area">	
	    			<span class="col2">
	    				<textarea name="content" placeholder="오늘은 무슨일이 있으셨나요?"></textarea>
	    			</span>
	    		</li>
	    		<li>
			        <span class="col2"><input type="file" name="upfile" onchange="readURL(this)"></span>
			    </li>
			    <li>
			    	<div id = "preview_image">
			    			<img id="preview"/></span>
			    	</div>	
			    </li>
			    <li>
			        <div class="radio-group">
			        		<label for="public-radio">전체 공개</label>
  								<input type="radio" name="public" value="true" id="public-radio" checked>

									<label for="private-radio">비공개</label>
  								<input type="radio" name="public" value="false" id="private-radio">
  							
							</div>
			    </li>
	    	    </ul>
	    	<ul class="buttons">
				<li><button type="button" onclick="location.href='board_list.php'">목록</button></li>
				<li><button type="button" onclick="check_input()">완료</button></li>
			</ul>
	    </form>
	</div> <!-- board_box -->
</section> 
<footer>
    <?php include "footer.php";?>
</footer>
</body>
</html>
