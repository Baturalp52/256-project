<?php
function getFile($name, $prefix = "default-")
{
    $date = new DateTime();

    $tmpName = $_FILES[$name]["tmp_name"];
    $fileName = md5($prefix . $date->getTimestamp());
    $newPath = $_SERVER["DOCUMENT_ROOT"] . "/uploads/{$fileName}." . explode("/", $_FILES[$name]['type'])[1];
    $res = move_uploaded_file($tmpName, $newPath);
    if ($res) {
        return $newPath;

    }

    return false;
}

?>