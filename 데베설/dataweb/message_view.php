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
<section>
   	<div id="message_box">
	    <h3 class="title">
<?php
	$mode = $_GET["mode"];
	$num  = $_GET["num"];

	$con = mysqli_connect("localhost", "root", "", "DBDBDIB");
	$sql = "select * from message where num=$num";
	$result = mysqli_query($con, $sql);

	$row = mysqli_fetch_array($result);
	$send_id    = $row["send_id"];
	$rv_id      = $row["rv_id"];
	$regist_day = $row["regist_day"];
	$subject    = $row["subject"];
	$content    = $row["content"];


	$content = str_replace(" ", "&nbsp;", $content);
	$content = str_replace("\n", "<br>", $content);

	if ($mode=="send")
		$result2 = mysqli_query($con, "select user_nickname from members where user_id='$rv_id'");
	else{
		$result2 = mysqli_query($con, "select user_nickname from members where user_id='$send_id'");

		if ($row["is_read"] == "false"){
		$sql = "update message set is_read ='true' where num=$num";
		mysqli_query($con, $sql);


		$sql = "select * from members where user_id='$rv_id'";
		$result = mysqli_query($con, $sql);
		$row = mysqli_fetch_array($result);
		$num_of_message = $row["num_of_message"];
		$num_of_message -= 1;
		$sql = "update members set num_of_message ='$num_of_message' where user_id= '$rv_id'";
		mysqli_query($con, $sql); // 받은 사람의 쪽지 수를 1 빼줌

		}
	}

	$record = mysqli_fetch_array($result2);
	$msg_name = $record["user_nickname"];

	if ($mode=="send")	    	
	    echo "보낸 쪽지함 > 내용보기";
	else
		echo "받은 쪽지함 > 내용보기";
?>
		</h3>
	    <ul id="view_content">
			<li>
				<span class="col1"><b>제목 :</b> <?=$subject?></span>
				<span class="col2"><?=$msg_name?> | <?=$regist_day?></span>
			</li>
			<li>
				<?=$content?>
			</li>		
	    </ul>
	    <ul class="buttons">
				<li><button onclick="location.href='message_box.php?mode=rv'">받은 쪽지함</button></li>
				<li><button onclick="location.href='message_box.php?mode=send'">보낸 쪽지함</button></li>
				<li><button onclick="location.href='message_response_form.php?num=<?=$num?>'">답장하기</button></li>
				<li><button onclick="location.href='message_delete.php?num=<?=$num?>&mode=<?=$mode?>'">삭제</button></li>
		</ul>
	</div> <!-- message_box -->
</section> 
<footer>
    <?php include "footer.php";?>
</footer>
</body>
</html>
