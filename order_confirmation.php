<?php
session_start();
include "connect.php";

if (!empty($_SESSION['cart'])) {
    header("Location: checkout.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cảm Ơn Bạn Đã Đặt Hàng</title>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }
        .order-confirm {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            text-align: center;
            max-width: 600px;
            width: 100%;
        }
        .order-confirm h1 {
            color: #28a745;
            font-size: 24px;
            margin-bottom: 10px;
        }
        .order-confirm p {
            color: #333;
            font-size: 16px;
            margin-bottom: 20px;
        }
        .order-confirm .fa-check-circle {
            color: #28a745;
            margin-right: 8px;
        }
        .btn {
            display: inline-block;
            padding: 12px 24px;
            background-color: #006064;
            color: #fff;
            text-decoration: none;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        .btn:hover {
            background-color: #004d50;
        }
        .btn .fa-home {
            margin-right: 8px;
        }
    </style>
</head>
<body>
    <div class="order-confirm">
        <h1><i class="fas fa-check-circle"></i> Cảm ơn bạn đã đặt hàng!</h1>
        <p>Đơn hàng của bạn đã được ghi nhận. Chúng tôi sẽ liên hệ với bạn sớm nhất để xác nhận chi tiết.</p>
        <a href="index.php" class="btn"><i class="fas fa-home"></i> Quay lại Trang chủ</a>
    </div>
</body>
</html>