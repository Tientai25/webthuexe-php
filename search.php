<?php
    include "connect.php";
    session_start();
    if (!isset($_SESSION['mySession'])) {
        header("location:login.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản Lý Cho Thuê Xe Đạp</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <div class="logo">
            <a href="index.php"><img src="assets/images/main-logo.jpg" alt="logo"></a>
        </div>
        <nav class="header_navbar"> 
            <ul>
                <li><a href="index.php">TRANG CHỦ</a></li>
                <li><a href="#">SẢN PHẨM</a></li>
                <li class="middle-section">
                    <form method="GET" action="search.php">
                        <input type="text" placeholder="Nhập tên sản phẩm..." style="padding: 8px; width: 300px; border-radius: 5px;" name="noidung">
                        <button type="submit" style="padding: 8px 16px; border-radius: 5px; color: black; text-decoration: none; font-size: 15px; border: solid black 2px;">TÌM KIẾM</button>
                    </form>
                </li>
                <!-- <li><a href="register.php">ĐĂNG KÝ</a></li> -->
                 <li><a href="register.php">LIÊN HỆ</a></li>
                <li><a href="logout.php">ĐĂNG XUẤT</a></li>
            </ul>
        </nav>

        <div class="header_info">
            <a href="user.php"><i class="fa-solid fa-plus"></i></a>
            <a class="cart" href="cart.php">
                <i class="fa fa-shopping-bag"></i>
            </a>

            <?php if (isset($_SESSION['mySession'])): ?>
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

    <section class="products">
    <?php
    // Kiểm tra xem có từ khóa tìm kiếm được gửi từ form không
    if (isset($_GET['noidung']) && !empty($_GET['noidung'])) {
        $noidung = mysqli_real_escape_string($conn, $_GET['noidung']);

        // Tạo câu truy vấn SQL để tìm kiếm sản phẩm theo từ khóa
        $sql = "SELECT * FROM bicycles WHERE title LIKE '%$noidung%'";
        $result = mysqli_query($conn, $sql);

        // Kiểm tra xem có sản phẩm nào phù hợp không
        if ($result && mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_array($result)) {
            ?>
            <div class="product-item">          
            <div class="product-info">
                <div class="title-delete" style="display: grid;grid-template-columns: 1fr 1fr; align-items: center;">
                    <h3><?php echo $row['title']; ?></h3>      
                     <a href="delete.php?this_id=<?php echo $row['id']; ?>" style="cursor: pointer;border: none; background-color: #006064; color: white; 
                     padding: 10px 10px;margin-top: 20px ;border-radius: 5px; text-decoration: none; 
                     transition: background-color 0.3s">Xóa</a>            
                </div>
                <img src="assets/images/<?php echo $row['img']; ?>" alt="">
                <p><?php echo $row['description']; ?></p>
                <h3 style="text-align: center" ><?php echo number_format($row['price']);?> VND</h3>
                <a href="detail.php?this_id=<?php echo $row['id']; ?>" class="btn" 
                    style="border-radius: 5px;margin-top:-6px">Thuê xe ngay</a>
            </div>
        </div>
        <?php } ?>
    <?php   } else { 
       echo "<p>Không tìm thấy sản phẩm nào phù hợp với từ khóa: '" . htmlspecialchars($noidung) . "'</p>"; 
        }
    } else {
        echo "<p>Vui lòng nhập từ khóa để tìm kiếm sản phẩm.</p>";
        // header("location:index.php");
    } ?>
    
    </section>

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
        </div>
    </footer>
</body>
</html>
