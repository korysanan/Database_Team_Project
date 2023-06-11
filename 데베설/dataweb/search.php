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
    <script src="https://kit.fontawesome.com/331cd420b4.js" crossorigin="anonymous">
    </script>
</head>
<?php
        $search = $_GET['search'];
        $front_date = $_POST['front_date'];
        $front_date =" ";
        $back_date = $_POST['back_date'];
        $front_running = $_POST['front_running'];
        $back_running = $_POST['back_running'];
?>

<body> 
    <header>
        <?php include "header.php";?>
    </header> 
    <script>
        function Filtering() {
           window.open("filtering.php", + document.member_form.id.value,
              "left=700,top=300,width=750,height=500,scrollbars=no,resizable=yes");
       }
   </script>
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
<h3 class="title" style ="margin-top: 30px;  padding: 10px; border-bottom: solid 2px #828DE2; font-size: 20px;position: relative; width: 800px; margin: 0 auto;">
    검색결과 | <?=$search?>
</h3> 
<h3 class="title" style ="margin-top: 30px;  padding: 10px; border-bottom: solid 2px #828DE2; font-size: 20px;position: relative; width: 800px; margin: 0 auto;">
    필터링 내용  
    <?php 
    if(($front_date)!= NULL && $back_date !=NULL)
        echo "<br>| 개봉시기 : $front_date ~ $back_date \n";
    if(($front_running)!= NULL && $back_running !=NULL)
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
</h3> 
<section>
    <div id="board_box">
        <br>
        <form  name="member_form" method="post" action="<?php echo $_SERVER [ 'PHP_SELF' ];?>">
            <span class="Filtering" onclick="location.href='filtering.php?search=<?=$search?>'" style="background-color: #828DE2; width: 20%; padding: 8px 14px; border-top-right-radius: 100px; border-top-left-radius: 100px;
            border-bottom-right-radius: 100px; border-bottom-left-radius: 100px; font-size: 20px; color: white; margin-left: 25px; text-align: center;">필터링</span>
        </form>

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

            $con = mysqli_connect("localhost", "root", "", "dbdbdib");
            $sql = "SELECT * FROM contents where "; 
            $sql .= "title LIKE '%$search%' or  director LIKE '%$search%' or author LIKE '%$search%' ";
            if(($front_date)!= NULL && $back_date !=NULL)
                $sql .= " AND DATE_FORMAT(opening_time, '%Y-%m-%d') > DATE_FORMAT( '$front_date', '%Y-%m-%d') AND DATE_FORMAT(opening_time, '%Y-%m-%d') < DATE_FORMAT( '$back_date', '%Y-%m-%d') ";
            if(($front_running)!= NULL && $back_running !=NULL)
                $sql .= " AND running_times  >= $front_running AND running_times <= $back_running ORDER BY id DESC";
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
