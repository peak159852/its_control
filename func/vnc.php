<?php
// VNC Viewer 실행 파일 경로
$vncViewerPath = 'C:\\Program Files (x86)\\UltraVNC\\vncviewer.exe';

// POST 요청에서 VNC 서버 IP 가져오기
$serverIP = $_POST['serverIP'] ?? '';
$serverPort = "5910";
$password = "rjawjd#820";

// VNC 실행 여부를 저장할 파일 경로
$statusFile = "vnc_running.txt";

// 모든 필수 정보 확인
if (empty($serverIP) || empty($serverPort) || empty($password)) {
    die("모든 정보를 입력해주세요.");
}

// **VNC가 실행 중인지 확인 (Windows에서 실행 중인 프로세스 확인)**
$checkCommand = 'tasklist /FI "IMAGENAME eq vncviewer.exe" 2>NUL';
$processList = shell_exec($checkCommand);

// VNC가 실행 중이면 상태 파일 생성
if (strpos($processList, "vncviewer.exe") !== false) {
    file_put_contents($statusFile, "running");
} else {
    // VNC 종료 시 상태 파일 삭제
    if (file_exists($statusFile)) {
        unlink($statusFile);
    }
}

// **VNC 실행 상태 확인 후 실행 여부 결정**
if (!file_exists($statusFile)) {
    // 실행 중이 아니라면 VNC 실행
    $command = "\"$vncViewerPath\" -password \"$password\" \"$serverIP::$serverPort\"";
    pclose(popen($command, "r"));
    
    // 실행되었으므로 상태 파일 생성
    file_put_contents($statusFile, "running");
    echo "<script>alert('VNC 접속 시도 중...');</script>";
} else {
    echo "<script>alert('VNC가 이미 실행 중이거나 종료될 때까지 다시 실행되지 않습니다.');</script>";
}

?>