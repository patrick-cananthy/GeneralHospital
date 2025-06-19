<?php 

error_reporting(0);
session_start();
$host ="localhost";
$user="root";
$password="";
$db="blog";

$data=mysqli_connect($host,$user,$password,$db);

if($data===false)
{
    die("connection error");
}

if($_SERVER["REQUEST_METHOD"]=="POST")
{
    $name = $_POST['username'];
    $password = $_POST['password'];

    $sql = "select * from users where username = '".$name."' AND password='".$password."' ";

    $result=mysqli_query($data,$sql);
    $row=mysqli_fetch_array($result);

    if($row["usertype"]=="admin"){
        $_SESSION['username']=$name;
        $_SESSION['usertype']="admin";
        header("location:adminUser.php");
    }
    elseif($row["usertype"]=="user"){
        $_SESSION['username']=$name;
        $_SESSION['usertype']="user";
        header("location:user.php");
    }
    else{
       
        $message ="username or password do not match";
        $_SESSION['loginMessage']=$message;
        header("location:index.php");
    }
}
?>