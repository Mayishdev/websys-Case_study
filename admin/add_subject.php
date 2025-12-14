<?php
session_start();
include '../db.php';
if ($_SESSION['role'] != 'admin') header("Location: ../login.php");

// Handle form submission
if (isset($_POST['save'])) {
    $code = mysqli_real_escape_string($conn, $_POST['subject_code']);
    $name = mysqli_real_escape_string($conn, $_POST['subject_name']);
    $units = intval($_POST['units']);
    $prereq = $_POST['prerequisite'];
    $prereq = $prereq === "" ? "NULL" : intval($prereq);

    $query = "INSERT INTO subjects (subject_code, subject_name, units, prerequisite_id) 
              VALUES ('$code', '$name', $units, $prereq)";
    mysqli_query($conn, $query);

    header("Location: list_subjects.php");
    exit;
}

// Fetch existing subjects for prerequisite dropdown
$subjects = mysqli_query($conn, "SELECT * FROM subjects");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Subject</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f6f9;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .card {
            background: #fff;
            padding: 30px 40px;
            border-radius: 12px;
            box-shadow: 0 8px 25px rgba(0,0,0,0.15);
            width: 400px;
        }

        h2 {
            text-align: center;
            margin-bottom: 25px;
            color: #333;
        }

        label {
            display: block;
            margin-bottom: 6px;
            font-weight: 500;
            color: #555;
        }

        input[type="text"],
        input[type="number"],
        select {
            width: 100%;
            padding: 10px 12px;
            margin-bottom: 20px;
            border-radius: 8px;
            border: 1px solid #ccc;
            font-size: 14px;
            box-sizing: border-box;
            outline: none;
            transition: all 0.3s ease;
        }

        input:focus,
        select:focus {
            border-color: #9b59b6;
            box-shadow: 0 0 5px rgba(155, 89, 182, 0.3);
        }

        button {
            width: 100%;
            padding: 12px;
            background: #9b59b6;
            border: none;
            color: #fff;
            font-size: 16px;
            border-radius: 8px;
            cursor: pointer;
            font-weight: bold;
            transition: background 0.3s ease;
        }

        button:hover {
            background: #8e44ad;
        }
    </style>
</head>
<body>

<div class="card">
    <h2>Add Subject</h2>
    <form method="POST">
        <label>Subject Code:</label>
        <input type="text" name="subject_code" required placeholder="e.g., HCI101">

        <label>Subject Name:</label>
        <input type="text" name="subject_name" required placeholder="e.g., Human-Computer Interaction">

        <label>Units:</label>
        <input type="number" name="units" min="1" max="10" required placeholder="e.g., 3">

        <label>Prerequisite (optional):</label>
        <select name="prerequisite">
            <option value="">None</option>
            <?php while($row = mysqli_fetch_assoc($subjects)): ?>
                <option value="<?php echo $row['id']; ?>"><?php echo $row['subject_name']; ?></option>
            <?php endwhile; ?>
        </select>

        <button name="save">Save</button>
<a href="list_subjects.php">
    <button type="button" style="margin-top: 10px; background: #95a5a6;">Back</button>
</a>
</a>
    </form>
</div>

</body>
</html>
