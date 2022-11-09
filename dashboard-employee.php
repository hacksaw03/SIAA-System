<?php 
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="dashboard-employee.css">
    <link rel="icon" href="images/Rectangle 31.png">
    <title>Dashboard</title>
</head>
<body>
    <nav>
        <img src="images/Rectangle 31.png" alt="Company Icon" id="company-icon">
        <ul>
            <li class="active">
                <a href="dashboard-employee.php" ><img src="images/dashboard-icon.png" alt="dashboard icon" id="dashboard-icon">
                <label for="dashboard-icon" id="dashboard-label">Dashboard</label></a>
            </li>
            <li>
                <a href="inventory-employee.php">
                    <img src="images/inventory-icon.png" alt="Inventory Icon" id="inventory-icon">
                    <label for="inventory-icon" id="inventory-label">Inventory</label>
                </a>
            </li>
            <li>
                <a href="orders-employee.php">
                    <img src="images/orders-icon.png" alt="Orders Icon" id="orders-icon">
                    <img src="images/orders-icon-check.png" alt="" id="orders-icon-check">
                    <label for="orders-icon" id="orders-label">Orders</label>
                </a>
            </li>
            <li>
                <a href="schedule-employee.php">
                    <img src="images/schedule-icon.png" alt="" id="schedule-icon">
                    <img src="images/schedule-icon-top.png" alt="" id="schedule-icon-top">
                    <label for="schedule-icon.png" id="schedule-label">Schedule</label>
                </a>
            </li>
            <li>
                <a href="delivery-employee.php">
                    <img src="images/delivery-icon.png" alt="Delivery Icon" id="delivery-icon">
                    <label for="delivery-icon" id="delivery-label">Delivery</label>
                </a>
            </li>
        </ul>
    </nav>
    <section class="top-bar">
        <h4 id="employee-title">EMPLOYEE</h4>
        <div class="vertical-line"></div>
        <div class="employee_name"><?php echo $_SESSION['username'];?></div>
        <button class="logout-button" onclick="logout()">LOG-OUT</button>
    </section>
    <main>
        <?php 
            include 'dbconnect.php';
            if ($conn -> connect_error){
                echo "<script>alert('Not Connected to Database')</script>";
            }
            $sql = "SELECT * FROM products";
            $result = $conn -> query($sql);
        ?>
        <h2 id="dashboard-title">Dashboard</h2>
        <hr>
        <div class="contents">
            <div class="inventory">
                <h5>Inventory</h5>
                <p><?php echo $result -> num_rows; ?> records</p>
                <hr>
                <a href="inventory-employee.php">View Details</a>
            </div>
            <div class="orders">
                <h5>Orders</h5>
                <p>0 records</p>
                <hr>
                <a href="orders-employee.php">View Details</a>
            </div>
            <div class="schedule">
                <h5>Schedule</h5>
                <p>0 records</p>
                <hr>
                <a href="schedule-employee.php">View Details</a>
            </div>
            <div class="delivery">
                <h5>Delivery</h5>
                <p>0 records</p>
                <hr>
                <a href="delivery-employee.php">View Details</a>
            </div>
        </div>
    </main>
    <footer>
        <p>©Tri-Color Mineral Drinking Water Refilling Station</p>
    </footer>
    <script>
        function logout(){
            if (confirm("Are you sure?") == true){
                location.href = "signin.php";
            }
        }
    </script>
</body>
</html>