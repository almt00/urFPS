<!-- ======= Hero Section ======= -->
<?php
if (isset($_SESSION['id_user'])){
?>
<section id="hero" class="d-flex align-items-center">

    <?php
    require_once "connections/connection.php";
    $link=new_db_connection();
    $stmt=mysqli_stmt_init($link);
    $query="SELECT nome_user,mail_user,password_hash FROM mp_user WHERE id_user=?";
    if (mysqli_stmt_prepare($stmt, $query)) { // Prepare the statement
        mysqli_stmt_bind_param($stmt, 'i', $_SESSION['id_user']);
        mysqli_stmt_execute($stmt); // Execute the prepared statement
        mysqli_stmt_bind_result($stmt, $username,$mail_user,$password_hash); // Bind results
        mysqli_stmt_fetch($stmt);
    }
    mysqli_stmt_close($stmt); // Close statement
    ?>

    <div class="container-fluid" data-aos="fade-up">
        <div class="row justify-content-center">
            <div class="col-xl-4 col-lg-4 pt-3 pt-lg-0 order-2 order-lg-1 d-flex flex-column justify-content-center">
                <h1>Alterar Dados</h1>
                <form method="post" action="scripts/sc_user_update.php">
                    <div class="form-group mt-4 ">
                        <label for="input_email" class="text-white">Alterar Email</label>
                        <input type="text" class="form-control" id="input_email" name="input_email"
                               placeholder="<?=$mail_user?>" value="<?=$mail_user?>">
                    </div>
                    <div class="form-group mt-4 ">
                        <label for="input_username" class="text-white">Alterar Username</label>
                        <input type="text" class="form-control" id="input_username" name="input_username"
                               placeholder="<?=$username?>" value="<?=$username?>">
                    </div>
                    <div class="form-group mt-4 ">
                        <label for="input_password" class="text-white">Inserir Password Antiga</label>
                        <input type="password" class="form-control" id="input_password_verify" name="input_password_verify"
                               placeholder="Password Antiga" autocomplete="off">
                    </div>
                    <div class="form-group mt-4 ">
                        <label for="input_new_password" class="text-white">Alterar Password</label>
                        <input type="password" class="form-control" id="input_confirm" name="input_new_password"
                               placeholder="Nova Password">
                    </div>
                    <button type="submit" class="btn btn-get-started scrollto">Guardar Alterações</button>
                </form>
            </div>
            <!--<div class="col-xl-3 col-lg-4 pt-3 pt-lg-0 order-2 order-lg-1 d-flex flex-column justify-content-center">
                <h2>Login</h2>
                <form method="post" action="scripts/sc_user_login.php">
                    <div class="form-group mt-4 ">
                        <input type="text" class="form-control" id="input_username" name="input_username"
                               placeholder="Username">
                    </div>
                    <div class="form-group mt-4 ">
                        <input type="password" class="form-control" id="input_password" name="input_password"
                               placeholder="Password">
                    </div>
                    <button type="submit" class="btn btn-get-started scrollto">Entrar</button>
                </form>
            </div>-->

        </div>
    </div>

</section><!-- End Hero -->
<?php
} else {
    header("Location: index.php");
}