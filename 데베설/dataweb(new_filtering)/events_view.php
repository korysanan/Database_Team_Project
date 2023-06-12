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
			이벤트 > 내용보기
		</h3>
<?php
	$num  = $_GET["num"];
	$page  = $_GET["page"];

	$con = mysqli_connect("localhost", "root", "", "dbdbdib");
	$sql = "select * from event where event_id=$num";
	$result = mysqli_query($con, $sql);

	$row = mysqli_fetch_array($result);
	$event_name  = $row["event_name"];
    $event_start  = substr($row["event_start"], 0, 10); // 표시;
    $event_end  = $row["event_end"];
    $event_detail = $row["event_detail"];
    
?>		
		<!-- 여기서 부터 화면 출력 -->
	    <ul id="view_content">
			<li>
				<span class="col1"><b>이벤트 제목 :</b> <?=$event_name?></span>
				<span class="col2">시작일: <?=$event_start?> | 종료일: <?=$event_end?></span>
			</li>
			<li>
			
			</li>
			
			<li>	
				<?php 
					//if($image_file) echo $image_file;
				?>	
			<br>
			</li>

			<li>					
				<?=$event_detail?>
			</li>		
	    </ul>
	    <ul class="buttons">
				<li><button onclick='history.go(-1)'>뒤로가기</button></li>
		</ul>
	</div> <!-- board_box -->
</section> 
<footer>
    <?php include "footer.php";?>
</footer>
</body>
</html>
