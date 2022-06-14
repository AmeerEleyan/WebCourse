<?php
require_once "parts/_header.php";

$statement_city = $pdo->prepare(/** @lang get cities */ "SELECT C.city_id, C.city_name FROM city C");
$statement_city->execute();
$cities = $statement_city->fetchAll();
$arr_cities = array();


$sql = /** @lang search by city or student major */
    "SELECT c.city_name city_name, m.* FROM company m,
    city c WHERE m.company_city_id = c.city_id AND 
    (m.company_name like :name or :name = '')
    AND (c.city_id = :city_id or :city_id = '')";

$stmt = $pdo->prepare($sql);
$stmt->bindValue(':name', '%' . ($_GET['company_name'] ?? '') . '%');
$stmt->bindValue(':city_id', ($_GET['city'] ?? ''));

?>
    <main>
        <h2>Companies List</h2>
        <hr>
        <form class="simple_form" action="?">

            <label for="company_name">Company Name:</label>
            <input type="search" name="company_name" id="company_name"
                   value="<?php echo($_GET['company_name'] ?? '') ?>" placeholder="company name">

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
                <th>Open positions</th>
            </tr>
            </thead>
            <tbody>
            <?php

            $stmt->execute();
            while ($company = $stmt->fetch()) : ?>
                <tr>
                    <td><img src="<?php echo $company['company_logo_path'] ?>" alt="company_photo"></td>
                    <td>
                        <a href="<?php echo "company.php?id=" . $company['company_id'] ?>"><?php echo $company['company_name'] ?></a>
                    </td>
                    <td><?php echo $arr_cities[$company['company_city_id']] ?></td>
                    <td><?php echo $company['company_position_count'] ?></td>
                </tr>
            <?php endwhile; ?>

            </tbody>
        </table>
        <?php
        $sql = /** @lang check the user exists in the system and his type */
            'SELECT company_id FROM company WHERE company_user_id = :user_id';
        $statement = $pdo->prepare($sql);
        $statement->bindValue(':user_id', $_SESSION['user_id'] ?? '');
        $statement->execute();
        $add_company = $statement->fetch();
        //student does not exist and user not a company
        if (!$add_company && $_SESSION['user_type'] != 1) : ?>
            <div class="links">
                <a href="add-company.php">Add Company</a>
            </div>
        <?php endif; ?>

    </main>
    <aside>
        <h2>Highlighted Company</h2>
        <hr>
        <p>
            This will contain a random special company details...
        </p>
    </aside>
<?php include "parts/_footer.php" ?>