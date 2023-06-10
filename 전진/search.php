<!DOCTYPE html>
<html>
<head> 
<meta charset="utf-8">
<title>Search</title>
<link rel="icon" href="./img/favicon.png"/>
<link rel="stylesheet" type="text/css" href="./css/common1.css">
<link rel="stylesheet" type="text/css" href="./css/board_list_for_recent.css">
<link rel="preconnect" href="https://fonts.googleapis.com%22%3E">
<link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Noto+Sans+KR:wght@300;500&display=swap" rel="stylesheet">
<script src="https://kit.fontawesome.com/331cd420b4.js" crossorigin="anonymous"></script>
</head>
<?php
    $search = $_GET['search'];
?>
<body> 
<header>
    <?php include "header.php";?>
</header> 
<br>
    <div class=search>
        <form name=subsearch method="get" action="search.php" style="text-align:center;margin:auto;" >
            <input class=textform type=text style="text-align:center; margin:auto; width:750px; height:100px; font-size:30px; border-width:10px"  name=search id="search_box" autocomplete="off" placeholder="검색할 항목을 입력하세요." required>
            <input class=submit type=submit value=검색 style="width:104px;height:104px; font-size:30px; border-width:10px ">
        </form>
        <p>
        </p>
    </form>
    </div>
    <h3 class="title" style ="margin-top: 30px;  padding: 10px; border-bottom: solid 2px #516e7f; font-size: 20px;position: relative; width: 800px; margin: 0 auto;">
        검색결과 | <?=$search?>
    </h3> 
<section>
    <div id="board_box">
        <div id = "btn_group">
            <button id = "recent_btn">최신순</button>
            <button id = "hit_btn" onclick="location.href='board_list_for_hit.php'">조회순</button>
            <button id = "recommend_btn" onclick="location.href='board_list_for_recommend.php'">추천순</button>
        </div>
        <h3>
            모두보기
        </h3>
       <ul id="board_list">
                <li>
          <!-- 각각의 게시물 카드 -->
                <?php
                    if (isset($_GET["page"]))
                        $page = $_GET["page"];
                    else
                        $page = 1;

                    $con = mysqli_connect("localhost", "root", "", "dbdbdip");
                    $sql = "SELECT * FROM contents where title LIKE '%$search%' ORDER BY id DESC";
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
                    <a href="board_view.php?num=<?=$id?>&page=<?=$page?>">
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
                    <button id = "input_btn" onclick="location.href='board_form.php'">일기쓰기</button>
<?php
    } else {
?>
                    <a href="javascript:alert('로그인 후 이용해 주세요!')"><button id = "input_btn">일기쓰기</button></a>
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
