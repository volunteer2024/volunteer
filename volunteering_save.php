<?php
session_start();
include "conn.php";


if (isset($_SESSION['user_id'])) {
    //Get the student's school
    $school_id = $_SESSION['school_id'];
    $user_id = $_SESSION['user_id'];

    $cate_id = $_POST['cat_id'];

    //Get the ID of the organizations for this category and check if the student's school accepts these organizations
    $org_id = $_POST['org_id'];
    $status = 'accepted';

    $school_accepted = "SELECT * FROM volunteersorganizationstatus WHERE org_id = ? AND school_id = ? AND status=?";
    $stmt = $con->prepare($school_accepted);
    $stmt->bind_param("iis", $org_id, $school_id, $status);
    $stmt->execute();
    $accepted = $stmt->get_result();

    // Check if data is found
    if ($accepted->num_rows > 0) {
        // Data found
        // You can perform further operations here
        $sq = "select * from volunteering_orders where user_id = $user_id and category_id = $cate_id";
        $re = $con->query($sq);
        if ($re->num_rows <= 0) {
            $sql = "insert into volunteering_orders(category_id, user_id) values (?, ?)";
            $st = $con->prepare($sql);
            $st->bind_param("ii", $cate_id, $user_id);
            $st->execute();

            $s = "update volunteering_categories set seats_reserved = seats_reserved+1 where id = $cate_id;";
            $con->query($s);
            header("Location:volunteer.php");
            exit();
        } else {
            echo '<script>alert("You Already Volunteering in this Category"); window.location.href = "volunteer.php";</script>';
            exit();
        }
    } else {

        echo "<script>alert('You cannot volunteer in this category because your school does not support volunteering in this organization'); window.location.href = 'volunteer.php';</script>";
        exit();
    }
} else {
    header("Location:login.php");
    exit();
}
