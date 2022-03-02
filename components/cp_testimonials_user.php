<?php
require_once "connections/connection.php";
if (isset($_SESSION['id_user'])) {
?>
<!-- ======= Testimonials Section ======= -->
<section id="testimonials" class="testimonials section-bg">
    <div class="container" data-aos="fade-up">

        <div class="section-title">
            <h2>Minhas Reviews</h2>
        </div>

        <div class="testimonials-slider swiper-container" data-aos="fade-up" data-aos-delay="100">
            <div class="">

                <?php
                $id_user = $_SESSION['id_user'];
                $link = new_db_connection();
                $stmt = mysqli_stmt_init($link);
                $query = "SELECT ref_id_user, ref_id_jogo,comentarios,nome_jogo,ref_id_classificacao FROM mp_review
                        INNER JOIN mp_jogo
                        ON ref_id_jogo=id_jogo
                        WHERE ref_id_user=?";
                if (mysqli_stmt_prepare($stmt, $query)) { // Prepare the statement
                    mysqli_stmt_bind_param($stmt, 'i', $id_user);
                    if (mysqli_stmt_execute($stmt)) { // Execute the prepared statement
                        mysqli_stmt_bind_result($stmt, $ref_id_user, $id_jogo, $comentario, $nome_jogo, $id_classificacao); // Bind results
                        while (mysqli_stmt_fetch($stmt)) { // Fetch values
                            ?>
                            <div class="swiper-slide">

                                <div class="testimonial-item">
                                    <p>
                                        <a href="editar_review.php?id_user=<?= $ref_id_user ?>&id_jogo=<?= $id_jogo ?>"><i
                                                    class="bx bxs-edit-alt edit-icon-right"></i></a>
                                        <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                                        <?= $comentario ?>
                                        <i class="bx bxs-quote-alt-right quote-icon-right"></i>
                                    </p>
                                    <img src="assets/img/testimonials/classificacao_<?= $id_classificacao ?>.png"
                                         class="testimonial-img" alt="classificacao_<?= $id_classificacao ?>">
                                    <h3><a href="portfolio-details.php?id=<?= $id_jogo ?>"><?= $nome_jogo ?></a></h3>
                                </div>

                            </div><!-- End testimonial item -->
                            <?php
                        }
                    }
                }
                mysqli_stmt_close($stmt);
                mysqli_close($link);
                } else {
                    header("Location: index.php");
                }
                ?>

            </div>
            <div class="swiper-pagination"></div>
        </div>

    </div>
</section><!-- End Testimonials Section -->
