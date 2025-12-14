<?php
session_start();
include '../db.php';

if ($_SESSION['role'] != 'student') {
    header("Location: ../login.php");
    exit;
}

$student_id = $_SESSION['user_id'];

// Fetch student enrollments with grades
$query = "SELECT s.subject_name, g.grade
          FROM enrollments e
          JOIN subjects s ON e.subject_id = s.id
          LEFT JOIN grades g 
          ON e.student_id = g.student_id 
          AND e.subject_id = g.subject_id
          WHERE e.student_id = $student_id";

$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html>
<head>
    <title>My Enrollments & Grades</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="card shadow p-4">
        <h3 class="text-center mb-4">My Enrollments & Grades</h3>

        <table class="table table-bordered table-striped text-center">
            <thead class="table-dark">
                <tr>
                    <th>Subject</th>
                    <th>Grade</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
            <?php while($row = mysqli_fetch_assoc($result)): ?>
                <tr>
                    <td><?php echo $row['subject_name']; ?></td>

                    <td>
                        <?php 
                        // Show numeric grades or fallback to text
                        if (!isset($row['grade'])) {
                            echo 'N/A';
                        } elseif (is_numeric($row['grade'])) {
                            echo number_format(floatval($row['grade']), 1);
                        } else {
                            echo $row['grade']; // old 'Pass'/'Fail' values
                        }
                        ?>
                    </td>

                    <td>
                        <?php 
                        if (!isset($row['grade'])) {
                            echo "<span class='badge bg-secondary'>N/A</span>";
                        } elseif (is_numeric($row['grade'])) {
                            // Numeric grading system: 1.0–3.0 = Pass, >3.0 = Fail
                            if (floatval($row['grade']) <= 3.0) {
                                echo "<span class='badge bg-success'>Passed</span>";
                            } else {
                                echo "<span class='badge bg-danger'>Failed</span>";
                            }
                        } else {
                            // Fallback for old grades
                            if (strtoupper($row['grade']) == 'PASS') {
                                echo "<span class='badge bg-success'>Passed</span>";
                            } else {
                                echo "<span class='badge bg-danger'>Failed</span>";
                            }
                        }
                        ?>
                    </td>
                </tr>
            <?php endwhile; ?>
            </tbody>
        </table>

        <div class="text-center mt-3">
            <a href="stud_dash.php" class="btn btn-secondary">⬅ Back to Dashboard</a>
        </div>
    </div>
</div>

</body>
</html>
