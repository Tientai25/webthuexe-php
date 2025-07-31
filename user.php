<?php
    include "connect.php";
    session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Management</title>
    <link rel="stylesheet" href="user.css">
</head>

<body>
    <div class="container">
        <h1>User Management</h1>
        <table id="userTable">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Username</th>
                    <th>Email</th>
                    <!-- <th>Address</th> -->
                    <th>Password</th>
                    <th>Confirm Password</th>                  
                    <th>Role</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
            <?php
                    // Truy vấn để lấy tất cả người dùng
                    $sql = "SELECT * FROM users";
                    $result = mysqli_query($conn, $sql);
                    
                    // Kiểm tra xem có kết quả không
                    if (mysqli_num_rows($result) > 0) {
                        // Duyệt qua từng bản ghi
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>";
                            echo "<td>" . $row['id'] . "</td>"; // ID
                            echo "<td>" . $row['username'] . "</td>"; // Username
                            echo "<td>" . $row['email'] . "</td>"; // Email
                            echo "<td>" . $row['password'] . "</td>"; // Password
                            echo "<td>" . $row['cfpassword'] . "</td>"; // Cfpassword                           
                            echo "<td>" . $row['role'] . "</td>"; // Role
                            echo "<td class='admin-actions'>
                                    <button class='edit'>
                                        <a href='edit-user.php?this_id=" . $row['id'] . "' style='color: white; text-decoration: none;'>Edit</a>
                                    </button>
                                    <button class='delete'>
                                        <a href='delete-user.php?this_id=" . $row['id'] . "' style='color: white; text-decoration: none;'>Delete</a>
                                    </button>
                                  </td>"; // Actions
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='5'>No users found</td></tr>";
                    }
                ?>
            </tbody>
        </table>
        <button class="home-button"><a href="index.php" style="color:white;text-decoration:none;">Trang Chủ</a></button>
    </div>
   
</body>                  
</html>