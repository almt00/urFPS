<?php
require_once "../connections/connection.php";
// var_dump($_GET['id']);
session_start();
if (isset($_GET['id_jogo']) && (isset($_SESSION['id_user']))) {
    $id_jogo = $_GET['id_jogo'];
    // var_dump($classificacao);
    $id_user = $_SESSION['id_user'];
    $link = new_db_connection();
    $stmt = mysqli_stmt_init($link);
    $query = "DELETE FROM mp_review WHERE ref_id_jogo=? AND ref_id_user=?";
    if (mysqli_stmt_prepare($stmt, $query)) {
        mysqli_stmt_bind_param($stmt, 'ii', $id_jogo, $id_user);
        if (mysqli_stmt_execute($stmt)) {
            header("Location: ../reviews.php");
        } else {
            echo 'erro exe'; //  implementar forma de so dar review se for possivel ou não existir uma feita ainda
        }
    } else {
        echo 'erro prepare';
    }
    mysqli_stmt_close($stmt);
    mysqli_close($link);
} else {
    echo 'erro fatal';
}