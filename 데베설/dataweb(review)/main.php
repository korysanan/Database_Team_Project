<br>
<style>
    .textform {
       border-color: #A07FF1;
    }

    .submit {
        border-color: #A07FF1;
    }
</style> 
        <form name=mainsearch method="get" action="search.php" style="text-align:center;margin:auto;" >
            <input class=textform type=text style="text-align:center; margin:auto; width:750px; height:100px; font-size:30px; border-width:10px"  name=search id="search_box" autocomplete="off" placeholder="검색할 항목을 입력하세요." required >
            <input class=submit type=submit value=검색 style="width:104px;height:104px; font-size:30px; border-width:10px ">
        </form>
      <div id="board_box">
        <h3>
            오늘의 추천작
        </h3>
            <ul id="board_list">
                
          <?php 
                $first = "first";
                $second = "second";
                $third = "third";
                $temp = range(0, 61);
                shuffle($temp);
                $data = array_slice($temp, 0, 3);

                if (!isset($_COOKIE[$first])) {
                    $num = mt_rand(1, 61);
                    setcookie($first, $num, time() + (60*60*24));
                }

                if (!isset($_COOKIE[$second])) {
                    $num = mt_rand(1, 61);
                    setcookie($second, $num, time() + (60*60*24));
                }

                if (!isset($_COOKIE[$third])) {
                    $num = mt_rand(1, 61);
                    setcookie($third, $num, time() + (60*60*24));
                }

                $con = mysqli_connect("localhost", "root", "", "dbdbdib");
                $sql = "select * from contents order by title asc";
                $result = mysqli_query($con, $sql);
                $total_record = mysqli_num_rows($result); // 전체 글 수 

                $array = array("first", "second", "third");
                for ($i= 0; $i<3; $i++)
                {
                    mysqli_data_seek($result, $_COOKIE[$array[$i]]);
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
                            
                                    <div class="card">
                                    <a href="contents_view.php?num=<?=$id?>&page=0">
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
                          
                            <?php
                            }
                            mysqli_close($con);
                            ?>
                                
                      </ul>
                </div>
        <div id="main_content">
            <div id="latest">
                <h4>최근에 쓰인 게시글</h4>
                <ul>
                    <!-- 최근 게시 글 DB에서 불러오기 -->
                    <?php
                        $con = mysqli_connect("localhost", "root", "", "dbdbdib");
                        $sql = "select * from board order by num desc limit 10";
                        $result = mysqli_query($con, $sql);

                        if (!$result)
                            echo "아직 게시글이 없습니다!";
                        else
                        {   
                            $count = 0;
                            while( $row = mysqli_fetch_array($result))
                            {   
                                if ($count < 5){
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

