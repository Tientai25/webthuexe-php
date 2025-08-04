<!DOCTYPE html>
<html lang="vi">

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
    <title>Đăng ký thuê xe đạp</title>
    <link rel="stylesheet" href="register.css">
</head>

<body>
    <?php
        include "connect.php";
        if(isset($_POST['btn'])){
            $id = " ";
            $username = $_POST['username'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $cfpassword = $_POST['confirm-password'];
            $sql = "INSERT INTO users(id,username,email,password,cfpassword) 
            VALUES('$id','$username','$email','$password','$cfpassword')";
            mysqLi_query($conn,$sql);
            header("location:login.php");
        }
        
    ?>
    <div class="container">
        <h1>Đăng ký </h1>
        <form id="registerForm" action="register.php" method="POST">
            <div class="form-group">
                <label for="username">Tên đăng nhập</label>
                <input type="text" id="username" name="username" placeholder="Tên đăng nhập phải có ít nhất 3 ký tự"
                    required>
                <small class="error-message" id="usernameError"></small>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required>
                <small class="error-message" id="emailError"></small>
            </div>
    
            <div class="form-group">
                <label for="password">Mật khẩu</label>
                <input type="password" id="password" name="password" placeholder="Mật khẩu phải có ít nhất 6 ký tự"
                    required>
                <small class="error-message" id="passwordError"></small>
            </div>
            <div class="form-group">
                <label for="confirm-password">Xác nhận mật khẩu</label>
                <input type="password" id="confirm-password" name="confirm-password"
                    placeholder="Mật khẩu phải có ít nhất 6 ký tự" required>
                <small class="error-message" id="confirmPasswordError"></small>
            </div>
            <button type="submit" name="btn">   </button>
        </form>
        <p id="successMessage" class="success-message"></p>
    </div>
    
</body>

</html>