<?php
require_once './_common.php';

if (empty($_FILES))
    dieJson('');

/*******************************************************
 * Only these origins will be allowed to upload images *
 ******************************************************/
$accepted_origins = array("http://localhost", NT_URL);

/*********************************************
 * Change this line to set the upload folder *
 *********************************************/
$imageFolder = NT_DATA_PATH.DIRECTORY_SEPARATOR.EDITOR_FILE_DIR.DIRECTORY_SEPARATOR.'temp';
if (!is_dir($imageFolder))
    mkdir($imageFolder, 0755, true);

// chunked file delete
$files = array_diff(scandir($imageFolder), array('.', '..'));
foreach ($files as $f) {
    $file = $imageFolder.DIRECTORY_SEPARATOR.$f;

    if (filemtime($file) < (NT_TIME_SERVER - 86400))
        unlink($file);
}

$files = array();

foreach ($_FILES as $temp) {
    if (is_uploaded_file($temp['tmp_name'])) {
        if (isset($_SERVER['HTTP_ORIGIN'])) {
            // same-origin requests won't set an origin. If the origin is set, it must be valid.
            if (in_array($_SERVER['HTTP_ORIGIN'], $accepted_origins)) {
                header('Access-Control-Allow-Origin: ' . $_SERVER['HTTP_ORIGIN']);
            } else {
                header("HTTP/1.1 403 Origin Denied");
            return;
            }
        }

        /*
            If your script needs to receive cookies, set images_upload_credentials : true in
            the configuration and enable the following two headers.
        */
        // header('Access-Control-Allow-Credentials: true');
        // header('P3P: CP="There is no P3P policy."');

        // Sanitize input
        if (preg_match("/([^\w\s\d\-_~,;:\[\]\(\).])|([\.]{2,})/", $temp['name']))
            continue;

        // Verify extension
        $ext = strtolower(pathinfo($temp['name'], PATHINFO_EXTENSION));
        if (!in_array($ext, array('gif', 'jpg', 'jpeg', 'png')))
            continue;

        // Accept upload if there was no origin, or if it is an accepted origin
        $filetowrite = $imageFolder . DIRECTORY_SEPARATOR . getUploadedFileName() . '.' . $ext;
        move_uploaded_file($temp['tmp_name'], $filetowrite);

        $name = str_replace(' ', '', $temp['name']);
        $size = getimagesize($filetowrite);

        $width  = $size[0];
        $height = $size[1];

        $fileInfo = array(
            'name'   => $temp['name'],
            'type'   => 'image',
            'src'    =>  str_replace(NT_DATA_PATH, NT_DATA_URL, $filetowrite),
            'width'  => $width,
            'height' => $height
        );

        $files[] = $fileInfo;

        $_SESSION['grapesImages'][] = basename($filetowrite);

        echo json_encode(array('data' =>$files));
    }
}
?>
