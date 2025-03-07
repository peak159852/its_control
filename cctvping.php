<?php
session_start();

$conn = mysqli_connect('localhost', 'root', 'vksek1333');
mysqli_query($conn, "set session character_set_connection=utf8;");
mysqli_query($conn, "set session character_set_results=utf8;");
mysqli_query($conn, "set session character_set_client=utf8;");
mysqli_select_db($conn, 'excctv');
set_time_limit(0);


$result = mysqli_query($conn, "SELECT mCameraName,mMile,mEncoderIP FROM ctl_camera_all WHERE mCameraName REGEXP '동산1|동산2|북방1|북방2|북방3|화촌|내촌1|내촌2' or  mEncoderCorp REGEXP '본선'");

$hosts = [];
$miles =[];
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
        $imgsrc = "images/greendot.png";
    } else {
        $imgsrc = "images/reddot.png";

    }
    if ($imgsrc === "images/reddot.png") {
        echo '<tr id="falping" name="pings" class="falping" ><td> ' . $names[$index] . '</td>' . '<td>' . $miles[$index] . 'k</td>' .'<td class="connectview"><img id= "connectview" src=' . $imgsrc . '></td>' . '</td></tr>';
    } 
    // echo "Host: " . $hosts[$index] . " Result: " . ($response == "1" ? 'Success' : 'Fail') . PHP_EOL;
    
    // cURL 핸들 닫기
    curl_multi_remove_handle($multi_handle, $ch);
    curl_close($ch);
}

// multi 핸들 종료
curl_multi_close($multi_handle);
?>