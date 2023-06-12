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
				location.href = 'index.php';
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

	$con = mysqli_connect("localhost", "root", "", "dbdbdib");
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
				<span class="col4">
				<?php
					if($division == 'M')
						echo "개봉일 : ";
					else
						echo "방영일 : ";
					echo $opening_time;
				?></span>
				<span class="col5">상영시간 : <?=$runnings_time."분"?></span>

				<span onclick="gradeinput()" class="col6">평점 : 
					<?php
						$sql = "select Content_ID, round(avg(grade),1) as grade from grade group by Content_ID having Content_ID=$id";
						$result2 = mysqli_query($con,$sql);
						if($row2 = mysqli_fetch_array($result2))
						{
							$grade=$row2["grade"];
							echo $grade."점";
						}
						else 
						{
							echo "없습니다.";
						}
						
						
					?><button id="gradebutton" onclick="window.open('grade_input.php?cid=<?=$id?>&mid=<?=$userid?>','grade_input', 'left=700,top=300,width=350,height=200,scrollbars=no,resizable=yes')">+</button></span>
				<span class="col7">감독 : <?=$director?></span>
				<span class="col8">작가 : <?=$author?></span>
				<span class="col9">종류 : 
				<?php
					if($division == 'D')
						echo "드라마";
					else
						echo "영화";

				?></span>
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

						$sql="select * from members where user_id='$userid'";
						$result2=mysqli_query($con,$sql);
						if($row2=mysqli_fetch_array($result2))
							{ $user_num=$row2["user_num"]; }
						$sql = "select * from platforms as p right join (select * from contents_platform where id=$id) as cp on p.name=cp.platform left join (select * from join_platform where user_num=$user_num)as jp on p.name=jp.platform order by jp.platform desc, price asc, family_price desc;";

						$result2 = mysqli_query($con,$sql);

						while($row2 = mysqli_fetch_array($result2))
						{
							$platform = $row2["name"];
							$link = $row2["link"];
							$imgpath = "./img/".$platform.".webp";					
					?>
						<a href = "<?=$link?>"><img id="platform" src="<?=$imgpath?>"></a>
					<?php
						}
					?></span>
					<!-- 클릭시 해당 영상의 리뷰 페이지로 이동 하는거 넣으면 좋을듯해서 일단 a태그 걸어둠 --> 
				<span class="col14"><a href = #>리뷰 : 
					<?php
						$sql = "select * from reviews where contents_title='$title' order by likes desc limit 1";
						$result2 = mysqli_query($con,$sql);
						if($row2=mysqli_fetch_array($result2))
						{
							$review  = $row2["reviewContent"];
							echo $review;
						}
						else
						{
							echo "리뷰가 없습니다. 리뷰를 달아주세요!";
						}
					?></a></span>

			</li>


			<li id="num">					
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
