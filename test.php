<?php
$inputPassword = "root1"; // 사용자가 입력한 비밀번호
$storedHash = '$2y$10$prUXss9KMSY0rgdCXW5y5eEkFxgF721tZMzNsjlMi8j'; // DB에서 가져온 값

if (password_verify($inputPassword, $storedHash)) {
    echo "비밀번호 일치 ✅";
} else {
    echo "비밀번호 불일치 ❌";
}
?>
