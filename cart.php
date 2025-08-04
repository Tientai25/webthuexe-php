<?php
session_start();
include "connect.php";

if (isset($_GET['action']) && $_GET['action'] == 'update' && isset($_GET['id'])) {
    $id = $_GET['id'];
    $newQuantity = $_POST['quantity'];

    if (isset($_SESSION['cart'][$id])) {
        $_SESSION['cart'][$id]['quantity'] = $newQuantity;
    }

    header("Location: cart.php");
}

if (isset($_GET['action']) && $_GET['action'] == "remove" && isset($_GET['id'])) {
    unset($_SESSION['cart'][$_GET['id']]);
    header("Location: cart.php");
}

if (isset($_GET['action']) && $_GET['action'] == "clear") {
    unset($_SESSION['cart']);
    header("Location: cart.php");
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Quản Lý Cho Thuê Xe Đạp</title>
    <!--  font-awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- font google -->
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap"
        rel="stylesheet" />

    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="cart.css" />
</head>

<body>
    <header>
        <div class="logo">
            <a href="index.php"><img src="../webthuexe-php/assets/images/main-logo.jpg" alt="logo" /></a>
        </div>

        <nav class="header_navbar">
            <ul>
                <li><a href="index.php">TRANG CHỦ</a></li>
                <li><a href="#">SẢN PHẨM</a></li>
                <li class="middle-section">
                    <form method="GET" action="search.php">
                        <input type="text" placeholder="Nhập tên sản phẩm..." style="padding: 8px; width: 300px; border-radius: 5px;" name="noidung" />
                        <button type="submit" style="padding: 8px 16px; border-radius: 5px; color: black; text-decoration: none; font-size: 15px; border: solid black 2px;">TÌM KIẾM</button>
                    </form>
                </li>
                <!-- <li><a href="register.php">ĐĂNG KÝ</a></li> -->
                <li><a href="register.php">LIÊN HỆ</a></li>
                <li><a href="logout.php">ĐĂNG XUẤT</a></li>
            </ul>
        </nav>

        <div class="header_info">
            <a href="user.php"><i class="fa-solid fa-users"></i></a>
            <a class="cart" href="#">
                <i class="fa fa-shopping-bag"></i>
            </a>

            <?php if (isset($_SESSION['user_id'])): ?>
                <a class="header_account" href="index.php">
                    <p class="accountname"><?php echo $_SESSION['username']; ?></p>
                </a>
            <?php else: ?>
                <a class="header_account" href="login.php">
                    <i class="fa fa-user-alt"></i>
                    <p class="accountname">Đăng nhập</p>
                </a>
            <?php endif; ?>
        </div>
    </header>

    <!-- cart -->
    <div class="container">
        <?php if (!empty($_SESSION["cart"])) { ?>
            <div class="cart-container">
                <table class="cart-table" style="width:100%; border-collapse: collapse;">
                    <thead>
                        <tr style="border-bottom: 2px solid #ddd;">
                            <th style="padding: 10px; text-align:center;">Ảnh</th>
                            <th style="padding: 10px; text-align:center;">Tên</th>
                            <th style="padding: 10px; text-align:center;">Số lượng</th>
                            <th style="padding: 10px; text-align:center;">Giá</th>
                            <th style="padding: 10px; text-align:center;">Tổng</th>
                            <th style="padding: 10px; text-align:center;">Xóa</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($_SESSION["cart"] as $item) { ?>
                            <tr style="border-bottom: 1px solid #ddd; text-align:center;">
                                <td style="padding: 10px;">
                                    <img src="assets/images/<?php echo $item['img']; ?>" alt="" style="width: 80px; height: 80px; object-fit: contain;" />
                                </td>
                                <td style="padding: 10px;"><?php echo $item['title']; ?></td>
                                <td style="padding: 10px;">
                                    <form method="post" action="cart.php?action=update&id=<?php echo $item['id']; ?>">
                                        <input type="number" name="quantity" value="<?php echo $item['quantity']; ?>" min="1" onchange="this.form.submit()" style="width: 60px; padding: 5px;" />
                                    </form>
                                </td>
                                <td style="padding: 10px;"><?php echo number_format($item['price']); ?> VND</td>
                                <td style="padding: 10px;"><?php echo number_format($item['price'] * $item['quantity']); ?> VND</td>
                                <td style="padding: 10px;">
                                    <a href="cart.php?action=remove&id=<?php echo $item['id']; ?>" style="color: white; background-color: #006064; padding: 8px 16px; border-radius: 5px; text-decoration: none;">Xóa</a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
            <div class="cart-summary" style="margin-top: 20px; text-align: right;">
                <div class="product-total" style="margin-bottom: 15px;">
                    <h2>Tổng tiền: 
                        <span id="total">
                            <?php
                            $total = 0;
                            foreach ($_SESSION["cart"] as $item) {
                                $total += $item['price'] * $item['quantity'];
                            }
                            echo number_format($total) . " VND";
                            ?>
                        </span>
                    </h2>
                </div>
                <div class="product-checkout" style="margin-bottom: 10px;">
                    <a href="checkout.php" class="checkout" style="background-color: #006064; color: white; padding: 12px 24px; border-radius: 5px; text-decoration: none;">Thanh toán</a>
                </div>
                <a href="cart.php?action=clear" class="removeAll" style="display: inline-block; background-color: #006064; color: white; padding: 10px 20px; border-radius: 5px; text-decoration: none;">Xóa tất cả</a>
            </div>
        <?php } else { ?>
            <div class="cart-empty" style="text-align:center; margin-top: 100px;">
                <h2>Giỏ hàng trống</h2>
                <a href="index.php">
                    <button class="HomeBtn" style="background-color: #006064; color: white; padding: 10px 50px; border: none; border-radius: 5px; cursor: pointer; margin-top: 20px;">Quay về Trang chủ</button>
                </a>
            </div>
        <?php } ?>
    </div>

    <footer>
        <div class="footer-container">
            <div class="footer-about">
                <h3>Về Chúng Tôi</h3>
                <p>Chúng tôi cung cấp dịch vụ thuê xe đạp chất lượng cao, giúp bạn khám phá thành phố một cách thân thiện với môi trường.</p>
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
                <p>Email: webbike@thuexedap.com</p>
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
</body>

</html>
