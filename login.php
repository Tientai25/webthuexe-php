<?php
        include "connect.php";

        //Bắt đầu phiên làm việc
         session_start();

        if(isset($_SESSION['mySession'])){
            header("location:index.php");
        }

        if (isset($_POST['btn'])) {
            $username = mysqli_real_escape_string($conn, $_POST['username']);
            $password = mysqli_real_escape_string($conn, $_POST['password']);
            
            // Truy vấn để lấy thông tin người dùng từ cơ sở dữ liệu
            $sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
            $result = mysqli_query($conn, $sql);
            
            if (mysqli_num_rows($result) == 1) {
                $row = mysqli_fetch_assoc($result);
    
                // Lưu thông tin cần thiết vào session
                $_SESSION['user_id'] = $row['id']; // ID của người dùng
                $_SESSION['username'] = $row['username']; // Tên người dùng
                $_SESSION['avatar'] = $row['avatar']; // Đường dẫn tới avatar (avatar là tên cột chứa đường dẫn ảnh trong CSDL)
                $_SESSION['role'] = $row['role']; // Vai trò của người dùng (admin hoặc user)
    
                // Thiết lập mySession để xác nhận đăng nhập
                $_SESSION['mySession'] = $username;
    
                // Điều hướng tới trang index sau khi đăng nhập thành công
                header("Location: index.php");
                echo "<script>alert('Username or password correct!');</script>";
                exit(); // Dừng script sau khi chuyển hướng
            } else {
                echo "<script>alert('Username or password incorrect!');</script>";
            }
        }
    ?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--  font-awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- font google -->
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap"
        rel="stylesheet">
    <title>Đăng Nhập - Thuê Xe Đạp</title>
    <link rel="stylesheet" href="login.css">
</head>

<body>

    <div class="login-container">
        <div class="login-box">
            <h2>Đăng Nhập</h2>
            <form id="loginForm" action="login.php" method = "post">
                <div class="input-group">
                    <label for="username">Tên Đăng Nhập</label>
                    <input type="text" id="username" name="username" placeholder="Nhập tên đăng nhập" required>
                </div>
                <div class="input-group">
                    <label for="password">Mật Khẩu</label>
                    <input type="password" id="password" name="password" placeholder="Nhập mật khẩu" required>
                </div>
                <button type="submit" name="btn">Đăng Nhập</button>
            </form>
            <p class="signup-link">Chưa có tài khoản? <a href="register.php">Đăng ký ngay</a></p>
        </div>
    </div>
</body>

</html>