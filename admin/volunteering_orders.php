<?php
include "header.php";

$user_id = $_SESSION['user_id'];

$sql = "select o.id, vc.name cat_name, u.name, vc.start_date, vc.end_date
from volunteering_orders o
join volunteering_categories vc on vc.id = o.category_id
join users u on u.id = o.user_id
where vc.user_id = $user_id                                                                
order by o.id desc;";

$re = $con->query($sql);

$rows = $re->fetch_all(MYSQLI_ASSOC);

?>


<main>
    <section class="contact-section section-padding" id="section_6">
        <div class="container">
            <div class="row">

                <div class="col-lg-12 col-12 ms-auto mb-5 mb-lg-0">
                    <div class="contact-info-wrap">
                        <h2>Orders</h2>

                        <table class="table table-bordered table-striped table-hover">
                            <thead>
                            <tr>
                                <th>Id</th>
                                <th>Category name</th>
                                <th>User name</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th width="100">#</th>
                                <th width="100">#</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($rows as $row) { ?>
                                <tr>
                                    <td><?=$row['id']?></td>
                                    <td><?=$row['cat_name']?></td>
                                    <td><?=$row['name']?></td>
                                    <td><?=$row['start_date']?></td>
                                    <td><?=$row['end_date']?></td>
                                    <td><a class="btn btn-success" target="_blank" href="show_order.php?id=<?=$row['id']?>">Show</a></td>
                                    <td><a class="btn btn-info" target="_blank" href="certificate.php?id=<?=$row['id']?>">Certificate</a></td>
                                </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>


            </div>
        </div>
    </section>
</main>



