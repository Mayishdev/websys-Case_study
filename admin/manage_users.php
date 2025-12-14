<?php
session_start();
include '../db.php';

if ($_SESSION['role'] != 'admin') {
    header("Location: ../login.php");
    exit;
}

// Delete user
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    mysqli_query($conn, "DELETE FROM users WHERE id=$id");
    header("Location: manage_users.php");
    exit;
}

$users = mysqli_query($conn, "SELECT * FROM users ORDER BY role, name");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Manage Users</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="card shadow p-4">
        <h3 class="text-center mb-4">Manage Users</h3>

        <table class="table table-bordered table-striped text-center align-middle">
            <thead class="table-dark">
                <tr>
                    <th>Name</th>
                    <th>Username</th>
                    <th>Role</th>
                    <th>Profile</th>
                    <th>Signature</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php while($u = mysqli_fetch_assoc($users)): ?>
                <tr>
                    <td><?php echo $u['name']; ?></td>
                    <td><?php echo $u['username']; ?></td>
                    <td><?php echo ucfirst($u['role']); ?></td>
                    <td>
                        <?php if($u['profile_pic']): ?>
                            <img src="../<?php echo $u['profile_pic']; ?>" width="50" class="img-thumbnail">
                        <?php else: ?> -
                        <?php endif; ?>
                    </td>
                    <td>
                        <?php if($u['signature']): ?>
                            <img src="../<?php echo $u['signature']; ?>" width="50" class="img-thumbnail">
                        <?php else: ?> -
                        <?php endif; ?>
                    </td>
                    <td>
                        <a href="?delete=<?php echo $u['id']; ?>" class="btn btn-danger btn-sm"
                           onclick="return confirm('Delete this user?')">
                           Delete
                        </a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>

        <div class="text-center mt-3">
            <a href="admin_dash.php" class="btn btn-secondary">⬅ Back to Dashboard</a>
        </div>
    </div>
</div>

</body>
</html>
