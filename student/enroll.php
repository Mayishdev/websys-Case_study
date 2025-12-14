<?php
session_start();
include '../db.php';

if ($_SESSION['role'] != 'student') {
    header("Location: ../login.php");
    exit;
}

$student_id = $_SESSION['user_id'];

// Handle enrollment
if (isset($_GET['subject_id'])) {
    $subject_id = $_GET['subject_id'];

    // Get prerequisite
    $prereq_query = "SELECT prerequisite_id FROM subjects WHERE id=$subject_id";
    $prereq_result = mysqli_query($conn, $prereq_query);
    $prereq = mysqli_fetch_assoc($prereq_result)['prerequisite_id'];

    $can_enroll = true;

    if ($prereq) {
        $check_query = "SELECT grade FROM grades 
                        WHERE student_id=$student_id AND subject_id=$prereq";
        $check_result = mysqli_query($conn, $check_query);

        $passed = false;
        if (mysqli_num_rows($check_result) > 0) {
            $grade = mysqli_fetch_assoc($check_result)['grade'];
            if (in_array(strtoupper($grade), ['PASS','A','B','C'])) {
                $passed = true;
            }
        }

        if (!$passed) {
            $can_enroll = false;
            $error = "Cannot enroll: prerequisite not completed or failed.";
        }
    }

    if ($can_enroll) {
        $already_query = "SELECT * FROM enrollments 
                          WHERE student_id=$student_id AND subject_id=$subject_id";
        $already_result = mysqli_query($conn, $already_query);

        if (mysqli_num_rows($already_result) == 0) {
            mysqli_query($conn, "INSERT INTO enrollments (student_id, subject_id) 
                                 VALUES ($student_id, $subject_id)");
            $success = "Enrolled successfully!";
        } else {
            $error = "You are already enrolled in this subject.";
        }
    }
}

// Get all subjects
$subjects_query = "SELECT s1.id, s1.subject_name, s2.subject_name AS prerequisite
                   FROM subjects s1
                   LEFT JOIN subjects s2 ON s1.prerequisite_id = s2.id";
$subjects_result = mysqli_query($conn, $subjects_query);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Enroll Subjects</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="card shadow p-4">
        <h3 class="text-center mb-4">Available Subjects</h3>

        <?php if(isset($success)) echo "<div class='alert alert-success'>$success</div>"; ?>
        <?php if(isset($error)) echo "<div class='alert alert-danger'>$error</div>"; ?>

        <table class="table table-bordered table-striped text-center">
            <thead class="table-dark">
                <tr>
                    <th>Subject</th>
                    <th>Prerequisite</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            <?php while($row = mysqli_fetch_assoc($subjects_result)): ?>
                <tr>
                    <td><?php echo $row['subject_name']; ?></td>
                    <td><?php echo $row['prerequisite'] ?? '-'; ?></td>
                    <td>
                        <a href="?subject_id=<?php echo $row['id']; ?>" class="btn btn-primary btn-sm">
                            Enroll
                        </a>
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
