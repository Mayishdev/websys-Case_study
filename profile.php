<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

if (isset($_POST['save'])) {

    $profileName = $_FILES['profile']['name'];
    $profileTmp = $_FILES['profile']['tmp_name'];
    $profilePath = "uploads/profiles/" . $profileName;

    $signName = $_FILES['signature']['name'];
    $signTmp = $_FILES['signature']['tmp_name'];
    $signPath = "uploads/signatures/" . $signName;

    move_uploaded_file($profileTmp, $profilePath);
    move_uploaded_file($signTmp, $signPath);

    $query = "UPDATE users SET 
              profile_pic='$profilePath',
              signature='$signPath'
              WHERE id='$user_id'";

    mysqli_query($conn, $query);

    $success = "Profile updated successfully!";
}

// Fetch current user info
$query = "SELECT * FROM users WHERE id='$user_id'";
$result = mysqli_query($conn, $query);
$user = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html>
<head>
    <title>My Profile</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="card shadow p-4" style="max-width: 500px; margin: auto;">
        <h3 class="text-center mb-4">Upload Profile & Signature</h3>

        <?php if (isset($success)): ?>
            <div class="alert alert-success"><?php echo $success; ?></div>
        <?php endif; ?>

        <form method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label class="form-label">Profile Picture</label><br>
                <?php if($user['profile_pic']): ?>
                    <img src="<?php echo $user['profile_pic']; ?>" class="img-thumbnail mb-2" width="150"><br>
                <?php endif; ?>
                <input type="file" name="profile" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Signature</label><br>
                <?php if($user['signature']): ?>
                    <img src="<?php echo $user['signature']; ?>" class="img-thumbnail mb-2" width="150"><br>
                <?php endif; ?>
                <input type="file" name="signature" class="form-control" required>
            </div>

            <button name="save" class="btn btn-success w-100">Save</button>
        </form>

        <div class="text-center mt-3">
            <a href="stud_dash.php" class="btn btn-secondary">⬅ Back to Dashboard</a>
        </div>
    </div>
</div>

</body>
</html>
