<?php
session_start();
if (!isset($_SESSION['username'])) {
    echo "<script>location.replace('login.php');</script>";
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


include_once "ping.php";
$res = mysqli_query($conn, "SELECT mName,mMile,mIP FROM lcs_vms_conf");
   

                while ($row = mysqli_fetch_array($res)) {

                    $imgsrc;
                    $host = $row['mIP'];

                    // $result = ping($host);
                    $result = 0;
                    if ($result === 1) {
                        $imgsrc = "images/greendot.png";
                    } else {
                        $imgsrc = "images/reddot.png";

                    }

                    if ($imgsrc === "images/reddot.png") {
                        echo '<tr id="falping" name="pings" class="falping" ><td> ' . $row['mName'] . '</td>' . '<td>' . $row['mMile'] . 'k</td>'   . '<td class="connectview"><img id= "connectview" src=' . $imgsrc . '></td>' . '</td></tr>';
                    } else {
                    //    echo  '<tr id="allping" name="pings" class="allping"><td width = 200px;>' . $row['mVDSname'] . '</td>' . '<td>' . $row['mMile'] . 'k</td>'  .  '<td class="connectview"><img id= "connectview" src=' . $imgsrc . '></td>' . '</td></tr>';
                    }



                }

?>