<?php

include("config.php");
$condb = new mysqli($host, $user, $password, $database);
// if ($condb->connect_error) {
//     echo "Failed to connect to MySQL: " . $codb->connect_error;
// } else {
//     echo "Success!!!";
// }
mysqli_query($condb, "SET NAMES 'utf8' ");
date_default_timezone_set('Asia/Bangkok');
?>



 <?php

    // function consheet()
    // {

    //     $spreadsheet = new Google_Service_Sheets_Spreadsheet([
    //         'properties' => [
    //             'title' => $title
    //         ]
    //     ]);
    //     $spreadsheet = $service->spreadsheets->create($spreadsheet, [
    //         'fields' => 'spreadsheetId'
    //     ]);
    //     printf("Spreadsheet ID: %s\n", $spreadsheet->spreadsheetId);
    // }
    ?>