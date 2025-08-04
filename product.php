<?php
    include "connect.php";
    session_start();

    $items_per_page = 9; 
    $current_page = isset($_GET['page']) ? (int)$_GET['page'] : 1; 
    if ($current_page < 1) $current_page = 1;
    $offset = ($current_page - 1) * $items_per_page;

    $sql_count = "SELECT COUNT(*) as total FROM bicycles";
    $result_count = mysqli_query($conn, $sql_count);
    $row_count = mysqli_fetch_assoc($result_count);
    $total_items = $row_count['total'];
    $total_pages = ceil($total_items / $items_per_page);
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Khám phá bộ sưu tập xe đạp chất lượng cao tại Hà Nội, Hồ Chí Minh, Đà Nẵng. Thuê xe đạp để trải nghiệm hành trình thân thiện với môi trường!">
    <meta name="keywords" content="thuê xe đạp, xe đạp, dịch vụ thuê xe, Hà Nội, Hồ Chí Minh, Đà Nẵng">
    <meta name="author" content="Thuê Xe Đạp">
    <title>Danh Sách Sản Phẩm - Thuê Xe Đạp</title>
    <link rel="icon" type="image/png" href="assets/images/favicon.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="product.css">
    <style>
        .pagination {
            text-align: center;
            margin: 20px 0;
        }
        .pagination a {
            padding: 8px 12px;
            margin: 0 5px;
            text-decoration: none;
            color: #006064;
            font-weight: bold;
            background-color: #e0f7fa;
            border-radius: 5px;
            transition: background-color 0.3s, transform 0.3s;
        }
        .pagination a:hover {
            background-color: #00e676;
            transform: scale(1.1);
        }
        .pagination .active {
            background-color: #00796b;
            color: #fff;
            pointer-events: none;
        }
        .pagination .disabled {
            color: #ccc;
            pointer-events: none;
            background-color: #f0f0f0;
        }
    </style>
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
                <li><a href="product.php" class="active">SẢN PHẨM</a></li>
                <li class="middle-section">
                    <form method="GET" action="search.php">
                        <input type="text" placeholder="Nhập tên sản phẩm..." class="search-input" name="noidung">
                        <button type="submit" class="search-btn">TÌM KIẾM</button>
                    </form>
                </li>
                <!-- <li><a href="register.php">ĐĂNG KÝ</a></li> -->
                 <li><a href="register.php">LIÊN HỆ</a></li>
                <li><a href="logout.php">ĐĂNG XUẤT</a></li>
            </ul>
        </nav>
        <div class="header_info">
            <a href="user.php" aria-label="Quản lý người dùng">
               <i class="fa-solid fa-users"></i>
            </a>
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

    <section id="products" class="container">
        <!-- Banner Carousel -->
        <div class="carousel-container">
            <div class="carousel">
                <div class="carousel-item">
                    <img src="assets/images/xe-dap-the-thao-cao-cap-1-1.png" alt="Xe Đạp Địa Hình">
                    <div class="carousel-caption">
                        <h3>Khám Phá Địa Hình</h3>
                        <a href="detail.php?this_id=1">Khám phá ngay</a>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="assets/images/xe-dap-the-thao-cao-cap-3-1.png" alt="Xe Đạp Đường Phố">
                    <div class="carousel-caption">
                        <h3>Chinh Phục Đường Phố</h3>
                        <a href="detail.php?this_id=3">Khám phá ngay</a>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="assets/images/xe-dap-the-thao-cao-cap-4-1.png" alt="Xe Đạp Thành Phố">
                    <div class="carousel-caption">
                        <h3>Thoải Mái Thành Phố</h3>
                        <a href="detail.php?this_id=4">Khám phá ngay</a>
                    </div>
                </div>
            </div>
            <div class="carousel-controls">
                <button onclick="prevSlide()">&#10094;</button>
                <button onclick="nextSlide()">&#10095;</button>
            </div>
        </div>

        <h2 style="text-align: center;">Danh Sách Xe Đạp</h2>
        <div class="intro-text">
            <p>Khám phá bộ sưu tập xe đạp đa dạng của chúng tôi, từ xe đạp địa hình mạnh mẽ đến xe đạp thành phố tiện lợi. Mỗi chiếc xe được thiết kế để mang lại trải nghiệm tuyệt vời, giúp bạn khám phá thành phố một cách thoải mái và thân thiện với môi trường.</p>
            <p>Chúng tôi cam kết cung cấp dịch vụ thuê xe đạp chất lượng cao với mức giá hợp lý. Hãy chọn chiếc xe phù hợp và bắt đầu hành trình của bạn ngay hôm nay!</p>
        </div>
        <div class="products">
            <?php
            $sql = "SELECT * FROM bicycles LIMIT $items_per_page OFFSET $offset";
            $result = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_array($result)) {
            ?>
                <div class="product-item">          
                    <div class="product-info">
                        <div class="title-delete" style="display: grid; grid-template-columns: 1fr 1fr; align-items: center;">
                            <h3><?php echo htmlspecialchars($row['title']); ?></h3>      
                            <?php if (isset($_SESSION['role']) && $_SESSION['role'] == 'admin'): ?>
                                <a href="delete.php?this_id=<?php echo $row['id']; ?>" style="cursor: pointer; border: none; background-color: #006064; color: white; padding: 10px 10px; margin-top: 20px; border-radius: 5px; text-decoration: none; transition: background-color 0.3s">Xóa</a>            
                            <?php endif; ?>
                        </div>
                        <img src="assets/images/<?php echo htmlspecialchars($row['img']); ?>" alt="<?php echo htmlspecialchars($row['title']); ?>">
                        <p>Số lượng: <?php echo htmlspecialchars($row['quantity']); ?></p>
                        <p><?php echo htmlspecialchars($row['description']); ?></p>
                        <h3 style="text-align: center"><?php echo number_format($row['price']); ?> VND</h3>
                        <a href="detail.php?this_id=<?php echo $row['id']; ?>" class="btn" style="border-radius: 5px; margin-top: -6px">Thuê xe ngay</a>
                    </div>
                </div>
            <?php 
                }
            } else {
                echo "<p style='text-align: center; color: #555;'>Hiện tại không có xe đạp nào trong danh sách.</p>";
            }
            ?>   
        </div>
        <!-- Phân trang -->
        <div class="pagination">
            <?php if ($current_page > 1): ?>
                <a href="product.php?page=<?php echo $current_page - 1; ?>">&laquo; Trước</a>
            <?php else: ?>
                <a class="disabled">&laquo; Trước</a>
            <?php endif; ?>

            <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                <a href="product.php?page=<?php echo $i; ?>" class="<?php echo $i == $current_page ? 'active' : ''; ?>"><?php echo $i; ?></a>
            <?php endfor; ?>

            <?php if ($current_page < $total_pages): ?>
                <a href="product.php?page=<?php echo $current_page + 1; ?>">Tiếp &raquo;</a>
            <?php else: ?>
                <a class="disabled">Tiếp &raquo;</a>
            <?php endif; ?>
        </div>
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
                    <li><a href="index.php">Trang chủ</a></li>
                    <li><a href="#about">Giới thiệu</a></li>
                    <li><a href="product.php">Xe đạp</a></li>
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

    <script>
        // JavaScript cho carousel
        let currentSlide = 0;
        const slides = document.querySelectorAll('.carousel-item');
        const totalSlides = slides.length;

        function showSlide(index) {
            if (index >= totalSlides) currentSlide = 0;
            if (index < 0) currentSlide = totalSlides - 1;
            const carousel = document.querySelector('.carousel');
            carousel.style.transform = `translateX(-${currentSlide * 100}%)`;
        }

        function nextSlide() {
            currentSlide++;
            showSlide(currentSlide);
        }

        function prevSlide() {
            currentSlide--;
            showSlide(currentSlide);
        }

        // Tự động chuyển slide mỗi 5 giây
        setInterval(nextSlide, 5000);

        // Khởi tạo slide đầu tiên
        showSlide(currentSlide);
    </script>
</body>
</html>