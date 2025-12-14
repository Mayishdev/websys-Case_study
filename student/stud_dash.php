<?php
session_start();
if ($_SESSION['role'] != 'student') {
    header("Location: ../login.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Student Dashboard</title>

    <!-- BOOTSTRAP -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container mt-5">
    <div class="card shadow p-4">
        <h3 class="text-center mb-4">Student Dashboard</h3>

        <div class="d-grid gap-3 col-6 mx-auto">
            <a href="enroll.php" class="btn btn-primary">Enroll Subjects</a>
            <a href="my_enrollments.php" class="btn btn-success">My Enrollments & Grades</a>
            <a href="../logout.php" class="btn btn-danger">Logout</a>
        </div>
    </div>
</div>

</body>
</html>
