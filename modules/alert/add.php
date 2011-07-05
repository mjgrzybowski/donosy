<?php

define('STATUS_NOT_A_IMAGE', 1);
define('STATUS_STORED', 2);
define('STATUS_SOMETHING_WENT_WRONG', 3);
define('UPLOAD_PATH', "upload/");
$alert = array();
$array['id'] = mt_rand(1,99999);

$output = array();

if ((($_FILES["file"]["type"] == "image/gif")
        || ($_FILES["file"]["type"] == "image/jpeg")
        || ($_FILES["file"]["type"] == "image/pjpeg"))
        && ($_FILES["file"]["size"] < 20000)) {
    if ($_FILES["file"]["error"] > 0) {
        echo "Return Code: " . $_FILES["file"]["error"] . "<br />";
    } else {
        $filename = $alert['id'] . '-' . $_FILES["file"]["name"];
        move_uploaded_file($_FILES["file"]["tmp_name"], UPLOAD_PATH . $filename);
            
        if (file_exists(UPLOAD_PATH . $filename)) {
            $output['status'] = STATUS_STORED;
            $output['data']['alert'] = $alert;
        } else {
            $output['status'] = STATUS_SOMETHING_WENT_WRONG;
            
        }
    }
} else {
    $output['status'] = STATUS_NOT_A_IMAGE;
}

header('Content-Type: application/json');
echo json_encode($output);
?>
