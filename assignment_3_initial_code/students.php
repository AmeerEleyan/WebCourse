<?php include "parts/_header.php" ?>
<main>
    <h2>Students List</h2>
    <hr>
    <form class="simple_form" method="get">
        <label for="student_study_major">Student Study Major:</label>
        <input type="search" name="student_study_major" id="student_study_major" placeholder="major">
        <label for="city">City:</label>
        <select name="city" id="city">
            <option value="">Select City</option>
        </select>
        <button type="submit">Search</button>
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
            <tr>
                <td><img src="../images/MyPhoto.jpg" alt="student_photo"></td>
                <td><a href="../student.php/">Ameer Eleyan</a></td>
                <td>Birzeit</td>
                <td>Birzeit University</td>
                <td>Computer Science</td>
            </tr>
            <tr>
                <td><img src="../images/student.png" alt="student_photo"></td>
                <td><a href="../student.php/">Ahmad Ali</a></td>
                <td>Jerusalem</td>
                <td>Birzeit University</td>
                <td>Computer Engineering</td>
            </tr>
            <tr>
                <td><img src="../images/student.png" alt="student_photo"></td>
                <td><a href="../student.php/">Marwan Mohammad</a></td>
                <td>Nublus</td>
                <td>QOU</td>
                <td>Teaching</td>
            </tr>
            <tr>
                <td><img src="../images/student.png" alt="student_photo"></td>
                <td><a href="../student.php/">Rawan Mahmoud</a></td>
                <td>Hebron</td>
                <td>Palestine Polytechnic University</td>
                <td>Mechanical Engineering</td>
            </tr>
        </tbody>
    </table>
    <div class="links">
        <a href="../add-student.php/">Add Student</a>
    </div>
</main>
<aside>
    <h2>Distinguished Students</h2>
    <hr>
    <p>
        Student Ali Ahmad from Birzeit is very special and he is looking for training in Computer Science...
    </p>
</aside>
<?php include "parts/_footer.php" ?>