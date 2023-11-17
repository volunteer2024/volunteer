<?php
include 'header.php';

$fetch_schools = array();
$type = 'student';
$userId = $_SESSION['user_id'];

// Prepare the SQL statement
$select_users = $con->prepare("SELECT * FROM users WHERE type = ? and school_id=?");
$select_users->bind_param('si', $type, $userId);

// Execute the query
$select_users->execute();

// Store the result
$result = $select_users->get_result();

// Check if any rows were returned
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $fetch_schools[] = $row;
    }
}


?>

<div id="table-container">

    <h1>School's Students</h1>



    <?php if (!empty($fetch_schools)) : ?>

        <table>

            <tr class="bg-info">
                <th>No</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Hours Number</th>
                <th>Info</th>
            </tr>
            <?php
            $serialNumber = 1; // Initialize the serial number count
            foreach ($fetch_schools as $user) : ?>
                <tr>
                    <td><?= $serialNumber++ ?></td>
                    <td><?= $user['name'] ?></td>
                    <td><?= $user['email'] ?></td>
                    <td><?= $user['phone'] ?></td>
                    <td><?= $user['hours_number'] ?></td>
                    <td><?= $user['info'] ?></td>

                </tr>
            <?php endforeach; ?>
        </table>

    <?php else : ?>
        <p>No Students found.</p>
    <?php endif; ?>
</div>



</body>

</html>