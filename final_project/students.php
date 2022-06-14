<?php
require_once "parts/_header.php";

$statement_city = $pdo->prepare(/** @lang get cities */ "SELECT C.city_id, C.city_name FROM city C");
$statement_city->execute();
$cities = $statement_city->fetchAll();
$arr_cities = array();


$sql = /** @lang search by city or student major */
    "SELECT c.city_name city_name, s.* FROM student s,
    city c WHERE s.student_city_id = c.city_id AND 
    (s.student_major like :major or :major = '')
    AND (c.city_id = :city_id or :city_id = '')";

$stmt = $pdo->prepare($sql);
$stmt->bindValue(':major', '%' . ($_GET['student_major'] ?? '') . '%');
$stmt->bindValue(':city_id', ($_GET['city'] ?? ''));

?>
    <main>
        <h2>Students List</h2>
        <hr>
        <form class="simple_form" action="?">

            <label for="student_major">Student Study Major:</label>
            <input type="search" name="student_major" id="student_major"
                   value="<?php echo($_GET['student_major'] ?? '') ?>" placeholder="major">

            <label for="city">City:</label>
            <select name="city" id="city">
                <option value="">Select city</option>
                <?php foreach ($cities as $city):
                    $arr_cities[$city['city_id']] = $city['city_name']; ?>
                    <option value="<?php echo $city['city_id'] ?>" <?php if ($city['city_id'] == ($_GET['city'] ?? '')) echo 'selected' ?>><?php echo $city['city_name'] ?></option>
                <?php endforeach; ?>
            </select>

            <input type="submit" name="search" value="Search">
        </form>
        <table class="list_table_student">
            <thead>
            <tr>
                <th>Photo</th>
                <th>Name</th>
                <th>City</th>
                <th>University</th>
                <th>Major</th>
            </tr>
            </thead>
            <tbody>
            <?php

            $stmt->execute();
            while ($student = $stmt->fetch()) : ?>
                <tr>
                    <td><img src="<?php echo $student['student_photo_path'] ?>" alt="student_photo"></td>
                    <td>
                        <a href="<?php echo "student.php?id=" . $student['student_id'] ?>"><?php echo $student['student_name'] ?></a>
                    </td>
                    <td><?php echo $arr_cities[$student['student_city_id']] ?></td>
                    <td><?php echo $student['student_university'] ?></td>
                    <td><?php echo $student['student_major'] ?></td>
                </tr>
            <?php endwhile; ?>

            </tbody>
        </table>
        <?php
        $sql = /** @lang check the user exists in the system and his type */
            'SELECT student_id FROM student WHERE student_user_id = :user_id';
        $statement = $pdo->prepare($sql);
        $statement->bindValue(':user_id', $_SESSION['user_id'] ?? '');
        $statement->execute();
        $add_student = $statement->fetch();
        //student does not exist and user not a company
        if (!$add_student && $_SESSION['user_type'] != 2) : ?>
            <div class="links">
                <a href="add-student.php">Add Student</a>
            </div>
        <?php endif; ?>

    </main>
    <aside>
        <h2>Distinguished Students</h2>
        <hr>
        <p>
            Student Ali Ahmad from Birzeit is very special and he is looking for training in Computer Science...
        </p>
    </aside>
<?php include "parts/_footer.php" ?>