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
    <link rel="stylesheet" href="orders-employee.css">
    <title>Orders</title>
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
            <li class="active">
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
        <h2 id="orders-title">Orders</h2>
        <hr>
        <table id="items-table">
                <th>Order Number</th>
                <th>Customer Name</th>
                <th>Product Name</th>
                <th>Category</th>
                <th>Quantity</th>
                <th>Price per Item</th>
                <th>Total Price</th>
                <th>Status</th>
                <th colspan=2>Action</th>
                <?php 
                    include 'dbconnect.php';
                    if ($conn -> connect_error){
                        echo "<script>alert('Not Connected to Database')</script>";
                    }
                    $sql = "SELECT * FROM orders";
                    $result = $conn -> query($sql);
                    if (($result -> num_rows) > 0){
                        while ($row = $result -> fetch_assoc()){
                            echo "<tr>";
                            echo "<td>", $row['order_number'];
                            echo "<td>", $row['customer_name'];
                            echo "<td>", $row['product_name'];
                            echo "<td>", $row['category'];
                            echo "<td>", $row['quantity'];
                            echo "<td>", $row['price_per_item'];
                            echo "<td>", $row['total_price'];
                            echo "<td>", $row['status']; 
                        }
                    }
                ?>
            <tr>
        </table>
    </main>
        <footer>
            <p>©Tri-Color Mineral Drinking Water Refilling Station</p>
        </footer>
    <script>
        const modal = document.querySelector('#modal');
        const openModal = document.querySelector('#add-item');
        const closeModal = document.querySelector('#close-button');
            modal.close();
            openModal.addEventListener('click', () => {
                modal.showModal();
            })
            closeModal.addEventListener('click', () => {
                modal.close();
            })
        const modal2 = document.querySelector('#modal-update');
        const table_id = document.getElementById('items-table');
        const openModal2 = document.querySelectorAll('#update-item');
        const closeModal2 = document.querySelector('#close-button-update');
            /*openModal2.addEventListener('click', () => {
                modal2.showModal();
                num++;
            })*/
            openModal2.forEach((e) => {
                e.addEventListener('click', () => {
                    modal2.showModal();
                })
            })
            closeModal2.addEventListener('click', () => {
                modal2.close();
            })
    </script>
</body>
</html>