<?php

session_start();

$mysqli = new mysqli('localhost', 'root', '', 'crud') or die(mysqli_error($mysqli));

$id = 0;
$name = '';
$location = '';
$update = false;

// Create 
if (isset($_POST['save'])) {
    $name = $_POST['name'];
    $location = $_POST['location'];


    $mysqli->query("INSERT INTO data (name, location) VALUES ('$name', '$location') ") or
        die($mysqli->error);

    $_SESSION['message'] = "Data has been added!";
    $_SESSION['msg_type'] = "success";

    header("location: index.php");
}

// Delete
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $mysqli->query("DELETE FROM data WHERE id=$id") or die(mysqli_error($mysqli));

    $_SESSION['message'] = "Record has been deleted!";
    $_SESSION['msg_type'] = "danger";

    header("location: index.php");
}


// Edit
if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $update = true;
    $result = $mysqli->query("SELECT * FROM data WHERE id=$id") or die(mysqli_error($mysqli));

    if ($result->num_rows) {
        $row = $result->fetch_array();
        $name = $row['name'];
        $location = $row['location'];
    }
}

if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $location = $_POST['location'];

    $mysqli->query("UPDATE data SET name='$name', location='$location' WHERE id=$id") or die(mysqli_error($mysqli));

    $_SESSION['message'] = "Record has been updated!";
    $_SESSION['msg_type'] = "warning";

    header("location: index.php");
}
