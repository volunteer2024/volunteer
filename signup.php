<?php
require_once('conn.php');


if (isset($_POST['name'])) {

    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $type = $_POST['ut'];
    $password = sha1($_POST['password']);
    
    $school = $_POST['school'];

    $user_type = "student";
    if ($type === "o") {
        $user_type = "org";
        $school = 0;
    }
    
    $sql = "INSERT INTO users (name,email,phone,password,type,school_id) VALUES(?,?,?,?,?,?)";
    $stmtinsert = $con->prepare($sql);

    $stmtinsert->bind_param(
        'sssssi',
        $name,
        $email,
        $phone,
        $password,
        $user_type,
        $school

    );
    $result = $stmtinsert->execute();


    if ($result) {
        

         header("Location: login.php");
    } else {
        echo 'There were erros while saving the data.';
    }
}
// Query to select name and id from users where type is "school"
$query = "SELECT name, id FROM users WHERE type = 'school'";
$result = mysqli_query($con, $query);

// Create an array to store the options
$options = array();

// Fetch the results and add them to the options array
while ($row = mysqli_fetch_assoc($result)) {
    $options[] = $row;
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!--=============== REMIXICONS ===============-->
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">

    <!--=============== CSS ===============-->
    <link rel="stylesheet" href="assets/css/styles.css">

    <title>Organized</title>
</head>

<body>
    <div class="login">
        <img src="assets/img/as.jpeg" alt="login image" class="login__img">

        <form action="signup.php" class="login__form" method="POST">
            <h1 class="login__title">Signup</h1>

            <div class="login__content">
                <div class="login__box">
                    <i class="ri-user-3-line login__icon"></i>

                    <div class="login__box-input">
                        <input type="text" value="" id="name" name="name" required class="login__input" placeholder=" ">
                        <label for="name" class="login__label">Name</label>
                    </div>
                </div>

                <div class="login__box">
                    <i class="ri-user-3-line login__icon"></i>


                    <div class="login__box-input">
                        <input type="email" id="email" name="email" required class="login__input" placeholder=" ">
                        <label for="email" class="login__label">Email</label>
                    </div>
                </div>

                <div class="login__box">
                    <i class="ri-user-3-line login__icon"></i>

                    <div class="login__box-input">
                        <input type="text" id="phone" name="phone" class="login__input" placeholder=" ">
                        <label for="phone" class="login__label">Phone Name</label>
                    </div>
                </div>

                <div class="login__box">
                    <i class="ri-lock-2-line login__icon"></i>

                    <div class="login__box-input">
                        <input type="password" name="password" required class="login__input" id="password" placeholder=" ">
                        <label for="password" class="login__label">Password</label>
                        <i class="ri-eye-off-line login__eye" id="login-eye"></i>
                    </div>
                </div>

                <div class="login__box" id="school_block">


                    <div class="login__box-input">

                        <select id="school" name="school" class="login__input" style="color: blue; border: none;">
                            <option value="">...Select School...</option>
                            <?php foreach ($options as $option) : ?>
                                <option value="<?= $option['id']; ?>"><?= $option['name']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>

            </div>

            <div class="login__check">
                <div class="login__check-group">
                    <label for="user_type_s" class="login__check-label">Student</label>
                    <input type="radio" class="login__check-input" name="ut" id="user_type_s" value="s" checked>

                </div>
                <div class="login__check-group">
                    <label for="user_type_o" class="login__check-label">Organized</label>
                    <input type="radio" value="o" name="ut" id="user_type_o" class="login__check-input">

                </div>


            </div>

            <button type="submit" class="login__button">Signup</button>

            <p class="login__register">
                Already have an account? <a href="login.php">Login</a>
            </p>
        </form>
    </div>

    <!--=============== MAIN JS ===============-->
    <script src="assets/js/main.js"></script>
    <script>
        // Get references to the select element and radio buttons
        const school_block = document.getElementById('school_block');
        const selectSchool = document.getElementById('school');
        const studentRadio = document.getElementById('user_type_s');
        const organizeRadio = document.getElementById('user_type_o');


        // Function to show the select school element
        function showSelectSchool() {
            school_block.style.display = 'block';
            selectSchool.setAttribute('required', 'required');
        }

        // Function to hide the select school element
        function hideSelectSchool() {
            school_block.style.display = 'none';
            selectSchool.removeAttribute('required');
        }

        // Set initial state when the page loads
        if (studentRadio.checked) {
            showSelectSchool();
        } else {
            hideSelectSchool();
        }

        // Add event listeners to the radio buttons
        studentRadio.addEventListener('change', function() {
            if (this.checked) {
                showSelectSchool();
            }
        });

        organizeRadio.addEventListener('change', function() {
            if (this.checked) {
                hideSelectSchool();
            }
        });
    </script>
</body>

</html>