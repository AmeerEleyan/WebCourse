<?php require_once "./parts/_database.php";
session_start();
if (isset($_SESSION['user_id'])) {
    $sql = /** @lang update last hit for user session */
        'UPDATE user SET last_hit = now() WHERE user_id= :user_id';
    $statement = $pdo->prepare($sql);
    $statement->bindValue('user_id', $_SESSION['user_id']);
    $statement->execute();
}
?>
<!DocType html>
<html lang="en">

<head>
    <meta charset="UTF-8"/>
    <title>Student Training</title>
    <link href="css/layout.css" type="text/css" rel="stylesheet"/>
    <link href="css/website.css" type="text/css" rel="stylesheet"/>
</head>

<body>
<header>
    <img src="images/training.png" alt="logo"/>
    <h1>Student Training</h1>
    <div class="right_container">
        <h3><?php if (isset($_SESSION['user_id'])) :
                echo $_SESSION['display_name']; ?>
                <a href="logout.php">Logout</a>
            <?php
            else : ?>
                <a href="index.php">Login</a>
            <?php endif; ?>
        </h3>
    </div>
    <nav>
        <a href="index.php">Home</a>
        <a href="students.php">Students List</a>
        <a href="companies.php">Companies List</a>
    </nav>
</header>