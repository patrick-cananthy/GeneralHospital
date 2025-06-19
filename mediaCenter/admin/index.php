<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Media Center</title>
    <link rel="icon" type="image/jpeg" href="../images/new.jpg">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <style>
        .form_deg{
            padding-top:200px;
        }

        .label_deg{
            display: inline-block;
            color: black;
            width: 100px;
            text-align: right;
            padding-top: 10px;
            padding-bottom:10px ;

        }

        .login_form{
            background-color: grey;
            width: 400px;
            padding-top: 70px;
            padding-bottom: 70px;
        }

        .title_deg{
            background-color:skyblue ;
            color: white;
            text-align: center;
            font-weight: bold;
            width: 400px;
            padding-top: 10px;
            padding-bottom:10px;
            font-size: 20px;
        }

        .body_deg{
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-size: cover;
        }
    </style>
</head>
<body class="body_deg "background="../images/shea1.jpg">
    
    <center>
        <div class="form_deg">
            <center class="title_deg">Login Form
                <h2>
                    <?php 
                     session_start();
                     error_reporting(0);
                     echo $_SESSION['loginMessage']; ?>
                </h2>
            </center>
            <form action="login_check.php" method="POST" class="login_form">
                <div>
                    <label class="label_deg" for="">Username</label>
                    <input type="text" name="username">
                </div>
                <div>
                    <label class="label_deg" for="">Password</label>
                    <input type="Password" name="password">
                </div>
                <div>
                    <input class="btn btn-primary" type="submit" name="submit" value="Login">
                </div>

            </form>
        </div>
    </center>
    
</body>
</html>