<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="signup.css">
    <link rel="icon" href="images/Rectangle 31.png">
    <title>Sign-up</title>
</head>
<body>
    <div class="rectangle2">
        <img src="images/Rectangle 31.png" alt="" id="rectangle31">
        <div class="copyright">©Tri-Color2004</div>
    </div>
    
    
    <div class="rectangle3">
        <h1 id="signup">Sign-up</h1>
        <form action="signup.php" method="POST">
        <div class="details">
            <div class="first-name">
                <h3 id="first-name-text">First Name</h3>
                <input type="text" name="first-name-input" id="first-name-input" placeholder="Enter First Name">
            </div>
            &nbsp;&nbsp;&nbsp;&nbsp;<div class="last-name">
                <h3 id="last-name-text">Last Name</h3>
                <input type="text" name="last-name-input" id="last-name-input" placeholder="Enter Last Name">
            </div>
            <div class="phone-number">
                <h3 id="phone-number-text">Phone Number *</h3>
                <input type="text" name="phone-number-input" id="phone-number-input" placeholder="+639********" required>
            </div>
            &nbsp;&nbsp;&nbsp;<div class="radio-buttons">
                <input type="radio" name="establishment-radio" id="radio-residences" value="Residences" onclick="func()">
                    <label for="radio-residences" id="label-radio-residences">Residences</label>
                <br>
                <input type="radio" name="establishment-radio" id="radio-mall" value="Mall" onclick="func()">
                    <label for="radio-mall" id="label-radio-mall">Mall</label>
            </div>
            <div class="company-name">
                <h3 id="company-name-text">Company Name</h3>
                <input type="text" name="company-name-input" id="company-name-input" placeholder="Enter Company Name">
            </div>
            <div class="address">
                <h3 id="address-text">Address</h3>
                <input type="text" name="address-input" id="address-input" placeholder="Enter Address">
            </div>
            <div class="shipping-address">
                <h3 id="shipping-address-text">Delivery Address</h3>
                <input type="text" name="shipping-address-input" id="shipping-address-input" placeholder="Enter Shipping Address">
            </div>
            <div class="username">
                <h3 id="username-text">Username</h3>
                <input type="text" name="username-input" id="username-input" placeholder="Enter Username">
            </div>
            <div class="password">
                <h3 id="password-text">Password</h3>
                <input type="password" name="password-input" id="password-input" placeholder="Enter Password">
            </div>
            <div class="confirm-password">
                <h3 id="confirm-password-text">Confirm Password</h3>
                <input type="password" name="confirm-password-input" id="confirm-password-input" placeholder="Confirm Password">
            </div>
            <input type="submit" name="submit" id="submit" value="SIGN-UP">
        </div>
        </form>
    </div>
    <script>
        var x = document.getElementById("radio-mall"); 
        var y = document.getElementById("radio-residences"); 
        var inp = document.getElementById("company-name-input"); 
        var text = document.getElementById("company-name-text"); 

        inp.style.display = "none";
        text.style.display = "none";

        function func(){
               
            if (x.checked == true){
                inp.style.display = "block";
                text.style.display = "block";
            }      
            
            if (y.checked == true){
                inp.style.display = "none";
                text.style.display = "none";
                inp.value = "";
            }
        }
    </script>
</body>
</html>
<?php 
include 'dbconnect.php';
if ($conn -> connect_error){
    echo "<script>";
	echo "alert('Not Connected')";
	echo "</script>";
}
if (isset($_POST['submit'])){
    $first_name = $_POST['first-name-input'];
    $last_name = $_POST['last-name-input'];
    $phone_number = $_POST['phone-number-input'];
    $establishment = $_POST['establishment-radio'];
    $company_name = $_POST['company-name-input'];
    $address = $_POST['address-input'];
    $shipping_address = $_POST['shipping-address-input'];
    $username = $_POST['username-input'];
    $password = $_POST['password-input'];
    $confirm_password = $_POST['confirm-password-input'];
    $sql = "INSERT INTO signup (f_name, l_name, phone_number, role, establishment, address, company_name, ship_address, username, password) VALUES ('$first_name', '$last_name', '$phone_number', 'Customer', '$establishment', '$address', '$company_name', '$shipping_address', '$username', '$password')"; 
    $logs = "INSERT INTO user_logs (username, action, date) VALUES ('$username', 'Signed-Up', now())";
    $insert = $conn -> query($sql);
    $insert1 = $conn -> query($logs);
    if ($insert == true){
        echo "<script>alert('Signed Up Successfully')</script>";
    }
    else {
        echo "<script>alert('Unsuccessfully signed up')</script>";
    }

    if ($password != $confirm_password){
        echo "<script>alert('Password and Confirm Password are not the same')</script>";
    }
}

?>