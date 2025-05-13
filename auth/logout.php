<?php
    session_start();
    session_unset();
    session_destroy();
    
    if (isset($_COOKIE[session_name()])) {
        setcookie(session_name(), '', time() - 42000, '/', '', false, true);
    }
    
    header("Location: ../index.php"); 
    exit;
    ?>