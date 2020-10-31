

<?php
// ลงเวลาเข้าdb 
require "config.php";
// require "profile.php";


$userId = $_POST["userIn"];
$email = $_POST["emailIn"];
insertdb($userId, $email, $timestamp);

function insertdb($userId, $email, $date)
{

    // require 'database.php';
    require "config.php";

    $conn = new mysqli($host, $user, $password, $database);
    // เช็คว่าต่อติดมั้ย
    // if ($conn->connect_error) {
    //     echo "Failed to connect to MySQL: " . $conn->connect_error;
    // } else {
    //     echo "Success!!!";
    // }

    $sql = "INSERT INTO checkin (userid, email, stamptime)
VALUES ('$userId','$email','$date')";

    if ($conn->query($sql) === TRUE) {

        // echo "สแกนสำเร็จแล้วครับ ณ เวลา : ";
        // echo "<br/>";
        echo  date("H:i:s");
        // เช็คว่าเลทมั้ย
        // if (date('H') >= 8 && date('i') >= 01) {
        //     echo "";
        //     echo "working late!";
        // }
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    $conn->close();
}
