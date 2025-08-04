<?php
    include "connect.php";
    session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý người dùng</title>
    <link rel="stylesheet" href="user.css">
</head>

<body>
    <div class="container">
        <h1>Quản lý người dùng</h1>
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
               
                    $sql = "SELECT * FROM users";
                    $result = mysqli_query($conn, $sql);
                   
                    if (mysqli_num_rows($result) > 0) {
            
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>";
                            echo "<td>" . $row['id'] . "</td>"; 
                            echo "<td>" . $row['username'] . "</td>"; 
                            echo "<td>" . $row['email'] . "</td>"; 
                            echo "<td>" . $row['password'] . "</td>"; 
                            echo "<td>" . $row['cfpassword'] . "</td>";                         
                            echo "<td>" . $row['role'] . "</td>"; 
                            echo "<td class='admin-actions'>
                                    <button class='edit'>
                                        <a href='edit-user.php?this_id=" . $row['id'] . "' style='color: white; text-decoration: none;'>Edit</a>
                                    </button>
                                    <button class='delete'>
                                        <a href='delete-user.php?this_id=" . $row['id'] . "' style='color: white; text-decoration: none;'>Delete</a>
                                    </button>
                                  </td>"; 
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='5'>No users found</td></tr>";
                    }
                ?>
            </tbody>
        </table>
        <button class="home-button"><a href="index.php" style="color:white;text-decoration:none; ">Trang Chủ</a></button>
    </div>
   
</body>                  
</html>