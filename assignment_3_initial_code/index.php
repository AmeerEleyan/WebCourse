<?php include "./parts/_header.php" ?>
<main>
    <h2>Login</h2>
    <hr />
    <form id="login_from" action="/process.php" method="post">
        <label for="username">User name</label>
        <input type="text" name="user_name" id="username" required placeholder="Username" autofocus>
        <br>
        <label for="password">Password </label>
        <input type="password" name="password" id="password" required placeholder="Password">
        <br>
        <input type="submit" name="login" id="login" value="Login">
    </form>
</main>
<aside>
    <h2>Aside</h2>
    <hr>
    <p>
        The aside will have information related to the current page or ads.
    </p>
</aside>
<?php include "./parts/_footer.php" ?>