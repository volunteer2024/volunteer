<?php
include "header.php";

$user_id = $_SESSION['user_id'];

$sql = "select * from volunteering_categories
         where user_id = $user_id order by id desc";
$re = $con->query($sql);

$rows = $re->fetch_all(MYSQLI_ASSOC);

?>

<main>
    <section class="contact-section section-padding" id="section_6">
        <div class="container2">
            <div class="row">
                <div class="col-lg-4 col-12 mx-auto">
                    <form class="custom-form contact-form" action="save_cat.php" method="post" role="form" enctype="multipart/form-data">
                        <h3>Add Categories</h3>

                        <label for="name"></label>
                        <input type="text" name="name"
                               id="name" class="form-control"
                               placeholder="Name"
                               required>

                        <label for="start_date">Start Date</label>
                        <input type="date" name="start_date"
                               id="start_date" class="form-control"
                               placeholder="Start Date" required>

                        <label for="end_date">End Date</label>
                        <input type="date" name="end_date"
                               id="end_date" class="form-control"
                               placeholder="End Date" required>

                        <label for="hours_number">Hours Number</label>
                        <input type="number" name="hours_number"
                               id="hours_number" class="form-control"
                               placeholder="Hours Number"
                               required>

                        <label for="seats_number">Seats Number</label>
                        <input type="number" name="seats_number"
                               id="seats_number" class="form-control"
                               placeholder="Seats Number"
                               required>

                        <label for="img_file">Image</label>
                        <input type="file" name="img_file"
                               id="img_file" class="form-control"
                               placeholder="Image"
                               >

                        <label for="skills">Skills</label>
                        <textarea name="skills" rows="5"
                                  class="form-control"
                                  id="skills"
                                  placeholder="Skills"></textarea>

                        <button type="submit" class="form-control">Save</button>
                    </form>
                </div>

                <div class="col-lg-8 col-12 ms-auto mb-5 mb-lg-0">
                    <div class="contact-info-wrap">
                        <h2>Categories</h2>

                        <table class="table table-bordered table-striped table-hover">
                           <thead>
                           <tr>
                               <th>Id</th>
                               <th>name</th>
                               <th>Start Date</th>
                               <th>End Date</th>
                               <th>Hours Number</th>
                               <th>Seats Number</th>
                               <th>Skills</th>
                               <th>#</th>
                           </tr>
                           </thead>
                            <tbody>
                            <?php foreach ($rows as $row) { ?>
                                <tr>
                                    <td><?=$row['id']?></td>
                                    <td><?=$row['name']?></td>
                                    <td><?=$row['start_date']?></td>
                                    <td><?=$row['end_date']?></td>
                                    <td><?=$row['hours_number']?></td>
                                    <td><?=$row['seats_number']?></td>
                                    <td><?=$row['skills']?></td>
                                    <td><a class="btn btn-sm btn-danger" href="delete_cat.php?id=<?=$row['id']?>">Delete</a> </td>
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



