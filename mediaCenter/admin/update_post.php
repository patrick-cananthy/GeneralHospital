<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("location: index.php");
    exit();
}

if (isset($_POST['update_blog'])) {
    $conn = mysqli_connect("localhost", "root", "", "blog");

    if (!$conn) {
        echo "Database connection failed.";
        exit();
    }

    $id = $_POST['id'];
    $title = $_POST['blog_title'];
    $content = $_POST['blog_content'];
    $date = $_POST['blog_date'];
    $old_image = $_POST['old_image'];

    // Check if a new image has been uploaded
    if ($_FILES['blog_image']['name'] != "") {
        $new_image = $_FILES['blog_image']['name'];
        $temp_image = $_FILES['blog_image']['tmp_name'];
        $image_type = $_FILES['blog_image']['type'];

        // Check file type
        if (($image_type == "image/jpeg") || ($image_type == "image/jpg") || ($image_type == "image/png")) {
            // Delete old image
            unlink("imagess/" . $old_image);

            // Upload new image
            $new_image_name = time() . "-" . $new_image;
            move_uploaded_file($temp_image, "imagess/" . $new_image_name);

            // Update post with new image
            $query = "UPDATE posts SET title='$title', content='$content', image='$new_image_name', date='$date' WHERE id='$id'";
        } else {
            echo "Only jpg, jpeg, and png files are allowed.";
            exit();
        }
    } else {
        // Update post without changing the image
        $query = "UPDATE posts SET title='$title', content='$content', date='$date' WHERE id='$id'";
    }

    $query_run = mysqli_query($conn, $query);

    if ($query_run) {
        echo '<script>alert("Post updated successfully."); window.location.href = "viewPost.php";</script>';
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }

    mysqli_close($conn);
} else {
    header("location: index.php");
    exit();
}
?>
