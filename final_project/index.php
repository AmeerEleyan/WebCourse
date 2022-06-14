<?php require_once 'parts/_header.php' ?>

<?php
$message = '';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $sql_query = /** @lang get user info. how logged in */
        "SELECT * FROM user WHERE uname= :user_name AND pass_word = sha1(:pass)";
    $statement = $pdo->prepare($sql_query);
    $statement->bindValue(':user_name', $_POST['user_name'] ?? '');
    $statement->bindValue(':pass', $_POST['pass'] ?? '');
    $statement->execute();
    $user = $statement->fetch();
    if ($user) {
        $_SESSION['user_id'] = $user['user_id'];
        $_SESSION['display_name'] = $user['display_name'];
        $_SESSION['user_type'] = $user['user_type'];
        $sql_user_type = /** @lang get student id in the current session */
            'SELECT student_id FROM student WHERE student_user_id = :user_id';
        $statement = $pdo->prepare($sql_user_type);
        $statement->bindValue(':user_id', $user['user_id'] ?? '');
        $statement->execute();
        $student = $statement->fetch();
        if ($student) {
            $_SESSION['student_id'] = $student['student_id'];
        } else {
            $sql_user_type = /** @lang get company id in current session */
                "SELECT company_id FROM company WHERE company_user_id = :user_id";
            $statement = $pdo->prepare($sql_user_type);
            $statement->bindValue(':user_id', $user['user_id'] ?? '');
            $statement->execute();
            $company = $statement->fetch();
            if ($company) {
                $_SESSION['company_id'] = $company['company_id'];
            }
        }
        header("Location: index.php");
    } else {
        $message = 'Username or password is wrong';
    }
}

?>
    <main>
        <?php if (!isset($_SESSION['user_id'])) : ?>

            <h2>Login</h2>
            <hr/>
            <?php echo $message ?>
            <form id="login_form" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
                <label for="user_name">User name</label>
                <input type="text" value="<?php echo $_POST['user_name'] ?? '' ?>" name="user_name" id="user_name"
                       required placeholder="Username" autofocus>
                <br>
                <label for="pass">Password </label>
                <input type="password" value="<?php echo $_POST['pass'] ?? '' ?>" name="pass" id="pass" required
                       placeholder="Password">
                <br>
                <input type="submit" name="login" id="login" value="Login">
            </form>

        <?php else : ?>
            <?php
            if ($_SESSION['user_type'] == 1) {
                $sql = /** @lang display application for current student */
                    "SELECT C.company_name as  'company_name' FROM  students_applications A, company C 
                        WHERE  A.student_id= :student_id AND A.company_id= C.company_id";
                $stmt = $pdo->prepare($sql);
                $stmt->bindValue(':student_id', $_SESSION['student_id'] ?? '');
                $stmt->execute();
                while ($comp_name = $stmt->fetch()) :
                    echo $comp_name['company_name']; ?>
                    <br>
                <?php
                endwhile;
            }
        endif ?>
    </main>
    <aside>
        <h2>Aside</h2>
        <hr>
        <p>
            The aside will have information related to the current page or ads.
        </p>
    </aside>
<?php include 'parts/_footer.php' ?>