<?php
session_start();
if(!isset($_SESSION['username'])) {
    echo "<script>location.replace('login.php');</script>";            
}

else {
    $username = $_SESSION['username'];
    $name = $_SESSION['name'];
} 

$conn = mysqli_connect('localhost', 'root', 'vksek1333');
mysqli_query($conn, "set session character_set_connection=utf8;");
mysqli_query($conn, "set session character_set_results=utf8;");
mysqli_query($conn, "set session character_set_client=utf8;");
mysqli_select_db($conn, 'excctv');
set_time_limit(0);


?>

<!doctype html>
<html lang="en">

<head>
    <!-- 10초마다 페이지 자동 리프레시 코드 -->
    <!-- <script language='javascript'> 
window.setTimeout('window.location.reload()',10000); 
</script> -->
    <title>ITS WEBSITE</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <!-- MAIN CSS -->
    <link rel="stylesheet" href="assets/css/equip.css">
    <!--style.css-->
    <link rel="stylesheet" href="assets/css/style.css">
    <!-- ICONS -->
    <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
    <link rel="icon" type="image/png" sizes="96x96" href="../assets/img/favicon.png">
</head>

<body>
    <!--welcome-hero start -->
    <section id="home" class="welcome-hero">
        <div class="container">
            <div class="search">검색 &nbsp;: <input type="text" class="keyword" placeholder="Search here...">
               <br> 장비 총 개수 : <a class="re-num"></a> &nbsp; <br>
               
                <?php
                $now = date("Y-m-d-H:i:s");
                echo '<div class= "nowtime"> 현재시간 :' . $now . '</div>'; ?>
                
            </div>
            <button id="toggle-soc" class="toggle-socket" onClick="openCloseToc()"> 전체목록 </button>
        </div>

    </section><!--/.welcome-hero-->
    <!-- MAIN -->

    <div class="main">
        <!-- MAIN CONTENT -->
        <div class="main-content">
            <div class="container-fluid">
                <!-- OVERVIEW -->
                <div class="panel panel-headline">
                <!-- <p class="searchres">검색한 장비 개수 </p> <a class="re-num1"></a> -->
                    <table id="allchart" class="tg">
                        <thead>
                            <tr>
                                <th>
                                    <span id=c2>cctv 이름</span>
                                </th>
                                <th>
                                    <span id=c2>이정</span>
                                </th>
                                <th>
                                    <span id=c2>인코더 아이피</span>
                                </th>
                                <th>
                                    <span id=c2>작동상태</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php

                            include_once "ping.php";
                            $res = mysqli_query($conn, "SELECT * FROM dsrc_conf ");

                
                            while ($row = mysqli_fetch_array($res)) {

                                $imgsrc;
                                $host = $row['mDSRCIP'];

                                $result = ping($host);
                            
                                if ($result === 1) {
                                    $imgsrc = "images/greendot.png";
                                } else {
                                    $imgsrc = "images/reddot.png";

                                }

                                if ($imgsrc === "images/reddot.png") {
                                    echo '<tr id="falping" name="pings" class="falping" ><td width = 200px;> ' . $row['mDSRCname'] . '</td>' . '<td>' . $row['mMile'] . 'k</td>' . '<td>' . $row['mDSRCIP'] . '<td class="connectview"><img id= "connectview" src=' . $imgsrc . '></td>' . '</td></tr>';
                                } else {
                                    echo '<tr id="allping" name="pings" class="allping"><td width = 200px;>' . $row['mDSRCname'] . '</td>' . '<td>' . $row['mMile'] . 'k</td>' . '<td>' . $row['mDSRCIP'] . '<td class="connectview"><img id= "connectview" src=' . $imgsrc . '></td>' . '</td></tr>';
                                }
                            }

                            ?>
                        </tbody>
                    </table>

                </div>
            </div>


        </div>
    </div>
    <!-- END MAIN CONTENT -->
    <!-- END MAIN -->

    <!-- END WRAPPER -->
    <!-- Javascript -->
    <script src="assets/js/jquery.js"></script>
    <script src="assets/js/jquery.counterup.min.js"></script>
    <script src="assets/js/slick.min.js"></script>
    <script src="assets/js/feather.min.js"></script>
    <script src="assets/js/custom.js"></script>

</body>

</html>