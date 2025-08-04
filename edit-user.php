<?php
include("connect.php");

if (isset($_GET['this_id'])) {
    $this_id = $_GET['this_id'];

    // Sử dụng prepared statement để lấy dữ liệu người dùng
    $sql = "SELECT * FROM users WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $this_id);
    mysqli_stmt_execute($stmt);
    $query = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_assoc($query);

    if (!$row) {
        header("location:user.php");
        exit();
    }

    if (isset($_POST['btn'])) {
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $cfpassword = $_POST['cfpassword'];       
        $role = $_POST['role'];

        // Sử dụng prepared statement để cập nhật dữ liệu
        $sql = "UPDATE users SET username = ?, email = ?, password = ?, cfpassword = ?, role = ? WHERE id = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "sssssi", $username, $email, $password, $cfpassword, $role, $this_id);
        mysqli_stmt_execute($stmt);

        header("location:user.php");
        exit();
    }
} else {
    header("location:user.php"); 
    exit();
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
        <form action="edit-user.php?this_id=<?php echo htmlspecialchars($this_id); ?>" method="post" enctype="multipart/form-data">
            <div>
                <label for="username">Username</label>
                <input type="text" name="username" value="<?php echo htmlspecialchars($row['username']); ?>" required>
            </div>

            <div>
                <label for="email">Email</label>
                <input type="email" name="email" value="<?php echo htmlspecialchars($row['email']); ?>" required>
            </div>

            <div>
                <label for="password">Password</label>
                <input type="password" name="password" value="<?php echo htmlspecialchars($row['password']); ?>" required>
            </div>

            <div>
                <label for="cfpassword">Confirm Password</label>
                <input type="password" name="cfpassword" value="<?php echo htmlspecialchars($row['cfpassword']); ?>" required>
            </div>
            
            <div>
                <label for="role">Role</label>
                <select name="role" id="role" required>
                    <option value="admin" <?php echo ($row['role'] == 'admin') ? 'selected' : ''; ?>>admin</option>
                    <option value="user" <?php echo ($row['role'] == 'user') ? 'selected' : ''; ?>>user</option>
                </select>
            </div>
            
            <button type="submit" name="btn">Chỉnh sửa</button>
        </form>
    </div>
</body>
</html>