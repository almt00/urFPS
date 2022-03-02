<!-- ======= Portfolio Section ======= -->
<section id="portfolio" class="portfolio">
    <div class="container" data-aos="fade-up">

        <div class="section-title mt-4">
            <h2>Jogos</h2>
            <p>Aqui podes ver todos os jogos da lista e saber mais detalhes sobre eles</p>
        </div>

        <div class="row">
            <div class="col-lg-12 d-flex justify-content-center">
                <ul id="portfolio-flters">
                    <li id="filtro_jogo" data-filter="*" class="filter-active">Todos</li>
                    <li id="filtro_franquia" data-filter="">Franquias</li>
                </ul>
            </div>
        </div>

        <!-- LISTA JOGOS -->
        <div id="lista_jogos" style="display: block;">
            <div class="row portfolio-container">
                <?php require_once("connections/connection.php");
                $link = new_db_connection();
                $stmt = mysqli_stmt_init($link);
                $query = "SELECT id_jogo,nome_jogo,imagem_jogo FROM mp_jogo";
                if (mysqli_stmt_prepare($stmt, $query)) { // Prepare the statement
                    mysqli_stmt_execute($stmt); // Execute the prepared statement
                    mysqli_stmt_bind_result($stmt, $id_jogo, $nome_jogo, $img); // Bind results
                    while (mysqli_stmt_fetch($stmt)) { // Fetch values
                        ?>
                        <div class="col-lg-4 col-md-6 portfolio-item filter-app">
                            <a href="portfolio-details.php?id=<?= $id_jogo ?>" title="More Details">
                                <div class="portfolio-wrap">
                                    <img src="assets/img/portfolio/<?= $img ?>" class="img-fluid" alt="">
                                    <div class="portfolio-info">
                                        <h4><?= $nome_jogo ?></h4>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <?php
                    }
                    mysqli_stmt_close($stmt); // Close statement
                    mysqli_close($link);
                }
                ?>
            </div>
        </div>

        <!-- LISTA FRANQUIAS -->
        <div id="lista_franquias" style="display: none;">
            <div class="row portfolio-container">
                <?php require_once("connections/connection.php");
                $link = new_db_connection();
                $stmt = mysqli_stmt_init($link);
                $query = "SELECT id_franquia,nome_franquia,imagem_franquia FROM mp_franquia";
                if (mysqli_stmt_prepare($stmt, $query)) { // Prepare the statement
                    mysqli_stmt_execute($stmt); // Execute the prepared statement
                    mysqli_stmt_bind_result($stmt, $id_franquia, $nome_franquia, $img_franquia); // Bind results
                    while (mysqli_stmt_fetch($stmt)) { // Fetch values
                        ?>
                        <div class="col-lg-4 col-md-6 portfolio-item filter-app">
                            <a href="franquia_details.php?id_franquia=<?= $id_franquia ?>">
                                <div class="portfolio-wrap">
                                    <img src="assets/img/portfolio/franquias/<?= $img_franquia ?>" class="img-fluid"
                                         alt="">
                                    <div class="portfolio-info">
                                        <h4><?= $nome_franquia ?></h4>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <?php
                    }
                    mysqli_stmt_close($stmt); // Close statement
                    mysqli_close($link);
                }
                ?>
            </div>
        </div>
    </div>
</section><!-- End Portfolio Section -->

<!-- SCRIPT PARA OS BOTOES -->
<script>
    document.getElementById('filtro_franquia').onclick = function () {
        document.getElementById('filtro_franquia').className = 'filter-active';
        document.getElementById('lista_franquias').style.display = 'block';
        document.getElementById('lista_jogos').style.display = 'none';
    }
    document.getElementById('filtro_jogo').onclick = function () {
        document.getElementById('filtro_franquia').className = '';
        document.getElementById('lista_franquias').style.display = 'none';
        document.getElementById('lista_jogos').style.display = 'block';
    }
</script>