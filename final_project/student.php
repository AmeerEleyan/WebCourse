<?php require_once "parts/_header.php" ?>
<?php
if (isset($_GET['id'])) {

    $sql = /** @lang get student info */
        "SELECT * FROM student where student_id= :student_id";
    $statement = $pdo->prepare($sql);
    $statement->bindValue(':student_id', $_GET['id'] ?? '');
    $statement->execute();
    $student = $statement->fetch();

    if ($student) :

        $std_name = $student['student_name'];
        $std_image = $student['student_photo_path'];

        $statement_city = $pdo->prepare(/** @lang get cities */
            'SELECT city_name FROM city C, student S WHERE S.student_city_id = C.city_id
            AND S.student_id= :student_id');
        $statement_city->bindValue(':student_id', $_GET['id'] ?? '');
        $statement_city->execute();
        $std_city = $statement_city->fetch()['city_name'];

        $std_email = $student['student_email'];
        $std_tel = $student['student_tel'];
        $std_university = $student['student_university'];
        $std_major = $student['student_major'];
        $std_projects = $student['student_projects'];
        $std_interests = $student['student_interests'];
        $student_user_id = $student['student_user_id'];

        ?>
        <main>
        <h2><?php echo $std_name ?></h2>
        <hr>
        <div class="student_info">
            <img id="student_photo" src="<?php echo $std_image ?>" alt="student photo">
            <dl>
                <dt id="city">City:</dt>
                <dd><?php echo $std_city ?></dd>
                <dt id="email">Email</dt>
                <dd><?php echo $std_email ?></dd>
                <dt id="tel">Tel</dt>
                <dd><?php echo $std_tel ?></dd>
                <dt id="university">University</dt>
                <dd><?php echo $std_university ?></dd>
                <dt id="major">Major</dt>
                <dd><?php echo $std_major ?></dd>
                <dt id="projects">Projects</dt>
                <dd><?php echo $std_projects; ?></dd>
                <dt id="interests">Interests</dt>
                <dd><?php echo $std_interests ?></dd>
            </dl>
        </div>
    <?php endif; ?>
    <div class="links">
        <a href="students.php">Back to Students List</a>
        <?php if ($_SESSION['user_type'] == 1 && $_GET['id'] == $_SESSION['student_id']): ?>
            | <a href="<?php echo 'add-student.php?id=' . $_GET['id'] ?>">Edit</a>
        <?php elseif ($_SESSION['user_type'] == 2): ?>
            | <?php

            // get applications status between this company and student
            $sql = /** @lang apply offers for current student by user company */
                'SELECT application_status FROM students_applications WHERE student_id= :std_id AND company_id= :comp_id';
            $statement_company_offer = $pdo->prepare($sql);
            $statement_company_offer->bindValue(':std_id', $_GET['id']);
            $statement_company_offer->bindValue(':comp_id', $_SESSION['company_id']);
            $statement_company_offer->execute();
            $app_status = $statement_company_offer->fetch();

            if ($app_status): ?>
                <spanp>Offered(<?php echo $app_status['application_status'] ?>)</spanp>
            <?php else: ?>
                <a href="<?php echo 'offer.php?s_id=' . $student['student_id'] . "&c_id=" . $_SESSION['company_id'] ?>">Offer A Training</a>
            <?php endif; ?>
        <?php endif; ?>
    </div>
    <?php if ($_SESSION['user_type'] == 1 && $_GET['id'] == $_SESSION['student_id']): ?>
        <?php
        $sql = /** @lang display offer for current student */
            'SELECT application_id, company_id, apply_date, application_status
             FROM students_applications WHERE student_id= :std_id';
        $stmt_offer = $pdo->prepare($sql);
        $stmt_offer->bindValue(':std_id', $student['student_id']);
        $stmt_offer->execute();
        $offers = $stmt_offer->fetchAll();
        if ($offers) : ?>
            <h2>Training Offers</h2>
            <hr/>
            <table class="list_table_offers">
                <thead>
                <tr>
                    <th>Company name</th>
                    <th>Date</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <?php
                foreach ($offers as $offer):
                    $sql = /** @lang get company name */
                        'SELECT company_name FROM company WHERE company_id= :comp_id';
                    $stmt_offer = $pdo->prepare($sql);
                    $stmt_offer->bindValue(':comp_id', $offer['company_id'] ?? '');
                    $stmt_offer->execute();
                    $comp = $stmt_offer->fetch();
                    ?>
                    <tr>
                        <td><?php echo $comp['company_name'] ?></td>
                        <td><?php echo $offer['apply_date'] ?></td>
                        <td><?php echo $offer['application_status'] ?></td>
                        <td>
                            <a href="<?php echo 'reject_accept.php?id=' . $_GET['id'] . '&application_id=' . $offer['application_id'] . '&for=1' ?>">Accept</a>
                            |
                            <a href="<?php echo 'reject_accept.php?id=' . $_GET['id'] . '&application_id=' . $offer['application_id'] . '&for=0' ?>">Reject</a>
                        </td>
                    </tr>
                <?php endforeach; ?>

                </tbody>
            </table>
        <?php endif; ?>
    <?php endif; ?>
<?php } else { ?>
    <p>Wrong...</p>
<?php } ?>
    </main>
    <aside>
        <h2>Similar Students</h2>
        <p>
            A student or 2 students with same major
        </p>
    </aside>
<?php include "parts/_footer.php" ?>