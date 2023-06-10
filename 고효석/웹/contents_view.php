<!DOCTYPE html>
<html>
<head> 
<meta charset="utf-8">
<title>Diary For Me</title>
<link rel="icon" href="./img/favicon.png"/>
<link rel="stylesheet" type="text/css" href="./css/common.css">
<link rel="stylesheet" type="text/css" href="./css/contents_view.css">
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
     $author	= $row["author"];
     $age_limit         = $row["age_limit"];
     $runnings_time     = $row["running_times"];
     $division	= $row["division"];

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
			
			<li id="image">
				<?php 
					echo  $image_file;
				?>	
			</li>
			<li>
				<span class="col3">제목 : <?=$title?></span>
				<?php if ($division == 'M'){?>
				<span class="col4">개봉일 : <?=$opening_time?></span>
				<?php }else if ($division == 'D'){  ?>
				<span class="col4">방영일 : <?=$opening_time?></span>
				<?php }?>
				<span class="col5">상영시간 : <?=$runnings_time."분"?></span>
				<span class="col7">감독 : <?=$director?></span>
				<span class="col8">작가 : <?=$author?></span>
				<span class="col9">종류 : <?=$division?></span>
				<span class="col10">장르 : 
					<?php
					    $sql = "select genre from contents_genre where id=$id";
						$result2 = mysqli_query($con, $sql); #장르 가져오기
						while($row2 = mysqli_fetch_array($result2))
						{
							$genre = $row2["genre"];
							echo $genre." ";
						}
					?></span>
				<span class="col11">나이 제한 : <?=$age_limit."세 이상"?></span>
				<span class="col12">제한 사유 : 
					<?php
						$sql = "select * from contents_limit where id=$id";
						$result2 = mysqli_query($con,$sql);
						while($row2 = mysqli_fetch_array($result2))
						{
							$limit_reason=$row2["limit_reason"];
							echo $limit_reason." ";
						}
					?></span>
				<span class="col13">플랫폼 : <br>
					<?php
						$sql = "select * from contents_platform where id=$id";
						$result2 = mysqli_query($con,$sql);
						while($row2 = mysqli_fetch_array($result2))
						{
							$platform = "./img/".$row2["platform"].".webp";
							$link = $row2["platform_link"];
					?>
						<a href = "<?=$link?>"><img id="platform" src="<?=$platform?>"></a>
					<?php
						}
					?></span>

			</li>


			<li id="num">					
				<?=$id?>
			</li>		
	    </ul>
	    
	    <ul class="buttons">
			<?php
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
