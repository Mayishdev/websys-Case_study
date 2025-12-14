<?php
session_start();
include '../db.php';

if ($_SESSION['role'] != 'faculty') {
    header("Location: ../login.php");
    exit;
}

// Get selected student and subject from GET (if any)
$selected_student = $_GET['student_id'] ?? '';
$selected_subject = $_GET['subject_id'] ?? '';

// College numeric grading system (GPA 1.0 to 5.0)
$grades = ['1.0','1.25','1.5','1.75','2.0','2.25','2.5','2.75','3.0','4.0','5.0'];

// Handle grade submission
if (isset($_POST['submit'])) {
    $student_id = $_POST['student_id'];
    $subject_id = $_POST['subject_id'];
    $grade = $_POST['grade'];

    // Check if grade already exists
    $check = mysqli_query($conn, "SELECT * FROM grades 
                                  WHERE student_id=$student_id AND subject_id=$subject_id");
    if (mysqli_num_rows($check) > 0) {
        mysqli_query($conn, "UPDATE grades SET grade='$grade' 
                             WHERE student_id=$student_id AND subject_id=$subject_id");
        $success = "Grade updated successfully!";
    } else {
        mysqli_query($conn, "INSERT INTO grades (student_id, subject_id, grade) 
                             VALUES ($student_id, $subject_id, '$grade')");
        $success = "Grade submitted successfully!";
    }
}

// Fetch all students
$students = mysqli_query($conn, "SELECT * FROM users WHERE role='student'");

// Fetch subjects enrolled by selected student (if any)
if ($selected_student) {
    $subjects = mysqli_query($conn, "SELECT s.id, s.subject_name 
                                     FROM enrollments e
                                     JOIN subjects s ON e.subject_id = s.id
                                     WHERE e.student_id = $selected_student");
} else {
    $subjects = mysqli_query($conn, "SELECT * FROM subjects");
}

// Get existing grade if student and subject are selected
$existing_grade = '';
if ($selected_student && $selected_subject) {
    $res = mysqli_query($conn, "SELECT grade FROM grades 
                                WHERE student_id=$selected_student AND subject_id=$selected_subject");
    if (mysqli_num_rows($res) > 0) {
        $existing_grade = mysqli_fetch_assoc($res)['grade'];
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Submit Grades</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="card shadow p-4" style="max-width: 500px; margin: auto;">
        <h3 class="text-center mb-4">Submit Grades (Numeric)</h3>

        <?php if (isset($success)): ?>
            <div class="alert alert-success"><?php echo $success; ?></div>
        <?php endif; ?>

        <form method="POST">
            <div class="mb-3">
                <label class="form-label">Student</label>
                <select name="student_id" class="form-select" required onchange="this.form.submit()">
                    <option value="">--Select Student--</option>
                    <?php while($s = mysqli_fetch_assoc($students)): ?>
                        <option value="<?php echo $s['id']; ?>" <?php if($s['id']==$selected_student) echo 'selected'; ?>>
                            <?php echo $s['name']; ?>
                        </option>
                    <?php endwhile; ?>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Subject</label>
                <select name="subject_id" class="form-select" required>
                    <option value="">--Select Subject--</option>
                    <?php 
                    mysqli_data_seek($subjects, 0);
                    while($sub = mysqli_fetch_assoc($subjects)): ?>
                        <option value="<?php echo $sub['id']; ?>" <?php if($sub['id']==$selected_subject) echo 'selected'; ?>>
                            <?php echo $sub['subject_name']; ?>
                        </option>
                    <?php endwhile; ?>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Grade (GPA)</label>
                <select name="grade" class="form-select" required>
                    <option value="">--Select Grade--</option>
                    <?php foreach($grades as $g): ?>
                        <option value="<?php echo $g; ?>" <?php if($existing_grade==$g) echo 'selected'; ?>>
                            <?php echo $g; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <button name="submit" class="btn btn-success w-100">Submit Grade</button>
        </form>

        <div class="text-center mt-3">
            <a href="classes.php" class="btn btn-secondary">⬅ Back to Classes</a>
        </div>
    </div>
</div>

</body>
</html>
