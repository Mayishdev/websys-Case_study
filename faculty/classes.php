<?php
session_start();
include '../db.php';

if ($_SESSION['role'] != 'faculty') {
    header("Location: ../login.php");
    exit;
}

// Fetch all students and their enrollments (if any)
$query = "SELECT u.id AS student_id, u.name AS student_name, u.profile_pic, u.signature,
                 s.id AS subject_id, s.subject_name
          FROM users u
          LEFT JOIN enrollments e ON u.id = e.student_id
          LEFT JOIN subjects s ON e.subject_id = s.id
          WHERE u.role = 'student'
          ORDER BY u.name, s.subject_name";

$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Faculty Class List</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="card shadow p-4">
        <h3 class="text-center mb-4">Class List</h3>

        <table class="table table-bordered table-striped text-center align-middle">
            <thead class="table-dark">
                <tr>
                    <th>Student</th>
                    <th>Profile Picture</th>
                    <th>Signature</th>
                    <th>Subject</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
            <?php while($row = mysqli_fetch_assoc($result)): ?>
                <tr>
                    <td><?php echo $row['student_name']; ?></td>

                    <td>
                        <?php if($row['profile_pic']): ?>
                            <img src="../<?php echo $row['profile_pic']; ?>" width="50">
                        <?php else: ?>
                            -
                        <?php endif; ?>
                    </td>

                    <td>
                        <?php if($row['signature']): ?>
                            <img src="../<?php echo $row['signature']; ?>" width="50">
                        <?php else: ?>
                            -
                        <?php endif; ?>
                    </td>

                    <td><?php echo $row['subject_name'] ?? '-'; ?></td>

                    <td>
                        <a href="../view_profile.php?id=<?php echo $row['student_id']; ?>" class="btn btn-info btn-sm">
                            View Profile
                        </a>
                        <?php if($row['subject_id']): ?>
                            <a href="submit_grade.php?student_id=<?php echo $row['student_id']; ?>&subject_id=<?php echo $row['subject_id']; ?>" 
                               class="btn btn-success btn-sm">
                                Submit Grade
                            </a>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endwhile; ?>
            </tbody>
        </table>

        <div class="text-center mt-3">
            <a href="facul_dash.php" class="btn btn-secondary">⬅ Back to Dashboard</a>
        </div>
    </div>
</div>

</body>
</html>
