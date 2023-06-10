 <br> 
        <form name=mainsearch method="get" action="search.php" style="text-align:center;margin:auto;" >
            <input class=textform type=text style="text-align:center; margin:auto; width:750px; height:100px; font-size:30px; border-width:10px"  name=search id="search_box" autocomplete="off" placeholder="검색할 항목을 입력하세요." required>
            <input class=submit type=submit value=검색 style="width:104px;height:104px; font-size:30px; border-width:10px ">
        </form>
      <div id="main_content">
            <div id="latest">
                <h4>최근에 쓰인 일기</h4>
                <ul>
<!-- 최근 게시 글 DB에서 불러오기 -->
<?php
    $con = mysqli_connect("localhost", "root", "", "dm");
    $sql = "select * from board order by num desc limit 10";
    $result = mysqli_query($con, $sql);

    if (!$result)
        echo "게시판 DB 테이블(board)이 생성 전이거나 아직 게시글이 없습니다!";
    else
    {   
        $count = 0;
        while( $row = mysqli_fetch_array($result))
        {   
            if ($row["public"] == "true" && $count < 5){ // 전체 공개가 허용된 게시글만
                $regist_day = substr($row["regist_day"], 0, 10); // 표시
?>
                <li>
                    <span><?=$row["subject"]?></span>
                    <span><?=$row["name"]?></span>
                    <span><?=$regist_day?></span>
                </li>
<?php
                $count++;
            }
        }
    }
?>
            </div>
        </div>

        <div id="main_content">
            <div id="hit">
                <h4>사람들이 많이 본 일기</h4>
                <ul>
<!-- 조회수가 많은 게시 글 DB에서 불러오기 -->
<?php
    $con = mysqli_connect("localhost", "root", "", "dm");
    $sql = "select * from board order by hit desc limit 10";
    $result = mysqli_query($con, $sql);

    if (!$result)
        echo "게시판 DB 테이블(board)이 생성 전이거나 아직 게시글이 없습니다!";
    else
    {
        $count = 0;
        while( $row = mysqli_fetch_array($result))
        {   
            if ($row["public"] == "true" && $count < 5){ // 전체 공개가 허용된 게시글만
?>
                <li>
                    <span><?=$row["subject"]?></span>
                    <span><?=$row["name"]?></span>
                    <span><?="조회수: ".$row["hit"]?></span>
                </li>
<?php
                $count++;
            }
        }
    }
?>
            </div>
        </div>

        <!-- 추천수가 많은 게시 글 DB에서 불러오기 -->
        <div id="main_content">
            <div id="hit">
                <h4>사람들이 많이 추천한 일기</h4>
                <ul>
<?php
    $con = mysqli_connect("localhost", "root", "", "dm");
    $sql = "select * from board order by recommend desc limit 10";
    $result = mysqli_query($con, $sql);

    if (!$result)
        echo "게시판 DB 테이블(board)이 생성 전이거나 아직 게시글이 없습니다!";
    else
    {
        $count = 0;
        while( $row = mysqli_fetch_array($result))
        {   
            if ($row["public"] == "true" && $count < 5){ // 전체 공개가 허용된 게시글만
?>
                <li>
                    <span><?=$row["subject"]?></span>
                    <span><?=$row["name"]?></span>
                    <span><?="추천수: ".$row["recommend"]?></span>
                </li>
<?php
                $count++;
            }
        }
    }
?>
            </div>
        </div>

