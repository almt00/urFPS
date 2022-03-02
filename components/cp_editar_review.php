<!-- ======= Hero Section ======= -->
<section id="hero" class="d-flex align-items-center">

    <?php
    if (isset($_GET['id_user']) && isset($_GET['id_jogo'])) {
        $id_user = $_GET['id_user'];
        $id_jogo = $_GET['id_jogo'];

        require_once "connections/connection.php";
        $link = new_db_connection();
        $stmt = mysqli_stmt_init($link);
        $query = "SELECT comentarios,ref_id_classificacao FROM mp_review WHERE ref_id_user=? AND ref_id_jogo=?";

        if (mysqli_stmt_prepare($stmt, $query)) { // Prepare the statement
            mysqli_stmt_bind_param($stmt, 'ii', $id_user, $id_jogo);
            if (mysqli_stmt_execute($stmt)) {
                mysqli_stmt_bind_result($stmt, $comentario, $ref_id_classificacao); // Bind results
                mysqli_stmt_fetch($stmt);
            }; // Execute the prepared statement
        } else {
            echo 'erro:' . mysqli_stmt_error($stmt);
        }
        mysqli_stmt_close($stmt); // Close statement
    }
    ?>

    <div class="container-fluid" data-aos="fade-up">
        <div class="row justify-content-center">
            <div class="col-xl-4 col-lg-4 pt-3 pt-lg-0 order-2 order-lg-1 d-flex flex-column justify-content-center">
                <h1>Editar Review</h1>
                <form name="editar_review" method="post" action="scripts/sc_user_review_edit.php?id_jogo=<?=$id_jogo?>">
                    <div class="form-group mt-4 ">
                        <label for="input_email" class="text-white">Editar comentário</label>
                        <textarea type="text" class="form-control" id="input_comment"
                                  name="input_comment" rows="4"><?= $comentario ?></textarea>
                    </div>
                    <div class="form-group mt-4 ">
                        <label for="classificacao" class="text-white">Classificação:</label>
                        <select id="classificacao" name="classificacao">
                            <?php
                            $stmt = mysqli_stmt_init($link);
                            $query = "SELECT id_classificacao,designacao_classificacao FROM mp_classificacao";
                            if (mysqli_stmt_prepare($stmt, $query)) { // Prepare the statement
                                mysqli_stmt_execute($stmt); // Execute the prepared statement
                                mysqli_stmt_bind_result($stmt, $id_classificacao, $classificacao); // Bind results
                                while (mysqli_stmt_fetch($stmt)) { // Fetch values
                                    $selected = "";
                                    if ($id_classificacao === $ref_id_classificacao) {
                                        $selected = "selected";
                                    }
                                    echo '<option value="' . $id_classificacao . '" ' . $selected . '>' . $classificacao . '</option>';
                                }
                            }
                            mysqli_stmt_close($stmt);
                            mysqli_close($link);
                            ?>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-get-started">Guardar Alterações</button>
                    <button type="submit" class="btn btn-get-started scrollto btn-danger" onclick="editar_review.action='scripts/sc_user_review_delete.php?id_jogo=<?=$id_jogo?>'">Eliminar Review</button>
                </form>
            </div>
        </div>
    </div>
</section><!-- End Hero -->