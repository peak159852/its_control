<?php
session_start();
$mysqli = new mysqli('localhost', 'root', 'vksek1333');
mysqli_select_db($mysqli, 'excctv'); //db 연결

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['id']);
    $password = trim($_POST['pw']);

    if (empty($username) || empty($password)) {
        echo "<script>alert('아이디와 비밀번호를 입력하세요.'); location.replace('loginpage.php');</script>";
        exit;
    }

    // 사용자 정보 조회
    $stmt = $mysqli->prepare("SELECT mUser, mPass FROM tbl_user WHERE mUser = ?");
    if (!$stmt) {
        die("쿼리 준비 실패: " . $mysqli->error);
    }

    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id, $hash);
        $stmt->fetch();

        // 입력된 비밀번호와 DB에 저장된 해시값 비교
        if (password_verify($password, $hash)) {
            $_SESSION['username'] = true;
            $_SESSION['name'] = $id;

            echo "<script>location.replace('main.php');</script>";
            exit;
        } else {
            echo "<script>alert('비밀번호가 틀렸습니다.'); location.replace('loginpage.php');</script>";
            exit;
        }
    } else {
        echo "<script>alert('존재하지 않는 아이디입니다.'); location.replace('loginpage.php');</script>";
    }

    $stmt->close();
    $mysqli->close();
}
?>
