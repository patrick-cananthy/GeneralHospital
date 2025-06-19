<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("location: index.php");
    exit();
} elseif ($_SESSION['usertype'] == 'user') {
    header("location: index.php");
    exit();
}

$host = "localhost";
$user = "root";
$password = "";
$db = "blog";

$data = mysqli_connect($host, $user, $password, $db);

if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "DELETE FROM users WHERE id = '$id'";

    if (mysqli_query($data, $sql)) {
        echo '<script>alert("User deleted successfully");</script>';
        header("refresh:0.1;url=viewUser.php");
        exit();
    } else {
        echo '<script>alert("Error deleting user: ' . mysqli_error($data) . '");</script>';
    }
}

$sql = "SELECT * FROM users";
$result = mysqli_query($data, $sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Users</title>
    <link rel="icon" type="image/jpeg" href="../images/new.jpg">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function confirmDelete() {
            return confirm("Are you sure you want to delete this user?");
        }
    </script>
    <style>
        .content {
            font-family: Arial, Helvetica, sans-serif;
            border-collapse: collapse;
        }

        .content td, .content th {
            border: 1px solid #ddd;
            padding: 8px;
        }

        .content tr:nth-child(even){background-color: #f2f2f2;}

        .content tr:hover {background-color: #ddd;}

        .content th {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: left;
            background-color: #04AA6D;
            color: white;
        }
    </style>
</head>
<body>
<?php include("sidebar.php"); ?>

<div class="content">
    <center>
        <h1>View Users</h1>
        <br><br>
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>ID</th>
                <th>USERNAME</th>
                <th>PASSWORD</th>
                <th>USERTYPE</th>
                <th>ACTION</th>
            </tr>
            </thead>
            <tbody>
            <?php while ($info = $result->fetch_assoc()) { ?>
                <tr>
                    <td><?php echo $info['id']; ?></td>
                    <td><?php echo $info['username']; ?></td>
                    <td><?php echo $info['password']; ?></td>
                    <td><?php echo $info['usertype']; ?></td>
                    <td>
                        <a href="updateUser.php?id=<?php echo $info['id']; ?>" class="btn btn-info">EDIT</a>
                        <a href="viewUser.php?id=<?php echo $info['id']; ?>" class="btn btn-danger" onclick="return confirmDelete();">DELETE</a>
                    </td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </center>
</div>
</body>
</html>
