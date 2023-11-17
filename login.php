<?php

session_start();
if (isset($_SESSION['username'])) {
    header('location:index.php');
    exit();
}

if (isset($_POST['submit'])) {
    include 'conn.php';
    $password = filter_var($_POST['password']);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);

    $errors = [];


    // validate email
    if (empty($email)) {
        $errors[] = "يجب كتابة البريد الاكترونى";
    }


    // validate password
    if (empty($password)) {
        $errors[] = "يجب كتابة  كلمة المرور ";
    }


    // insert or errros
    if (empty($errors)) {

        // echo "check db";

        $stm = "SELECT * FROM users WHERE email =?";
        $q = $con->prepare($stm);
        $q->bind_param("s", $email);
        $q->execute();
        $data = $q->get_result();
        $data = $data->fetch_assoc();

        if (!$data) {
            $errors[] = "خطأ فى تسجيل الدخول 1";
        } else {

            $password_hash = $data['password'];

            if (sha1($password) !== $password_hash) {
                $errors[] = " 2 خطأ فى تسجيل الدخول";
            } else {
                $_SESSION['user_id'] = $data['id'];
                $_SESSION['username'] = $data['name'];
                $_SESSION['email'] = $email;
                $_SESSION['type'] = $data['type'];
                $_SESSION['school_id'] = $data['school_id'];
                if ($data['type'] == "org") {
                    header('location:admin/index.php');
                }
                if ($data['type'] == "student") {
                    header('location:index.php');
                }
                if ($data['type'] == "school") {
                    header('location:schoolAdmin/manage_students.php');
                }
                if ($data['type'] == "admin") {
                    header('location:manager/school_managment.php');
                }
            }
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="description" content="">
    <meta name="author" content="">


    <!-- CSS FILES -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <link href="css/bootstrap-icons.css" rel="stylesheet">

    <link href="css/templatemo-kind-heart-charity.css" rel="stylesheet">
    <!--=============== REMIXICONS ===============-->
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">

    <!--=============== CSS ===============-->
    <link rel="stylesheet" href="assets/css/styles.css">

    <title>Organized</title>
</head>

<body>



    <div class="login">
        <img src="assets/img/as.jpeg" alt="login image" class="login__img">

        <form action="login.php" class="login__form" method="post">
            <h1 class="login__title">Login</h1>

            <?php

            if (isset($errors)) {
                foreach ($errors as $error) {
                    echo "<h5 class='text-danger'>$error</h5>";
                }
            }

            ?>

            <div class="login__content">
                <div class="login__box">
                    <i class="ri-user-3-line login__icon"></i>

                    <div class="login__box-input">
                        <input type="email" name="email" value="<?php if (isset($_POST['email'])) {
                                                                    echo $_POST['email'];
                                                                } ?>" required class="login__input" placeholder=" ">
                        <label for="email" class="login__label">Email</label>
                    </div>
                </div>

                <div class="login__box">
                    <i class="ri-lock-2-line login__icon"></i>

                    <div class="login__box-input">
                        <input type="password" name="password" value="<?php if (isset($_POST['password'])) {
                                                                            echo $_POST['password'];
                                                                        } ?>" required class="login__input" id="login-pass" placeholder=" ">
                        <label for="Password" class="login__label">Password</label>
                        <i class="ri-eye-off-line login__eye" id="login-eye"></i>
                    </div>
                </div>
            </div>

            <div class="login__check">
                <div class="login__check-group">
                    <input type="checkbox" class="login__check-input">
                    <label for="" class="login__check-label">Remember me</label>

                </div>


                <a href="#" class="login__forgot">Forgot Password?</a>
            </div>

            <button type="submit" name="submit" class="login__button">Login</button>

            <p class="login__register">
                Don't have an account? <a href="signup.php">Register</a>
            </p>
        </form>
    </div>

    <!--=============== MAIN JS ===============-->
    <script src="assets/js/main.js"></script>
</body>

</html>