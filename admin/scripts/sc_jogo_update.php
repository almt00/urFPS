<?php
session_start();

if (isset($_POST['id_jogo']) && ($_POST['id_jogo'] != '') &&
    isset($_POST['nome']) && ($_POST['nome'] != '') &&
    isset($_POST['data']) && ($_POST['data'] != '') &&
    isset($_POST['descricao']) && ($_POST['descricao'] != '') &&
    isset($_POST['id_distribuidora']) && ($_POST['id_distribuidora'] != '') &&
    isset($_POST['website'])) {

    $id_jogo = $_POST['id_jogo'];
    $nome = $_POST['nome'];
    $data = $_POST['data'];
    $descricao = $_POST['descricao'];
    if ($_POST['id_franquia'] === '') {
        $id_franquia = NULL;
    } else {
        $id_franquia = $_POST['id_franquia'];
    }
    $id_distribuidora = $_POST['id_distribuidora'];
    $website = $_POST['website'];

    /*if (isset($active) && ($active == "on")) {
        $active = 1;
    } else {
        $active = 0;
    }*/

    require_once("../connections/connection.php");

    $link = new_db_connection();

    $stmt = mysqli_stmt_init($link);

    $query = "UPDATE mp_jogo
            SET nome_jogo=?,data_jogo=?,descricao_jogo=?,ref_id_franquia=?, ref_id_distribuidora=?,website_jogo=?
            WHERE id_jogo=?";
    if (mysqli_stmt_prepare($stmt, $query)) {
        mysqli_stmt_bind_param($stmt, 'sssiisi', $nome, $data, $descricao, $id_franquia, $id_distribuidora, $website, $id_jogo);
        if (!mysqli_stmt_execute($stmt)) {
            echo "Error:" . mysqli_stmt_error($stmt);
        }
        mysqli_stmt_close($stmt);
    } else {
        echo("Error description: " . mysqli_error($link));
    }
    mysqli_close($link);
}
var_dump($id_franquia);
header("Location: ../pages/jogos.php");
