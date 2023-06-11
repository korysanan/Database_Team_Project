<!DOCTYPE html>
<html>
<head> 
<meta charset="utf-8">
<title>DBDBDIP</title>
<link rel="icon" href="./img/favicon.png"/>
<link rel="stylesheet" type="text/css" href="./css/common1.css">
<link rel="stylesheet" type="text/css" href="./css/contents_list_movie.css">
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
   	<div id="board_box">
   		<div id = "btn_group">
			<button id = "recent_btn" onclick="location.href='contents_list.php'">콘텐츠</button>
			<button id = "hit_btn" onclick="location.href='contents_list_drama.php'">드라마</button>
			<button id = "recommend_btn">영화</button>
		</div>
	    <h3>
	    	영화
		</h3>
	   <ul id="board_list">
				<li>
          <!-- 각각의 게시물 카드 -->
                <?php
                    if (isset($_GET["page"]))
                        $page = $_GET["page"];
                    else
                        $page = 1;

                    $con = mysqli_connect("localhost", "root", "", "dbdbdib");
                    $sql = "select * from contents where division = 'M' order by title asc";
                    $result = mysqli_query($con, $sql);
                    $total_record = mysqli_num_rows($result); // 전체 글 수

                    $scale = 9;
                    // $scale = 1;

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
                   mysqli_data_seek($result, $i);
      // 가져올 레코드로 위치(포인터) 이동
      $row = mysqli_fetch_array($result);
      // 하나의 레코드 가져오기
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
                <li>
                    <div class="card">
                    <a href="contents_view.php?num=<?=$id?>&page=<?=$page?>">
                        <div class="image_file"><?php echo $image_file;?></div>
                        <div class="board_list_block">
                            <div class="row1"><?=$title?></div>
                            <div class="row2">
                                <span class="name">감독 · <?=$director?></span>
                                <span class="hits">나이제한 · <?=$age_limit."세"?></span>
                            </div>
                            <div class="row3"><?=$runnings_time."분"?></div>
                        </div>
                    </a>
                  </div>
                </li>   
            <?php
                $number--;
            }
            mysqli_close($con);
            ?>
				</li>
      </ul>
			<ul id="page_num"> 
	
<?php
	if ($total_page>=2 && $page >= 2)	
	{
		$new_page = $page-1;
		echo "<li><a href='contents_list_movie.php?page=$new_page'>◀ 이전</a> </li>";
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
			echo "<li><a href='contents_list_movie.php?page=$i'> $i </a><li>";
		}
   	}
   	if ($total_page>=2 && $page != $total_page)		
   	{
		$new_page = $page+1;	
		echo "<li> <a href='contents_list_movie.php?page=$new_page'>다음 ▶</a> </li>";
	}
	else 
		echo "<li>&nbsp;</li>";
?>
			</ul> <!-- page -->	    	
	</div> <!-- board_box -->
</section> 
<footer>
    <?php include "footer.php";?>
</footer>
</body>
</html>
