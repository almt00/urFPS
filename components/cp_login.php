<!-- ======= Hero Section ======= -->
<section id="hero" class="d-flex align-items-center">

    <div class="container-fluid" data-aos="fade-up">

        <div class="row justify-content-center">
            <div class="col-xl-3 col-lg-4 pt-3 pt-lg-0 order-2 order-lg-1 d-flex flex-column border border-2 rounded p-3 m-2 bg-gradient">

                <h2 class="pt-3 text-white">Criar Conta</h2>
                <form method="post" action="scripts/sc_user_register.php" id="register-form">
                    <div class="form-group mt-4 ">
                        <input type="text" class="form-control" id="input_email" name="input_email"
                               placeholder="Email" required="required">
                    </div>
                    <div class="form-group mt-4 ">
                        <input type="text" class="form-control" id="input_username" name="input_username"
                               placeholder="Username" required="required">
                    </div>
                    <div class="form-group mt-4 ">
                        <input type="password" class="form-control" id="input_password" name="input_password"
                               placeholder="Password" required="required" onkeyup="checkPass(); return false;">
                    </div>
                    <!--<div class="form-group mt-4 ">
                        <input type="password" class="form-control" id="input_confirm" name="input_confirm"
                               placeholder="Confirmar Password" required="required" onkeyup="checkPass(); return false;">
                        <span id="confirmMessage" class="confirmMessage"></span>
                    </div>-->
                    <button type="submit" class="btn btn-get-started scrollto">Criar Conta</button>
                </form>
            </div>
            <div class="col-xl-3 col-lg-4 pt-3 pt-lg-0 order-2 order-lg-1 d-flex flex-column justify-content-center border border-2 rounded p-3 m-2 bg-gradient">
                <h2 class="text-white">Login</h2>
                <form method="post" action="scripts/sc_user_login.php">
                    <div class="form-group mt-4 ">
                        <input type="text" class="form-control" id="input_username_login" name="input_username"
                               placeholder="Username" required="required">
                    </div>
                    <div class="form-group mt-4 ">
                        <input type="password" class="form-control" id="input_password_login" name="input_password"
                               placeholder="Password" required="required">
                    </div>
                    <button type="submit" class="btn btn-get-started scrollto align-self-end">Entrar</button>
                </form>
            </div>

        </div>
        <div class="row">
            <div class="col-lg-12 mx-auto">
                <?php
                if (isset($_GET["msg"])) {
                    $msg_show = true;
                    switch ($_GET["msg"]) {
                        case 0:
                            $message = "ocorreu um erro no registo";
                            $class = "alert-warning";
                            break;
                        case 1:
                            $message = "registo efectuado com sucesso";
                            $class = "alert-success";
                            break;
                        case 2:
                            $message = "ocorreu um erro no login";
                            $class = "alert-warning";
                            break;
                        case 3:
                            $message = "login efectuado com sucesso";
                            $class = "alert-success";
                            break;
                        case 4:
                            $message = "só é permitido fazer login se o utilizador se
encontrar ativo";
                            $class = "alert-warning";
                            break;
                        default:
                            $msg_show = false;
                    }

                    echo "<div class=\"alert $class alert-dismissible fade show\" role=\"alert\">
" . $message . "
  <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
    <span aria-hidden=\"true\">&times;</span>
  </button>
</div>";
                    if ($msg_show) {
                        echo '<script>window.onload=function (){$(\'.alert\').alert();}</script>';
                    }
                }
                ?>
            </div>
    </div>

</section><!-- End Hero -->

<script>
    function checkPass() {
        //Store the password field objects into variables ...
        var pass1 = $("#register-form #input_password");
        var pass2 = $("#register-form #input_confirm");

        console.log(pass1.value, pass2.value);
        //Store the Confimation Message Object ...
        var message = $('#confirmMessage');
        //Set the colors we will be using ...
        var goodColor = "#66cc66";
        var badColor = "#ff6666";
        //Compare the values in the password field
        //and the confirmation field
        if (pass1.val() == pass2.val()) {
            //The passwords match.
            //Set the color to the good color and inform
            //the user that they have entered the correct password
            pass2.css("backgroundColor", goodColor);
            message.css("color", goodColor);
            message.html("Passwords Match");
        } else {
            //The passwords do not match.
            //Set the color to the bad color and
            //notify the user.
            pass2.css("backgroundColor", badColor);
            message.css("color", badColor);
            message.html("Passwords Do Not Match!");
        }
    }

    function validatephone(phone) {
        var maintainplus = '';
        var numval = phone.value
        if (numval.charAt(0) == '+') {
            var maintainplus = '';
        }
        curphonevar = numval.replace(/[\\A-Za-z!"£$%^&\,*+_={};:'@#~,.Š\/<>?|`¬\]\[]/g, '');
        phone.value = maintainplus + curphonevar;
        var maintainplus = '';
        phone.focus;
    }

    // validates text only
    function Validate(txt) {
        txt.value = txt.value.replace(/[^a-zA-Z-'\n\r.]+/g, '');
    }

    // validate email
    function email_validate(email) {
        var regMail = /^([_a-zA-Z0-9-]+)(\.[_a-zA-Z0-9-]+)*@([a-zA-Z0-9-]+\.)+([a-zA-Z]{2,3})$/;

        if (regMail.test(email) == false) {
            document.getElementById("status").innerHTML = "<span class='warning'>Email address is not valid yet.</span>";
        } else {
            document.getElementById("status").innerHTML = "<span class='valid'>Thanks, you have entered a valid Email address!</span>";
        }
    }

    // validate date of birth
    function dob_validate(dob) {
        var regDOB = /^(\d{1,2})[-\/](\d{1,2})[-\/](\d{4})$/;

        if (regDOB.test(dob) == false) {
            document.getElementById("statusDOB").innerHTML = "<span class='warning'>DOB is only used to verify your age.</span>";
        } else {
            document.getElementById("statusDOB").innerHTML = "<span class='valid'>Thanks, you have entered a valid DOB!</span>";
        }
    }

    // validate address
    function add_validate(address) {
        var regAdd = /^(?=.*\d)[a-zA-Z\s\d\/]+$/;

        if (regAdd.test(address) == false) {
            document.getElementById("statusAdd").innerHTML = "<span class='warning'>Address is not valid yet.</span>";
        } else {
            document.getElementById("statusAdd").innerHTML = "<span class='valid'>Thanks, Address looks valid!</span>";
        }
    }

</script>