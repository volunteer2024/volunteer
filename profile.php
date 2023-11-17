<?php
include "header.inc";
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];

if (isset($_POST['name'], $_POST['email'], $_POST['info'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $info = $_POST['info'];

    $sql = "update users set name = ?, email = ?, info =? where id = ?";
    $st = $con->prepare($sql);
    $st->bind_param("sssi", $name, $email, $info, $user_id);
    $st->execute();
}



$sql = "select * from users where id = " . $user_id;
$res = $con->query($sql);

$row = $res->fetch_assoc();

?>

<section class="contact-section section-padding" id="section_6">
    <div class="container">
        <div class="row">

            <!--            <div class="col-lg-4 col-12 ms-auto mb-5 mb-lg-0">-->
            <!--                <div class="contact-info-wrap">-->
            <!--                    <h2>Get in touch</h2>-->
            <!---->
            <!--                    <div class="contact-image-wrap d-flex flex-wrap">-->
            <!--                        <img src="images/avatar/pretty-blonde-woman-wearing-white-t-shirt.jpg"-->
            <!--                             class="img-fluid avatar-image" alt="">-->
            <!---->
            <!--                        <div class="d-flex flex-column justify-content-center ms-3">-->
            <!--                            <p class="mb-0">Clara Barton</p>-->
            <!--                            <p class="mb-0"><strong>HR & Office Manager</strong></p>-->
            <!--                        </div>-->
            <!--                    </div>-->
            <!---->
            <!--                    <div class="contact-info">-->
            <!--                        <h5 class="mb-3">Contact Infomation</h5>-->
            <!---->
            <!--                        <p class="d-flex mb-2">-->
            <!--                            <i class="bi-geo-alt me-2"></i>-->
            <!--                            Kingdom of Saudi Arabia-->
            <!--                        </p>-->
            <!---->
            <!--                        <p class="d-flex mb-2">-->
            <!--                            <i class="bi-telephone me-2"></i>-->
            <!---->
            <!--                            <a href="tel: 56 546 9774">-->
            <!--                                56 546 9774-->
            <!--                            </a>-->
            <!--                        </p>-->
            <!---->
            <!--                        <p class="d-flex">-->
            <!--                            <i class="bi-envelope me-2"></i>-->
            <!---->
            <!--                            <a href="mailto:info@yourgmail.com">-->
            <!--                                taatawaa@gmail.com-->
            <!---->
            <!--                            </a>-->
            <!--                        </p>-->
            <!---->
            <!--                        <a href="#" class="custom-btn btn mt-3">Get Direction</a>-->
            <!--                    </div>-->
            <!--                </div>-->
            <!--            </div>-->

            <div class="col-lg-5 col-12 mx-auto">
                <form class="custom-form contact-form" action="profile.php" method="post" role="form">
                    <h3>Profile</h3>

                    <p class="mb-4">Account info
                    </p>

                    <label for="name">Name</label><input type="text" name="name" id="name" class="form-control" placeholder="Name" value="<?= $row['name'] ?>" required>

                    <label for="email">Email</label><input type="email" name="email" id="email" pattern="[^ @]*@[^ @]*" class="form-control" value="<?= $row['email'] ?>" placeholder="Email" required>

                    <label for="nh">Hours Number</label>
                    <input type="text" id="nh" readonly disabled class="form-control" placeholder="Hours Number" value="<?= $row['hours_number'] ?>">


                    <label for="info">Info</label>
                    <textarea name="info" rows="5" class="form-control" id="info" placeholder="Info"><?= $row['info'] ?></textarea>

                    <button type="submit" class="form-control">Update</button>
                </form>
            </div>

        </div>
    </div>
</section>