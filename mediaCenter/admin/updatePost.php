<?php

session_start();

if(!isset($_SESSION['username']))
{
  header("location:index.php");
}

?>
<!DOCTYPE html>
<html lang="en">
<link rel="icon" type="image/jpeg" href="../images/new.jpg">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

<body>
<?php include("sidebar.php"); ?>
    <div class="content">
        <h1>Update Post</h1>
<div class="container mt-4">
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header bg-warning">
          <h4> EDIT POST</h4>

        </div>
        <div class="card-body">

        <?php
        $conn = mysqli_connect("localhost","root","","blog");

        $id = $_GET['id'];
        $query = "SELECT* FROM posts WHERE id='$id'";
        $query_run =mysqli_query($conn,$query);
        if(mysqli_num_rows($query_run)>0)
        {
          foreach($query_run as $row)
          {
            ?>
           <form action="update_post.php?id=<?php echo $id; ?>" method="POST" enctype="multipart/form-data">

    <div class="form-group">
        <label for="">Title</label>
        <input type="text" name="blog_title" value="<?php echo $row ['title'];?>" class="form-control" placeholder="Blog Title Here">
    </div>
    <div class="form-group">
        <label for="">Content</label>
        <textarea name="blog_content" required class="form-control" placeholder="Blog Content Here" rows="8"><?php echo $row ['content'];?></textarea>
    </div>
    <div class="form-group">
        <label for="">Image</label>
        <input type="file" name="blog_image" class="form-control" placeholder="Blog Image Here">
        <input type="hidden" name="id" value="<?php echo $row['id'];?>">
        <input type="hidden" name="old_image" value="<?php echo $row['image'];?>">
    </div>
    <div class="form-group">
        <label for="">Date</label>
        <input type="date" name="blog_date" value="<?php echo $row['date'];?>" class="form-control">
    </div>
    <div class="form-group">
        <button type="submit" name="update_blog" class="btn btn-primary"> Update</button>
    </div>
</form>

            <?php
          }
        }else{
          echo "No record Available";
        }

        ?>
          
        </div>

      </div>
    </div>
  </div>
</div>
        
        
    </div>
</body>
</html>