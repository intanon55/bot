<?php

$id = $_POST['userId'];
$richmenuEmp = 'richmenu-63b610998401493dc84f2486484dc3c5';
$richmenuManeger = 'richmenu-6d448d184f3de5c456a497374f0a4516';

require "config.php";

$conn = new mysqli($host, $user, $password, $database);
// เช็คว่าต่อติดมั้ย
// if ($conn->connect_error) {
//     echo "Failed to connect to MySQL: " . $conn->connect_error;
// } else {
//     echo "Success!!!";
// }
mysqli_set_charset($conn, "utf8");

$sql = "SELECT count(*)  FROM student where userid = '$id'";
$res = mysqli_query($conn, $sql);
$data = mysqli_fetch_array($res);
if ($data[0] != 0) {
    $sql = "SELECT * FROM student where userid = '$id'";
    $res = mysqli_query($conn, $sql);
    $data = mysqli_fetch_array($res);

    $name = $data['name_title'] . " " . $data['fname'] . ' ' . $data['lname'];

    if ($data[10] == 'emp') {

        /*Get Data From POST Http Request*/
        $datas = file_get_contents('php://input');
        /*Decode Json From LINE Data Body*/
        $deCode = json_decode($datas, true);
        $messages = '';

        file_put_contents('log.txt', file_get_contents('php://input') . PHP_EOL, FILE_APPEND);

        $LINEDatas['url'] = "https://api.line.me/v2/bot/user/" . $id . "/richmenu" . "/" . $richmenuEmp;
        $LINEDatas['token'] = "Ybt8pl9LynUdSvMIcSlQiEvG+ZcXCHL2PEkhhgQ7HUm0JlSdS0t6N+3X5IxG4l21xjMqgpZlXGcv+yV6PathA4ppGc7RQdrjX/vvQZ7E6aURroy04yeUM4zbmJ2h+PdCByvFcAsEhDSf85m9YdsLMwdB04t89/1O/w1cDnyilFU=";

        $encodeJson = json_encode($messages);

        $results = sentMessage($encodeJson, $LINEDatas);
    } else if ($data[10] != 'emp') {
        /*Get Data From POST Http Request*/
        $datas = file_get_contents('php://input');
        /*Decode Json From LINE Data Body*/
        $deCode = json_decode($datas, true);
        $messages = '';

        file_put_contents('log.txt', file_get_contents('php://input') . PHP_EOL, FILE_APPEND);

        $LINEDatas['url'] = "https://api.line.me/v2/bot/user/" . $id . "/richmenu" . "/" . $richmenuManeger;
        $LINEDatas['token'] = "Ybt8pl9LynUdSvMIcSlQiEvG+ZcXCHL2PEkhhgQ7HUm0JlSdS0t6N+3X5IxG4l21xjMqgpZlXGcv+yV6PathA4ppGc7RQdrjX/vvQZ7E6aURroy04yeUM4zbmJ2h+PdCByvFcAsEhDSf85m9YdsLMwdB04t89/1O/w1cDnyilFU=";

        $encodeJson = json_encode($messages);

        $results = sentMessage($encodeJson, $LINEDatas);
    }
} else {
    echo  '1';
}

function sentMessage($encodeJson, $datas)
{
    $datasReturn = [];
    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => $datas['url'],
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => $encodeJson,
        CURLOPT_HTTPHEADER => array(
            "authorization: Bearer " . $datas['token'],
            "cache-control: no-cache",
            "content-type: application/json; charset=UTF-8",
        ),
    ));

    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);
}
echo $name;
// }
