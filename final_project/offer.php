<?php
require_once 'parts/_database.php';
if (isset($_GET['s_id']) && isset($_GET['c_id'])) {
    $sql = /** @lang insert new application */
        "INSERT INTO students_applications (student_id, company_id,
        apply_date, application_status, requested_by_user_id)
        VALUES(:student_id, :company_id, now(), 'Sent', :user_id)";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':student_id', $_GET['s_id'] ?? '');
    $stmt->bindValue(':company_id', $_GET['c_id'] ?? '');
    $stmt->bindValue(':user_id', $_SESSION['user_id'] ?? '');
    $stmt->execute();
    header('Location: student.php?id=' . $_GET['s_id'] ?? '');
}