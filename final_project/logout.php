<?php
session_start();
unset($_SESSION['user_id']);
unset($_SESSION['display_name']);
unset($_SESSION['user_type']);
if (isset($_SESSION['student_id'])) unset($_SESSION['student_id']);
if (isset($_SESSION['company_id'])) unset($_SESSION['company_id']);
header('Location: index.php');
