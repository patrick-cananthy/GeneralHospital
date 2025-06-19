<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (!isset($_SESSION['username'])) {
    header("location: index.php");
    exit();
}

if (isset($_POST['add_post'])) {
    $conn = mysqli_connect("localhost", "root", "", "blog");

    if (!$conn) {
        echo "Database connection failed.";
        exit();
    }

    $title = $_POST['blog_title'];
    $content = $_POST['blog_content'];
    $date = $_POST['blog_date'];
    $username = $_SESSION['username'];

    // Check if a new image has been uploaded
    if ($_FILES['blog_image']['name'] != "") {
        $image = $_FILES['blog_image']['name'];
        $temp_image = $_FILES['blog_image']['tmp_name'];
        $image_type = $_FILES['blog_image']['type'];

        // Check file type
        if (($image_type == "image/jpeg") || ($image_type == "image/jpg") || ($image_type == "image/png")) {
            // Upload image
            $image_name = time() . "-" . $image;
            move_uploaded_file($temp_image, "imagess/" . $image_name);

            // Insert post into database
            $query = "INSERT INTO posts (title, content, image, date, username) VALUES ('$title', '$content', '$image_name', '$date', '$username')";
            $query_run = mysqli_query($conn, $query);

            if ($query_run) {
                echo '<script>alert("Post added successfully.");</script>';
                header("refresh:0.1;url=viewPost.php");
                exit();
            } else {
                echo '<script>alert("Error adding post: ' . mysqli_error($conn) . '");</script>';
            }
        } else {
            echo "Only jpg, jpeg, and png files are allowed.";
        }
    } else {
        echo "Please select an image.";
    }

    mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Post</title>
    <link rel="icon" type="image/jpeg" href="../images/new.jpg">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <?php include("sidebar.php"); ?>

    <div class="content">
        <h1>Add Post</h1>
        <div class="container mt-4">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header bg-warning">
                            <h4>Add New Post</h4>
                        </div>
                        <div class="card-body">
                            <form action="" method="POST" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label for="">Title</label>
                                    <input type="text" name="blog_title" class="form-control" placeholder="Blog Title Here" required>
                                </div>
                                <div class="form-group">
                                    <label for="">Content</label>
                                    <textarea name="blog_content" class="form-control" placeholder="Blog Content Here" rows="8" required></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="">Image</label>
                                    <input type="file" name="blog_image" class="form-control" placeholder="Blog Image Here" required>
                                </div>
                                <div class="form-group">
                                    <label for="">Date</label>
                                    <input type="date" name="blog_date" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <button type="submit" name="add_post" class="btn btn-primary">Add Post</button>
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
