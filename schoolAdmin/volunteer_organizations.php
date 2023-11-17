<?php
include 'header.php';

$fetch_orgs = array();
$type = 'org';
$school_id = $_SESSION['user_id'];

// Prepare the SQL statement
$select_orgs = $con->prepare("SELECT * FROM users WHERE type = ? ");
$select_orgs->bind_param('s', $type);

// Execute the query
$select_orgs->execute();

// Store the result
$result = $select_orgs->get_result();

// Check if any rows were returned
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $fetch_orgs[] = $row;
    }
}

if (isset($_POST['accept'])) {
    $org_id = $_POST['org_id'];
    $status = 'accepted';
    saveStatus($status, $org_id, $school_id);
}
if (isset($_POST['reject'])) {
    $org_id = $_POST['org_id'];
    $status = 'rejected';
    saveStatus($status, $org_id,$school_id);
}

function saveStatus($status, $org_id, $school_id)
{
    // Check if the record already exists
    global $con;
    $stmt = $con->prepare("SELECT * FROM volunteersorganizationstatus WHERE org_id = ? AND school_id = ?");
    $stmt->bind_param("ii", $org_id, $school_id);
    $stmt->execute();
    $result = $stmt->get_result();

    // If a record exists, update the status; otherwise, insert a new row
    if ($result->num_rows > 0) {
        $stmt = $con->prepare("UPDATE volunteersorganizationstatus SET status = ? WHERE org_id = ? AND school_id = ?");
        $stmt->bind_param("sii", $status, $org_id, $school_id);
        $stmt->execute();
        if ($stmt->affected_rows > 0) {
            echo "Status updated successfully.";
        } else {
            echo "Already organization status Match That Changed.";
        }
    } else {
        $stmt = $con->prepare("INSERT INTO volunteersorganizationstatus (org_id, school_id, status) VALUES (?, ?, ?)");
        $stmt->bind_param("iis", $org_id, $school_id, $status);
        $stmt->execute();
        if ($stmt->affected_rows > 0) {
            echo "New record inserted successfully.";
        } else {
            echo "Failed to insert data.";
        }
    }
}


?>

<div id="table-container">

    <h1>Managing volunteer organizations at school</h1>



    <?php if (!empty($fetch_orgs)) : ?>

        <table>

            <tr class="bg-info">
                <th>No</th>
                <th>Organization Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Info</th>
                <th>ِAction</th>
            </tr>
            <?php
            $serialNumber = 1; // Initialize the serial number count
            foreach ($fetch_orgs as $org) : ?>
                <tr>
                    <td><?= $serialNumber++ ?></td>
                    <td><?= $org['name'] ?></td>
                    <td><?= $org['email'] ?></td>
                    <td><?= $org['phone'] ?></td>
                    <td><?= $org['info'] ?></td>
                    <td>
                        <div class="action-buttons">

                            <form style="display: inline-block;" method="POST">
                                <input type="hidden" name="org_id" value="<?= $org['id'] ?>">
                                <button type="submit" name="accept" class="btn btn-success btn-sm">Accept</button>
                            </form>

                            <form style="display: inline-block;" method="POST">
                                <input type="hidden" name="org_id" value="<?= $org['id'] ?>">
                                <button type="submit" name="reject" class="btn btn-danger btn-sm">Reject</button>
                            </form>
                        </div>
                    </td>

                </tr>
            <?php endforeach; ?>
        </table>

    <?php else : ?>
        <p>No Organizations found.</p>
    <?php endif; ?>
</div>



</body>

</html>