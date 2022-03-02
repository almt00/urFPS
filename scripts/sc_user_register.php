<?php
require_once "../connections/connection.php";
if (isset($_POST['input_email']) && (isset($_POST['input_username'])) && (isset($_POST['input_password'])) && (isset($_POST['input_confirm']))) {
    $username = $_POST['input_username'];
    $email = $_POST['input_email'];
    $password_hash = password_hash($_POST['input_password'], PASSWORD_DEFAULT);
    $link = new_db_connection();
    $stmt = mysqli_stmt_init($link);
    $query = "INSERT INTO mp_user (nome_user,mail_user,password_hash) VALUES (?,?,?)";
    if (mysqli_stmt_prepare($stmt, $query)) {
        mysqli_stmt_bind_param($stmt, 'sss', $username, $email, $password_hash);
        if (mysqli_stmt_execute($stmt)) {
           /* session_start();
            $_SESSION['username'] = $username;
            $_SESSION['id_user'] = $username; // colocar id
            $_SESSION["role"] = $id_roles;*/


            header("Location: ../index.php?msg=1#login");
        } else {
            header("Location: ../index.php?msg=0#login");
        }
    }
    mysqli_stmt_close($stmt);
    mysqli_close($link);


}