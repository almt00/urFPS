<main id="main">

    <!-- ======= About Section ======= -->
    <section id="about" class="about">
        <div class="container">

            <div class="row">
                <div class="col-lg-6 order-1 order-lg-2" data-aos="zoom-in" data-aos-delay="150">
                    <img src="assets/img/about.png" class="img-fluid w-auto" alt="">
                </div>
                <div class="col-lg-6 pt-4 pt-lg-0 order-2 order-lg-1 content" data-aos="fade-right">
                    <h3>Encontra os teus jogos favoritos e descobre o próximo!</h3>
                    <p class="fst-italic">
                        Bem-vindo ao ur.FPS, onde vais encontrar os jogos FPS mais populares, incluindo o teu favorito!
                        Deixa a tua opinião e descobre mais através...
                    </p>
                    <ul>
                        <li><i class="bi bi-check-circle"></i> da lista de jogos principal com todos os jogos...
                        </li>
                        <li><i class="bi bi-check-circle"></i> da lista das franquias para encontrares o teu jogo mais
                            facilmente...
                        </li>
                        <li><i class="bi bi-check-circle"></i> das reviews deixadas pelos utilizadores em cada jogo.
                            Vem descobrir o que acham dos teus jogos preferidos e junta-te deixando a tua review!
                        </li>
                    </ul>
                    <a href="galeria_jogos.php" class="read-more">Ver Jogos<i class="bi bi-long-arrow-right"></i></a>
                </div>
            </div>

        </div>
    </section><!-- End About Section -->

    <!-- ======= Counts Section ======= -->
    <section id="counts" class="counts">
        <div class="container">

            <div class="row counters">
                <?php
                require_once "connections/connection.php";
                $link = new_db_connection();
                $stmt = mysqli_stmt_init($link);
                $query = "SELECT COUNT(id_jogo) FROM mp_jogo";
                if (mysqli_stmt_prepare($stmt, $query)) {
                    // mysqli_stmt_bind_param($stmt, 's', $username);
                    if (mysqli_stmt_execute($stmt)) {
                        mysqli_stmt_bind_result($stmt, $n_jogos);
                        if (mysqli_stmt_fetch($stmt)) {
                            mysqli_stmt_close($stmt);
                        }
                    }
                }
                ?>
                <div class="col-lg-3 col-6 text-center">
                    <span data-purecounter-start="700" data-purecounter-end="<?= $n_jogos ?>" data-purecounter-duration="1"
                          class="purecounter"></span>
                    <p>Jogos</p>
                </div>
                <?php
                $stmt = mysqli_stmt_init($link);
                $query = "SELECT COUNT(ref_id_franquia) FROM mp_jogo";
                if (mysqli_stmt_prepare($stmt, $query)) {
                    // mysqli_stmt_bind_param($stmt, 's', $username);
                    if (mysqli_stmt_execute($stmt)) {
                        mysqli_stmt_bind_result($stmt, $n_franquias);
                        if (mysqli_stmt_fetch($stmt)) {
                            mysqli_stmt_close($stmt);
                        }
                    }
                }
                ?>
                <div class="col-lg-3 col-6 text-center">
                    <span data-purecounter-start="400" data-purecounter-end="<?=$n_franquias?>" data-purecounter-duration="1"
                          class="purecounter"></span>
                    <p>Franquias</p>
                </div>
                <?php
                $stmt = mysqli_stmt_init($link);
                $query = "SELECT COUNT(comentarios) FROM mp_review";
                if (mysqli_stmt_prepare($stmt, $query)) {
                    // mysqli_stmt_bind_param($stmt, 's', $username);
                    if (mysqli_stmt_execute($stmt)) {
                        mysqli_stmt_bind_result($stmt, $n_reviews);
                        if (mysqli_stmt_fetch($stmt)) {
                            mysqli_stmt_close($stmt);
                        }
                    }
                }
                ?>
                <div class="col-lg-3 col-6 text-center">
                    <span data-purecounter-start="100" data-purecounter-end="<?=$n_reviews?>" data-purecounter-duration="1"
                          class="purecounter"></span>
                    <p>Reviews</p>
                </div>
                <?php
                $stmt = mysqli_stmt_init($link);
                $query = "SELECT COUNT(id_user) FROM mp_user";
                if (mysqli_stmt_prepare($stmt, $query)) {
                    // mysqli_stmt_bind_param($stmt, 's', $username);
                    if (mysqli_stmt_execute($stmt)) {
                        mysqli_stmt_bind_result($stmt, $n_users);
                        if (mysqli_stmt_fetch($stmt)) {
                            mysqli_stmt_close($stmt);
                            mysqli_close($link);
                        }
                    }
                }
                ?>
                <div class="col-lg-3 col-6 text-center">
                    <span data-purecounter-start="340" data-purecounter-end="<?=$n_users?>" data-purecounter-duration="1"
                          class="purecounter"></span>
                    <p>Utilizadores</p>
                </div>
            </div>
        </div>
    </section><!-- End Counts Section -->
</main><!-- End #main -->