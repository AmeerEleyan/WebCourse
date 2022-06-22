<?php require_once "parts/_header.php" ?>

<?php

// status of submit
$message = '';
$addOrUpdate = 'Add student';
// Get cities
$statement_city = $pdo->query(/** @lang get cities */ 'SELECT city_id, city_name FROM city');

$arrCities = array();
while ($city = $statement_city->fetch()):
    $arrCities[$city['city_id']] = $city['city_name'];
endwhile;

$std_name = '';
$std_email = '';
$std_tel = '';
$std_university = '';
$std_major = '';
$std_projects = '';
$std_interests = '';
$std_image = '';
$std_user_id = '';
$std_city_id = '';
$std_city_name = '';
$isExist = false;

$sql_student = /** @lang get student info if exist in the session */
    'SELECT * FROM student WHERE student_user_id = :user_id';
$stmt = $pdo->prepare($sql_student);
$stmt->bindValue(':user_id', $_SESSION['user_id'] ?? '');
$stmt->execute();
$student = $stmt->fetch();

if ($student) {
    $std_name = $student['student_name'];
    $std_email = $student['student_email'];
    $std_tel = $student['student_tel'];
    $std_university = $student['student_university'];
    $std_major = $student['student_major'];
    $std_projects = $student['student_projects'];
    $std_interests = $student['student_interests'];
    $std_image = $student['student_photo_path'];
    $std_user_id = $student['student_user_id'];
    $std_city_id = $student['student_city_id'];
    $std_city_name = $arrCities[$student['student_city_id']];
    $addOrUpdate = $std_name . " Information";
    $isExist = true;
}


$sql = '';
if ($_SERVER["REQUEST_METHOD"] == "POST"):

    if ($isExist): // student exist in the system, and update his info.

        $sql = /** @lang query to update student info */
            'UPDATE student SET student_name = :name_,  
                student_email = :email, student_tel = :tel, student_university = :university,
                student_major = :major, student_interests = :interests, student_projects= :projects,
                student_photo_path = :student_img, student_user_id = :user_id, 
                student_city_id = :city WHERE student_id = :student_id';
    else:
        $sql = /** @lang student does not exist in the system, and create new recorde */
            'INSERT INTO student (student_name, student_email, student_tel,
                     student_university, student_major, student_projects, student_interests
                     ,student_photo_path, student_user_id, student_city_id)
                     VALUES( :name_, :email, :tel, :university, :major, :projects,
                     :interests, :student_img, :user_id, :city)';
    endif;//end if student

    require_once 'parts/_upload_file.php';
    if ($_FILES['student_img_path']['error'] == UPLOAD_ERR_OK) {
        $std_image = $target_file;
    }


    $statement = $pdo->prepare($sql);
    $statement->bindValue(':name_', $_POST['name_'] ?? '');
    $statement->bindValue(':email', $_POST['email'] ?? '');
    $statement->bindValue(':tel', $_POST['tel'] ?? '');
    $statement->bindValue(':university', $_POST['university'] ?? '');
    $statement->bindValue(':major', $_POST['major'] ?? '');
    $statement->bindValue(':projects', $_POST['projects'] ?? '');
    $statement->bindValue(':interests', $_POST['interests'] ?? '');
    $statement->bindValue(':student_img', $std_image ?? '');
    $statement->bindValue(':user_id', $_SESSION['user_id'] ?? '');
    $statement->bindValue(':city', $_POST['city'] ?? '');

    $message = 'Student account was created successfully';
    if ($isExist):
        $statement->bindValue(':student_id', $student['student_id'] ?? '');
        $message = 'Updated successfully';
    endif;//end if isExist

    $statement->execute();
    if (!$isExist)
        $_SESSION['student_id'] = $pdo->lastInsertId();

endif; ?>
    <main>
        <h2><?php echo $addOrUpdate ?></h2>
        <hr/>
        <?php echo $message ?>
        <form enctype="multipart/form-data" class="add_form" action="<?php echo $_SERVER['PHP_SELF'] ?>"
              method="post">
            <table>
                <tbody>
                <tr>
                    <td>
                        <label for='student_img_path'>Personal Photo</label>
                    </td>
                    <td>
                        <input type="file" value="<?php echo $std_image ?>" name="student_img_path"
                               id='student_img_path'>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="name_">Name</label>
                    </td>
                    <td>
                        <input type="text" value="<?php echo $std_name ?>" name="name_" id="name_"
                               required placeholder="Name">
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="city">City</label>
                    </td>
                    <td>
                        <select name="city" id="city">
                            <?php if ($isExist): echo $std_city_name ?>
                                <option selected
                                        value="<?php echo $std_city_id ?>"><?php echo $std_city_name ?></option>
                            <?php else: ?>
                                <option selected value=''>Select city</option>
                            <?php endif; ?>
                            <?php foreach ($arrCities as $city_id => $city_name) : ?>
                                <option value="<?php echo $city_id ?>"><?php echo $city_name ?></option>
                            <?php endforeach; ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="email">Email</label>
                    </td>
                    <td>
                        <input type="email" value="<?php echo $std_email ?>" name="email" id="email" required
                               placeholder="email">
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="tel">Tel</label>
                    </td>
                    <td>
                        <input type="tel" value="<?php echo $std_tel ?>" name="tel" id="tel" required
                               placeholder="telephone">
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="university">University</label>
                    </td>
                    <td>
                        <input type="text" value="<?php echo $std_university ?>" name="university"
                               id="university" required placeholder="university">
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="major">Major</label>
                    </td>
                    <td>
                        <input type="text" value="<?php echo $std_major ?>" name="major" id="major"
                               required placeholder="major">
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="projects">Projects</label>
                    </td>
                    <td>
                            <textarea name="projects" id="projects"
                                      placeholder="Enter about your projects"><?php echo $std_projects ?></textarea>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="interests">Interests</label>
                    </td>
                    <td>
                            <textarea name="interests" id="interests"
                                      placeholder="Enter about your interests"><?php echo $std_interests ?></textarea>
                    </td>
                </tr>
                </tbody>
            </table>
            <input type="submit" name="add_student" value="<?php if ($isExist) echo 'Update'; else echo 'Add'; ?>">
            <input type="reset" value="Clear">
        </form>
        <div class="links">
            <a class="link" href="students.php">Cancel and return to Student List</a>
        </div>
    </main>
    <aside>
        <h2>Help</h2>
        <p>
            Add your student details including projects and interests so that companies can select you...
        </p>
    </aside>
<?php include "parts/_footer.php" ?>