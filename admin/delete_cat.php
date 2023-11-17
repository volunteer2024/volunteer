<?php
include "../conn.php";

if(isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "delete from volunteering_categories where id = ?";
    $st = $con->prepare($sql);
    $st->bind_param("i", $id);
    $st->execute();

}
header("Location: vol_categories.php");
