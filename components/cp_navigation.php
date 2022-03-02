<!-- ======= Header ======= -->
<?php
session_start();
?>
<header id="header" class="fixed-top ">
    <div class="container d-flex align-items-center justify-content-between">
        <h1 class="logo"><a href="index.php">ur.FPS</a></h1>

        <nav id="navbar" class="navbar">
            <ul>

                <li><a class="nav-link scrollto" href="index.php#index">Homepage</a></li>
                <li><a class="nav-link scrollto " href="galeria_jogos.php#lista_jogos">Lista de Jogos</a></li>
                <li><a class="nav-link scrollto " href="galeria_jogos.php#lista_franquias">Franquias</a></li>
                <!--rever-->
                <?php
                if (isset($_SESSION['role']) && $_SESSION['role'] == 1) {
                    echo "<li><a class='nav-link scrollto' href='admin/pages/jogos.php'>Admin</a></li>";
                }
                ?>

                <?php
                if (isset($_SESSION['username'])) { ?>
                    <li class="dropdown"><a class=" getstarted scrollto " href=""><?= $_SESSION["username"] ?></a>
                        <ul>
                            <li class="dropdown-item"><a href="reviews.php">Reviews</a></li>
                            <li class="dropdown-item"><a href="gerir_conta.php">Gerir Conta</a></li>
                            <?php
                            if (isset($_SESSION['role']) && $_SESSION['role'] == 1) {
                                echo "<li class='dropdown-item'><a class='nav-link scrollto' href='admin/pages/jogos.php'>Admin</a></li>";
                            }
                            ?>
                            <li class="dropdown-item"><a href="scripts/sc_user_logout.php">Logout</a></li>
                        </ul>
                    </li>
                <?php } elseif (!isset($_SESSION['username'])) { ?>
                    <li><a class="getstarted scrollto" href="login.php">Login</a></li>
                    <?php
                }
                ?>

            </ul>
            <i class="bi bi-list mobile-nav-toggle"></i>
        </nav><!-- .navbar -->

    </div>
</header><!-- End Header -->
