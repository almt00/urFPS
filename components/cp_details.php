<?php
if (isset($_GET['id']) && $_GET['id'] != '') {
    $id_jogo = $_GET['id'];
    require_once("connections/connection.php");
    $link = new_db_connection();
    $stmt = mysqli_stmt_init($link);
    $query = "SELECT nome_jogo,imagem_jogo,data_jogo,descricao_jogo,nome_distribuidora,website_jogo 
            FROM mp_jogo
            INNER JOIN
            mp_distribuidora 
            ON ref_id_distribuidora=id_distribuidora
            WHERE id_jogo=?";
    if (mysqli_stmt_prepare($stmt, $query)) { // Prepare the statement
        mysqli_stmt_bind_param($stmt, 'i', $id_jogo);
        mysqli_stmt_execute($stmt); // Execute the prepared statement
        mysqli_stmt_bind_result($stmt, $nome_jogo, $img, $data_jogo, $descricao_jogo, $ref_distribuidora, $website_jogo); // Bind results
        mysqli_stmt_fetch($stmt);
        mysqli_stmt_close($stmt); // Close statement
    }
} else {
    header("Location: index.php");
    die();
}
?>

<main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <section id="breadcrumbs" class="breadcrumbs">
        <div class="container">

            <div class="d-flex justify-content-between align-items-center">
                <h2>Detalhes do Jogo</h2>
                <ol>
                    <li><a href="galeria_jogos.php">Lista de Jogos</a></li>
                    <li>Detalhes do Jogo</li>
                </ol>
            </div>

        </div>
    </section><!-- End Breadcrumbs -->

    <!-- ======= Portfolio Details Section ======= -->
    <section id="portfolio-details" class="portfolio-details">
        <div class="container">

            <div class="row gy-4">

                <div class="col-lg-7">
                    <div class=" align-items-center">
                        <img class="img-fluid" src="assets/img/portfolio/<?= $img ?>" alt="<?= $nome_jogo ?>">
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="portfolio-info">
                        <h3><?= $nome_jogo ?></h3>
                        <ul>
                            <?php
                            $stmt = mysqli_stmt_init($link);
                            $query = "SELECT nome_desenvolvedora FROM  mp_desenvolvedora
                                    INNER JOIN mp_jogo_has_mp_desenvolvedora
                                    ON ref_id_desenvolvedora=id_desenvolvedora
                                    WHERE ref_id_jogo=?";
                            if (mysqli_stmt_prepare($stmt, $query)) { // Prepare the statement
                            mysqli_stmt_bind_param($stmt, 'i', $id_jogo);
                            mysqli_stmt_execute($stmt); // Execute the prepared statement
                            mysqli_stmt_bind_result($stmt, $nome_desenvolvedora); // Bind results
                            ?>
                            <li><strong>Desenvolvedora</strong>:<p>
                                    <?php
                                    while (mysqli_stmt_fetch($stmt)) {
                                        echo $nome_desenvolvedora . '<br>';
                                    };
                                    mysqli_stmt_close($stmt); // Close statement
                                    }
                                    ?></p>
                            </li>
                            <li><strong>Publicadora</strong>: <?= $ref_distribuidora ?></li>
                            <li><strong>Data de lançamento</strong>: <?= $data_jogo ?></li>
                            <?php
                            $stmt = mysqli_stmt_init($link);
                            $query = "SELECT nome_plataforma FROM  mp_plataforma
                                    INNER JOIN mp_jogo_has_mp_plataforma
                                    ON ref_id_plataforma=id_plataforma
                                    WHERE ref_id_jogo=?";
                            if (mysqli_stmt_prepare($stmt, $query)) { // Prepare the statement
                            mysqli_stmt_bind_param($stmt, 'i', $id_jogo);
                            mysqli_stmt_execute($stmt); // Execute the prepared statement
                            mysqli_stmt_bind_result($stmt, $nome_plataforma); // Bind results
                            ?>
                            <li><strong>Plataformas</strong>:<p>
                                    <?php
                                    while (mysqli_stmt_fetch($stmt)) {
                                        echo $nome_plataforma . '<br>';
                                    };
                                    mysqli_stmt_close($stmt); // Close statement
                                    mysqli_close($link);
                                    }
                                    ?></p>
                                <?php
                                if ($website_jogo != NULL) {
                                    echo "<li><strong>Website</strong>: <a href=" . $website_jogo . " target='_blank'>$website_jogo</a> </li>";
                                }
                                ?>

                        </ul>

                    </div>
                    <?php
                    if (isset($_SESSION['username'])) {
                        echo '<button class=" mt-4 w-100 btn btn-detalhe" id="btn-review">Fazer Review</button>';
                    } else {
                        echo "<h4 class='m-3'><a href='login.php'>Inicia sessão</a> pra deixares uma review!</h4>";
                    }
                    ?>
                    <script>
                        document.getElementById('btn-review').onclick = function show() {
                            if (document.getElementById('input-review').style.display === "none") {
                                document.getElementById('input-review').style.display = "block";
                            } else {
                                document.getElementById('input-review').style.display = "none";
                            }
                        }
                    </script>

                </div>
                <div class="row p-0">
                    <div class="portfolio-description col-lg-6">
                        <h2>Sobre este jogo</h2>
                        <p>
                            <?= $descricao_jogo ?>
                        </p>
                    </div>
                    <div class="portfolio-description col-lg-6" id="input-review" style="display: none">
                        <form method="post" action="scripts/sc_user_review.php?id=<?= $id_jogo ?>">
                            <div class="form-group mt-4 ">
                                <textarea rows="4" autofocus type="text" class="form-control" id="input_comment"
                                          name="input_comment"
                                          placeholder="Comentário"></textarea>
                            </div>
                            <div class="form-group mt-4 ">
                                <label for="classificacao">Classificação:</label>
                                <select id="classificacao" name="classificacao">
                                    <?php
                                    $link = new_db_connection();
                                    $stmt = mysqli_stmt_init($link);
                                    $query = "SELECT id_classificacao,designacao_classificacao FROM mp_classificacao";
                                    if (mysqli_stmt_prepare($stmt, $query)) { // Prepare the statement
                                        mysqli_stmt_execute($stmt); // Execute the prepared statement
                                        mysqli_stmt_bind_result($stmt, $id_classificacao, $classificacao); // Bind results
                                        while (mysqli_stmt_fetch($stmt)) { // Fetch values
                                            echo '<option value="' . $id_classificacao . '">' . $classificacao . '</option>';
                                        }
                                    }
                                    mysqli_stmt_close($stmt);
                                    mysqli_close($link);
                                    ?>


                                </select>
                            </div>
                            <button type="submit" class="btn btn-detalhe">Submeter</button>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </section><!-- End Portfolio Details Section -->

</main><!-- End #main -->