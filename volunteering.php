<?php
include "header.inc";

if (!isset($_GET['id'])) {
    header("Location: volunteer.php");
    exit();
}
$id = $_GET['id'];
$sql = "select * from volunteering_categories where  id = $id";
$re = $con->query($sql);

$row = $re->fetch_assoc();


$ava = $row['seats_reserved'] < $row['seats_number'];
?>
<main>

    <section class="donate-section">
        <div class="section-overlay"></div>
        <div class="container">
            <div class="row">

                <div class="col-lg-6 col-12 mx-auto">
                    <form class="custom-form donate-form" action="volunteering_save.php" method="post" role="form">
                        <h3 class="mb-4"><?= $row['name'] ?></h3>
                        <input type="hidden" name="cat_id" value="<?= $row['id'] ?>">
                        <input type="hidden" name="org_id" value="<?= $row['user_id'] ?>">

                        <div class="row">
                            <div class="col-lg-12 col-12">
                                <h5 class="mb-3">Start Date</h5>
                            </div>
                            <div class="col-lg-12 col-12 mt-2">
                                <input type="text" name="sd" id="sd" class="form-control" placeholder="Start Date" readonly value="<?= $row['start_date'] ?>">
                            </div>

                            <div class="col-lg-12 col-12 mt-4">
                                <h5 class="mb-3">End Date</h5>
                            </div>

                            <div class="col-lg-12 col-12 mt-2">
                                <input type="text" name="ed" id="ed" class="form-control" placeholder="End Date" readonly value="<?= $row['end_date'] ?>">
                            </div>


                            <div class="col-lg-12 col-12 mt-4">
                                <h5 class="mt-2 mb-3">Skills</h5>
                            </div>

                            <div class="col-lg-12 col-12 form-check-group">
                                <p>
                                    <?= $row['skills'] ?>
                                </p>
                            </div>



                            <div class="col-lg-12 col-12">
                                <h5 class="mt-1">Number of reserved seats</h5>
                            </div>

                            <div class="col-lg-12 col-12 mt-2">
                                <h3><?= $row['seats_reserved'] ?>/<?= $row['seats_number'] ?></h3>
                            </div>


                            <?php if ($ava) {
                            ?>
                                <button type="submit" class="form-control mt-4">Save</button>

                            <?php
                            } else {
                            ?>
                                <button class="form-control mt-4" disabled>Save</button>

                            <?php
                            } ?>
                        </div>
                </div>
                </form>
            </div>

        </div>
        </div>
    </section>
</main>

<?php
include "footer.inc";
?>