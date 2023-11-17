<?php
include "../conn.php";

if(isset($_GET['id'])) {
    $id = $_GET['id'];
    $cate_id = $_GET['c_id'];


    $sql = "delete from volunteering_orders where id = ?";
    $st = $con->prepare($sql);
    $st->bind_param("i", $id);
    $st->execute();

    $s = "update volunteering_categories
        set seats_reserved = seats_reserved-1
        where id = $cate_id;";
    $con->query($s);
}

header("Location: volunteering_orders.php");
