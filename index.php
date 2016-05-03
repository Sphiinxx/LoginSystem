<?php
    session_start();

    if (!isset($_SESSION['id'])) {
        header("Location: login.php");
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <title>YAY</title>
    </head>
    <body>
        <h1>YAY TEST</h1>
        </form>
    </body>
</html>