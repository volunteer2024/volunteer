<?php
include "header.inc";

$sql = "select * from volunteering_categories order by id desc";
$re = $con->query($sql);

$rows = $re->fetch_all(MYSQLI_ASSOC);


?>
<main>
    <section class="news-detail-header-section text-center">
        <div class="section-overlay"></div>

        <div class="container">
            <div class="row">

                <div class="col-lg-12 col-12">
                    <h1 class="text-white">Volunteering</h1>
                </div>

            </div>
        </div>
    </section>
    <section class="section-padding" id="">
        <div class="container">
            <div class="row">

                <div class="col-lg-12 col-12 text-center mb-4">
                    <h2>Choose one of the volunteers</h2>
                </div>
                <?php foreach ($rows as $row) {

                    if ($row['img_url'] === "") {
                        $row['img_url'] = "images/causes/african-woman-pouring-water-recipient-outdoors.jpg";
                    } else {
                        $row['img_url'] = "img/" . $row['img_url'];
                    }
                    ?>
                    <div class="col-lg-4 col-md-6 col-12">
                        <div class="custom-block-wrap">
                            <img src="<?= $row['img_url'] ?>"
                                 class="custom-block-image img-fluid" alt="" height="200">

                            <div class="custom-block">
                                <div class="custom-block-body">
                                    <h5 class="mb-3"><?= $row['name'] ?></h5>

                                    <p><?= $row['skills'] ?></p>

                                    <div class="progress mt-4">
                                        <div class="progress-bar w-100" role="progressbar" aria-valuenow="100"
                                             aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>

                                    <div class="d-flex align-items-center my-2">
                                        <p class="mb-0">
                                            <strong>Start:</strong>
                                            <?= $row['start_date'] ?>
                                        </p>

                                        <p class="ms-auto mb-0">
                                            <strong>End:</strong>
                                            <?= $row['end_date'] ?>
                                        </p>
                                    </div>
                                </div>

                                <a href="volunteering.php?id=<?= $row['id'] ?>" class="custom-btn btn">Volunteering
                                    Now</a>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </section>
</main>

<?php
include "footer.inc";
?>
