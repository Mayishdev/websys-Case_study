<?php
session_start();
include '../db.php';
if ($_SESSION['role'] != 'admin') header("Location: ../login.php");

$id = $_GET['id'];
mysqli_query($conn, "DELETE FROM subjects WHERE id=$id");
header("Location: list_subjects.php");
