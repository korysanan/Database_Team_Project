<!DOCTYPE html>
<html>
<head> 
<meta charset="utf-8">
<title>DBDBDIB</title>
<link rel="icon" href="./img/favicon.png"/>
<link rel="stylesheet" type="text/css" href="./css/common.css">
<link rel="stylesheet" type="text/css" href="./css/member.css">
<link rel="preconnect" href="https://fonts.googleapis.com%22%3E">
<link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Noto+Sans+KR:wght@300;500&display=swap" rel="stylesheet">
<script src="https://kit.fontawesome.com/331cd420b4.js" crossorigin="anonymous"></script>

<script>
   function check_input()
   {
      if (!document.member_form.id.value) {
          alert("아이디를 입력하세요!");    
          document.member_form.id.focus();
          return;
      }

      if (!document.member_form.pass.value) {
          alert("비밀번호를 입력하세요!");    
          document.member_form.pass.focus();
          return;
      }

      if (!document.member_form.pass_confirm.value) {
          alert("비밀번호확인을 입력하세요!");    
          document.member_form.pass_confirm.focus();
          return;
      }

      if (!document.member_form.name.value) {
          alert("이름을 입력하세요!");    
          document.member_form.name.focus();
          return;
      }

      if (!document.member_form.email1.value) {
          alert("이메일 주소를 입력하세요!");    
          document.member_form.email1.focus();
          return;
      }

      if (!document.member_form.email2.value) {
          alert("이메일 주소를 입력하세요!");    
          document.member_form.email2.focus();
          return;
      }

      if (document.member_form.pass.value != 
            document.member_form.pass_confirm.value) {
          alert("비밀번호가 일치하지 않습니다.\n다시 입력해 주세요!");
          document.member_form.pass.focus();
          document.member_form.pass.select();
          return;
      }

      document.member_form.submit();
   }

   function reset_form() {
      document.member_form.id.value = "";  
      document.member_form.pass.value = "";
      document.member_form.pass_confirm.value = "";
      document.member_form.name.value = "";
      document.member_form.email1.value = "";
      document.member_form.email2.value = "";
      document.member_form.id.focus();
      return;
   }

   function check_id() {
     window.open("member_check_id.php?id=" + document.member_form.id.value,
         "IDcheck",
          "left=700,top=300,width=350,height=200,scrollbars=no,resizable=yes");
   }
</script>
</head>
<body> 
	<header>
    	<?php include "header.php";?>
    </header>
	<section>
        <div id="main_content">
          <h3>
            <i class="fa-solid fa-star fa-bounce" style="color: #ffe01a;"></i>
            DBDBDIB에 어서오세요!
            <i class="fa-solid fa-star fa-bounce" style="color: #ffe01a;"></i>
          </h3>
      		<div id="join_box">
          	<form  name="member_form" method="post" action="member_insert.php">
			    <h2>회원 가입</h2>
    		    	<div class="form id">
				        <div class="col1">아이디</div>
				        <div class="col2"> <input type="text" name="id"></div>  
				        <div class="col3">
				        	<span class="check" onclick="check_id()">중복확인</span>
				        </div>                 
			       	</div>
			       	<div class="clear"></div>

			       	<div class="form">
				        <div class="col1">비밀번호</div>
				        <div class="col2">
							<input type="password" name="pass">
				        </div>                 
			       	</div>
			       	<div class="clear"></div>
			       	<div class="form">
				        <div class="col1">비밀번호 확인</div>
				        <div class="col2">
							<input type="password" name="pass_confirm">
				        </div>                 
			       	</div>
			       	<div class="clear"></div>
			       	<div class="form">
				        <div class="col1">닉네임</div>
				        <div class="col2">
							<input type="text" name="name">
				        </div>                 
			       	</div>
			       	<div class="clear"></div>
			       	<div class="form email">
				        <div class="col1">이메일</div>
				        <div class="col2">
							<input type="text" name="email1">@<input type="text" name="email2">
				        </div>                 
			       	</div>

              <div class="clear"></div>
              <div class="form">
                <div class="col1">선호장르</div>

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
                  <label >관심없음</label>
                  <input type="checkbox" name="genre[]" value="관심없음">
                </div>

                <div class="clear"></div>
                <div class="form">
                <div class="col1">가입 플랫폼</div>
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


			       	<div class="clear"></div>
			       	<div class="bottom_line"> </div>
			       	<div class="buttons">
                    <li><button onclick="histroy.go(-1)">뒤로 가기</button></li>
                    <li><button onclick="check_input()">회원 가입</button></li>
	           	</div>
           	</form>
        	</div> <!-- join_box -->
        </div> <!-- main_content -->
	</section> 
	<footer>
    	<?php include "footer.php";?>
    </footer>
</body>
</html>

