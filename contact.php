<?php
include "connect.php";
session_start();
if(!isset($_SESSION['mySession'])){
    header("location:login.php");
    exit();
}

$success_message = '';
$error_message = '';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    $sql = "INSERT INTO contacts (name, email, message, created_at) VALUES (?, ?, ?, NOW())";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "sss", $name, $email, $message);

    if (mysqli_stmt_execute($stmt)) {
        $success_message = "Tin nhắn của bạn đã được gửi thành công!";
    } else {
        $error_message = "Lỗi: " . mysqli_error($conn);
    }

    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Liên hệ với chúng tôi để thuê xe đạp chất lượng cao tại Hà Nội, Hồ Chí Minh, Đà Nẵng.">
    <meta name="keywords" content="thuê xe đạp, liên hệ, Hà Nội, Hồ Chí Minh, Đà Nẵng">
    <meta name="author" content="Thuê Xe Đạp">
    <title>Liên Hệ - Thuê Xe Đạp</title>
    <link rel="icon" type="image/png" href="assets/images/favicon.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="contact.css">
</head>
<body>
    <header>      
        <div class="logo">
            <a href="index.php"><img src="assets/images/main-logo.jpg" alt="Logo Thuê Xe Đạp"></a>
        </div>
        <div class="hamburger">
            <i class="fa fa-bars" aria-label="Menu"></i>
        </div>                      
        <nav class="header_navbar"> 
            <ul>
                <li><a href="index.php">TRANG CHỦ</a></li>
                <li><a href="product.php">SẢN PHẨM</a></li>
                <li class="middle-section">
                    <form method="GET" action="search.php">
                        <input type="text" placeholder="Nhập tên sản phẩm..." class="search-input" name="noidung">
                        <button type="submit" class="search-btn">SEARCH</button>
                    </form>
                </li>
                <li><a href="register.php">ĐĂNG KÝ</a></li>
                <li><a href="logout.php">ĐĂNG XUẤT</a></li>
            </ul>
        </nav>
        <div class="header_info">
            <?php if (isset($_SESSION['role']) && $_SESSION['role'] == 'admin'): ?>
                <a href="user.php" aria-label="Quản lý người dùng">
                    <i class="fa-solid fa-users"></i>
                </a>
            <?php endif; ?>
            <a class="cart" href="cart.php" aria-label="Giỏ hàng">
                <i class="fa fa-shopping-bag"></i>
                <p>0</p>
            </a>
            <?php if (isset($_SESSION['mySession'])): ?>
                <a class="header_account" href="index.php">
                    <?php if (isset($_SESSION['img']) && !empty($_SESSION['img'])): ?>
                        <img src="assets/images/<?php echo htmlspecialchars($_SESSION['img']); ?>" alt="Avatar" class="user-avatar">
                    <?php else: ?>
                        <i class="fa fa-user-alt"></i>
                    <?php endif; ?>
                    <p class="accountname"><?php echo htmlspecialchars($_SESSION['username']); ?></p>
                </a>
            <?php else: ?>
                <a class="header_account" href="login.php">
                    <i class="fa fa-user-alt"></i>
                    <p class="accountname">Đăng nhập</p>
                </a>
            <?php endif; ?>
        </div>
    </header>
    <div class="container">
        <header>
            <h1>Liên Hệ Chúng Tôi</h1>
            <p>Chúng tôi rất muốn nghe ý kiến từ bạn! Hãy liên hệ với chúng tôi nếu có bất kỳ thắc mắc nào của bạn</p>
        </header>
        <?php if (!empty($success_message)): ?>
            <div class="success-message"><?php echo htmlspecialchars($success_message); ?></div>
        <?php endif; ?>
        <?php if (!empty($error_message)): ?>
            <div class="error-message"><?php echo htmlspecialchars($error_message); ?></div>
        <?php endif; ?>
        <div class="contact-section">
            <div class="contact-form">
                <h2>Gửi Tin Nhắn</h2>
                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
                    <label for="name">Họ Tên <span style="color: red;">*</span></label>
                    <input type="text" id="name" name="name" required placeholder="Họ tên">

                    <label for="email">Email <span style="color: red;">*</span></label>
                    <input type="email" id="email" name="email" required placeholder="Email">

                    <label for="message">Mong Muốn <span style="color: red;">*</span></label>
                    <textarea id="message" name="message" rows="6" required placeholder="Phản hồi"></textarea>

                    <button type="submit">Gửi Tin Nhắn</button>
                </form>
            </div>
            <div class="contact-info">
                <h2>Thông Tin Liên Hệ</h2>
                <p><strong>Công Ty:</strong> WEB BICYCLE</p>
                <p><strong>Địa Chỉ:</strong> Thanh Xuân, Hà Nội</p>
                <p><strong>Liên Hệ:</strong> 0123-456-789</p>
                <p><strong>Email:</strong> webbike@thuexedap.com</p>
                <h3>Kết Nối Với Chúng Tôi</h3>
                <div class="social-links">
                    <a href="https://www.facebook.com/yourpage"><i class="fab fa-facebook"></i> Facebook</a>
                    <a href="https://www.instagram.com/yourpage"><i class="fab fa-instagram"></i> Instagram</a>
                    <a href="https://www.twitter.com/yourpage"><i class="fab fa-twitter"></i> Twitter</a>
                </div>
            </div>
        </div>
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
                    <li><a href="index.php">Trang chủ</a></li>
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
                <a href="https://www.facebook.com/yourpage" class="social-icon" aria-label="Facebook"><i class="fab fa-facebook"></i></a>
                <a href="https://www.instagram.com/yourpage" class="social-icon" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
                <a href="https://www.twitter.com/yourpage" class="social-icon" aria-label="Twitter"><i class="fab fa-twitter"></i></a>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; 2025 Thuê Xe Đạp. All Rights Reserved.</p>
        </div>
    </footer>
    <script src="main.js"></script>
</body>
</html>