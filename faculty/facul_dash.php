<?php
session_start();
if ($_SESSION['role'] != 'faculty') {
    header("Location: ../login.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Faculty Dashboard</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="card shadow p-4" style="max-width: 400px; margin: auto;">
        <h3 class="text-center mb-4">Faculty Dashboard</h3>

        <div class="d-grid gap-3">
            <a href="classes.php" class="btn btn-primary btn-lg">View Classes</a>
            <a href="../logout.php" class="btn btn-danger btn-lg">Logout</a>
        </div>
    </div>
</div>

</body>
</html>
