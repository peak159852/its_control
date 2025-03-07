<?php
session_start();

$conn = mysqli_connect('localhost', 'root', 'vksek1333');
mysqli_query($conn, "set session character_set_connection=utf8;");
mysqli_query($conn, "set session character_set_results=utf8;");
mysqli_query($conn, "set session character_set_client=utf8;");
mysqli_select_db($conn, 'excctv');
set_time_limit(0);

 
include_once "ping.php";
$res = mysqli_query($conn, "SELECT mCameraName,mMile,mEncoderIP FROM ctl_camera_all WHERE mCameraName REGEXP '동산1|동산2|북방1|북방2|북방3|화촌|내촌1|내촌2' or  mEncoderCorp REGEXP '본선'");


while ($row = mysqli_fetch_array($res)) {

    $imgsrc;
    $host = $row['mEncoderIP'];

    // $result = ping($host);
    $result = 0;

    if ($result === 1) {
        $imgsrc = "images/greendot.png";
    } else {
        $imgsrc = "images/reddot.png";

    }

    if ($imgsrc === "images/reddot.png") {
        echo '<tr id="falping" name="pings" class="falping" ><td> ' . $row['mCameraName'] . '</td>' . '<td>' . $row['mMile'] . 'k</td>' .'<td class="connectview"><img id= "connectview" src=' . $imgsrc . '></td>' . '</td></tr>';
    } else {
    //    echo  '<tr id="allping" name="pings" class="allping"><td width = 200px;>' . $row['mCameraName'] . '</td>' . '<td>' . $row['mMile'] . 'k</td>' .   '<td class="connectview"><img id= "connectview" src=' . $imgsrc . '></td>' . '</td></tr>';
    }

   
}

?>