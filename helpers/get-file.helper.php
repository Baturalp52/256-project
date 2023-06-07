<?php
function getFile($name, $prefix = "default-")
{
    if (!file_exists($_SERVER["DOCUMENT_ROOT"] . "/uploads")) {
        mkdir($_SERVER["DOCUMENT_ROOT"] . "/uploads", 0777, true);
    }

    $date = new DateTime();

    $tmpName = $_FILES[$name]["tmp_name"];
    if ($tmpName) {
        $fileName = md5($prefix . $date->getTimestamp());
        $newPath = "/uploads/{$fileName}." . explode("/", $_FILES[$name]['type'])[1];

        $res = move_uploaded_file($tmpName, $_SERVER["DOCUMENT_ROOT"] . $newPath);
        if ($res) {
            return $newPath;

        }
    }

    return "";
}

?>