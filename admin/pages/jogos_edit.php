<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Admin - Edição de Jogos</title>

    <!-- Custom fonts for this template-->
    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
          rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">

<!-- Page Wrapper -->
<div id="wrapper">

    <!-- Sidebar -->
    <?php
    include_once "../components/cp_navbars_side.php";
    ?>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

            <!-- Topbar -->
            <?php
            include_once "../components/cp_navbars_top.php";
            ?>
            <!-- End of Topbar -->

            <!-- Begin Page Content -->
            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800">Gestão de Jogos</h1>
                </div>

                <!-- Content Row -->
                <div class="row">

                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Edição de Jogos
                            </div>
                            <!-- /.panel-heading -->
                            <?php
                            if (isset($_GET['id'])) {
                                $id_jogo = $_GET['id'];
                                require_once "../connections/connection.php";
                                $link = new_db_connection();
                                $stmt = mysqli_stmt_init($link);
                                $query = "SELECT id_jogo,nome_jogo,data_jogo,descricao_jogo, nome_franquia, ref_id_franquia, nome_distribuidora, ref_id_distribuidora,website_jogo, imagem_jogo FROM mp_jogo
                                                  LEFT JOIN mp_franquia
                                                  ON ref_id_franquia=id_franquia
                                                  LEFT JOIN  mp_distribuidora
                                                  ON ref_id_distribuidora=id_distribuidora
                                                  WHERE id_jogo=?";
                                if (mysqli_stmt_prepare($stmt, $query)) {
                                    mysqli_stmt_bind_param($stmt, 'i', $id_jogo);
                                    if (mysqli_stmt_execute($stmt)) {
                                        mysqli_stmt_bind_result($stmt, $id_jogo, $nome_jogo, $data, $descricao, $franquia, $ref_id_franquia, $distribuidora, $ref_id_distribuidora, $website, $img_jogo);
                                        if (!mysqli_stmt_fetch($stmt)) {
                                            // Isto significa que não há resultado da query
                                            header("Location: index.php");
                                            die();
                                        }
                                        $_SESSION["id_jogo"] = $id_jogo;
                                        /*$checked = "";
                                       if ($active == 1) {
                                           $checked = "checked";
                                       }*/
                                    } else {
                                        echo "Error:" . mysqli_stmt_error($stmt);
                                    }
                                } else {
                                    echo("Error description: " . mysqli_error($link));
                                }
                                /* close statement */
                                mysqli_stmt_close($stmt);
                                /* close connection */

                            } else {
                                header("Location: index.php");
                                die();
                            }
                            ?>
                            <div class="panel-body">
                                <form id="jogo_update" role="form" method="post" action="../scripts/sc_jogo_update.php">
                                    <input type="hidden" name="id_jogo" value="<?= $id_jogo ?>">
                                    <div class="form-group">
                                        <label>ID do Jogo</label>
                                        <p class="form-control-static"><?= $_SESSION['id_jogo'] ?></p>
                                    </div>
                                    <div class="form-group">
                                        <label>Nome</label>
                                        <input class="form-control" name="nome" placeholder="Nome"
                                               value="<?= $nome_jogo ?>">
                                    </div>
                                    <div class="form-group">
                                        <label>Data de lançamento</label>
                                        <input class="form-control" name="data" placeholder="Data de lançamento"
                                               value="<?= $data ?>">
                                    </div>
                                    <div class="form-group">
                                        <label>Descrição</label>
                                        <textarea class="form-control" name="descricao" rows="4"
                                                  placeholder="Descrição"><?= $descricao ?></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>Franquia</label>
                                        <select class="form-control" name="id_franquia">

                                            <?php
                                            $stmt = mysqli_stmt_init($link);
                                            $query = "SELECT id_franquia, nome_franquia FROM mp_franquia";
                                            if (mysqli_stmt_prepare($stmt, $query)) {
                                                if (mysqli_stmt_execute($stmt)) {
                                                    mysqli_stmt_bind_result($stmt, $id_franquia, $nome_franquia);
                                                    while (mysqli_stmt_fetch($stmt)) {
                                                        $selected = '';
                                                        if ($ref_id_franquia == $id_franquia) {
                                                            $selected = 'selected';
                                                        }
                                                        echo " <option value='$id_franquia' $selected>$nome_franquia</option>";
                                                    }
                                                    if ($ref_id_franquia == '') {
                                                        echo " <option value='' selected></option>";
                                                    } else {
                                                        echo " <option value=''></option>";
                                                    }
                                                } else {
                                                    echo "Error:" . mysqli_stmt_error($stmt);
                                                }
                                                mysqli_stmt_close($stmt);
                                            } else {
                                                echo("Error description: " . mysqli_error($link));
                                            }
                                            ?>

                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Distribuidora</label>
                                        <select class="form-control" name="id_distribuidora">
                                            <?php
                                            $stmt = mysqli_stmt_init($link);
                                            $query = "SELECT id_distribuidora, nome_distribuidora FROM mp_distribuidora";
                                            if (mysqli_stmt_prepare($stmt, $query)) {
                                                if (mysqli_stmt_execute($stmt)) {
                                                    mysqli_stmt_bind_result($stmt, $id_distribuidora, $nome_distribuidora);
                                                    while (mysqli_stmt_fetch($stmt)) {
                                                        $selected = '';
                                                        if ($id_distribuidora == $ref_id_distribuidora) {
                                                            $selected = 'selected';
                                                        }
                                                        echo " <option value='$id_distribuidora' $selected>$nome_distribuidora</option>";
                                                    }
                                                } else {
                                                    echo "Error:" . mysqli_stmt_error($stmt);
                                                }
                                                mysqli_stmt_close($stmt);
                                            } else {
                                                echo("Error description: " . mysqli_error($link));
                                            }
                                            mysqli_close($link);
                                            ?>

                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Website</label>
                                        <input class="form-control" name="website" value="<?= $website ?>">
                                    </div>


                                    <button type="submit" class="btn btn-info" form="jogo_update">
                                        Submeter alterações
                                    </button>
                                </form>
                                <div class="form-group">
                                    <label>Escolher Imagem</label>
                                    <form action="../scripts/upload_img.php?id=<?=$id_jogo?>" method="post" name="upload_img" id="upload_img"
                                          enctype="multipart/form-data">
                                        <p><input type="file" name="fileToUpload" id="fileToUpload"></p>
                                        <input type="submit" form="upload_img"  value="Upload Image" name="submit">
                                    </form>
                                </div>
                                <!-- /.table-responsive -->
                            </div>
                            <!-- /.panel-body -->
                        </div>
                        <!-- /.panel -->
                    </div>
                </div>
            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- End of Main Content -->

        <!-- Footer -->
        <footer class="sticky-footer bg-white">
            <div class="container my-auto">
                <div class="copyright text-center my-auto">
                    <span>Copyright &copy; ur:FPS 2021</span>
                </div>
            </div>
        </footer>
        <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>


<!-- Bootstrap core JavaScript-->
<script src="../vendor/jquery/jquery.min.js"></script>
<script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="../vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="../js/sb-admin-2.min.js"></script>

<!-- Page level plugins -->
<script src="../vendor/chart.js/Chart.min.js"></script>

<!-- Page level custom scripts -->
<script src="../js/demo/chart-area-demo.js"></script>
<script src="../js/demo/chart-pie-demo.js"></script>

</body>

</html>