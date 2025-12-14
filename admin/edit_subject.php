<?php
session_start();
include '../db.php';
if ($_SESSION['role'] != 'admin') header("Location: ../login.php");

$id = $_GET['id'];
$subject = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM subjects WHERE id=$id"));

// Handle update
if (isset($_POST['update'])) {
    $code = $_POST['subject_code'];
    $name = $_POST['subject_name'];
    $units = $_POST['units'];
    $prereq = $_POST['prerequisite'] ?: "NULL";

    mysqli_query($conn, "UPDATE subjects 
                         SET subject_code='$code', 
                             subject_name='$name', 
                             units=$units, 
                             prerequisite_id=$prereq
                         WHERE id=$id");

    header("Location: list_subjects.php");
}

// Fetch all subjects except current (for prerequisite selection)
$subjects = mysqli_query($conn, "SELECT * FROM subjects WHERE id != $id");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Subject</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="card shadow p-4" style="max-width: 500px; margin: auto;">
        <h3 class="text-center mb-4">Edit Subject</h3>
        <form method="POST">
            <div class="mb-3">
                <label class="form-label">Subject Code:</label>
                <input type="text" name="subject_code" class="form-control" value="<?php echo $subject['subject_code']; ?>" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Subject Name:</label>
                <input type="text" name="subject_name" class="form-control" value="<?php echo $subject['subject_name']; ?>" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Units:</label>
                <input type="number" name="units" class="form-control" value="<?php echo $subject['units']; ?>" min="1" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Prerequisite (optional):</label>
                <select name="prerequisite" class="form-select">
                    <option value="">--None--</option>
                    <?php while($row = mysqli_fetch_assoc($subjects)): ?>
                        <option value="<?php echo $row['id']; ?>" <?php if($row['id'] == $subject['prerequisite_id']) echo "selected"; ?>>
                            <?php echo $row['subject_name']; ?>
                        </option>
                    <?php endwhile; ?>
                </select>
            </div>

            <button name="update" class="btn btn-primary w-100">Update Subject</button>
        </form>

        <div class="text-center mt-3">
            <a href="list_subjects.php" class="btn btn-secondary">⬅ Back to Subjects</a>
        </div>
    </div>
</div>

</body>
</html>
