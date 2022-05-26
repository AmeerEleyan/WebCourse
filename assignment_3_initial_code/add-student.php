<?php include "parts/_header.php" ?>
<main>
    <h2>Add Student</h2>
    <hr />
    <form class="add_form" action="/process.php" method="post">
        <table>
            <tbody>
                <tr>
                    <td>
                        <label for="student_photo_file">Personal Photo</label>
                    </td>
                    <td>
                        <input type="file" name="student_photo_file" id="student_photo_file" required autofocus>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="name">Name</label>
                    </td>
                    <td>
                        <input type="text" name="name" id="name" required placeholder="Name">
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="city">City</label>
                    </td>
                    <td>
                        <select name="city" id="city">
                            <option value="">Select City</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="email">Email</label>
                    </td>
                    <td>
                        <input type="email" name="email" id="email" required placeholder="email">
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="tel">Tel</label>
                    </td>
                    <td>
                        <input type="tel" name="tel" id="tel" required placeholder="telephone">
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="university">University</label>
                    </td>
                    <td>
                        <input type="text" name="university" id="university" required placeholder="university">
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="major">Major</label>
                    </td>
                    <td>
                        <input type="text" name="major" id="major" required placeholder="major">
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="projects">Projects</label>
                    </td>
                    <td>
                        <textarea name="projects" id="projects" placeholder="Enter about your projects"></textarea>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="interests">Interests</label>
                    </td>
                    <td>
                        <textarea name="interests" id="interests" placeholder="Enter about your interests"></textarea>
                    </td>
                </tr>
            </tbody>
        </table>
        <input type="submit" name="add_student" id="add_student" value="Add Student">
        <input type="reset" value="Clear">
    </form>
    <div class="links">
        <a class="link" href="../students.php/">Cancel and return to Student List</a>
    </div>
</main>
<aside>
    <h2>Help</h2>
    <p>
        Add your student details including projects and interests so that companies can select you...
    </p>
</aside>
<?php include "parts/_footer.php" ?>