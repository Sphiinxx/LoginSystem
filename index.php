<?php
    session_start();

    if (!isset($_SESSION['id'])) {
        header("Location: login.php");
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Logged In</title>
    </head>
    <body>
        <h1>Logged In</h1>
        </form>
    </body>
</html>