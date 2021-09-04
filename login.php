<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="css/login.css">
</head>
<body>
    <?php
          Session_start();

      // كود الاتصال بقاعدة البيانات
      $host='localhost';
      $user='root';
      $pass='';
      $db='studentnative';
      $con=mysqli_connect($host,$user,$pass,$db);
      
    //define varaibles for pass data
    $username='';
    $password='';
    if(isset($_POST['UserName'])){
        $username=$_POST['UserName'];
        // echo $username;
    }

    if(isset($_POST['Password'])){
        $password=$_POST['Password'];
        // echo $password;
    }

   if(isset($_POST['LoginButton'])){
    // echo $password;
    $sql="select * from users where username='$username' and password='$password'";
    $res=mysqli_query($con,$sql);
    if(!$row=mysqli_fetch_assoc($res))
    {
        echo 'invalide username or password';

    }
    else{
        $_SESSION['userdata']=$row['username']; 
        header("location:home.php");
        }
    }
     ?>
    <div class="Loginbox">
        <img src="images/login.jpg" class="loginimg">
        <h1>Login</h1>
        <form  method="post">
            <p>UserName</p>
            <input type="text" name="UserName" placeholder="Enter UserName" required>
            <p>Password</p>
            <input type="text" name="Password" placeholder="Enter Password" required>
            <input type="submit" name="LoginButton" value="Login">
        </form>
    </div>
</body>
</html>