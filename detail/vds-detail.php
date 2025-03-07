<?php
include('session_timeout.php');
if (!isset($_SESSION['username'])) {
	echo "<script>location.replace('../loginpage.php');</script>";
} else {
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
    <link rel="stylesheet" href="../assets/css/equip.css">
    <!--style.css-->
    <link rel="stylesheet" href="../assets/css/style.css">
    <!-- ICONS -->
    <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
    <link rel="icon" type="image/png" sizes="96x96" href="../assets/img/favicon.png">
</head>

<body>
    <!--welcome-hero start -->
    <section id="home" class="welcome-hero">
        <div class="container">

            <div class="search">검색 &nbsp;: <input type="text" class="keyword" placeholder="Search here...">
                <br>

                <?php
                $now = date("Y-m-d-H:i:s");
                echo '<div class= "nowtime"> 현재시간 :' . $now . '</div>'; ?>

            </div>
        </div>
        <table id="allchart" class="tg">
            <thead>
                <tr>
                    <th>
                        <span id=c2>기기 이름</span>
                    </th>
                    <th>
                        <span id=c2>이정</span>
                    </th>
                    <th>
                        <span id=c2>제어기 아이피</span>
                    </th>
                    <th>
                        <span id=c2>작동상태</span>
                    </th>
                </tr>
            </thead>
            <tbody>
                <?php
                //세션에 캐싱 데이터가있으면  그대로사용
                if (isset($_SESSION['cached_data']) && (time() - $_SESSION['cache_time'] < 60)) {
                    echo $_SESSION['cached_data'];
                    exit;
                }
                include_once "../ping.php";
                $res = mysqli_query($conn, "SELECT mName, mMile, mIP, mDirect FROM avc_conf UNION SELECT mName, mMile, mIP, mDirect FROM dsrc_conf UNION SELECT mName, mMile, mIP, mDirect FROM ftms_vds_conf UNION SELECT mName, mMile, mIP, mDirect FROM ttms_vds_conf");
                $data = "";

                while ($row = mysqli_fetch_array($res)) {

                    $imgsrc;
                    $host = $row['mIP'];

                    $result = ping($host);
                    // $result = 1;
                    if ($result === 1) {
                        $imgsrc = "../images/greendot.png";
                    } else {
                        $imgsrc = "../images/reddot.png";

                    }

                    if ($imgsrc === "../images/reddot.png") {
                        $data .= '<tr id="falping" name="pings" class="falping" ><td width = 200px;> ' . $row['mName'] . '</td>' . '<td>' . $row['mMile'] . 'k</td>' . '<td>' . $row['mIP'] . '<td class="connectview"><img id= "connectview" src=' . $imgsrc . '></td>' . '</td></tr>';
                    } else {
                        $data .= '<tr id="allping" name="pings" class="allping"><td width = 200px;>' . $row['mName'] . '</td>' . '<td>' . $row['mMile'] . 'k</td>' . '<td>' . $row['mIP'] . '<td class="connectview"><img id= "connectview" src=' . $imgsrc . '></td>' . '</td></tr>';
                    }


                }

                $_SESSION['cached_data'] = $data;
                $_SESSION['cache_time'] = time();
                echo $data;

                ?>
            </tbody>
        </table>

        </div>

    </section><!--/.welcome-hero-->
    <!-- MAIN -->

    <div class="main">
        <!-- MAIN CONTENT -->
        <div class="main-content">
            <div class="container-fluid">
                <!-- OVERVIEW -->
            </div>

        </div>
    </div>
    <!-- END MAIN CONTENT -->
    <!-- END MAIN -->

    <!-- END WRAPPER -->
    <!-- Javascript -->

    <script src="../assets/js/jquery.js"></script>
    <script src="../assets/js/jquery.counterup.min.js"></script>
    <script src="../assets/js/slick.min.js"></script>
    <script src="../assets/js/feather.min.js"></script>
    <script src="../assets/js/custom.js"></script>

</body>

</html>