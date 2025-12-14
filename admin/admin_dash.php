<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>

    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: #f4f6f9;
        }
        .card-hover:hover {
            transform: scale(1.03);
            transition: 0.2s;
        }
    </style>
</head>
<body>

<div class="container py-5">
    <h2 class="text-center mb-4">Admin Dashboard</h2>
    <p class="text-center">Welcome, Admin!</p>

    <div class="row justify-content-center">

        <div class="col-md-4 mb-3">
            <div class="card shadow card-hover text-center">
                <div class="card-body">
                    <h5 class="card-title">Manage Users</h5>
                    <p class="card-text">Add, view, and remove system users</p>
                    <a href="manage_users.php" class="btn btn-primary w-100">Open</a>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-3">
            <div class="card shadow card-hover text-center">
                <div class="card-body">
                    <h5 class="card-title">Manage Subjects</h5>
                    <p class="card-text">Add subjects and assign prerequisites</p>
                    <a href="list_subjects.php" class="btn btn-success w-100">Open</a>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-3">
            <div class="card shadow card-hover text-center">
                <div class="card-body">
                    <h5 class="card-title">Enrollment Override</h5>
                    <p class="card-text">Manually enroll students</p>
                    <a href="enrollment_override.php" class="btn btn-warning w-100">Open</a>
                </div>
            </div>
        </div>

        <div class="col-md-4 mt-4">
            <a href="../logout.php" class="btn btn-danger w-100">Logout</a>
        </div>

    </div>
</div>

</body>
</html>
