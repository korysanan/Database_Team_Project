<!DOCTYPE html>
<html>
<head> 
<meta charset="utf-8">
<title>DBDBDIP</title>
<link rel="icon" href="./img/favicon.png"/>
<link rel="stylesheet" type="text/css" href="./css/common1.css">
<link rel="stylesheet" type="text/css" href="./css/contents_list.css">
<link rel="preconnect" href="https://fonts.googleapis.com%22%3E">
<link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Noto+Sans+KR:wght@300;500&display=swap" rel="stylesheet">
<script src="https://kit.fontawesome.com/331cd420b4.js" crossorigin="anonymous"></script>

</head>
<?php
if(!empty($_POST['front_date']))
    $front_date = $_POST['front_date'];
if(!empty($_POST['back_date']))
    $back_date = $_POST['back_date'];
if(!empty($_POST['front_running']))
    $front_running = $_POST['front_running'];
if(!empty($_POST['back_running']))
    $back_running = $_POST['back_running'];
$search=0;
?>
<body> 
<header>
    <?php include "header.php";?>
</header>  
<section>
   	<div id="board_box">
   		<div id = "btn_group">
			<button id = "recent_btn">콘텐츠</button>
			<button id = "hit_btn" onclick="location.href='contents_list_drama.php'">드라마</button>
			<button id = "recommend_btn" onclick="location.href='contents_list_movie.php'">영화</button>
            <button id = "recommend_btn" onclick="location.href='new_filtering.php'">필터링</button>
		</div>
	    <h3>
	    	모두보기
		</h3>
              <h3>
        필터링 내용
    </h3>
    <?php 
    if(!empty($front_date) && !empty($back_date))
        echo "<br>| 개봉시기 : $front_date ~ $back_date \n";
    if(!empty($front_running) && !empty($back_running))
        echo "<br>| 러닝타임 : $front_running (분) ~ $back_running (분)";
    if(isset($_POST['genre'])){
        echo  "<br>| 장르 : ";
        for ($i = 0; $i < count($_POST['genre']); $i++){
            $genre = $_POST['genre'][$i];
            echo " $genre ";
        }
    }
    if(isset($_POST['platform'])){
        echo "<br>| 지원 플랫폼 : ";
        for ($i = 0; $i < count($_POST['platform']); $i++){
            $platform = $_POST['platform'][$i];
            echo " $platform ";
        }
    } 
    ?>
	   <ul id="board_list">
				<li>
          <!-- 각각의 게시물 카드 -->
                <?php
                    if (isset($_GET["page"]))
                        $page = $_GET["page"];
                    else
                        $page = 1;

                    $con = mysqli_connect("localhost", "root", "", "dbdbdib");
        $sql = "SELECT * FROM contents where "; 
        $sql .= "(contents.id != -1) ";
        if(!empty($front_date) && !empty($back_date))
            $sql .= " And opening_time between '$front_date' and '$back_date' ";
        if(!empty($front_running) && !empty($back_running))
            $sql .= " AND running_times  >= $front_running AND running_times <= $back_running ";

        if(isset($_POST['genre'])&&isset($_POST['platform'])){
            $sql = "select * from (contents inner join contents_genre on contents.id=contents_genre.id) inner join contents_platform on contents.id = contents_platform.id where";
            $sql .= "(contents.id != -1) ";
            if(!empty($front_date) && !empty($back_date))
                $sql .= " And opening_time between '$front_date' and '$back_date' ";
            if(!empty($front_running) && !empty($back_running))
                $sql .= " AND running_times  >= $front_running AND running_times <= $back_running ";
            $sql .= " AND (";
            for ($i = 0; $i < count($_POST['genre'])-1; $i++){
                $genre = $_POST['genre'][$i];
                $sql .= "contents_genre.genre = '$genre' or ";
            }
            $genre = $_POST['genre'][count($_POST['genre'])-1];
            $sql .= "contents_genre.genre = '$genre' ) and (";
            for ($i = 0; $i < count($_POST['platform'])-1; $i++){
                $platform = $_POST['platform'][$i];
                $sql .= "contents_platform.platform = '$platform' or ";
            }
            $sql .= "contents_platform.platform = '$platform' )";
        }
        else if(isset($_POST['genre'])){
            $sql = "SELECT * FROM contents inner join contents_genre on contents.id=contents_genre.id where ";
            $sql .= "(contents.id != -1) ";
            if(!empty($front_date) && !empty($back_date))
                $sql .= " And opening_time between '$front_date' and '$back_date' ";
            if(!empty($front_running) && !empty($back_running))
                $sql .= " AND running_times  >= $front_running AND running_times <= $back_running ";
            $sql .= " AND (";
            for ($i = 0; $i < count($_POST['genre'])-1; $i++){
                $genre = $_POST['genre'][$i];
                $sql .= "contents_genre.genre = '$genre' or ";
            }
            $genre = $_POST['genre'][count($_POST['genre'])-1];
            $sql .= "contents_genre.genre = '$genre' ) ";
        }
        else if(isset($_POST['platform'])){
            $sql = "SELECT * FROM contents inner join contents_platform on contents.id=contents_platform.id where ";
            $sql .= "(contents.id != -1) ";
            if(!empty($front_date) && !empty($back_date))
                $sql .= " And opening_time between '$front_date' and '$back_date' ";
            if(!empty($front_running) && !empty($back_running))
                $sql .= " AND running_times  >= $front_running AND running_times <= $back_running ";
            $sql .= " AND (";
            for ($i = 0; $i < count($_POST['platform'])-1; $i++){
                $platform = $_POST['platform'][$i];
                $sql .= "contents_platform.platform = '$platform' or ";
            }
            $platform = $_POST['platform'][count($_POST['platform'])-1];
            $sql .= "contents_platform.platform = '$platform' ) ";
        }
        

        $sql .= "group by contents.id ORDER BY contents.id DESC";
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
		echo "<li><a href='contents_list.php?page=$new_page'>◀ 이전</a> </li>";
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
			echo "<li><a href='contents_list.php?page=$i'> $i </a><li>";
		}
   	}
   	if ($total_page>=2 && $page != $total_page)		
   	{
		$new_page = $page+1;	
		echo "<li> <a href='contents_list.php?page=$new_page'>다음 ▶</a> </li>";
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
