<?php
session_start();
if (!isset($_SESSION['username'])) {
    echo "<script>location.replace('../login.php');</script>";
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
include "../ping.php";


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
    <link rel="shortcut icon" href="#">
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
        
        <div class="accordion-item">본선 CCTV<button class="accordion-button">펼치기</button>
        <span class="icon">➤</span></div>
            <div id="ftms" class="accordion-content">
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
                                <span id=c2>인코더 아이피</span>
                            </th>
                            <th>
                                <span id=c2>작동상태</span>
                            </th>
                            <th>
                                <span id=c2>실시간화면</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $res = mysqli_query($conn, "SELECT mCameraName,mMile,mEncoderIP,mEncoderCorp FROM ctl_camera_all WHERE mCameraName REGEXP '동산1|동산2|북방1|북방2|북방3|화촌|내촌1|내촌2' or  mEncoderCorp REGEXP '본선'");
                        while ($row = mysqli_fetch_array($res)) {
                            $imgsrc;
                            $host = $row['mEncoderIP'];
                            $result = ping($host);
                            // $result = 1;
                            if ($result === 1) {
                                $imgsrc = "../images/greendot.png";
                            } else {
                                $imgsrc = "../images/reddot.png";
                            }
                            if (stripos($row['mEncoderCorp'], "본선") !== false) {
                                echo '<tr name="pings" class="ftms" ><td> ' . $row['mCameraName'] . '</td>' . '<td>' . $row['mMile'] . 'k</td>' . '<td>' . $row['mEncoderIP'] . '</td>' . '<td class="connectview"><img id= "connectview" src=' . $imgsrc . '></td> 
                            <td><form action="../func/vlc.php" target="vlcWindow" method="post"><input type="hidden" name="rtspUrl" value="' . $row['mEncoderIP'] . '"><button type="submit">보기</button></form></td></tr>';
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <div class="accordion-item">동산1터널 ~ 북방1터널<button class="accordion-button">펼치기</button>
            <span class="icon">➤</span></div>
            <div id="bb1" class="accordion-content">
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
                                <span id=c2>인코더 아이피</span>
                            </th>
                            <th>
                                <span id=c2>작동상태</span>
                            </th>
                            <th>
                                <span id=c2>실시간화면</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $res = mysqli_query($conn, "SELECT mCameraName,mMile,mEncoderIP,mEncoderCorp FROM ctl_camera_all WHERE mCameraName REGEXP '동산1|동산2|북방1|북방2|북방3|화촌|내촌1|내촌2' or  mEncoderCorp REGEXP '본선'");

                        while ($row = mysqli_fetch_array($res)) {
                            $imgsrc;
                            $host = $row['mEncoderIP'];
                            $result = ping($host);
                            // $result = 1;
                            if ($result === 1) {
                                $imgsrc = "../images/greendot.png";
                            } else {
                                $imgsrc = "../images/reddot.png";
                            }
                            if (stripos($row['mCameraName'], "북방1") !== false) {
                                echo '<tr name="pings" class="bb1" ><td> ' . $row['mCameraName'] . '</td>' . '<td>' . $row['mMile'] . 'k</td>' . '<td>' . $row['mEncoderIP'] . '</td>' . '<td class="connectview"><img id= "connectview" src=' . $imgsrc . '></td> 
                            <td><form action="../func/vlc.php" target="vlcWindow" method="post"><input type="hidden" name="rtspUrl" value="' . $row['mEncoderIP'] . '"><button type="submit">보기</button></form></td></tr>';
                            } elseif (stripos($row['mCameraName'], "동산") !== false) {
                                echo '<tr name="pings" class="ds"><td>' . $row['mCameraName'] . '</td>' . '<td>' . $row['mMile'] . 'k</td>' . '<td>' . $row['mEncoderIP'] . '</td>' . '<td class="connectview"><img id= "connectview" src=' . $imgsrc . '></td>' . '<td>                            <form action="../func/vlc.php" target="vlcWindow" method="post">                            <input type="hidden" name="rtspUrl" value="' . $row['mEncoderIP'] . '"> <button type="submit">보기</button></form></td></tr>';
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        
            <div class="accordion-item">북방2터널 ~ 북방3터널<button class="accordion-button">펼치기</button>
            <span class="icon">➤</span></div>
            <div id="bb3" class="accordion-content">
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
                                <span id=c2>인코더 아이피</span>
                            </th>
                            <th>
                                <span id=c2>작동상태</span>
                            </th>
                            <th>
                                <span id=c2>실시간화면</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $res = mysqli_query($conn, "SELECT mCameraName,mMile,mEncoderIP,mEncoderCorp FROM ctl_camera_all WHERE mCameraName REGEXP '동산1|동산2|북방1|북방2|북방3|화촌|내촌1|내촌2' or  mEncoderCorp REGEXP '본선'");
                        while ($row = mysqli_fetch_array($res)) {
                            $imgsrc;
                            $host = $row['mEncoderIP'];
                            $result = ping($host);
                            // $result = 1;
                            if ($result === 1) {
                                $imgsrc = "../images/greendot.png";
                            } else {
                                $imgsrc = "../images/reddot.png";
                            }
                            if (stripos($row['mCameraName'], "북방2") !== false) {
                                echo '<tr name="pings" class="bb2" ><td> ' . $row['mCameraName'] . '</td>' . '<td>' . $row['mMile'] . 'k</td>' . '<td>' . $row['mEncoderIP'] . '</td>' . '<td class="connectview"><img id= "connectview" src=' . $imgsrc . '></td> 
                            <td><form action="../func/vlc.php" target="vlcWindow" method="post"><input type="hidden" name="rtspUrl" value="' . $row['mEncoderIP'] . '"><button type="submit">보기</button></form></td></tr>';
                            } elseif (stripos($row['mCameraName'], "북방3") !== false) {
                                echo '<tr name="pings" class="bb3" ><td> ' . $row['mCameraName'] . '</td>' . '<td>' . $row['mMile'] . 'k</td>' . '<td>' . $row['mEncoderIP'] . '</td>' . '<td class="connectview"><img id= "connectview" src=' . $imgsrc . '></td> 
                                <td><form action="../func/vlc.php" target="vlcWindow" method="post"><input type="hidden" name="rtspUrl" value="' . $row['mEncoderIP'] . '"><button type="submit">보기</button></form></td></tr>';                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        
            <div class="accordion-item">화촌1터널 ~ 화촌8터널<button class="accordion-button">펼치기</button>
            <span class="icon">➤</span></div>
            <div id="hc" class="accordion-content">
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
                                <span id=c2>인코더 아이피</span>
                            </th>
                            <th>
                                <span id=c2>작동상태</span>
                            </th>
                            <th>
                                <span id=c2>실시간화면</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $res = mysqli_query($conn, "SELECT mCameraName,mMile,mEncoderIP,mEncoderCorp FROM ctl_camera_all WHERE mCameraName REGEXP '동산1|동산2|북방1|북방2|북방3|화촌|내촌1|내촌2' or  mEncoderCorp REGEXP '본선'");
                        while ($row = mysqli_fetch_array($res)) {
                            $imgsrc;
                            $host = $row['mEncoderIP'];
                            $result = ping($host);
                            // $result = 1;
                            if ($result === 1) {
                                $imgsrc = "../images/greendot.png";
                            } else {
                                $imgsrc = "../images/reddot.png";
                            }
                            if (stripos($row['mCameraName'], "화촌") !== false && stripos($row['mEncoderCorp'], "본선") === false && stripos($row['mCameraName'], "화촌9") === false) {
                                echo '<tr name="pings" class="hc" ><td> ' . $row['mCameraName'] . '</td>' . '<td>' . $row['mMile'] . 'k</td>' . '<td>' . $row['mEncoderIP'] . '</td>' . '<td class="connectview"><img id= "connectview" src=' . $imgsrc . '></td> 
                            <td><form action="../func/vlc.php" target="vlcWindow" method="post"><input type="hidden" name="rtspUrl" value="' . $row['mEncoderIP'] . '"><button type="submit">보기</button></form></td></tr>';
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <div class="accordion-item">화촌9터널 ~ 내촌2터널<button class="accordion-button">펼치기</button>
            <span class="icon">➤</span></div>
            <div id="hc9" class="accordion-content">
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
                                <span id=c2>인코더 아이피</span>
                            </th>
                            <th>
                                <span id=c2>작동상태</span>
                            </th>
                            <th>
                                <span id=c2>실시간화면</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $res = mysqli_query($conn, "SELECT mCameraName,mMile,mEncoderIP,mEncoderCorp FROM ctl_camera_all WHERE mCameraName REGEXP '동산1|동산2|북방1|북방2|북방3|화촌|내촌1|내촌2' or  mEncoderCorp REGEXP '본선'");
                        while ($row = mysqli_fetch_array($res)) {
                            $imgsrc;
                            $host = $row['mEncoderIP'];
                            $result = ping($host);
                            // $result = 1;
                            if ($result === 1) {
                                $imgsrc = "../images/greendot.png";
                            } else {
                                $imgsrc = "../images/reddot.png";
                            }
                            if (stripos($row['mCameraName'], "화촌9") !== false && stripos($row['mEncoderCorp'], "본선") === false) {
                                echo '<tr name="pings" class="hc9" ><td> ' . $row['mCameraName'] . '</td>' . '<td>' . $row['mMile'] . 'k</td>' . '<td>' . $row['mEncoderIP'] . '</td>' . '<td class="connectview"><img id= "connectview" src=' . $imgsrc . '></td> 
                            <td><form action="../func/vlc.php" target="vlcWindow" method="post"><input type="hidden" name="rtspUrl" value="' . $row['mEncoderIP'] . '"><button type="submit">보기</button></form></td></tr>';
                            } elseif (stripos($row['mCameraName'], "내촌") !== false && stripos($row['mEncoderCorp'], "본선") === false) {
                                echo '<tr name="pings" class="nc"><td>' . $row['mCameraName'] . '</td>' . '<td>' . $row['mMile'] . 'k</td>' . '<td>' . $row['mEncoderIP'] . '</td>' . '<td class="connectview"><img id= "connectview" src=' . $imgsrc . '></td>' . '<td>                            <form action="../func/vlc.php" target="vlcWindow" method="post">                            <input type="hidden" name="rtspUrl" value="' . $row['mEncoderIP'] . '">                            <button type="submit">보기</button>                            </form></td></tr>';
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
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
            let vlcWindow = window.open("", "vlcWindow", "width=400,height=200");

            // form이 submit될 때 새 창이 `vlc.php`로 이동
            setTimeout(() => {
                if (vlcWindow.location.href === "about:blank") {
                    vlcWindow.location.href = "../func/vlc.php";
                }
            }, 500);
        }
    </script>

</body>

</html>