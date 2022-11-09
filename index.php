<?php 
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign-In</title>
    <link rel="stylesheet" href="signin.css">
    <link rel="icon" href="images/Rectangle 31.png">
</head>
<body>
    <div class="bg">
        <img src="images/Rectangle 31.png" alt="Tri-Color Logo" id="logo"> 
        <p id="copyright">©Tri-Color 2004</p>
    </div>
    <div class="details">
        <div class="details-container">
            <h3>Welcome</h3>
            <p id="text-1">Please enter your details.</p>
            <form action="signin.php" method="post">
                <p id="username-input-label">Username</p>
                <input type="text" name="username-input" id="username-input" placeholder="Enter your username"> 
                <p id="password-input-label">Password</p>
                <input type="password" name="password-input" id="password-input" placeholder="Enter your password">
                <br><input type="submit" name="submit" value="LOGIN">
                <p id="signup-prompt">Don't have an account? <a href="signup.php">Sign-up</a></p>
            </form>
        </div>
    </div>
</body>
</html>
<?php 
include 'dbconnect.php';
if ($conn -> connect_error){
    echo "<script>alert('Not Connected to Database')</script>";
}

if (isset($_POST['submit'])){
    $username = $_POST['username-input'];
    $password = $_POST['password-input'];
    $sql = "SELECT * FROM signup WHERE username = '$username' AND password = '$password'";
    $result = $conn -> query($sql); 
    if (($result -> num_rows) > 0){
            $row = $result -> fetch_assoc();
            $pos = $row['role'];
            if ($pos == 'Admin-tricolor'){
                echo "<script>alert('Welcome Admin!')</script>";
                header("refresh:0; url=dashboard-admin.php");
                $_SESSION["username"] = $username;
            }
            else if ($pos == 'Owner-tricolor'){
                echo "<script>alert('Welcome Owner!')</script>";
                header("refresh:0; url=dashboard-admin.php");
                $_SESSION["username"] = $username;
            }
            else if ($pos == 'Employee-tricolor'){
                echo "<script>alert('Welcome Employee!')</script>";
                header("refresh:0; url=dashboard-employee.php");
                $_SESSION["username"] = $username;
            }
            else {
                echo "<script>alert('Welcome Customer!')</script>";
                header("refresh:0; url=landing-page.php");
                $_SESSION["username"] = $username;
            }
            $logs = "INSERT INTO user_logs (username, action, date) VALUES ('$username', 'Sign-In', now())";
            $result1 = $conn -> query($logs);
    }
    else {
        echo "<script>alert('Incorrect Username or Password')</script>";
    }
}

?>
