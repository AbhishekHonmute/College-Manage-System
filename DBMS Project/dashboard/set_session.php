<?php
    session_start();
    if(isset($_POST['session_name'])) {
        $_SESSION[$_POST['session_name']] = $_POST['session_value'];
    }
    // if(isset($_SESSION['session_name'])) {
    //     echo $_SESSION['session_name'];
    // }
?>