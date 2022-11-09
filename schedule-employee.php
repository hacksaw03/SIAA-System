<?php 
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="images/Rectangle 31.png">
    <link rel="stylesheet" href="schedule-employee.css">
    <title>Schedule</title>
    <script>
        function logout(){
            if (confirm("Are you sure?") == true){
                location.href = "signin.php";
            }
        }        
    </script>
</head>
<body>
    <nav>
        <img src="images/Rectangle 31.png" alt="Company Icon" id="company-icon">
        <ul>
            <li>
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
            <li class="active">
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
        <h2 id="schedule-title">Schedule</h2>
        <hr>
        <table id="items-table">
            <th>Delivery Date</th>
            <th>Start Time</th>
            <th>End Time</th>
            <th>Delivery Address</th>
            <th>Status</th>
            <th colspan=2>Action</th>
            <?php 
                include 'dbconnect.php';
                if ($conn -> connect_error){
                    echo "<script>alert('Not Connected')</script>";
                }
                $sql = "SELECT * FROM schedule";
                $result = $conn -> query($sql);
                if (($result -> num_rows) > 0){
                    while ($row = $result -> fetch_assoc()){
                        echo "<tr>";
                        echo "<td>", $row['delivery_date'];
                        echo "<td>", $row['start_time'];
                        echo "<td>", $row['end_time'];
                        echo "<td>", $row['delivery_address'];
                        echo "<td>", $row['status'];                      
                    }
                }
            ?>  
        </table>
    </main>
    <footer>
        <p>©Tri-Color Mineral Drinking Water Refilling Station</p>
    </footer>
    
</body>
</html>