<!DOCTYPE html>
<html>
<head> 
<meta charset="utf-8">
<title>DBDBDIB</title>
<link rel="icon" href="./img/favicon.png"/>
<link rel="stylesheet" type="text/css" href="./css/common.css">
<link rel="stylesheet" type="text/css" href="./css/message.css">
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
				alert('로그인 후 이용해주세요!');
				history.go(-1);
				</script>
			");
		exit;
	}
?>  
<section>
   	<div id="message_box">
	    <h3>
<?php
 		if (isset($_GET["page"]))
			$page = $_GET["page"];
		else
			$page = 1;

		$mode = $_GET["mode"];

		if ($mode=="send")
			echo "보낸 쪽지함 > 목록보기";
		else
			echo "받은 쪽지함 > 목록보기";
?>
		</h3>
	    <div>
	    	<ul id="message">
				<li>
					<span class="col1">번호</span>
					<span class="col2">제목</span>
					<span class="col3">
<?php						
						if ($mode=="send")
							echo "받은이";
						else
							echo "보낸이";
?>
					</span>
					<span class="col4">등록일</span>
				</li>
<?php
	$con = mysqli_connect("localhost", "root", "", "DBDBDIB");

	if ($mode=="send")
		$sql = "select * from message where send_id='$userid' order by num desc";
	else
		$sql = "select * from message where rv_id='$userid' order by num desc";

	$result = mysqli_query($con, $sql);
	$total_record = mysqli_num_rows($result); // 전체 글 수

	$scale = 10;

	// 전체 페이지 수($total_page) 계산 
	if ($total_record % $scale == 0)     
		$total_page = floor($total_record/$scale);      
	else
		$total_page = floor($total_record/$scale) + 1; 
 
	// 표시할 페이지($page)에 따라 $start 계산  
	$start = ($page - 1) * $scale;      

	$number = $total_record - $start;

   for ($i=$start; $i<$start+$scale && $i < $total_record; $i++)
   {
      mysqli_data_seek($result, $i);
      // 가져올 레코드로 위치(포인터) 이동
      $row = mysqli_fetch_array($result);
      // 하나의 레코드 가져오기
	  $num    = $row["num"];
	  $subject     = $row["subject"];
     $regist_day  = $row["regist_day"];
     $is_read		= $row["is_read"];

	  if ($mode=="send")
	  	$msg_id = $row["rv_id"];
	  else
	  	$msg_id = $row["send_id"];
	  
	  $result2 = mysqli_query($con, "select user_nickname from members where user_id='$msg_id'");
	  $record = mysqli_fetch_array($result2);
	  $msg_name  = $record["user_nickname"];	  
?>
				<li>
					<?php if($mode == "send"){?>
							<!--보낸 쪽지함인 경우 -->
									<span class="col1"><?=$number?></span>
									<span class="col2" ><a href="message_view.php?mode=<?=$mode?>&num=<?=$num?>"style="color: black"><?=$subject?></a></span>
									<span class="col3"><?=$msg_name?>(<?=$msg_id?>)</span>
									<span class="col4"><?=$regist_day?></span>
									<!--글자색은 무조건 검정색-->
					<?php }
							else{
							// 받은 쪽지함인 경우	
									if($is_read == "true"){?>
									<!--해당 쪽지를 읽었으면-->

									<span class="col1"style="color: gray"><?=$number?></span>
									<span class="col2" ><a href="message_view.php?mode=<?=$mode?>&num=<?=$num?>" style="color: gray"><?=$subject?></a></span>
									<span class="col3" style="color: gray"><?=$msg_name?>(<?=$msg_id?>)</span>
									<span class="col4" style="color: gray"><?=$regist_day?></span>
									<!--글자 색을 회색으로 출력-->

									<?php }
											else{
									?>
									<!--해당 쪽지를 읽지 않았으면-->

									<span class="col1"><?=$number?></span>
									<span class="col2" ><a href="message_view.php?mode=<?=$mode?>&num=<?=$num?>"style="color: black"><?=$subject?></a></span>
									<span class="col3"><?=$msg_name?>(<?=$msg_id?>)</span>
									<span class="col4"><?=$regist_day?></span>
									<!--글자 색을 검정으로 출력-->
									<?php		}
								}
									?>

				</li>	
<?php
   	   $number--;
   }
   mysqli_close($con);
?>
	    	</ul>
			<ul id="page_num"> 	
<?php
	if ($total_page>=2 && $page >= 2)	
	{
		$new_page = $page-1;
		echo "<li><a href='message_box.php?mode=$mode&page=$new_page'>◀ 이전</a> </li>";
	}		
	else 
		echo "<li>&nbsp;</li>";

   	// 게시판 목록 하단에 페이지 링크 번호 출력
   	for ($i=1; $i<=$total_page; $i++)
   	{
		if ($page == $i)     // 현재 페이지 번호 링크 안함
		{
			echo "<li><b> $i </b></li>";
		}
		else
		{
			echo "<li> <a href='message_box.php?mode=$mode&page=$i'> $i </a> <li>";
		}
   	}
   	if ($total_page>=2 && $page != $total_page)		
   	{
		$new_page = $page+1;	
		echo "<li> <a href='message_box.php?mode=$mode&page=$new_page'>다음 ▶</a> </li>";
	}
	else 
		echo "<li>&nbsp;</li>";
?>
			</ul> <!-- page -->	    	
			<ul class="buttons">
				<?php						
						if ($mode=="send"){
				?>

				<li><button onclick="location.href='message_box.php?mode=rv'">받은 쪽지함</button></li>
				<?php						
						}

						else {
				?>

				<li><button onclick="location.href='message_box.php?mode=send'">보낸 쪽지함</button></li>
				<?php						
						}
				?>
						
				<li><button onclick="location.href='message_form.php'">쪽지 보내기</button></li>
			</ul>
	</div> <!-- message_box -->
</section> 
<footer>
    <?php include "footer.php";?>
</footer>
</body>
</html>
