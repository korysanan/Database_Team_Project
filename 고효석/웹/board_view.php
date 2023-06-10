<!DOCTYPE html>
<html>
<head> 
<meta charset="utf-8">
<title>Diary For Me</title>
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
			일기장 > 내용보기
		</h3>
<?php
	$id  = $_GET["num"];
	$page  = $_GET["page"];

	$con = mysqli_connect("localhost", "root", "", "dbdbdip");
	$sql = "select * from contents where id=$id";
	$result = mysqli_query($con, $sql);

	$row = mysqli_fetch_array($result);

	 $id          = $row["id"];
     $title        = $row["title"];
     $opening_time  = $row["opening_time"];
     $director  = $row["director"];
     $age_limit         = $row["age_limit"];
     $runnings_time     = $row["running_times"];

	$sql2 = "select * from images where id = '$id'";
    $result2 = mysqli_query($con, $sql2);
    $row = mysqli_fetch_array($result2);
    $image_file = '<img src="data:image/jpeg;base64,'.base64_encode($row['imageData']).'"/>';
?>		
		<!-- 여기서 부터 화면 출력 -->
	    <ul id="view_content">
			<li>
				<span class="col1"><b>제목 :</b> <?=$title?></span>
				<span class="col2"><?=$director?> | <?=$runnings_time."분"?> | <?="나이제한: ".$age_limit?></span>
			</li>
			
			<li>	
				<?php 
					echo $image_file;
				?>	
			<br>
			</li>

			<li>					
				<?=$id?>
			</li>		
	    </ul>
	    
	    <ul class="buttons">
			<?php // 수정과 삭제하기 버튼을 제공	
					echo"<li><button onclick='history.go(-1)''>뒤로가기</button></li>"; //뒤로가기 버튼만 제공
			?>	
		</ul>
	</div> <!-- board_box -->
</section> 
<footer>
    <?php include "footer.php";?>
</footer>
</body>
</html>
