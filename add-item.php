<?php 
    session_start();
    $conn = new mysqli('localhost', 'root', '', 'db_siaa_system');
    if ($conn -> connect_error){
        echo "<script>alert('Not Connected to database')</script>";
    }
    $username = $_SESSION['username'];
    if (isset($_POST['submit'])){
        $stock_code = $_POST['stock-code-input'];
        $prod_name = $_POST['name-input'];
        $prod_category = $_POST['product-cat-input'];
        $distributed_gallons = $_POST['distributed-gallons-input'];
        $remaining_gallons = $_POST['remaining-gallons-input'];
        $date = $_POST['date-input'];
        $sql = "INSERT INTO `products`(`stockCode`, `prodName`, `prodCategory`, `distributedGallons`, `remainingGallons`, `date`) VALUES ('$stock_code','$prod_name','$prod_category','$distributed_gallons','$remaining_gallons','$date')";
        $insert = $conn -> query($sql);
        if ($insert == true){
            echo "<script>alert('Successfully Added Product')</script>";
        }
        else {
            echo "<script>alert('Unsuccessfully signed up')</script>";
        }
    }
?>