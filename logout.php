<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <title>Log out</title>
</head>

<body>
    <!--===============================================================================================-->
    <script src="jquery.min.js"></script>
    <script src="https://static.line-scdn.net/liff/edge/versions/2.3.0/sdk.js"></script>
    <script>
        liff.init({
                liffId: "1654195194-732m4xvP",
            },
            () => {
                if (liff.isLoggedIn()) {
                    runApp();
                } else {
                    liff.login();
                }
            },
            (err) => console.error(err.code, error.message)
        );

        function runApp() {
            liff
                .getProfile()
                .then((profile) => {
                    id = profile.userId;
                    console.log(id);
                    getprofile(id);

                })
                .catch((err) => {
                    console.log("error", err);
                });
        }

        function getprofile(id) {
            console.log(id);

            $.ajax({
                url: "logout.php",
                type: "POST",
                data: {
                    userId: id,
                },
                success: function(result) {
                    if (result != '<br>') {
                        swal({
                            title: "ไว้โอกาสหน้าใช้งานใหม่นะครับ",
                            text: "เราจะรอคุณกลับมาเสมอ",
                            icon: "success",
                            button: "OK!",
                        }).then((value) => {
                            liff.closeWindow();
                        });
                    } else {
                        swal({
                            title: "ผิดพลาด",
                            text: result,
                            icon: "Error",
                            button: "OK!",
                        }).then((value) => {
                            liff.closeWindow();
                        });
                    }
                },
            });
        }
    </script>
</body>

</html>


<?php

$id = $_POST['userId'];

/*Get Data From POST Http Request*/
$datas = file_get_contents('php://input');
/*Decode Json From LINE Data Body*/
$deCode = json_decode($datas, true);

file_put_contents('log.txt', file_get_contents('php://input') . PHP_EOL, FILE_APPEND);

$LINEDatas['url'] = "https://api.line.me/v2/bot/user/" . $id . "/richmenu";
$LINEDatas['token'] = "Ybt8pl9LynUdSvMIcSlQiEvG+ZcXCHL2PEkhhgQ7HUm0JlSdS0t6N+3X5IxG4l21xjMqgpZlXGcv+yV6PathA4ppGc7RQdrjX/vvQZ7E6aURroy04yeUM4zbmJ2h+PdCByvFcAsEhDSf85m9YdsLMwdB04t89/1O/w1cDnyilFU=";

$encodeJson = json_encode($messages);

$results = sentMessage($encodeJson, $LINEDatas);

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
        CURLOPT_CUSTOMREQUEST => 'DELETE',
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
    echo "<br>";
}
?>