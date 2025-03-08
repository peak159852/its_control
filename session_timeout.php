<?php
session_start();
// 세션 타임아웃 시간 설정 (예: 15분)
$timeout_duration =  5*60;  //  초로 계산

// 세션 시작 시간 (마지막 활동 시간)
if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY']) > $timeout_duration) {
    // 세션 타임아웃 (활동이 없으면 로그아웃)
    session_unset();
    session_destroy();
    header("Location: loginpage.php");  // 로그인 페이지로 리디렉션
    exit();
}
// echo "Last Activity: " . (isset($_SESSION['LAST_ACTIVITY']) ? date('Y-m-d H:i:s', $_SESSION['LAST_ACTIVITY']) : 'No Activity Yet');
// 마지막 활동 시간 갱신
$_SESSION['LAST_ACTIVITY'] = time();
?>
