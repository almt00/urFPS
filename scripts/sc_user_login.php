<?php
require_once "../connections/connection.php";
if ((isset($_POST['input_username'])) && (isset($_POST['input_password']))) {
    $username = $_POST['input_username'];
    $password = $_POST['input_password'];
    $link = new_db_connection();
    $stmt = mysqli_stmt_init($link);
    $query = "SELECT password_hash, id_user,id_roles FROM mp_user WHERE nome_user LIKE ?";
    if (mysqli_stmt_prepare($stmt, $query)) {
        mysqli_stmt_bind_param($stmt, 's', $username);
        if (mysqli_stmt_execute($stmt)) {
            mysqli_stmt_bind_result($stmt, $password_hash, $id_user,$id_roles);
            if (mysqli_stmt_fetch($stmt)) {
                if (password_verify($password, $password_hash)) {
                    // Guardar sessão de utilizador
                    session_start();
                    $_SESSION["username"] = $username;
                    $_SESSION["id_user"] = $id_user;
                    $_SESSION["role"] = $id_roles;
                    // Feedback de sucesso
                    header("Location: ../login.php?msg=3#login");
                } else {
                    // Password está errada
                    header("Location: ../login.php?msg=2#login");
                }
                mysqli_stmt_close($stmt);
                mysqli_close($link);
            }
        }
    }
}
