<?php
include "../conn.php";

session_start();
$user_id = $_SESSION['user_id'];

if (isset($_POST['name'])) {
    $name = $_POST['name'];
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
    $hours_number = $_POST['hours_number'];
    $seats_number = $_POST['seats_number'];
    $skills = $_POST['skills'];

    $img_url = '';

    if(isset($_FILES['img_file'])) {
        $img_file = $_FILES['img_file'];
        $img_url = "img_" . random_int(111111, 9999999) . ".png";
        $path = "../img/" . $img_url;
        $s = copy($img_file['tmp_name'], $path);
    }

    $sql = "insert into volunteering_categories(name,
                                    start_date, end_date,
                                    hours_number,
                                    seats_number, 
                                    skills,
                                    img_url,
                                    user_id)
values (?,?,?,?,?,?,?,?)";

    $st = $con->prepare($sql);
    $st->bind_param("sssiissi", $name, $start_date,
        $end_date,$hours_number,
        $seats_number, $skills,$img_url, $user_id);
    $st->execute();

    header("Location: vol_categories.php");
}
