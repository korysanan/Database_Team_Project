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
<script type="text/javascript" src="./js/member_modify.js"></script>
</head>
<body> 
	<header>
    	<?php include "header.php";?>
    </header>
<?php    
   	$con = mysqli_connect("localhost", "root", "", "dbdbdib");
    $sql    = "select * from members where user_id='$userid'";
    $result = mysqli_query($con, $sql);
    $row    = mysqli_fetch_array($result);

    $pass = $row["password"];
    $name = $row["user_nickname"];

    $email = explode("@", $row["email"]);
    $email1 = $email[0];
    $email2 = $email[1];

    mysqli_close($con);
?>
	<section>
        <div id="main_content">
      		<div id="join_box">
          	<form  name="member_form" method="post" action="member_modify.php?id=<?=$userid?>">
			    <h2>내 정보수정</h2>
    		    	<div class="form id">
				        <div class="col1">아이디</div>
				        <div class="col2">
							<?=$userid?>
				        </div>                 
			       	</div>
			       	<div class="clear"></div>

			       	<div class="form">
				        <div class="col1">비밀번호</div>
				        <div class="col2">
							<input type="password" name="pass" value="<?=$pass?>">
				        </div>                 
			       	</div>
			       	<div class="clear"></div>
			       	<div class="form">
				        <div class="col1">비밀번호 확인</div>
				        <div class="col2">
							<input type="password" name="pass_confirm" value="<?=$pass?>">
				        </div>                 
			       	</div>
			       	<div class="clear"></div>
			       	<div class="form">
				        <div class="col1">이름</div>
				        <div class="col2">
							<input type="text" name="name" value="<?=$name?>">
				        </div>                 
			       	</div>
			       	<div class="clear"></div>
			       	<div class="form email">
				        <div class="col1">이메일</div>
				        <div class="col2">
							<input type="text" name="email1" value="<?=$email1?>">@<input 
							       type="text" name="email2" value="<?=$email2?>">
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
                    	<li><button onclick="check_input()">수정 하기</button></li>
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

