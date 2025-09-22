<?php
if (isset($_POST['submit'])) {
    // Directory where files will be uploaded
    $target_dir = "uploads/";

    // Create the uploads folder if not exists
    if (!is_dir($target_dir)) {
        mkdir($target_dir, 0777, true);
    }

    $file_name = basename($_FILES["myfile"]["name"]);
    $target_file = $target_dir . $file_name;
    $uploadOk = 1;

    $fileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    $newFileName = uniqid("file_", true) . "." . $fileType;
    $target_file = $target_dir . $newFileName;

    // Check if file exists
    if (file_exists($target_file)) {
        echo "Sorry, file already exists.<br>";
        $uploadOk = 0;
    }

    // Limit file size (2MB max)
    if ($_FILES["myfile"]["size"] > 2 * 1024 * 1024) {
        echo "Sorry, your file is too large (max 2MB).<br>";
        $uploadOk = 0;
    }

    // Allow only certain file formats
    $allowed_types = ["jpg", "jpeg", "png", "gif", "pdf"];
    if (!in_array($fileType, $allowed_types)) {
        echo "Sorry, only JPG, JPEG, PNG, GIF & PDF files are allowed.<br>";
        $uploadOk = 0;
    }

    // Upload file if valid
    if ($uploadOk == 0) {
        echo "Your file was not uploaded.<br>";
        $uploadedFilePath = "";
    } else {
        if (move_uploaded_file($_FILES["myfile"]["tmp_name"], $target_file)) {
            $uploadedFilePath = $target_file;
        } else {
            echo "Sorry, there was an error uploading your file.<br>";
            $uploadedFilePath = "";
        }
    }

    if ($uploadedFilePath != "" && in_array($fileType, ["jpg", "jpeg", "png", "gif"])) {
    } elseif ($uploadedFilePath != "" && $fileType == "pdf") {
        echo "<strong>Uploaded File:</strong> <a href='" . $uploadedFilePath . "' target='_blank'>View PDF</a><br>";
    }
} else {
    echo "No data submitted.";
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Biodata Output</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f1f4f7;
        }
        .biodata-wrapper {
            display: flex;
            justify-content: center;
            margin-top: 40px;
        }
        .biodata-container {
            position: relative;
            width: 800px;
            padding: 20px;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0px 4px 8px rgba(0,0,0,0.1);
        }
        .biodata-picture {
            position: absolute;
            top: 20px;
            left: 20px;
            width: 150px;
            height: auto;
            border: 2px solid #444;
            border-radius: 8px;
        }
        .biodata-info {
            margin-left: 190px; /* pushes text away from the picture */
        }
        .biodata-info h2 {
            text-align: center;
            margin-top: 0;
            color: #222;
        }
        .biodata-info p {
            margin: 6px 0;
            font-size: 15px;
        }
    </style>
</head>
<body>

<div class="biodata-wrapper">
    <div class="biodata-container">
        <?php if (!empty($uploadedFilePath) && in_array($fileType, ["jpg", "jpeg", "png", "gif"])): ?>
            <img src="<?php echo $uploadedFilePath; ?>" alt="Uploaded Picture" class="biodata-picture">
        <?php elseif (!empty($uploadedFilePath) && $fileType == "pdf"): ?>
            <p><strong>Uploaded File:</strong> <a href="<?php echo $uploadedFilePath; ?>" target="_blank">View PDF</a></p>
        <?php endif; ?>

        <div class="biodata-info">
            <h2>Biodata Information</h2>
            <p><strong>Position Desired:</strong> <?php echo htmlspecialchars($_POST['position']); ?></p>
            <p><strong>Name:</strong> <?php echo htmlspecialchars($_POST['name']); ?></p>
            <p><strong>Gender:</strong> <?php echo htmlspecialchars($_POST['gender']); ?></p>
            <p><strong>City Address:</strong> <?php echo htmlspecialchars($_POST['city_address']); ?></p>
            <p><strong>Provincial Address:</strong> <?php echo htmlspecialchars($_POST['provincial_address']); ?></p>
            <p><strong>Telephone:</strong> <?php echo htmlspecialchars($_POST['telephone']); ?></p>
            <p><strong>Email Address:</strong> <?php echo htmlspecialchars($_POST['email']); ?></p>
            <p><strong>Date of Birth:</strong> <?php echo htmlspecialchars($_POST['dob']); ?></p>
            <p><strong>Civil Status:</strong> <?php echo htmlspecialchars($_POST['civil_status']); ?></p>
            <p><strong>Citizenship:</strong> <?php echo htmlspecialchars($_POST['citizenship']); ?></p>
            <p><strong>Hobbies:</strong> <?php echo htmlspecialchars($_POST['hob']); ?></p>
            <p><strong>Date of Place:</strong> <?php echo htmlspecialchars($_POST['dop']); ?></p>
            <p><strong>Height:</strong> <?php echo htmlspecialchars($_POST['height']); ?></p>
            <p><strong>Religion:</strong> <?php echo htmlspecialchars($_POST['religion']); ?></p>
            <p><strong>Weight:</strong> <?php echo htmlspecialchars($_POST['weight']); ?></p>
            <p><strong>Elementary:</strong> <?php echo htmlspecialchars($_POST['elementary']); ?></p>
            <p><strong>High School:</strong> <?php echo htmlspecialchars($_POST['highschool']); ?></p>
            <p><strong>College:</strong> <?php echo htmlspecialchars($_POST['college']); ?></p>
            <p><strong>Degree Received:</strong> <?php echo htmlspecialchars($_POST['degree']); ?></p>
            <p><strong>Special Skills:</strong> <?php echo htmlspecialchars($_POST['skills']); ?></p>
        </div>
    </div>
</div>

</body>
</html>