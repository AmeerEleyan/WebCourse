<?php
require_once 'parts/_database.php';
if (isset($_GET['application_id']) && isset($_GET['id'])):
    $status = 'Approved';
    if ($_GET['for'] == 0) {
        $status = 'Rejected';
    }
    $sql = /** @lang update application status to approved */
        "UPDATE students_applications SET application_status= :status
        WHERE application_id= :app_id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':app_id', $_GET['application_id']);
    $stmt->bindValue(':status', $status);
    $stmt->execute();
    header("Location: student.php?id=" . $_GET['id']);
endif;