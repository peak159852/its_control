<?php
function ping($host)
{
    //전송 데이터 (32byte 테스트)
    $package = "\x08\x00\x19\x2f\x00\x00\x00\x00\x70\x69\x6e\x67";

    //icmp프로토콜 소켓생성
    $socket = socket_create(AF_INET, SOCK_RAW, 1);

    //타임아웃 설정
    socket_set_option($socket, SOL_SOCKET, SO_RCVTIMEO, array("sec" => 1, "usec" => 0));

    //소켓연결!
    socket_connect($socket, $host, 0);

    //딜레이 시간 기록
    // list($start_usec, $start_sec) = explode(" ", microtime());
    // $start_time = ((float) $start_usec + (float) $start_sec);

    socket_send($socket, $package, strlen($package), 0);

    //데이터를 받아온다.
    $result = -1;

    $flag = "";
    $flag = @socket_recv($socket, $buf, 1024, 0);
    if ($flag != "") { //데이터를 받아왔다면 걸린시간 계산
    //     list($end_usec, $end_sec) = explode(" ", microtime());
    //     $end_time = ((float) $end_usec + (float) $end_sec);
        // $total_time = $end_time - $start_time;
        $result = 1;
    }
    //소켓종료
    socket_close($socket);

    //결과 리턴
    if ($result == -1)
        return -1; //테스트 실패했을경우 -1리턴
    else
        return 1; // 핑 성공 1 리턴
}

?>