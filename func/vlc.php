



<?php
// VLC 경로 설정 (Windows)
$vlcPath = 'C:\\Program Files\\VideoLAN\\VLC\\vlc.exe';

// POST 요청으로 받은 RTSP URL 가져오기
$rtspUrl = $_POST['rtspUrl'] ?? '';
$baseRtspUrl = "rtsp://172.21.123.171";
$finalRtspUrl = $baseRtspUrl . "/" . $rtspUrl . ":ch0:D"; 
// URL이 비어 있으면 종료
if (empty($rtspUrl)) {
    die("<script>alert('RTSP URL이 제공되지 않았습니다.');</script>");
}

// 🔥 'rtsp://'가 없으면 자동으로 추가
if (strpos($rtspUrl, 'rtsp://') !== 0) {
    $rtspUrl = 'rtsp://' . $rtspUrl;
}

// VLC 실행 여부 확인 (Windows)
$checkCommand = "tasklist /FI \"IMAGENAME eq vlc.exe\"";
$processes = shell_exec($checkCommand);


    // --sout사용 vlc가 아니라 http로 영상 열수있게해줌 , 현재는 vlc 롤 볼거라 사용하지않음 
    //  $command = "start /B \"\" \"$vlcPath\" \"$rtspUrl\" --sout \"#http{mux=ts,dst=:$httpPort/$streamPath}\"";
  
// VLC가 실행 중이지 않은 경우에만 실행
if (strpos($processes, "vlc.exe") === false) {
    $command = "start /B \"\" \"$vlcPath\" \"$finalRtspUrl\"";
    pclose(popen($command, "r"));

    // 🔥 JavaScript alert로 실행 메시지 표시
    echo "<script>alert('VLC 실행 완료!');</script>";
} else {
    echo "<script>alert('VLC가 이미 실행 중입니다.');</script>";
}
?>