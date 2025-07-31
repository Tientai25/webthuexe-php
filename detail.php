<?php
    include "connect.php";
    session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản Lý Cho Thuê Xe Đạp</title>
    <!--  font-awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- font google -->
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap"
        rel="stylesheet">

    <link rel="stylesheet" href="style.css">

    <link rel="stylesheet" href="detail.css">
</head>

<body>
    <header>
        <div class="logo">
            <a href="#"><img src="assets/images/logo.png" alt="logo"></a>
        </div>

        <nav class="header_navbar"> 
            <ul>
                <li><a href="index.php">TRANG CHỦ</a></li>
                <li><a href="#">SẢN PHẨM</a></li>
                <li class="middle-section">
                    <form method="GET" action="search.php">
                        <input type="text" placeholder="Nhập tên sản phẩm..." style="padding: 8px; width: 300px; border-radius: 5px;" name="noidung">
                        <button type="submit" style="padding: 8px 16px; border-radius: 5px; color: black; text-decoration: none; font-size: 15px; border: solid black 2px;">SEARCH</button>
                    </form>
                </li>
                <li><a href="register.php">ĐĂNG KÝ</a></li>
                <li><a href="logout.php">ĐĂNG XUẤT</a></li>
            </ul>
        </nav>

        <div class="header_info">
            <a href="user.php"><i class="fa-solid fa-plus">123</i></a>
            <a class="cart" href="cart.php">
                <!-- <p class="cart-item">0</p> -->
                <i class="fa fa-shopping-bag"></i>
            </a>

            <?php if (isset($_SESSION['mySession'])): ?>
                <!-- Nếu người dùng đã đăng nhập -->
                <a class="header_account" href="index.php"> <!-- Link đến trang profile của user hoặc admin -->
                    <!-- <img src="assets/images/<?php echo $_SESSION['img']; ?>" alt="Avatar" class="user-avatar"> -->
                    <p class="accountname"><?php echo $_SESSION['username']; ?></p>
                </a>
            <?php else: ?>
                <!-- Nếu người dùng chưa đăng nhập -->
                <a class="header_account" href="login.php">
                    <i class="fa fa-user-alt"></i>
                    <p class="accountname">Đăng nhập</p>
                </a>
            <?php endif; ?>
        </div>
    </header>

    <div class="detail-container">
        <?php
            include "connect.php";
            $this_id = $_GET['this_id'];
            $sql = "SELECT * FROM bicycles WHERE id = " . $this_id ;
            $result = mysqLi_query($conn,$sql);
            while($row = mysqli_fetch_array($result)){
        ?> 
            <div class="detail">
                <div class="detail-image">
                    <img src="assets/images/<?php echo $row['img']; ?>" alt="">
                </div>
            <div class="detail-info">
                <h3><?php echo $row['title']; ?></h3>                
                <p><?php echo $row['description']; ?></p>
                <div class="detail-price">
                    <h3 style = "text-align: center" ><?php echo number_format($row['price']);?> VND</h3>                   
                </div>
                <button class="btn-add" id="addCart"> 
                    <a href="detail.php?this_id=<?php echo $row['id'];?> & action=add">Thuê Xe</a>
                </button>
            </div>
               
        <?php } ?>  
    
        <?php            
            include "connect.php";
            $this_id = $_GET['this_id'];

            if (isset($_GET['action']) && $_GET['action'] == 'add') {
            $sql = "SELECT * FROM bicycles WHERE id = " . $this_id;
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_array($result);

            $itemArray = array(
                $row['id'] => array(
                    'title' => $row['title'],
                    'id' => $row['id'],
                    'price' => $row['price'],
                    'quantity' => 1,
                    'img' => $row['img']
                )
            );

            if (!empty($_SESSION["cart"])) {
                if (array_key_exists($row['id'], $_SESSION["cart"])) {
                    $_SESSION["cart"][$row['id']]['quantity']++;
                } else {
                    $_SESSION["cart"] = array_merge($_SESSION["cart"], $itemArray);
                }
            } else {
                $_SESSION["cart"] = $itemArray;
            }
            header("Location: cart.php");
        }?>

    </div>
    
    <footer>
        <div class="footer-container">
            <div class="footer-about">
                <h3>Về Chúng Tôi</h3>
                <p>Chúng tôi cung cấp dịch vụ thuê xe đạp chất lượng cao, giúp bạn khám phá thành phố một cách thân
                    thiện với môi trường.</p>
            </div>
            <div class="footer-links">
                <h3>Liên Kết Nhanh</h3>
                <ul>
                    <li><a href="#">Trang chủ</a></li>
                    <li><a href="#about">Giới thiệu</a></li>
                    <li><a href="#bikes">Xe đạp</a></li>
                    <li><a href="contact.php">Liên hệ</a></li>
                </ul>
            </div>
            <div class="footer-contact">
                <h3>Liên Hệ</h3>
                <p>Địa chỉ: Thanh Xuân, Hà Nội</p>
                <p>Email: anhhao@thuexedap.com</p>
                <p>Điện thoại: 0123-456-789</p>
            </div>
            <div class="footer-social">
                <h3>Kết Nối Với Chúng Tôi</h3>
                <a href="#" class="social-icon"><i class="fab fa-facebook"></i></a>
                <a href="#" class="social-icon"><i class="fab fa-instagram"></i></a>
                <a href="#" class="social-icon"><i class="fab fa-twitter"></i></a>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; 2024 Thuê Xe Đạp. All Rights Reserved.</p>
        </div>
    </footer>
    <!-- <script src="detail.js"></script> -->
</body> 

</html>