<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="icon" type="image/jpeg" href="../images/new.jpg">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <style>
        * {
            margin: 0px;
            padding: 0px;
        }
        .header {
            background-color: skyblue;
            line-height: 70px;
            padding-left: 30px;
            position: fixed;
            width: 100%;
            z-index: 1000;
        }
        a,a:hover {
            text-decoration: none!important;
        }
        .logout {
            float: right;
            padding-right: 30px;
        }
        ul {
            background-color: #424a5b;
            width: 200px;
            position: fixed;
            padding-top: 70px; /* Adjusted padding */
            text-align: center;
            height: 100%; /* Height of the viewport */
            overflow-y: auto; /* Enable vertical scrollbar */
        }
        ul li {
            list-style: none;
            padding-bottom: 10px; /* Adjusted padding */
            font-size: 15px;
        }
        ul li s {
            color: white;
            font-size: bold;
        }
        ul li a:hover {
            color: skyblue;
            text-decoration: none;
        }
        .content {
            margin-left: 200px; /* Adjusted margin */
            padding-top: 70px; /* Height of the header */
        }
    </style>
</head>
<body>
    <header class="header">
        <?php
        if ($_SESSION['usertype'] == 'admin') {
            echo '<a href="adminUser.php">Welcome back Admin</a>';
        } else {
            echo '<a href="user.php">Welcome back ' . $_SESSION['username'] . '</a>';
        }
        ?>
        <div class="logout">
            <a class="btn btn-primary" href="logout.php">Logout</a>
        </div>
    </header>
    <aside>
        <ul>
            <?php
            if ($_SESSION['usertype'] == 'admin') {
                echo '<li><a href="add_user.php">Add User</a></li>';
                echo '<li><a href="viewUser.php">View Users</a></li>';
            }
            ?>
            <hr>
            <li><a href="addPost.php">Add Post</a></li> <!-- Fixed missing text -->
            <li><a href="viewPost.php">View Post</a></li>
        </ul>
    </aside>
</body>
</html>
