<?php
$target_file = '';
$validExt = array("jpg", "png", "PNG");
$validMime = array("image/jpg", "image/png", "image/jpeg");


if ($_FILES['student_img_path']['error'] == UPLOAD_ERR_OK) {

    $fileName = $_FILES['student_img_path']["name"];
    $s = explode(".", $fileName);
    $extension = end($s);
    if (in_array($extension, $validExt) && in_array($_FILES['student_img_path']['type'], $validMime)) {
        $target_file = "images/students/";
        $target_file .= basename($fileName);
        move_uploaded_file($_FILES['student_img_path']['tmp_name'], $target_file);
    } else {
        echo 'has an invalid mime type or extension';
    }
}


