<?php
$errors = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $required_fields = [
        "position" => "Position Desired",
        "name" => "Name",
        "gender" => "Gender",
        "city_address" => "City Address",
        "provincial_address" => "Provincial Address",
        "telephone" => "Telephone",
        "email" => "Email Address",
        "dob" => "Date of Birth",
        "civil_status" => "Civil Status",
        "citizenship" => "Citizenship",
        "hob" => "Hobbies",
        "dop" => "Birth of Place",
        "height" => "Height",
        "religion" => "Religion",
        "weight" => "Weight",
        "elementary" => "Elementary",
        "highschool" => "High School",
        "college" => "College",
        "degree" => "Degree Received",
        "skills" => "Special Skills"
    ];

    foreach ($required_fields as $field => $label) {
        if (empty($_POST[$field])) {
            $errors[$field] = "$label is required";
        }
    }

    
    if ($_FILES["myfile"]["error"] == 4) {
        $errors["myfile"] = "Picture upload is required";
    }

   
    if (empty($errors)) {
        include("display_biodata.php");
        exit;
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Biodata Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f7f9;
            padding: 20px;
        }
        h2 {
            text-align: center;
            color: #333;
        }
        form {
            max-width: 700px;
            margin: auto;
            background: #fff;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0,0,0,0.1);
        }
        .form-group {
            margin-bottom: 15px;
        }
        label {
            font-weight: bold;
            color: #444;
            display: inline-block;
            width: 180px; 
        }
        .error {
            color: red;
            font-size: 13px;
            margin-left: 5px;
        }
        input[type="text"],
        input[type="email"],
        input[type="date"],
        input[type="file"] {
            width: calc(100% - 190px);
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 6px;
            font-size: 14px;
        }
        input[type="file"] {
            border: none;
        }
        input[type="submit"] {
            background: #007bff;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 15px;
            display: block;
            margin: 20px auto 0;
        }
        input[type="submit"]:hover {
            background: #0056b3;
        }
    </style>
</head>
<body>
    <h2>Biodata Form</h2>
    <form action="" method="POST" enctype="multipart/form-data">

        <div class="form-group">
            <label>Position Desired:</label>
            <span class="error"><?php echo $errors['position'] ?? ''; ?></span>
            <input type="text" name="position" value="<?php echo $_POST['position'] ?? '';?>">
        </div>

        <div class="form-group">
            <label>Name:</label>
            <span class="error"><?php echo $errors['name'] ?? ''; ?></span>
            <input type="text" name="name" value="<?php echo $_POST['name'] ?? '';?>">
        </div>

        <div class="form-group">
            <label>Gender:</label>
            <span class="error"><?php echo $errors['gender'] ?? ''; ?></span>
            <input type="text" name="gender" value="<?php echo $_POST['gender'] ?? '';?>">
        </div>

        <div class="form-group">
            <label>City Address:</label>
            <span class="error"><?php echo $errors['city_address'] ?? ''; ?></span>
            <input type="text" name="city_address" value="<?php echo $_POST['city_address'] ?? '';?>">
        </div>

        <div class="form-group">
            <label>Provincial Address:</label>
            <span class="error"><?php echo $errors['provincial_address'] ?? ''; ?></span>
            <input type="text" name="provincial_address" value="<?php echo $_POST['provincial_address'] ?? '';?>">
        </div>

        <div class="form-group">
            <label>Telephone:</label>
            <span class="error"><?php echo $errors['telephone'] ?? ''; ?></span>
            <input type="text" name="telephone" value="<?php echo $_POST['telephone'] ?? '';?>">
        </div>

        <div class="form-group">
            <label>Email Address:</label>
            <span class="error"><?php echo $errors['email'] ?? ''; ?></span>
            <input type="email" name="email" value="<?php echo $_POST['email'] ?? '';?>">
        </div>

        <div class="form-group">
            <label>Date of Birth:</label>
            <span class="error"><?php echo $errors['dob'] ?? ''; ?></span>
            <input type="date" name="dob" value="<?php echo $_POST['dob'] ?? '';?>">
        </div>

        <div class="form-group">
            <label>Civil Status:</label>
            <span class="error"><?php echo $errors['civil_status'] ?? ''; ?></span>
            <input type="text" name="civil_status" value="<?php echo $_POST['civil_status'] ?? '';?>">
        </div>

        <div class="form-group">
            <label>Citizenship:</label>
            <span class="error"><?php echo $errors['citizenship'] ?? ''; ?></span>
            <input type="text" name="citizenship" value="<?php echo $_POST['citizenship'] ?? '';?>">
        </div>

         <div class="form-group">
            <label>Hobbies:</label>
            <span class="error"><?php echo $errors['citizenship'] ?? ''; ?></span>
            <input type="text" name="hob" value="<?php echo $_POST['hob'] ?? '';?>">
        </div>

        <div class="form-group">
            <label>Date of Place:</label>
            <span class="error"><?php echo $errors['dob'] ?? ''; ?></span>
            <input type="text" name="dop" value="<?php echo $_POST['dob'] ?? '';?>">
        </div>

        <div class="form-group">
            <label>Height:</label>
            <span class="error"><?php echo $errors['height'] ?? ''; ?></span>
            <input type="text" name="height" value="<?php echo $_POST['height'] ?? '';?>">
        </div>

        <div class="form-group">
            <label>Religion:</label>
            <span class="error"><?php echo $errors['religion'] ?? ''; ?></span>
            <input type="text" name="religion" value="<?php echo $_POST['religion'] ?? '';?>">
        </div>

        <div class="form-group">
            <label>Weight:</label>
            <span class="error"><?php echo $errors['weight'] ?? ''; ?></span>
            <input type="text" name="weight" value="<?php echo $_POST['weight'] ?? '';?>">
        </div>

        <div class="form-group">
            <label>Elementary:</label>
            <span class="error"><?php echo $errors['elementary'] ?? ''; ?></span>
            <input type="text" name="elementary" value="<?php echo $_POST['elementary'] ?? '';?>">
        </div>

        <div class="form-group">
            <label>High School:</label>
            <span class="error"><?php echo $errors['highschool'] ?? ''; ?></span>
            <input type="text" name="highschool" value="<?php echo $_POST['highschool'] ?? '';?>">
        </div>

        <div class="form-group">
            <label>College:</label>
            <span class="error"><?php echo $errors['college'] ?? ''; ?></span>
            <input type="text" name="college" value="<?php echo $_POST['college'] ?? '';?>">
        </div>

        <div class="form-group">
            <label>Degree Received:</label>
            <span class="error"><?php echo $errors['degree'] ?? ''; ?></span>
            <input type="text" name="degree" value="<?php echo $_POST['degree'] ?? '';?>">
        </div>

        <div class="form-group">
            <label>Special Skills:</label>
            <span class="error"><?php echo $errors['skills'] ?? ''; ?></span>
            <input type="text" name="skills" value="<?php echo $_POST['skills'] ?? '';?>">
        </div>

        <div class="form-group">
            <label>Upload Picture:</label>
            <span class="error"><?php echo $errors['myfile'] ?? ''; ?></span>
            <input type="file" name="myfile">
        </div>

        <input type="submit" name="submit" value="Submit">
    </form>
</body>
</html>
