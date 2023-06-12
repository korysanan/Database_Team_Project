<!DOCTYPE html>
<html>
<head> 
<meta charset="utf-8">
<title>DBDBDIB</title>
<link rel="icon" href="./img/favicon.png"/>
<link rel="stylesheet" type="text/css" href="./css/common.css">
<link rel="stylesheet" type="text/css" href="./css/board_view.css">
<link rel="preconnect" href="https://fonts.googleapis.com%22%3E">
<link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Noto+Sans+KR:wght@300;500&display=swap" rel="stylesheet">
<script src="https://kit.fontawesome.com/331cd420b4.js" crossorigin="anonymous"></script>
</head>
<body> 
<header>
    <?php include "header.php";?>
</header>
<?php
	if (!$userid )
	{
		echo("<script>
				alert('로그인을 해야 읽을 수 있습니다!!');
				history.go(-1);
				</script>
			");
		exit;
	}
?>  
<section>
   	<div id="board_box">
	    <h3 class="title">
			게시글 > 내용보기
		</h3>
<?php
	$num  = $_GET["num"];
	$page  = $_GET["page"];

	$con = mysqli_connect("localhost", "root", "", "dbdbdib");
	$sql = "select * from board where num=$num";
	$result = mysqli_query($con, $sql);

	$row = mysqli_fetch_array($result);
	$id      = $row["id"];
	$name      = $row["name"];
	$regist_day = $row["regist_day"];
	$subject    = $row["subject"];
	$content    = $row["content"];
	$file_name    = $row["file_name"];
	$file_type    = $row["file_type"];
	$file_copied  = $row["file_copied"];
	$hit          = $row["hit"];
	$recommend	  = $row["recommend"]; 

    if ($file_type) {
        $image_file = "<img src='./data/{$file_copied}'>";
        }
    else{
    	$image_file = false;
    }   

	$content = str_replace(" ", "&nbsp;", $content);
	$content = str_replace("\n", "<br>", $content);

	$hit_check = $userid.$num."_hit"; 
	$new_hit = $hit;
	
    if(!(isset($_COOKIE[$hit_check]))) { // 쿠키가 없어야만
        $new_hit = $hit + 1;  // 조회수 1 증가 
        $sql = "update board set hit=$new_hit where num=$num";  
        mysqli_query($con, $sql);
        setcookie("$hit_check", true, time() + (60*60*24)); // 24시간동안 조회수 쿠키 생성
      } 
    
?>		
		<!-- 여기서 부터 화면 출력 -->
	    <ul id="view_content">
			<li>
				<span class="col1"><b>제목 :</b> <?=$subject?></span>
				<span class="col2"><?=$name?> | <?=$regist_day?> | <?="조회수: ".$new_hit?></span>
			</li>
			<li>
				<?php
					if($file_name) {
						$real_name = $file_copied;
						$file_path = "./data/".$real_name;
						$file_size = filesize($file_path);

						echo "▷ 첨부파일 : $file_name ($file_size Byte) &nbsp;&nbsp;&nbsp;&nbsp;
			       		<a href='board_download.php?num=$num&real_name=$real_name&file_name=$file_name&file_type=$file_type'>[저장]</a><br><br>";
			           	}
				?>
			</li>
			
			<li>	
				<?php 
					if($image_file) echo $image_file;
				?>	
			<br>
			</li>

			<li>					
				<?=$content?>
			</li>		
	    </ul>
	    <ul>
	    	<form name="form1" method="post">
	    		<div id = "btn_group">	
	    		<input id ="recommend_btn" type="submit" name="recommend" value="추천해요!"> <span class="col1"><?=$recommend?></span>
	    			<?php
	    				if(isset($_POST['recommend'])){
	    						$recommend_check = $userid.$num."_recommend";
								if(!(isset($_COOKIE[$recommend_check]))) { // 쿠키가 없어야만
        							$new_recommend = $recommend + 1;  // 추천이 1 증가 
        							$sql = "update board set recommend=$new_recommend where num=$num";  
        							mysqli_query($con, $sql);
        							setcookie("$recommend_check", true, time() + (60*60*24)); // 24시간동안 쿠키 생성
        							echo "<script> history.go(0)</script>";
      							}
						}		
					?>
				</div>	
			</form>			
	    </ul>	
	    <ul class="buttons">
	    	<?php
	    		if($id == $_SESSION['userid']) // 로그인된 유저와 글 작성자가 같으면
	    		{
	    	?>
				<li><button onclick="location.href='board_modify_form.php?num=<?=$num?>&page=<?=$page?>'">수정</button></li>
				<li><button onclick="location.href='board_delete.php?num=<?=$num?>&page=<?=$page?>'">삭제</button></li>
				<li><button onclick="history.go(-1)">뒤로가기</button></li>
			<?php // 수정과 삭제하기 버튼을 제공
				} 
				else { // 다르다면
					echo"<li><button onclick='history.go(-1)''>뒤로가기</button></li>"; //뒤로가기 버튼만 제공
				}
			?>	
		</ul>
	</div> <!-- board_box -->
</section> 
<footer>
    <?php include "footer.php";?>
</footer>
</body>
</html>
