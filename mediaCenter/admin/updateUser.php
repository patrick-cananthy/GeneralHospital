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

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "SELECT * FROM users WHERE id='$id'";
    $result = mysqli_query($conn, $query);
    if ($result) {
        $user = mysqli_fetch_assoc($result);
    } else {
        echo "User not found.";
        exit();
    }
} else {
    echo "User ID not provided.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update User</title>
    <link rel="icon" type="image/jpeg" href="../images/new.jpg">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
<?php include("sidebar.php"); ?>
<br>

<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-warning">
                    <br>
                    <br>
                    <h4>Edit User</h4>
                </div>
                <div class="card-body">
                    <form action="update_user.php" method="POST">
                        <input type="hidden" name="id" value="<?php echo $user['id']; ?>">
                        <div class="form-group mb-3">
                            <label for="username">Username</label>
                            <input type="text" name="username" class="form-control" value="<?php echo $user['username']; ?>" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="password">Password</label>
                            <input type="password" name="password" class="form-control" value="<?php echo $user['password']; ?>" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="usertype">User Type</label>
                            <select name="usertype" class="form-control" required>
                                <option value="user" <?php if ($user['usertype'] == 'user') echo 'selected'; ?>>User</option>
                                <option value="admin" <?php if ($user['usertype'] == 'admin') echo 'selected'; ?>>Admin</option>
                            </select>
                        </div>
                        <button type="submit" name="update_user" class="btn btn-primary">Update User</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
