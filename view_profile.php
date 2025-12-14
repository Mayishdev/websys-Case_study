<?php
session_start();
include 'db.php';

if (!isset($_SESSION['role'])) {
    header("Location: login.php");
    exit;
}

$id = $_GET['id'];

$query = "SELECT * FROM users WHERE id=$id";
$result = mysqli_query($conn, $query);
$user = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Student Profile</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="card shadow p-4" style="max-width: 500px; margin: auto;">
        <h3 class="text-center mb-4">Student Profile</h3>

        <p><strong>Name:</strong> <?php echo $user['name']; ?></p>

        <p><strong>Profile Picture:</strong></p>
        <?php if($user['profile_pic']): ?>
            <img src="<?php echo $user['profile_pic']; ?>" class="img-thumbnail" width="150">
        <?php else: ?>
            <p class="text-muted">No profile picture uploaded.</p>
        <?php endif; ?>

        <p><strong>Signature:</strong></p>
        <?php if($user['signature']): ?>
            <img src="<?php echo $user['signature']; ?>" class="img-thumbnail" width="150">
        <?php else: ?>
            <p class="text-muted">No signature uploaded.</p>
        <?php endif; ?>

        <div class="text-center mt-4">
            <a href="javascript:history.back()" class="btn btn-secondary">⬅ Back</a>
        </div>
    </div>
</div>

</body>
</html>
