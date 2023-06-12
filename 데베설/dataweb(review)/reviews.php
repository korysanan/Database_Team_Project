<!DOCTYPE html>
<html>
<head> 
<meta charset="utf-8">
<title>DBDBDIB</title>
<link rel="icon" href="./img/favicon.png"/>
<link rel="stylesheet" type="text/css" href="./css/common.css">
<link rel="stylesheet" type="text/css" href="./css/reviews.css">
<link rel="preconnect" href="https://fonts.googleapis.com%22%3E">
<link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Noto+Sans+KR:wght@300;500&display=swap" rel="stylesheet">
<script src="https://kit.fontawesome.com/331cd420b4.js" crossorigin="anonymous"></script>
<script>

	function not_empty()
	{
		if(!document.review_insert_form.review_content.value)
		{
			alert("리뷰를 입력하세요!");
			document.review_insert_form.review_content.focus();
			return false;
		}
		return true;
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
				alert('로그인을 해야 읽을 수 있습니다!!');
				history.go(-1);
				</script>
			");
		exit;
	}
	$id  = $_GET["num"];
	$page  = $_GET["page"];

	$con = mysqli_connect("localhost", "root", "", "dbdbdib");
	$sql = "select * from contents where id=$id";
	$result = mysqli_query($con, $sql);
	$row = mysqli_fetch_array($result);
	$title = $row["title"];
?>  
<section>
   	<div id="board_box">
	    <h3 class="title">
			리뷰 > <?=$title?>
		</h3>
		<ul id="review_insert">
			<form name="review_insert_form" method="post" action="review_insert.php?&title=<?=$title?>&page=<?=$page?>&num=<?=$id?>" onsubmit="return not_empty();">
				<textarea id="textarea1"  name="review_content"></textarea>
				<input type="submit" value="확인">
			</form>
		</ul>
		<ul id=review_contents>
		<?php
			$sql = "select * from reviews where contents_title='$title' order by postDate desc";
			$result = mysqli_query($con, $sql);
			$like = array();
			while($row=mysqli_fetch_array($result))
			{
				$i=0;
				$postNumber = $row["postNumber"];
				$user_nickname = $row["user_nickname"];
				$contents_title = $title;
				$reviewContent = $row["reviewContent"];
				$postDate = $row["postDate"];
				$likes = $row["likes"];
				$dislikes = $row["dislikes"];

				$like[$i]=$postNumber;
				$i++;
				$sql = "select * from members where user_nickname='$user_nickname'";
				$result2 = mysqli_query($con, $sql);
				$row2 = mysqli_fetch_array($result2);
				$user_id = $row2["user_id"];
				$length = strlen($user_id);
				$temp_user_id =  mb_substr($user_id, 0, $length/2);
				for($i=$length/2;$i<$length;$i++)
				{
					$temp_user_id .="*";
				}
		?>
			<li>
				<span class="col1"><?=$user_nickname."(".$temp_user_id.")"?></span>
				<span class="col2"><?=$reviewContent?></span>
				<span class="col3"><?=$postDate?>
				<?php 
					if($username==$user_nickname)
					{
				?>
					<a href="review_delete.php?&postNumber=<?=$postNumber?>&num=<?=$id?>&page=<?=$page?>"><button>삭제</button></a>
				<?php
					}
					else
					{
				?>
					<form name="form1" method="post">
					<input id="like_btn" type="submit" name="<?=$postNumber.'like'?>" value="좋아요! : <?=$likes?>">
					<?php
						if(isset($_POST["{$postNumber}like"]))
						{
							$like_check=$userid.$postNumber."_like";
							if(!(isset($_COOKIE[$like_check])))
							{
								$new_likes = $likes+1;
								$sql="update reviews set likes=$new_likes where postNumber=$postNumber";
								mysqli_query($con, $sql);
								setcookie("$like_check", true, time()+(60*60*24*365));
								echo "<script> history.go(0)</script>";
							}
						}
					?>
					<input id="dislike_btn" type="submit" name="<?=$postNumber.'dislike'?>" value="싫어요! : <?=$dislikes?>">
					<?php
						if(isset($_POST["{$postNumber}dislike"]))
						{
							$dislike_check=$userid.$postNumber."_dislike";
							if(!(isset($_COOKIE[$dislike_check])))
							{
								$new_dislikes = $dislikes+1;
								$sql="update reviews set dislikes=$new_dislikes where postNumber=$postNumber";
								mysqli_query($con, $sql);
								setcookie("$dislike_check", true, time()+(60*60*24*365));
								echo "<script> history.go(0)</script>";
							}
						}
					?>
						</form>
					<?php } ?>

				</span>
			</li>
		<?php
			}
		?>
		</ul>
	    <ul class="buttons">
				<a href=contents_view.php?num=<?=$id?>&page=<?=$page?>><li><button>뒤로가기</button></li>
	
		</ul>
	</div> <!-- board_box -->
</section> 
<footer>
    <?php include "footer.php";?>
</footer>
</body>
</html>