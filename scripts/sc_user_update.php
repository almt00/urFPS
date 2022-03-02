<?php
session_start();
if (isset($_POST['input_email']) && (isset($_POST['input_username'])) && (isset($_POST['input_password_verify']))) {
    require_once "../connections/connection.php";

    $link = new_db_connection();
    $stmt = mysqli_stmt_init($link);
    // check
    if (isset($_POST['input_password_verify']) && (isset($_POST['input_username'])) && (isset($_POST['input_email']))) {
        //check
        $password = $_POST['input_password_verify'];
        $username = $_POST['input_username'];
        $email = $_POST['input_email'];
        $query = "SELECT password_hash FROM mp_user WHERE id_user=?";
        if (mysqli_stmt_prepare($stmt, $query)) {
            mysqli_stmt_bind_param($stmt, 'i', $_SESSION['id_user']);
            if (mysqli_stmt_execute($stmt)) {
                // check
                mysqli_stmt_bind_result($stmt, $password_hash);
                mysqli_stmt_fetch($stmt);
                if (!password_verify($password, $password_hash)) {
                    //check
                    // password errada
                    echo mysqli_stmt_error($stmt) . mysqli_connect_error();
                    mysqli_stmt_close($stmt);
                    mysqli_close($link);
                    header("Location: ../index.php?msg=1#login");
                    die();
                } else {
                    mysqli_stmt_close($stmt);
                    if (isset($_POST['input_new_password']) && $_POST['input_new_password'] != '') {
                        $new_password_hash = password_hash($_POST['input_new_password'], PASSWORD_DEFAULT);
                        $stmt = mysqli_stmt_init($link);
                        $query = "UPDATE mp_user SET nome_user=?,mail_user=?,password_hash=? WHERE id_user=?";
                        if (mysqli_stmt_prepare($stmt, $query)) {
                            mysqli_stmt_bind_param($stmt, 'sssi', $username, $email, $new_password_hash, $_SESSION['id_user']);
                            if (mysqli_stmt_execute($stmt)) {
                                // session_start();
                                // $_SESSION['username'] = $username;
                                header("Location: ../index.php");
                            } else {
                                header("Location: ../index.php?msg=0#login");
                            }
                        }
                        mysqli_stmt_close($stmt);
                        mysqli_close($link);
                        die();
                    } else {
                        $stmt = mysqli_stmt_init($link);
                        $query = "UPDATE mp_user SET nome_user=?,mail_user=? WHERE id_user=?";
                        if (mysqli_stmt_prepare($stmt, $query)) {
                            mysqli_stmt_bind_param($stmt, 'ssi', $username, $email, $_SESSION['id_user']);
                            if (mysqli_stmt_execute($stmt)) {
                                //check
                                $_SESSION['username'] = $username;
                                 header("Location: ../index.php");
                            } else {
                                 header("Location: ../gerir_conta.php");
                            }
                        }
                        mysqli_stmt_close($stmt);
                        mysqli_close($link);
                    }
                }
            } else {
                header("Location: ../index.php?msg=0#login");
            }
        }
    }
}