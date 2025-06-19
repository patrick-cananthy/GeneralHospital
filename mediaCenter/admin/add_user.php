<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("location: index.php");
    exit();
} elseif ($_SESSION['usertype'] == 'user') {
    header("location: index.php");
    exit();
}

if (isset($_POST['add_user'])) {
    $conn = mysqli_connect("localhost", "root", "", "blog");

    if (!$conn) {
        echo "Database connection failed.";
        exit();
    }

    $username = $_POST['username'];
    $password = $_POST['password'];
    $usertype = $_POST['usertype'];

    // Check if username already exists
    $check_query = "SELECT * FROM users WHERE username='$username'";
    $check_result = mysqli_query($conn, $check_query);

    if (mysqli_num_rows($check_result) > 0) {
        echo '<script>alert("Username already exists. Please choose a different username.");</script>';
    } else {
        // Insert user into database
        $password_hash =$password;
        $insert_query = "INSERT INTO users (username, password, usertype) VALUES ('$username', '$password_hash', '$usertype')";
        $insert_result = mysqli_query($conn, $insert_query);

        if ($insert_result) {
            echo '<script>alert("User added successfully.");</script>';
            header("refresh:0.1;url=viewUser.php");
            exit();
        } else {
            echo '<script>alert("Error adding user: ' . mysqli_error($conn) . '");</script>';
        }
    }

    mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add User</title>
    <link rel="icon" type="image/jpeg" href="../images/new.jpg">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <?php include("sidebar.php"); ?>

    <div class="content">
        <h1>Add User</h1>
        <div class="container mt-4">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header bg-warning">
                            <h4>Add New User</h4>
                        </div>
                        <div class="card-body">
                            <form action="" method="POST">
                                <div class="form-group">
                                    <label for="">Username</label>
                                    <input type="text" name="username" class="form-control" placeholder="Username" required>
                                </div>
                                <div class="form-group">
                                    <label for="">Password</label>
                                    <input type="password" name="password" class="form-control" placeholder="Password" required>
                                </div>
                                <div class="form-group">
                                    <label for="">User Type</label>
                                    <select name="usertype" class="form-control" required>
                                        <option value="">Select User Type</option>
                                        <option value="user">User</option>
                                        <option value="admin">Admin</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <button type="submit" name="add_user" class="btn btn-primary">Add User</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
