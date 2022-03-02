<!-- ======= Portfolio Section ======= -->
<section id="portfolio" class="portfolio">
    <div class="container" data-aos="fade-up">

        <div class="section-title mt-4">
            <?php require_once("connections/connection.php");
            $id_franquia = $_GET['id_franquia'];
            $link = new_db_connection();
            $stmt = mysqli_stmt_init($link);
            $query = "SELECT nome_franquia FROM mp_franquia WHERE id_franquia=?";
            if (mysqli_stmt_prepare($stmt, $query)) { // Prepare the statement
                mysqli_stmt_bind_param($stmt, 'i', $id_franquia);
                mysqli_stmt_execute($stmt); // Execute the prepared statement
                mysqli_stmt_bind_result($stmt, $nome_franquia); // Bind results
                while (mysqli_stmt_fetch($stmt)) { // Fetch values
                    echo '<h2>' . $nome_franquia . '</h2>';
                }
            }
            mysqli_stmt_close($stmt); // Close statement
            ?>
        </div>

        <!-- LISTA JOGOS DA FRANQUIA-->
        <div id="lista_jogos">
            <div class="row portfolio-container">
                <?php
                $stmt = mysqli_stmt_init($link);
                $query = "SELECT id_jogo,nome_jogo,imagem_jogo FROM mp_jogo WHERE ref_id_franquia=?";
                if (mysqli_stmt_prepare($stmt, $query)) { // Prepare the statement
                    mysqli_stmt_bind_param($stmt, 'i', $id_franquia);
                    mysqli_stmt_execute($stmt); // Execute the prepared statement
                    mysqli_stmt_bind_result($stmt, $id_jogo, $nome_jogo, $img); // Bind results
                    while (mysqli_stmt_fetch($stmt)) { // Fetch values
                        ?>
                        <div class="col-lg-4 col-md-6 portfolio-item filter-app">
                            <a href="portfolio-details.php?id=<?= $id_jogo ?>" title="More Details"><div class="portfolio-wrap">
                                <img src="assets/img/portfolio/<?= $img ?>" class="img-fluid" alt="">
                                <div class="portfolio-info">
                                    <h4><?= $nome_jogo ?></h4>
                                </div>
                                </div></a>
                        </div>
                        <?php
                    }
                    mysqli_stmt_close($stmt); // Close statement
                    mysqli_close($link);
                }
                ?>
            </div>
        </div>