<?php include "parts/_header.php" ?>
<main>
    <h2>Companies List</h2>
    <hr>
    <form class="simple_form" method="get">
        <label for="company_name">Company Name:</label>
        <input type="search" name="company_name" id="company_name" placeholder="company name">
        <label for="city">City:</label>
        <select name="city" id="city">
            <option value="">Select City</option>
        </select>
        <button type="submit">Search</button>
    </form>
    <table class="list_table_companies">
        <thead>
            <tr>
                <th>Logo</th>
                <th>Name</th>
                <th>City</th>
                <th>Open Positions</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><img src="../images/company.png" alt="company logo"></td>
                <td><a href="../company.php/">Harri</a></td>
                <td>Jerusalem</td>
                <td>3</td>
            </tr>
            <tr>
                <td><img src="../images/company.png" alt="company logo"></td>
                <td><a href="../company.php/">EXALT</a></td>
                <td>Nablus</td>
                <td>0</td>
            </tr>
            <tr>
                <td><img src="../images/asal.jpg" alt="company logo"></td>
                <td><a href="../company.php/">ASAL</a></td>
                <td>Ramallah</td>
                <td>7</td>
            </tr>
            <tr>
                <td><img src="../images/company.png" alt="company logo"></td>
                <td><a href="../company.php/">Proginner</a></td>
                <td>Gaza</td>
                <td>1</td>
            </tr>
            <tr>
                <td><img src="../images/company.png" alt="company logo"></td>
                <td><a href="../company.php/">Freighots</a></td>
                <td>Amman</td>
                <td>2</td>
            </tr>
        </tbody>
    </table>
    <div class="links">
        <a href="../add-company.php/">Add Company</a>
    </div>
</main>
<aside>
    <h2>Highlighted Company</h2>
    <hr>
    <p>
        This will contain a random special company details...
    </p>
</aside>
<?php include "parts/_footer.php" ?>