<?php
include("connect.php");

if (isset($_GET['this_id'])) {
    $this_id = $_GET['this_id'];

    $sql = "SELECT * FROM users WHERE id=" . $this_id;
    $query = mysqli_query($conn, $sql); 
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

        $sql = "UPDATE users SET username='$username', email='$email', password='$password', cfpassword='$cfpassword',
                role='$role' WHERE id=" . $this_id;
        mysqli_query($conn, $sql); 
        header("location:user.php");
        exit(); 
    }
} else {
   
    header("location:user.php"); 
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