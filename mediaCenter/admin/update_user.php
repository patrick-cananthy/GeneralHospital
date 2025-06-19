<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("location: index.php");
    exit();
}

$conn = mysqli_connect("localhost", "root", "", "blog");

if (!$conn) {
    echo "Database connection failed.";
    exit();
}

if (isset($_POST['update_user'])) {
    $id = $_POST['id'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $usertype = $_POST['usertype'];

    $query = "UPDATE users SET username='$username', password='$password', usertype='$usertype' WHERE id='$id'";
    if (mysqli_query($conn, $query)) {
        // Redirect back to view users page with success message
        $_SESSION['success_message'] = "User updated successfully.";
        header("location: viewUser.php");
        exit();
    } else {
        echo "Error updating user: " . mysqli_error($conn);
    }
} else {
    echo "Form not submitted correctly.";
}
?>
