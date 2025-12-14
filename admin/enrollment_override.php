<?php
session_start();
include '../db.php';

if ($_SESSION['role'] != 'admin') {
    header("Location: ../login.php");
    exit;
}

// Handle override enrollment
if (isset($_POST['override'])) {
    $student_id = $_POST['student_id'];
    $subject_id = $_POST['subject_id'];

    // Check if already enrolled
    $check = mysqli_query($conn, 
        "SELECT * FROM enrollments 
         WHERE student_id=$student_id AND subject_id=$subject_id");

    if (mysqli_num_rows($check) == 0) {
        mysqli_query($conn,
            "INSERT INTO enrollments (student_id, subject_id)
             VALUES ($student_id, $subject_id)");
        $success = "Enrollment override successful!";
    } else {
        $error = "Student already enrolled in this subject.";
    }
}

// Fetch students and subjects
$students = mysqli_query($conn, "SELECT * FROM users WHERE role='student'");
$subjects = mysqli_query($conn, "SELECT * FROM subjects");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Enrollment Override</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="card shadow p-4" style="max-width: 500px; margin: auto;">
        <h3 class="text-center mb-4">Enrollment Override</h3>

        <?php if (isset($success)): ?>
            <div class="alert alert-success"><?php echo $success; ?></div>
        <?php endif; ?>
        <?php if (isset($error)): ?>
            <div class="alert alert-danger"><?php echo $error; ?></div>
        <?php endif; ?>

        <form method="POST">
            <div class="mb-3">
                <label class="form-label">Student:</label>
                <select name="student_id" class="form-select" required>
                    <option value="">-- Select Student --</option>
                    <?php while($s = mysqli_fetch_assoc($students)): ?>
                        <option value="<?php echo $s['id']; ?>">
                            <?php echo $s['name']; ?>
                        </option>
                    <?php endwhile; ?>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Subject:</label>
                <select name="subject_id" class="form-select" required>
                    <option value="">-- Select Subject --</option>
                    <?php while($sub = mysqli_fetch_assoc($subjects)): ?>
                        <option value="<?php echo $sub['id']; ?>">
                            <?php echo $sub['subject_name']; ?>
                        </option>
                    <?php endwhile; ?>
                </select>
            </div>

            <button name="override" class="btn btn-success w-100">Override Enroll</button>
        </form>

        <div class="text-center mt-3">
            <a href="admin_dash.php" class="btn btn-secondary">⬅ Back to Dashboard</a>
        </div>
    </div>
</div>

</body>
</html>
