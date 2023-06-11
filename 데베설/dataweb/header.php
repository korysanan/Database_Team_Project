<?php
    session_start();
    $num_of_messege = 0;

    if (isset($_SESSION["userid"])) $userid = $_SESSION["userid"];
    else $userid = "";
    if (isset($_SESSION["username"])) $username = $_SESSION["username"];
    else $username = "";

?>		
        <div id="top">
            <h3>
                <i class="fa-solid fa-mug-hot"></i>
                <a href="index.php">DBDBDIB</a>
            </h3>
            <ul id="top_menu">  

<?php
    if(!$userid) {
?>                
                <li><a href="member_form.php">회원 가입</a> </li>
                <li> | </li>
                <li><a href="login_form.php">로그인</a></li>
                
<?php
    } else {
                $logged = $username."(".$userid.")님";
                $con = mysqli_connect("localhost", "root", "", "dbdbdib");
                $sql = "select * from members where user_id='$userid'";
                $result = mysqli_query($con, $sql);
                $row = mysqli_fetch_array($result);
                $num_of_messege = $row["num_of_messege"]; // 사용자의 안 읽은 쪽지수를 가졋와서
?>
                <li><?=$logged?> </li>
                <li> | </li>
                <li><a href="logout.php">로그아웃</a> </li>
                <li> | </li>
                <li><a href="member_modify_form.php">정보 수정</a></li>
                <li> | </li>
                <li><a href="member_delete.php">회원 탈퇴</a></li>
<?php
    }
?>

         </ul>
        </div>
        <div id="menu_bar">
            <ul> 
                <li><a href="contents_list.php">Contents</a></li>
                <li><a href="board_list.php">Boards</a></li>
                <li><a href="board_form.php">Event</a></li>
                <?php if($num_of_messege != 0){
                        // 안읽은 쪽지가 있다면 
                ?>
                <li><a href="message_box.php?mode=rv">Note <i class="fa-solid fa-circle fa-bounce fa-2xs" style="color: #ff0000;"></i></a></li>
                <!--안읽은 쪽지가 있다고 표시해주고-->
                <?php } 
                    else{
                    // 안읽은 쪽지가 없다면 
                ?>
                <li><a href="message_box.php?mode=rv">Note</a></li>
                <!--표시 삭제-->
            <?php }?>
            </ul>
        </div>