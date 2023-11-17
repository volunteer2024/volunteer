<?php
include "header.php";

$user_id = $_SESSION['user_id'];

if(!isset($_GET['id'])) {
    header("Location: volunteering_orders.php");
    exit;
}

if(isset($_POST['hours_number'])) {
    $nh = $_POST['hours_number'];
    $u_id = $_POST['user_id'];

    $s = "update users set hours_number = $nh where id = $u_id";
    $con->query($s);
}

$id = $_GET['id'];

$sql = "select o.id, vc.name c_name, vc.seats_number,
       vc.hours_number, vc.skills, vc.id c_id, u.id u_user_id,
       u.hours_number u_hours_number,
       u.name u_name, u.email, u.phone, u.info,
       vc.start_date, vc.end_date
from volunteering_orders o
join volunteering_categories vc on vc.id = o.category_id
join users u on u.id = o.user_id
where o.id = $id";

$re = $con->query($sql);

$row = $re->fetch_assoc();

?>


<main>
    <section class="contact-section mt-5" id="section_6">
        <div class="container">
            <h3>Order</h3><hr>
            <div class="row">
                <div class="col-5">
                    <h4>Category</h4>
                    <p>Name: <strong><?=$row['c_name']?></strong></p>
                    <p>Start Date: <strong><?=$row['start_date']?></strong></p>
                    <p>End Date: <strong><?=$row['end_date']?></strong></p>
                    <p>Hours Number: <strong><?=$row['hours_number']?></strong></p>
                    <p>Seats Number: <strong><?=$row['seats_number']?></strong></p>
                    <p>Skills: <strong><?=$row['skills']?></strong></p>
                </div>
                <div class="col-5">
                    <h4>User</h4>
                    <p>Name: <strong><?=$row['u_name']?></strong></p>
                    <p>Email: <strong><?=$row['email']?></strong></p>
                    <p>Phone: <strong><?=$row['phone']?></strong></p>
                    <p>Skills: <strong><?=$row['info']?></strong></p>
                    <div>
                        <form action="show_order.php?id=<?=$_GET['id']?>" method="post">
                            <label for="hours_number">Hours Number</label>
                            <input type="number" name="hours_number"
                                   id="hours_number" class="form-control"
                                   value="<?=$row['u_hours_number']?>"
                                   placeholder="Hours Number"
                                   required>
                            <input type="hidden" value="<?=$row['u_user_id']?>" name="user_id">
                            <button type="submit" class="mt-3 btn btn-primary">Save</button>
                        </form>
                    </div>
                </div>
                <div class="col-2">
                    <a class="btn btn-sm btn-danger" href="delete_order.php?id=<?=$row['id']?>&c_id=<?=$row['c_id']?>">Delete Order</a>
                </div>
            </div>
        </div>
    </section>
</main>

