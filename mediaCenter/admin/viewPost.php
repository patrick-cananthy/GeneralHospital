<?php
session_start();

if(!isset($_SESSION['username'])) {
  header("location:index.php");
  exit();
} 

$host = "localhost";
$user = "root";
$password = "";
$db = "blog";

$data = mysqli_connect($host, $user, $password, $db);

if(isset($_GET['id']) && !empty($_GET['id'])) {
  $id = $_GET['id'];
  
  $sql = "DELETE FROM posts WHERE id = '$id'";
  
  if(mysqli_query($data, $sql)) {
    echo '<script>alert("Post deleted successfully");</script>';
    header("refresh:0.1;url=viewPost.php");
    exit();
  } else {
    echo '<script>alert("Error deleting post: ' . mysqli_error($data) . '");</script>';
  }
}

$sql = "SELECT * from posts";
$result = mysqli_query($data, $sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>View Post</title>
  <link rel="icon" type="image/jpeg" href="../images/new.jpg">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    function confirmDelete() {
      return confirm("Are you sure you want to delete this post?");
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
    <h1>View Post</h1>
    <br><br>
    <table class="table table-bordered">
      <thead>
      <tr>
        <th>ID</th>
        <th>TITLE</th>
        <th>CONTENT</th>
        <th>IMAGE</th>
        <th>DATE</th>
        <th>EDIT</th>
        <th>DELETE</th>
      </tr>
      </thead>
      <tbody>
      <?php while($info = $result->fetch_assoc()) { ?>
        <tr>
          <td><?php echo $info['id']; ?></td>
          <td><?php echo $info['title']; ?></td>
          <td><?php echo $info['content']; ?></td>
          <td><img src="imagess/<?php echo $info['image']; ?>" width="100px" alt="image"></td>
          <td><?php echo $info['date']; ?></td>
          <td><a href="updatePost.php?id=<?php echo $info['id']; ?>" class="btn btn-info">EDIT</a></td>
          <td><a href="viewPost.php?id=<?php echo $info['id']; ?>" class="btn btn-danger" onclick="return confirmDelete();">DELETE</a></td>
        </tr>
      <?php } ?>
      </tbody>
    </table>
  </center>
</div>
</body>
</html>
