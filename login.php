<?php
    session_start();

    if (isset($_POST['username']) && isset($_POST['password'])) {
        include_once("db.php");
        $username = mysqli_real_escape_string($sqlcon, $_POST['username']);
        $password = mysqli_real_escape_string($sqlcon, $_POST['password']);
        
        for ($i = 0; $i < 1000; $i++) {
            $password = hash(sha512, $password . $username);
        }

        $userQuery = "SELECT * FROM users WHERE username = '" . $username . "' LIMIT 1";
        $user = mysqli_query($sqlcon, $userQuery);

        if (mysqli_num_rows($user) > 0) { // If user exists,
            $user = mysqli_fetch_assoc($user); // mysqli_fetch_arrays put values into $user[0], $user[1], etc.
            $id = $user['id'];
            $databasepass = $user['password'];

            if ($password === $databasepass) {
                $_SESSION['username'] = $username;
                $_SESSION['id'] = $id;
                header("Location: index.php");
            } else {
                echo "The username and password you entered did not match our records. Please double-check and try again.";
            }
        } else {
            echo "The username and password you entered did not match our records. Please double-check and try again.";
        }
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Login</title>
    </head>
    <body>
        <h1>Login</h1>
        <form action="login.php" method="post" enctype="multipart/form-data">
            <input placeholder="Username" name="username" type="text" autofocus>
            <input placeholder="Password" name="password" type="password">
            <input name="login" type="submit" value="Login">
        </form>
    </body>
</html>