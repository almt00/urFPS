<?php
$target_dir = "../../assets/img/portfolio/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

// Check if image file is a actual image or fake image
if (isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if ($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        //$uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
}

// Check if file already exists
if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
}

// Check file size
if ($_FILES["fileToUpload"]["size"] > 500 * 1024) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}

// Allow certain file formats
if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif") {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "The file " . htmlspecialchars(basename($_FILES["fileToUpload"]["name"])) . " has been uploaded. <br>";
        $nome_img = htmlspecialchars(basename($_FILES["fileToUpload"]["name"]));
        // Update do campo imagem na tabela X
        if (isset($_GET['id']) && $_GET['id'] != '') {
            require_once("../connections/connection.php");
            $link = new_db_connection();
            $stmt = mysqli_stmt_init($link);
            $query = "UPDATE mp_jogo
            SET imagem_jogo=?
            WHERE id_jogo=?";
            if (mysqli_stmt_prepare($stmt, $query)) {
                mysqli_stmt_bind_param($stmt, 'si', $nome_img, $id_jogo);
                if (!mysqli_stmt_execute($stmt)) {
                    echo "Error:" . mysqli_stmt_error($stmt);
                }
                mysqli_stmt_close($stmt);
            } else {
                echo("Error description: " . mysqli_error($link));
            }
            mysqli_close($link);

            // Redirecionar para página qualquer
        }
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}