<?php
require_once "../connections/connection.php";
// var_dump($_GET['id']);
session_start();
if (isset($_GET['id']) && isset($_POST['input_comment']) && (isset($_POST['classificacao'])) && (isset($_SESSION['id_user']))) {
    $id_jogo = $_GET['id'];
    $input_comment = $_POST['input_comment'];
    $classificacao = $_POST['classificacao'];
    $id_user = $_SESSION['id_user'];
    $link = new_db_connection();
    $stmt = mysqli_stmt_init($link);
    $query = "INSERT INTO mp_review (ref_id_user,ref_id_jogo,comentarios,ref_id_classificacao) VALUES (?,?,?,?)";
    if (mysqli_stmt_prepare($stmt, $query)) {
        mysqli_stmt_bind_param($stmt, 'iisi', $id_user, $id_jogo, $input_comment, $classificacao);
        if (mysqli_stmt_execute($stmt)) {
            header("Location: ../portfolio-details.php?id=$id_jogo");
        } else {
            echo 'erro exe';
            header('Location: ../portfolio-details.php?id='.$id_jogo);//  implementar forma de so dar review se for possivel ou não existir uma feita ainda
            die();
        }
    } else {
        echo 'erro prepare';
    }
    mysqli_stmt_close($stmt);
    mysqli_close($link);


} else {
    echo 'erro fatal';
    var_dump($_GET['id'], $_SESSION['id_user']);
}