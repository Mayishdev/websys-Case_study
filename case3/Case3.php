<!DOCTYPE html>
<html>
<head>
    <title>Odd Numbers in Yellow</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 30px;
            background: #f5f5f5;
        }
        h1 {
            text-align: center;
        }
        form {
            text-align: center;
            margin-bottom: 20px;
        }
        table {
            margin: auto;
            border-collapse: collapse;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
            background: white;
        }
        td {
            width: 50px;
            height: 50px;
            text-align: center;
            border: 1px solid #ffffffff;
            font-size: 18px;
        }
        .odd {
            background: yellow;
            font-weight: bold;
        }
    </style>
</head>
<body>

<h1>All Odd Numbers Highlighted in Yellow</h1>

<form method="post">
    Rows:<input type="number" name="rows" required>
    Columns:<input type="number" name="cols" required>
    <button type="submit">Generate Number</button>
</form>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $rows = intval($_POST["rows"]);
    $cols = intval($_POST["cols"]);
    $num = 1;

    echo "<table>";
    for ($i = 1; $i <= $rows; $i++) {
        echo "<tr>";
        for ($j = 1; $j <= $cols; $j++) {
            if ($num % 2 != 0) {
                echo "<td class='odd'>$num</td>";
            } else {
                echo "<td>$num</td>";
            }
            $num++;
        }
        echo "</tr>";
    }
    echo "</table>";
}
?>

</body>
</html>
