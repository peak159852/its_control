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
                <span class="icon">➤</span>
            </div>
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
                        $result = mysqli_query($conn, "SELECT mCameraName,mMile,mEncoderIP,mEncoderCorp FROM ctl_camera_all WHERE mEncoderCorp REGEXP '본선'");

                        $hosts = [];
                        $miles = [];
                        $names = [];
                        $corps = [];
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                $hosts[] = $row['mEncoderIP'];
                                $miles[] = $row['mMile'];
                                $names[] = $row['mCameraName'];
                                $corps[] = $row['mEncoderCorp'];
                            }
                        } else {
                            echo "No hosts found";
                        }

                        // $conn->close();

                        // cURL multi 핸들 생성
                        $multi_handle = curl_multi_init();
                        $curl_handles = [];

                        foreach ($hosts as $index => $host) {
                            // cURL 세션 초기화
                            $curl_handles[$index] = curl_init();

                            // 핑을 위해 호출할 URL 세팅 (여기서 ping.php 파일을 호출합니다)
                            curl_setopt($curl_handles[$index], CURLOPT_URL, "localhost/ping.php?host=" . urlencode($host));
                            curl_setopt($curl_handles[$index], CURLOPT_RETURNTRANSFER, true);

                            // multi 핸들에 추가
                            curl_multi_add_handle($multi_handle, $curl_handles[$index]);
                        }

                        // 요청 실행
                        $running = null;
                        do {
                            curl_multi_exec($multi_handle, $running);
                        } while ($running > 0);

                        // 응답 처리
                        foreach ($curl_handles as $index => $ch) {
                            $response = curl_multi_getcontent($ch);
                            // 핑 결과 출력
                            if ($response === 1) {
                                $imgsrc = "../images/greendot.png";
                            } else {
                                $imgsrc = "../images/reddot.png";

                            }
                            if (stripos($corps[$index], "본선") !== false) {
                                echo '<tr name="pings" ><td> ' . $names[$index] . '</td>' . '<td>' . $miles[$index] . 'k</td>' . '<td>' . $hosts[$index] . '</td>' . '<td class="connectview"><img id= "connectview" src=' . $imgsrc . '></td> 
                                <td><form action="../func/vlc.php" target="vlcWindow" method="post"><input type="hidden" name="rtspUrl" value="' . $hosts[$index] . '"><button type="submit">보기</button></form></td></tr>';
                            }
                            // cURL 핸들 닫기
                            curl_multi_remove_handle($multi_handle, $ch);
                            curl_close($ch);
                        }

                        // multi 핸들 종료
                        curl_multi_close($multi_handle);
                        ?>
                    </tbody>
                </table>
            </div>
            <div class="accordion-item">동산1터널 ~ 북방1터널<button class="accordion-button">펼치기</button>
                <span class="icon">➤</span>
            </div>
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
                        $result = mysqli_query($conn, "SELECT mCameraName,mMile,mEncoderIP FROM ctl_camera_all WHERE mCameraName REGEXP '동산1|동산2|북방1'");

                        $hosts = [];
                        $miles = [];
                        $names = [];
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                $hosts[] = $row['mEncoderIP'];
                                $miles[] = $row['mMile'];
                                $names[] = $row['mCameraName'];
                            }
                        } else {
                            echo "No hosts found";
                        }

                        // $conn->close();

                        // cURL multi 핸들 생성
                        $multi_handle = curl_multi_init();
                        $curl_handles = [];

                        foreach ($hosts as $index => $host) {
                            // cURL 세션 초기화
                            $curl_handles[$index] = curl_init();

                            // 핑을 위해 호출할 URL 세팅 (여기서 ping.php 파일을 호출합니다)
                            curl_setopt($curl_handles[$index], CURLOPT_URL, "localhost/ping.php?host=" . urlencode($host));
                            curl_setopt($curl_handles[$index], CURLOPT_RETURNTRANSFER, true);

                            // multi 핸들에 추가
                            curl_multi_add_handle($multi_handle, $curl_handles[$index]);
                        }

                        // 요청 실행
                        $running = null;
                        do {
                            curl_multi_exec($multi_handle, $running);
                        } while ($running > 0);

                        // 응답 처리
                        foreach ($curl_handles as $index => $ch) {
                            $response = curl_multi_getcontent($ch);
                            // 핑 결과 출력
                            if ($response === 1) {
                                $imgsrc = "../images/greendot.png";
                            } else {
                                $imgsrc = "../images/reddot.png";

                            }
                            if (stripos($names[$index], "동산") !== false || stripos($names[$index], "북방1") !== false) {
                                echo '<tr name="pings" ><td> ' . $names[$index] . '</td>' . '<td>' . $miles[$index] . 'k</td>' . '<td>' . $hosts[$index] . '</td>' . '<td class="connectview"><img id= "connectview" src=' . $imgsrc . '></td> 
                                <td><form action="../func/vlc.php" target="vlcWindow" method="post"><input type="hidden" name="rtspUrl" value="' . $hosts[$index] . '"><button type="submit">보기</button></form></td></tr>';
                            }   else {
                                echo 'not found';
                            }
                            // cURL 핸들 닫기
                            curl_multi_remove_handle($multi_handle, $ch);
                            curl_close($ch);
                        }

                        // multi 핸들 종료
                        curl_multi_close($multi_handle);
                        ?>
                    </tbody>
                </table>
            </div>

            <div class="accordion-item">북방2터널 ~ 북방3터널<button class="accordion-button">펼치기</button>
                <span class="icon">➤</span>
            </div>
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
                        $result = mysqli_query($conn, "SELECT mCameraName,mMile,mEncoderIP,mEncoderCorp FROM ctl_camera_all WHERE mCameraName REGEXP '북방2|북방3'");

                        $hosts = [];
                        $miles = [];
                        $names = [];
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                $hosts[] = $row['mEncoderIP'];
                                $miles[] = $row['mMile'];
                                $names[] = $row['mCameraName'];
                            }
                        } else {
                            echo "No hosts found";
                        }

                        // $conn->close();

                        // cURL multi 핸들 생성
                        $multi_handle = curl_multi_init();
                        $curl_handles = [];

                        foreach ($hosts as $index => $host) {
                            // cURL 세션 초기화
                            $curl_handles[$index] = curl_init();

                            // 핑을 위해 호출할 URL 세팅 (여기서 ping.php 파일을 호출합니다)
                            curl_setopt($curl_handles[$index], CURLOPT_URL, "localhost/ping.php?host=" . urlencode($host));
                            curl_setopt($curl_handles[$index], CURLOPT_RETURNTRANSFER, true);

                            // multi 핸들에 추가
                            curl_multi_add_handle($multi_handle, $curl_handles[$index]);
                        }

                        // 요청 실행
                        $running = null;
                        do {
                            curl_multi_exec($multi_handle, $running);
                        } while ($running > 0);

                        // 응답 처리
                        foreach ($curl_handles as $index => $ch) {
                            $response = curl_multi_getcontent($ch);
                            // 핑 결과 출력
                            if ($response === 1) {
                                $imgsrc = "../images/greendot.png";
                            } else {
                                $imgsrc = "../images/reddot.png";

                            }
                            if (stripos($names[$index], "북방2") !== false || stripos($names[$index], "북방3") !== false) {
                                echo '<tr name="pings" ><td> ' . $names[$index] . '</td>' . '<td>' . $miles[$index] . 'k</td>' . '<td>' . $hosts[$index] . '</td>' . '<td class="connectview"><img id= "connectview" src=' . $imgsrc . '></td> 
                                <td><form action="../func/vlc.php" target="vlcWindow" method="post"><input type="hidden" name="rtspUrl" value="' . $hosts[$index] . '"><button type="submit">보기</button></form></td></tr>';
                            }
                            // cURL 핸들 닫기
                            curl_multi_remove_handle($multi_handle, $ch);
                            curl_close($ch);
                        }

                        // multi 핸들 종료
                        curl_multi_close($multi_handle);
                        ?>
                    </tbody>
                </table>
            </div>

            <div class="accordion-item">화촌1터널 ~ 화촌8터널<button class="accordion-button">펼치기</button>
                <span class="icon">➤</span>
            </div>
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
                        $result = mysqli_query($conn, "SELECT mCameraName,mMile,mEncoderIP,mEncoderCorp FROM ctl_camera_all WHERE mCameraName REGEXP '화촌' or  mEncoderCorp REGEXP '본선'");

                        $hosts = [];
                        $miles = [];
                        $names = [];
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                $hosts[] = $row['mEncoderIP'];
                                $miles[] = $row['mMile'];
                                $names[] = $row['mCameraName'];
                            }
                        } else {
                            echo "No hosts found";
                        }

                        // $conn->close();

                        // cURL multi 핸들 생성
                        $multi_handle = curl_multi_init();
                        $curl_handles = [];

                        foreach ($hosts as $index => $host) {
                            // cURL 세션 초기화
                            $curl_handles[$index] = curl_init();

                            // 핑을 위해 호출할 URL 세팅 (여기서 ping.php 파일을 호출합니다)
                            curl_setopt($curl_handles[$index], CURLOPT_URL, "localhost/ping.php?host=" . urlencode($host));
                            curl_setopt($curl_handles[$index], CURLOPT_RETURNTRANSFER, true);

                            // multi 핸들에 추가
                            curl_multi_add_handle($multi_handle, $curl_handles[$index]);
                        }

                        // 요청 실행
                        $running = null;
                        do {
                            curl_multi_exec($multi_handle, $running);
                        } while ($running > 0);

                        // 응답 처리
                        foreach ($curl_handles as $index => $ch) {
                            $response = curl_multi_getcontent($ch);
                            // 핑 결과 출력
                            if ($response === 1) {
                                $imgsrc = "../images/greendot.png";
                            } else {
                                $imgsrc = "../images/reddot.png";

                            }
                            if (stripos($names[$index], "화촌") !== false && stripos($names[$index], "본선") === false && stripos($names[$index], "화촌9") === false) {
                                echo '<tr name="pings" ><td> ' . $names[$index] . '</td>' . '<td>' . $miles[$index] . 'k</td>' . '<td>' . $hosts[$index] . '</td>' . '<td class="connectview"><img id= "connectview" src=' . $imgsrc . '></td> 
                                <td><form action="../func/vlc.php" target="vlcWindow" method="post"><input type="hidden" name="rtspUrl" value="' . $hosts[$index] . '"><button type="submit">보기</button></form></td></tr>';
                            }
                            // cURL 핸들 닫기
                            curl_multi_remove_handle($multi_handle, $ch);
                            curl_close($ch);
                        }

                        // multi 핸들 종료
                        curl_multi_close($multi_handle);
                        ?>
                    </tbody>
                </table>
            </div>
            <div class="accordion-item">화촌9터널 ~ 내촌2터널<button class="accordion-button">펼치기</button>
                <span class="icon">➤</span>
            </div>
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
                        $result = mysqli_query($conn, "SELECT mCameraName,mMile,mEncoderIP,mEncoderCorp FROM ctl_camera_all WHERE mCameraName REGEXP '화촌9|내촌1|내촌2' or  mEncoderCorp REGEXP '본선'");

                        $hosts = [];
                        $miles = [];
                        $names = [];
                        $corps = [];
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                $hosts[] = $row['mEncoderIP'];
                                $miles[] = $row['mMile'];
                                $names[] = $row['mCameraName'];
                                $corps[] = $row['mEncoderCorp'];
                            }
                        } else {
                            echo "No hosts found";
                        }

                        $conn->close();

                        // cURL multi 핸들 생성
                        $multi_handle = curl_multi_init();
                        $curl_handles = [];

                        foreach ($hosts as $index => $host) {
                            // cURL 세션 초기화
                            $curl_handles[$index] = curl_init();

                            // 핑을 위해 호출할 URL 세팅 (여기서 ping.php 파일을 호출합니다)
                            curl_setopt($curl_handles[$index], CURLOPT_URL, "localhost/ping.php?host=" . urlencode($host));
                            curl_setopt($curl_handles[$index], CURLOPT_RETURNTRANSFER, true);

                            // multi 핸들에 추가
                            curl_multi_add_handle($multi_handle, $curl_handles[$index]);
                        }

                        // 요청 실행
                        $running = null;
                        do {
                            curl_multi_exec($multi_handle, $running);
                        } while ($running > 0);

                        // 응답 처리
                        foreach ($curl_handles as $index => $ch) {
                            $response = curl_multi_getcontent($ch);
                            // 핑 결과 출력
                            if ($response === 1) {
                                $imgsrc = "../images/greendot.png";
                            } else {
                                $imgsrc = "../images/reddot.png";

                            }
                            if (stripos($names[$index], "화촌9") !== false  || stripos($names[$index], "내촌") !== false && stripos($corps[$index], "본선") === false) {
                                echo '<tr name="pings" ><td> ' . $names[$index] . '</td>' . '<td>' . $miles[$index] . 'k</td>' . '<td>' . $hosts[$index] . '</td>' . '<td class="connectview"><img id= "connectview" src=' . $imgsrc . '></td> 
                                <td><form action="../func/vlc.php" target="vlcWindow" method="post"><input type="hidden" name="rtspUrl" value="' . $hosts[$index] . '"><button type="submit">보기</button></form></td></tr>';
                            }
                            // cURL 핸들 닫기
                            curl_multi_remove_handle($multi_handle, $ch);
                            curl_close($ch);
                        }

                        // multi 핸들 종료
                        curl_multi_close($multi_handle);
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