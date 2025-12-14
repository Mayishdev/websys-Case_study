<?php
session_start();
include '../db.php';

if ($_SESSION['role'] != 'admin') {
    header("Location: ../login.php");
    exit;
}

// Fetch subjects with prerequisite
$query = "SELECT s1.id, s1.subject_code, s1.subject_name, s1.units, 
                 s2.subject_name AS prerequisite
          FROM subjects s1
          LEFT JOIN subjects s2 ON s1.prerequisite_id = s2.id";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Manage Subjects</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="card shadow p-4">
        <h3 class="text-center mb-4">Subjects</h3>

        <div class="text-end mb-3">
            <a href="add_subject.php" class="btn btn-success">Add Subject</a>
        </div>

        <table class="table table-bordered table-striped text-center align-middle">
            <thead class="table-dark">
                <tr>
                    <th>Code</th>
                    <th>Subject Name</th>
                    <th>Units</th>
                    <th>Prerequisite</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while($row = mysqli_fetch_assoc($result)): ?>
                <tr>
                    <td><?php echo $row['subject_code']; ?></td>
                    <td><?php echo $row['subject_name']; ?></td>
                    <td><?php echo $row['units']; ?></td>
                    <td><?php echo $row['prerequisite'] ?? '-'; ?></td>
                    <td>
                        <a href="edit_subject.php?id=<?php echo $row['id']; ?>" class="btn btn-primary btn-sm">Edit</a>
                        <a href="delete_subject.php?id=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm"
                           onclick="return confirm('Delete this subject?')">Delete</a>
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
