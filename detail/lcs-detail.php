<?php
session_start();
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
                if (isset($_SESSION['cached_data1']) && (time() - $_SESSION['cache_time1'] < 60)) {
                    echo $_SESSION['cached_data1'];
                    exit;
                }
                include_once "../ping.php";
                $res = mysqli_query($conn, "SELECT mName,mMile,mIP FROM lcs_vms_conf");
                $data1 = "";

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
                        $data1 .= '<tr id="falping" name="pings" class="falping" ><td> ' . $row['mName'] . '</td>' . '<td>' . $row['mMile'] . 'k</td>' . '<td>' . $row['mIP'] . '</td>' . '<td class="connectview"><img id= "connectview" src=' . $imgsrc . '></td> 
                            <td><form action="../func/vnc.php" target="vncWindow" method="post"><input type="hidden" name="serverIP" value="' . $row['mIP'] . '"><button type="submit">원격 보기</button></form></td></tr>';
                    } else {
                        $data1 .= '<tr id="allping" name="pings" class="allping"><td>' . $row['mName'] . '</td>' .
                            '<td>' . $row['mMile'] . 'k</td>' .
                            '<td>' . $row['mIP'] . '</td>' .
                            '<td class="connectview"><img id= "connectview" src=' . $imgsrc . '></td>' .
                            '<td>
                            <form action="../func/vnc.php" target="vncWindow" method="post">
                            <input type="hidden" name="serverIP" value="' . $row['mIP'] . '">
                            <button type="submit">원격 보기</button>
                            </form>
                            </td>
                            </tr>';
                    }



                }

                $_SESSION['cached_data1'] = $data1;
                $_SESSION['cache_time1'] = time();
                echo $data1;

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
    <script>
        function openVlcWindow() {
            // form을 새 창에서 열기 위해 새로운 창 생성
            let vlcWindow = window.open("", "vncWindow", "width=400,height=200");

            // form이 submit될 때 새 창이 `vlc.php`로 이동
            setTimeout(() => {
                if (vlcWindow.location.href === "about:blank") {
                    vlcWindow.location.href = "../func/vnc.php";
                }
            }, 500);
        }
    </script>
</body>

</html>