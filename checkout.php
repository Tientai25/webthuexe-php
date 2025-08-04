<?php
session_start();
include "connect.php";

// Kiểm tra nếu giỏ hàng không trống
if (empty($_SESSION['cart'])) {
    header("Location: cart.php");
    exit;
}

// Xử lý khi biểu mẫu được gửi
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    
    // Kiểm tra dữ liệu đầu vào
    if (empty($name) || empty($phone) || empty($address)) {
        $error = "Vui lòng điền đầy đủ thông tin.";
    } else {
        // Bắt đầu giao dịch
        $conn->begin_transaction();
        try {
            // Lưu thông tin đơn hàng vào bảng orders
            $stmt = $conn->prepare("INSERT INTO orders (customer_name, customer_phone, customer_address, order_date) VALUES (?, ?, ?, NOW())");
            $stmt->bind_param("sss", $name, $phone, $address);
            $stmt->execute();
            $order_id = $conn->insert_id; // Lấy ID của đơn hàng vừa tạo

            // Lưu chi tiết đơn hàng và cập nhật số lượng xe đạp
            foreach ($_SESSION['cart'] as $item) {
                $bike_id = intval($item['id']);
                $quantity_ordered = intval($item['quantity']);
                $price = $item['price'];

                // Kiểm tra số lượng xe đạp hiện có
                $stmt = $conn->prepare("SELECT quantity FROM bicycles WHERE id = ?");
                $stmt->bind_param("i", $bike_id);
                $stmt->execute();
                $result = $stmt->get_result();
                
                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    $current_quantity = $row['quantity'];
                    
                    if ($current_quantity >= $quantity_ordered) {
                        // Cập nhật số lượng xe đạp
                        $updated_quantity = $current_quantity - $quantity_ordered;
                        $update_stmt = $conn->prepare("UPDATE bicycles SET quantity = ? WHERE id = ?");
                        $update_stmt->bind_param("ii", $updated_quantity, $bike_id);
                        $update_stmt->execute();

                        // Lưu chi tiết đơn hàng
                        $detail_stmt = $conn->prepare("INSERT INTO order_details (order_id, bike_id, quantity, price) VALUES (?, ?, ?, ?)");
                        $detail_stmt->bind_param("iiid", $order_id, $bike_id, $quantity_ordered, $price);
                        $detail_stmt->execute();
                    } else {
                        throw new Exception("Số lượng xe đạp (ID: $bike_id) không đủ.");
                    }
                } else {
                    throw new Exception("Xe đạp (ID: $bike_id) không tồn tại.");
                }
            }

            // Xác nhận giao dịch
            $conn->commit();
            
            // Xóa giỏ hàng
            unset($_SESSION['cart']);
            
            // Chuyển hướng đến trang xác nhận
            header("Location: order_confirmation.php");
            exit;
        } catch (Exception $e) {
            $conn->rollback();
            $error = "Lỗi: " . $e->getMessage();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thanh Toán Đơn Hàng</title>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <!-- <link rel="stylesheet" href="style.css"> -->
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }
        .checkout-container {
            max-width: 800px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            color: #006064;
            text-align: center;
        }
        .error {
            color: red;
            text-align: center;
            margin-bottom: 15px;
        }
        .cart-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        .cart-table th, .cart-table td {
            padding: 10px;
            text-align: center;
            border-bottom: 1px solid #ddd;
        }
        .cart-table th {
            background-color: #f8f8f8;
        }
        .cart-table img {
            width: 80px;
            height: 80px;
            object-fit: contain;
        }
        .total {
            text-align: right;
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 20px;
        }
        .checkout-form {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }
        .checkout-form label {
            font-weight: bold;
        }
        .checkout-form input, .checkout-form textarea {
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            width: 100%;
            box-sizing: border-box;
        }
        .checkout-form button {
            background-color: #006064;
            color: white;
            padding: 12px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }
        .checkout-form button:hover {
            background-color: #004d50;
        }
        .back-btn {
            display: inline-block;
            margin-top: 20px;
            text-align: center;
            text-decoration: none;
            color: #006064;
        }
    </style>
</head>
<body>
    <div class="checkout-container">
        <h1>Thanh Toán Đơn Hàng</h1>
        
        <?php if (isset($error)): ?>
            <p class="error"><?php echo htmlspecialchars($error); ?></p>
        <?php endif; ?>

        <!-- Hiển thị danh sách xe đạp trong giỏ hàng -->
        <h2>Thông tin xe đạp thuê</h2>
        <table class="cart-table">
            <thead>
                <tr>
                    <th>Ảnh</th>
                    <th>Tên</th>
                    <th>Số lượng</th>
                    <th>Giá</th>
                    <th>Tổng</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $total = 0;
                foreach ($_SESSION['cart'] as $item) {
                    $subtotal = $item['price'] * $item['quantity'];
                    $total += $subtotal;
                ?>
                    <tr>
                        <td><img src="assets/images/<?php echo htmlspecialchars($item['img']); ?>" alt=""></td>
                        <td><?php echo htmlspecialchars($item['title']); ?></td>
                        <td><?php echo htmlspecialchars($item['quantity']); ?></td>
                        <td><?php echo number_format($item['price']); ?> VND</td>
                        <td><?php echo number_format($subtotal); ?> VND</td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
        <p class="total">Tổng tiền: <?php echo number_format($total); ?> VND</p>

        <!-- Biểu mẫu điền thông tin khách hàng -->
        <h2>Thông tin khách hàng</h2>
        <form class="checkout-form" method="POST">
            <label for="name">Họ và tên:</label>
            <input type="text" id="name" name="name" required>
            
            <label for="phone">Số điện thoại:</label>
            <input type="tel" id="phone" name="phone" required>
            
            <label for="address">Địa chỉ nhận xe:</label>
            <textarea id="address" name="address" rows="4" required></textarea>
            
            <button type="submit">Xác nhận đặt hàng</button>
        </form>
        
        <a href="cart.php" class="back-btn"><i class="fas fa-arrow-left"></i> Quay lại giỏ hàng</a>
    </div>
</body>
</html>