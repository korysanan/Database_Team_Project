<!DOCTYPE html>
<html>
<head> 
<meta charset="utf-8">
<title>DBDBDIB</title>
<link rel="icon" href="./img/favicon.png"/>
<link rel="stylesheet" type="text/css" href="./css/common1.css">
<link rel="stylesheet" type="text/css" href="./css/board_list_for_recent.css">
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
            <button id = "recent_btn">최신순</button>
            <button id = "hit_btn" onclick="location.href='board_list_for_hit.php'">조회순</button>
            <button id = "recommend_btn" onclick="location.href='board_list_for_recommend.php'">추천순</button>
        </div>
        <h3>
            게시글 보기(최신순)
        </h3>
        <ul id="board_list">
                <li>
                    <span class="col1">제목</span>
                    <span class="col2">글쓴이</span>
                    <span class="col4">등록일</span>
                    <span class="col5">조회수</span>
                    <span class="col2">추천수</span>
                </li>
<?php
    if (isset($_GET["page"]))
        $page = $_GET["page"];
    else
        $page = 1;

    $con = mysqli_connect("localhost", "root", "", "DBDBDIB");
    $sql = "select * from board order by num desc";
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
      $num         = $row["num"];
      $id          = $row["id"];
      $name        = $row["name"];
      $subject     = $row["subject"];
      $regist_day  = $row["regist_day"];
      $file_name    = $row["file_name"];
      $file_type    = $row["file_type"];
      $file_copied  = $row["file_copied"];
      $hit         = $row["hit"];
      $recommend     = $row["recommend"];

      if ($file_type == "image/jpeg" || $file_type == "image/png" || $file_type == "image/jpg" || $file_type == "image/gif") {
            $image_file = "<img src='./data/{$file_copied}'>";
       }
      else{
            $image_file = " ";
     }  
?>
                <li>
                    <span class="col1"><a href="board_view.php?num=<?=$num?>&page=<?=$page?>"><?=$subject?></a></span>
                    <span class="col2"><?=$name?></span>
                    <span class="col4"><?=$regist_day?></span>
                    <span class="col5"><?=$hit?></span>
                    <span class="col2"><?=$recommend?></span>
                    <span class="col7"><?=$image_file?></span>
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
        echo "<li><a href='board_list.php?page=$new_page'>◀ 이전</a> </li>";
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
            echo "<li><a href='board_list.php?page=$i'> $i </a><li>";
        }
    }
    if ($total_page>=2 && $page != $total_page)     
    {
        $new_page = $page+1;    
        echo "<li> <a href='board_list.php?page=$new_page'>다음 ▶</a> </li>";
    }
    else 
        echo "<li>&nbsp;</li>";
?>
            </ul> <!-- page -->         
            <ul class="buttons">
                <li>
<?php 
    if($userid) {
?>
                <div id = "btn_group"></div>
                    <button id = "input_btn" onclick="location.href='board_form.php'">게시글쓰기</button>
<?php
    } else {
?>
                    <a href="javascript:alert('로그인 후 이용해 주세요!')"><button id = "input_btn">게시글쓰기</button></a>
<?php
    }
?>
                </li>
            </ul>
    </div> <!-- board_box -->
</section> 
<footer>
    <?php include "footer.php";?>
</footer>
</body>
</html>
