<!-- ======= Testimonials Section ======= -->
<section id="testimonials" class="testimonials section-bg">
    <div class="container" data-aos="fade-up">

        <div class="section-title">
            <h2>Reviews</h2>
        </div>

        <div class="testimonials-slider swiper-container" data-aos="fade-up" data-aos-delay="100">
            <div class="">

                <?php
                if (isset($_GET['id'])) {
                    $id_jogo = $_GET['id'];
                }
                $link = new_db_connection();
                $stmt = mysqli_stmt_init($link);
                $query = "SELECT comentarios, ref_id_classificacao, nome_user,ref_id_user FROM mp_review
                            INNER JOIN mp_user
                            ON ref_id_user=id_user
                            WHERE ref_id_jogo=?";
                if (mysqli_stmt_prepare($stmt, $query)) { // Prepare the statement
                    mysqli_stmt_bind_param($stmt, 'i', $id_jogo);
                    if (mysqli_stmt_execute($stmt)) { // Execute the prepared statement
                        mysqli_stmt_bind_result($stmt, $comentario, $id_classificacao, $username, $ref_id_user); // Bind results
                        while (mysqli_stmt_fetch($stmt)) { // Fetch values
                            ?>
                            <div class="swiper-slide">

                                <div class="testimonial-item">
                                    <p>
                                        <?php
                                        if (isset($_SESSION['id_user']) && $_SESSION['id_user'] === $ref_id_user) {
                                            echo "<a href='editar_review.php?id_user=$ref_id_user&id_jogo=$id_jogo'><i
                                    class='bx bxs-edit-alt edit-icon-right'></i></a>";
                                        }
                                        ?>
                                        <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                                        <?= $comentario ?>
                                        <i class="bx bxs-quote-alt-right quote-icon-right"></i>
                                    </p>
                                    <img src="assets/img/testimonials/classificacao_<?= $id_classificacao ?>.png"
                                         class="testimonial-img" alt="classificacao_<?= $id_classificacao ?>">
                                    <h3><?= $username ?></h3>
                                </div>

                            </div><!-- End testimonial item -->
                            <?php
                        }
                    }
                }
                mysqli_stmt_close($stmt);
                mysqli_close($link);
                ?>

            </div>
            <div class="swiper-pagination"></div>
        </div>

    </div>
</section><!-- End Testimonials Section -->
