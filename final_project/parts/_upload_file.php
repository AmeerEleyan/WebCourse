<?php
$target_file = '';
$validExt = array("jpg", "png", "PNG");
$validMime = array("image/jpg", "image/png", "image/jpeg");

foreach ($_FILES as $fileKey => $fileArray) :

    //check if uploaded file has valid extension and mimeType
    $array = explode(".", $fileArray["name"]);
    $extension = end($array);
    if (in_array($fileArray["type"], $validMime) && in_array($extension, $validExt)):

        // name of the uploaded file.
        $target_file = 'images/students/' . basename($_FILES["student_img_path"]["name"]);
        if (isset($_FILES['student_img_path'])):

            if (!move_uploaded_file($_FILES['student_img_path']['tmp_name'], $target_file)) :
                echo "Error when uploading image";
            endif; ?>
        <?php endif; ?>
    <?php else :
        echo 'has an invalid mime type or extension'; ?>
    <?php endif; ?>
<?php endforeach; ?>

