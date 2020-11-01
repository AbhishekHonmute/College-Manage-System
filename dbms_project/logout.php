<!DOCTYPE html>
<html>
    <head>
        <title>Logout</title>
    </head>
    <body>
        <?php 
            session_start();
            echo "<script>alert('Logout Successful');</script>";
            if (isset($_SESSION['login_user_mis'])) {
                unset($_SESSION['login_user_mis']);
            }
            if (isset($_SESSION['login_mode'])) {
                unset($_SESSION['login_mode']);
            }
            header("Location: login_page.php");
        ?>
    </body>
</html>
