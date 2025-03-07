<!DOCTYPE html>
<html>
<head>
   <meta charset="utf-8">
   <title></title>
</head>
<body>
   <?php
   session_start();
      $mysqli = new mysqli('localhost', 'root', 'vksek1333');
      mysqli_select_db($mysqli, 'excctv'); //db 연결
      
      //login.php에서 입력받은 id, password
      $username = $_POST['id'];
      $userpass = $_POST['pw'];
      
      $q = "SELECT * FROM tbl_user WHERE mUser = '$username' AND mPass = '$userpass'";
      $result = $mysqli->query($q);
      $row = $result->fetch_array(MYSQLI_ASSOC);
      
      //결과가 존재하면 세션 생성
      if ($row != null) {
         $_SESSION['username'] = $row['mName'];
         $_SESSION['name'] = $row['mUser'];
         echo "<script>location.replace('main.php');</script>";
         exit;
      }
      
      //결과가 존재하지 않으면 로그인 실패
      if($row == null){
         echo "<script>alert('아이디 비밀번호를 확인해주세요.')</script>";
         echo "<script>location.replace('login.php');</script>";
         exit;
      }
      ?>
   </body>