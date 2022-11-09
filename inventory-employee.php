<?php 
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="inventory-employee.css">
    <link rel="icon" href="images/Rectangle 31.png">
    <title>Inventory</title>
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
            <li class="active">
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
        <h2 id="inventory-title">Inventory</h2>
        <hr>
        <table id="items-table">
            <th>Product ID</th>
            <th>Name</th>
            <th>Product Category</th>
            <th>Distributed Gallons</th>
            <th>Date</th>
            <th colspan=2>Action</th>  
            <?php 
                include 'dbconnect.php';
                if ($conn -> connect_error){
                    echo "<script>alert('Not Connected to database')</script>";
                }
                $username = $_SESSION['username'];
                if (isset($_POST['submit'])){
                    $stock_code = $_POST['stock-code-input'];
                    $prod_name = $_POST['name-input'];
                    $prod_category = $_POST['product-cat-input'];
                    $distributed_gallons = $_POST['distributed-gallons-input'];
                    $date = $_POST['date-input'];
                    $sql = "INSERT INTO `products`(`stockCode`, `prodName`, `prodCategory`, `distributedGallons`, `date`) VALUES ('$stock_code','$prod_name','$prod_category','$distributed_gallons','$date')";
                    $logs = "INSERT INTO user_logs (username, action, date) VALUES ('$username', 'Added Product', now())";
                    $insert = $conn -> query($sql);
                    if ($insert == true){
                        echo "<script>alert('Successfully Added Product')</script>";
                    }
                    else {
                        echo "<script>alert('Unsuccessfully signed up')</script>";
                    }
                }

                if ($conn -> connect_error){
                    echo "<script>alert('Not Connected')</script>";
                }
                $sql = "SELECT * FROM products";
                $result = $conn -> query($sql);
                $stock_codes = array();
                if (($result -> num_rows) > 0){
                    while ($row = $result -> fetch_assoc()){
                        echo "<tr>";
                        echo "<td>", $row['stockCode'];
                        echo "<td>", $row['prodName'];
                        echo "<td>", $row['prodCategory'];
                        echo "<td>", $row['distributedGallons'];
                        echo "<td>", $row['date'];
                        echo "<td><button type='button' id='update-item'>
                                UPDATE
                              </button>";
                        echo "<td><button type='button'>
                                ARCHIVE
                              </button>";
                        array_push($stock_codes, $row['stockCode']);
                    }
                }
            ?>      
        </table>
        <button type="button" id="add-item">
            <p>+ Add item</p>
        </button>
        <div class="add-item-popup">
            <dialog open class="modal" id="modal">
                <form action="inventory-employee.php" method="POST">
                    <table id="table-popup">
                        <th colspan=2><h3>ADD ITEM</h3></th>
                        <tr>
                            <td>PRODUCT ID</td>
                            <td>
                                <input type="text" name="stock-code-input" id="stock-code-input" required>
                            </td>
                        <tr>
                            <td>NAME</td>
                            <td>
                                <input type="text" name="name-input" id="name-input" required>
                            </td>
                        <tr>
                            <td>PRODUCT CATEGORY</td>
                            <td>
                                <input type="text" name="product-cat-input" id="product-cat-input" required>
                            </td>
                        <tr>
                            <td>DISTRIBUTED GALLONS</td>
                            <td>
                                <input type="number" name="distributed-gallons-input" id="distributed-gallons-input" min=1 required>
                            </td>
                        <tr>
                            <td>DATE</td>
                            <td>
                                <input type="date" name="date-input" id="date-input" required>
                            </td>
                        <tr>
                            <td colspan = 2>
                                <button type="submit" name="submit" id="submit">Add Item</button>
                                <button type="button" id="close-button">Cancel</button>
                            </td>
                    </table>
                </form>
            </dialog>
        </div>
        <div class="update-item-popup">
            <dialog class="modal-update" id="modal-update">
                <form action="inventory.php" method="POST">
                    <table id="table-popup">
                        <?php 
                            $sql = "SELECT * FROM products"; 
                            $result = $conn -> query($sql);
                            $row = $result -> fetch_assoc();
                                
                            $sql = "SELECT * FROM products WHERE stockCode = ". $row['stockCode'];
                            $result = $conn -> query($sql);
                            $row = $result -> fetch_assoc();
                        ?>
                        <th colspan=2><h3>UPDATE ITEM</h3></th>
                        <tr>
                            <td>STOCK CODE</td>
                            <td>
                                <input type="text" name="stock-code-input" id="stock-code-input" value="<?php echo $row['stockCode'];?>">
                            </td>
                        <tr>
                            <td>NAME</td>
                            <td>
                                <input type="text" name="name-input" id="name-input" value="<?php 
                                echo $row['prodName'];?>">
                            </td>
                        <tr>
                            <td>PRODUCT CATEGORY</td>
                            <td>
                                <input type="text" name="product-cat-input" id="product-cat-input" value="<?php echo $row['prodCategory'];?>">
                            </td>
                        <tr>
                            <td>DISTRIBUTED GALLONS</td>
                            <td>
                                <input type="number" name="distributed-gallons-input" id="distributed-gallons-input" min=1 value="<?php echo $row['distributedGallons'];?>">
                            </td>
                        <tr>
                            <td>DATE</td>
                            <td>
                                <input type="date" name="date-input" id="date-input" value="<?php echo $row['date'];?>">
                            </td>
                        <tr>
                            <td colspan = 2>
                                <button type="submit" name="update" id="update">Update Item</button>
                                <button type="button" id="close-button-update">Cancel</button>
                            </td>                                 
                    </table>
                </form>
            </dialog>
        </div>
        
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