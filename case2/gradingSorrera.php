<?php 
$name   = $_GET['name'];
$score  = $_GET['score'];
$grade  = $_GET['grade'];
$remark = $_GET['remark'];

echo "<div style='border:1px solid black; padding:15px; width:400px; margin:20px auto; background:#E79EAF;'>";

echo "<h2 style='color:black; text-align:center;'>Student Result</h2>";
echo "<hr style='border:1px solid black;'>";

echo "<h3>Name: $name</h3>";
echo "<h3>Score: $score</h3>";
echo "<h3>Grade: $grade</h3>";
echo "<h3>Corresponding Remarks: $remark</h3>";

echo "<h3 style='color:darkred;'>Result:</h3>";

if ($grade >= 100) {
    echo "<span style='color:green;'>Excellent Grade, </span>";
} elseif ($grade >= 90) {
    echo "<span style='color:teal;'>Very good grade, </span>";
} elseif ($grade >= 85) {
    echo "<span style='color:blue;'>Good grade, </span>";
} elseif ($grade >= 75) {
    echo "<span style='color:orange;'>Need some improvements, </span>";
} else {
    echo "<span style='color:red;'>You failed in the class, </span>";
}

if ($remark == "A" || $remark == "a") {
    echo "<span style='color:darkgreen;'>Outstanding Performance!</span>";
} elseif ($remark == "B" || $remark == "b") {
    echo "<span style='color:blue;'>Great job today!</span>";
} elseif ($remark == "C" || $remark == "c") {
    echo "<span style='color:purple;'>Good effort, keep it up!</span>";
} elseif ($remark == "D" || $remark == "d") {
    echo "<span style='color:orange;'>Work harder next time!</span>";
} elseif ($remark == "F" || $remark == "f") {
    echo "<span style='color:orange;'>You Need to Improve!</span>";
} else {
    echo "<span style='color:red;'>Invalid remark</span>";
}

echo "<br>";
echo "<hr style='border:1px solid black;'>";

echo "</div>";
?>
