<?php
include "header.php";


$sql = "select * from complaints order by msg_date desc";
$re = $con->query($sql);

$rows = $re->fetch_all(MYSQLI_ASSOC);

?>

<main>
    <section class="section-padding">
        <div class="container">
            <h4>Complaints</h4>
            <table class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Message</th>
                    <th>Date</th>
                </tr>
                </thead>
                <tbody>

                <?php foreach ($rows as $row) { ?>
                    <tr>
                        <td><?=$row['id']?></td>
                        <td><?=$row['name']?></td>
                        <td><?=$row['email']?></td>
                        <td><?=$row['message']?></td>
                        <td><?=$row['msg_date']?></td>

                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
    </section>
</main>




