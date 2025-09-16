<?php
//image
echo "<img src='SORRERA_CEDRIC.png' alt='My Photo'>";

// Personal Information
$name = "Cedric Johanns C. Sorrera";
$role = "Web Developer";
$course = "Bachelor of Science in Information Technology";
$phone = "09468482554";
$email = "cedric.sorrera@email.com";
$address = "Canarvacnan Binalonan, Pangasinan";
$dob = "December 20, 2003";
$gender = "Male";
$natio = "Filipino";
$linkedin = "1linkedin.com/in/cedric-johanns-sorrera-433762381";
$gitlab = "142711918+Mayishdev@users.noreply.github.com";


$educ = "Education";
$ex = "Experience";
$skill = "Skills";
$job = "NA";
$comp = "NA";
$task = "NA";
$skil = ["HTML", "CSS", "JavaScript", "PHP", "SQL"];


echo "<h2> $name </h2>";
echo "<h3> $role </h3>";
echo "Phone number: " .$phone. "<br>";
echo "Email: " .$email. "<br>";
echo "Address: " .$address. "<br>";
echo "Date of Birth: " .$dob. "<br>";
echo "Genderr: " .$gender. "<br>";
echo "Nationality: " .$gender. "<br>";
echo "Gender: " .$natio. "<br>";
echo "linkedin: " .$linkedin. "<br>";
echo "Github: " .$gitlab. "<br>";
echo "<hr>";

echo "<h3> $educ </h3>";
echo "<h3><p> 2010-2016: North Central School Sped Center</p></h3>" ."<br>";
echo "<h3><p> 2017-2020: (Junior High) Juan G. Macaraeg National High School</p></h3>";
echo "<h3><p> 2020-2022: (Senior High) Juan G. Macaraeg National High School</p></h3>" ."<br>";
echo "<h3><p> 2023-Present: (College) Pangasinan State University Urdaneta Campus</p></h3>";
echo "<h3> $course </h3>";
echo "<hr>";

echo "<h3> $ex </h3>";
echo "<h3>Job title: " .$job. "<br></h3>";
echo "<h3>Company: " .$comp. "<br></h3>";
echo "<h3>Task: " .$task ."</h3>";
echo "<hr>";

echo "<h3> $skill </h3>";
echo "<h3><li>HTML</li>" ."<li>CSS</li>" ."<li>PHP</li></h3>";
?>