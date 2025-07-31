<?php
// Kết nối tới MySQL
$servername = "localhost"; // Tên máy chủ
$username = "root"; // Tên đăng nhập MySQL của bạn
$password = ""; // Mật khẩu MySQL của bạn
$dbname = "bike_store"; // Tên cơ sở dữ liệu của bạn

// Tạo kết nối
$conn = new mysqli($servername, $username, $password, $dbname);

if($conn){
    mysqLi_query($conn, "SET NAMES 'utf8' ");
    // echo "Connected!";
}else{
    echo "Disconnected!";
}