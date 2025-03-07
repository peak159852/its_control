<?php
session_start();
// DB 연결
$mysqli = new mysqli('localhost', 'root', 'vksek1333', 'excctv');

// DB 연결 오류 체크
if ($mysqli->connect_error) {
    die("DB 연결 실패: " . $mysqli->connect_error);
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['id']);
    $password = trim($_POST['pw']);

    // 입력값 검증
    if (empty($username) || empty($password)) {
        echo "<script>alert('아이디와 비밀번호를 입력하세요.'); location.replace('loginpage.php');</script>";
        exit;
    }

    // 중복된 아이디 체크
    $stmt = $mysqli->prepare("SELECT mUser FROM tbl_user WHERE mUser = ?");
    if (!$stmt) {
        die("쿼리 준비 실패: " . $mysqli->error);
    }
    
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();
    
    if ($stmt->num_rows > 0) {
        echo "<script>alert('이미 존재하는 아이디입니다.'); location.replace('loginpage.php');</script>";
        $stmt->close();
        $mysqli->close();
        exit;
    }
    $stmt->close();

    // 비밀번호 해싱 (중요!)
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // 데이터베이스에 저장
    $stmt = $mysqli->prepare("INSERT INTO tbl_user (mUser, mPass) VALUES (?, ?)");
    if (!$stmt) {
        die("쿼리 준비 실패: " . $mysqli->error);
    }

    $stmt->bind_param("ss", $username, $hashed_password);

    if ($stmt->execute()) {
        echo "<script>alert('회원가입 성공! 로그인 페이지로 이동합니다.'); location.replace('loginpage.php');</script>";
    } else {
        echo "<script>alert('회원가입 실패: " . addslashes($stmt->error) . "'); location.replace('loginpage.php');</script>";
    }

    $stmt->close();
    $mysqli->close();
}
?>
