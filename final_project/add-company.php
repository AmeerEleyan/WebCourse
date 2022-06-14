<?php include "parts/_header.php" ?>
<main>
    <h2>Add Company</h2>
    <hr />
    <form class="add_form" action="/process.php" method="post">
        <table>
            <tbody>
                <tr>
                    <td>
                        <label for="logo">Logo</label>
                    </td>
                    <td>
                        <input type="file" name="logo-file" id="logo" required>
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
                        <label for="pos_count">Positions Count</label>
                    </td>
                    <td>
                        <input type="number" name="pos_count" id="pos_count" required placeholder="positions count">
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="pos_details">Positions Details</label>
                    </td>
                    <td>
                        <textarea name="pos_details" id="pos_details" placeholder="Enter the positions details"></textarea>
                    </td>
                </tr>
            </tbody>
        </table>
        <input type="submit" name="add_company" id="add_company" value="Add Company">
        <input type="reset" value="Clear">
    </form>
    <div class="links">
        <a href="../companies.php/">Cancel and return to Companies List</a>
    </div>
</main>
<aside>
    <h2>Help</h2>
    <p>
        Add company and positions details so that students can find you...
    </p>
</aside>
<?php include "parts/_footer.php" ?>