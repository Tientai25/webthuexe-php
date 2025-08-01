<?php
include("connect.php");

// Kiểm tra sự tồn tại của tham số 'this_id'
if (isset($_GET['this_id'])) {
    $this_id = $_GET['this_id'];

    // Truy vấn thông tin người dùng
    $sql = "SELECT * FROM users WHERE id=" . $this_id;
    $query = mysqli_query($conn, $sql); // Đảm bảo sử dụng mysqli_query
    $row = mysqli_fetch_assoc($query);

    // Nếu không tìm thấy người dùng với ID này, chuyển hướng về trang quản lý
    if (!$row) {
        header("location:user.php");
        exit();
    }

    // Khi nhấn nút edit
    if (isset($_POST['btn'])) {
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $cfpassword = $_POST['cfpassword'];       
        $role = $_POST['role'];

        // Cập nhật thông tin người dùng
        $sql = "UPDATE users SET username='$username', email='$email', password='$password', cfpassword='$cfpassword',
                role='$role' WHERE id=" . $this_id;
        mysqli_query($conn, $sql); // Sửa lại từ mysqLi_query thành mysqli_query
        header("location:user.php");
        exit(); // Kết thúc script sau khi chuyển hướng
    }
} else {
    // Nếu không có this_id, chuyển hướng về trang khác hoặc hiển thị thông báo
    header("location:user.php"); // Chuyển hướng về trang user
    exit(); // Kết thúc script
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sửa người dùng</title>
    <link rel="stylesheet" href="edit-user.css">
</head>
<body>
    <div class="container">
        <h1>Sửa người dùng</h1>
        <form action="edit-user.php?this_id=<?php echo $this_id; ?>" method="post" enctype="multipart/form-data">
            <div>
                <label for="username">Username</label>
                <input type="text" name="username" required>
            </div>

            <div>
                <label for="email">Email</label>
                <input type="email" name="email" required>
            </div>

            <div>
                <label for="password">Password</label>
                <input type="password" name="password" required>
            </div>

            <div>
                <label for="cfpassword">Confirm Password</label>
                <input type="password" name="cfpassword" required>
            </div>
            
            <div>
                <label for="role">Role</label>
                <select name="role" id="role" required>
                    <option value="Admin">Admin</option>
                    <option value="User">User</option>
                </select>
            </div>
            
            <button type="submit" name="btn">Chỉnh sửa</button>
        </form>
    </div>
</body>
</html>