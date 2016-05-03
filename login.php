<?php
    session_start();

    if (isset($_POST['username']) && isset($_POST['password'])) {
        include_once("db.php");
        $username = mysqli_real_escape_string($sqlcon, $_POST['username']);
        $username = strtoupper($username);
        $password = mysqli_real_escape_string($sqlcon, $_POST['password']);

        for ($i = 0; $i < 1000; $i++) {
            $password = hash(sha512, $password . $username);
        }

        $userQuery = "SELECT * FROM users WHERE username = '" . $username . "' LIMIT 1";
        $user = mysqli_query($sqlcon, $userQuery);

        if (mysqli_num_rows($user) > 0) {
            $user = mysqli_fetch_assoc($user);
            $id = $user['id'];
            $databasepass = $user['password'];

            if ($password === $databasepass) {
                $_SESSION['username'] = $username;
                $_SESSION['id'] = $id;
                header("Location: admin.php");
            } else {
                $incorrect = '<div class="alert alert-danger" style="text-align:center"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                The <strong>username</strong> or <strong>password</strong> you entered did not match our records. Please double-check and try again.</div>';
            }
        } else {
          $incorrect = '<div class="alert alert-danger" style="text-align:center"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
          The <strong>username</strong> or <strong>password</strong> you entered did not match our records. Please double-check and try again.</div>';
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
        <?php
            echo $incorrect;
        ?>
    </body>
</html>