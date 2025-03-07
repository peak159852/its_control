<?php
// ping.php

function ping($host)
{
    $package = "\x08\x00\x19\x2f\x00\x00\x00\x00";
    $socket = socket_create(AF_INET, SOCK_RAW, 1);
    socket_set_option($socket, SOL_SOCKET, SO_RCVTIMEO, array("sec" => 3, "usec" => 0));
    socket_connect($socket, $host, 0);
    socket_send($socket, $package, strlen($package), 0);
    
    $read = array($socket);
    $write = null;
    $except = null;
    $timeout = array("sec" => 1, "usec" => 0);
    $flag = socket_select($read, $write, $except, $timeout['sec'], $timeout['usec']);
    
    if ($flag > 0) {
        socket_recv($socket, $buf, 1024, MSG_DONTWAIT);
        socket_close($socket);
        return 1; // 핑 성공
    } else {
        socket_close($socket);
        return -1; // 핑 실패
    }

}
?>
