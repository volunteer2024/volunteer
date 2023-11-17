<?php
include 'header.php';

$fetch_schools = array();
$type = 'school';
// Prepare the SQL statement
$select_users = $con->prepare("SELECT * FROM users WHERE type = ?");
$select_users->bind_param('s', $type);

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

if (isset($_POST['buttonSave'])) {
    //user table 	name	email	phone	password	type	info
    $name = $_POST['name'];
    $name = filter_var($name, FILTER_SANITIZE_STRING);

    $email = $_POST['email'];
    $email = filter_var($email, FILTER_SANITIZE_EMAIL);

    $info = $_POST['info'];
    $info = filter_var($info, FILTER_SANITIZE_STRING);

    $phone = $_POST['phone'];
    $phone = filter_var($phone, FILTER_SANITIZE_STRING);

    $pass = sha1($_POST['pass']);
    $pass = filter_var($pass, FILTER_SANITIZE_STRING);

    $type_user = 'school';

    //check if userid is empty insert new user
    $check_user = $con->prepare("SELECT * FROM users WHERE email = ?");
    $check_user->bind_param('s', $email);
    $check_user->execute();
    $check_user_result = $check_user->get_result();

    if ($check_user_result->num_rows > 0) {
        $message[] = 'Email Already Exists. Please Use Another Email';
        echo '<script>$("#UserModal").modal("hide");</script>';
        echo '<script>alert("Email Already Exists. Please Use Another Email");</script>';
    } else {
        $insert_user = $con->prepare("INSERT INTO users (name, email, info, phone, password, type) VALUES (?, ?, ?, ?, ?, ?)");
        $insert_user->bind_param('ssssss', $name, $email, $info, $phone, $pass, $type_user);

        if ($insert_user->execute()) {

            echo '<script>$("#UserModal").modal("hide");</script>';
            echo '<script> window.location.href = "school_managment.php";</script>';
            exit();
        } else {
            $message[] = 'Failed to Create New Account';
            echo '<script>$("#UserModal").modal("hide");</script>';
        }
    }
}
// Delete user logic
if (isset($_POST['delete_user'])) {
    $userId = $_POST['user_id'];
    $delete_user = $con->prepare("DELETE FROM users WHERE id = ?");
    $delete_user->bind_param('i', $userId);
    $delete_user->execute();
    // Redirect to same page to display updated user list
    echo '<script>alert("Successfully Delete School Account"); window.location.href = "school_managment.php";</script>';
    exit();
}
?>

<div id="table-container" class="vh-100">

    <h1>School Management</h1>
    <?php
    if (isset($message)) {
        foreach ($message as $message) {
            echo '
         <div class="fw-bold">
            <span style="color:red;">' . $message . '</span>
            <i class="fa fa-times" onclick="this.parentElement.remove();"></i>
         </div>';
        }
    }

    ?>
    <div class="mb-3" style="text-align: left;">
        <button onclick="openUserModal()" class="btn btn-info btn-sm">Add New School</button>
    </div>

    <?php if (!empty($fetch_schools)) : ?>

        <table>

            <tr class="bg-info">
                <th>No</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Type</th>
                <th>Info</th>
                <th>Actions</th>
            </tr>
            <?php
            $serialNumber = 1; // Initialize the serial number count
            foreach ($fetch_schools as $user) : ?>
                <tr>
                    <td><?= $serialNumber++ ?></td>
                    <td><?= $user['name'] ?></td>
                    <td><?= $user['email'] ?></td>
                    <td><?= $user['phone'] ?></td>
                    <td><?= $user['type'] ?></td>
                    <td><?= $user['info'] ?></td>
                    <td>

                        <form style="display: inline-block;" method="POST" onsubmit="return confirm('Are you sure you want to delete this user?')">
                            <input type="hidden" name="user_id" value="<?= $user['id'] ?>">
                            <button type="submit" name="delete_user" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>

    <?php else : ?>
        <p>No Schools found.</p>
    <?php endif; ?>
</div>

<!-- Add User Modal -->
<div class="modal fade" id="UserModal" tabindex="-1" aria-labelledby="UserModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="UserModalLabel">Add User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Add your form elements for adding a new user here -->
                <!-- Example: -->
                <form id="addUserForm" method="POST">

                    <input type="hidden" class="form-control" id="userId" name="id">

                    <div class="mb-3">
                        <input type="text" class="form-control" id="name" name="name" placeholder="Name" required>
                    </div>
                    <div class="mb-3">

                        <input type="text" class="form-control" name="info" id="info" placeholder="info" required>
                    </div>

                    <div class="mb-3">

                        <input type="tel" class="form-control" name="phone" id="phone" placeholder="Phone Number" required>
                    </div>
                    <div class="mb-3">

                        <input type="email" class="form-control" name="email" id="email" placeholder="email" required>
                    </div>
                    <div class="mb-3">

                        <input type="password" class="form-control" name="pass" id="pass" placeholder="Password" required>
                    </div>

                </form>
            </div>
            <div class="modal-footer">

                <button type="submit" class="btn btn-primary" form="addUserForm" name="buttonSave">Save</button>
            </div>
        </div>
    </div>
</div>

<?php include 'footer.php' ?>

<script>
    function openUserModal() {
        $('#UserModalLabel').text('Add New School');
        $('#UserModal').modal('show'); // Show the modal
    }
</script>