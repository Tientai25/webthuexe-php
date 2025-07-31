<?php
    include "connect.php";

    if(isset($_POST['btn'])){
        $title = $_POST['bikeType'];
        $des = $_POST['description'];
        $price = $_POST['price'];
        $img = $_FILES['img']['name']; // Lấy tên file ảnh để lưu vào database
        $img_tmp_name = $_FILES['img']['tmp_name']; // Lấy đường dẫn tạm thời của ảnh

        // Câu truy vấn SQL
        $sql = "INSERT INTO bicycles(title, description, price, img) 
                VALUES('$title', '$des', '$price', '$img')";

        // Kiểm tra và thực hiện câu truy vấn
        if(mysqli_query($conn, $sql)){
            // Di chuyển file ảnh từ thư mục tạm thời đến thư mục đích
            move_uploaded_file($img_tmp_name, 'assets/images/'. $img);
            echo "<script>alert('Thêm sản phẩm thành công!');</script>";
            header("location:index.php");
        } else {
            echo "Lỗi: " . mysqli_error($conn);
        }
    }
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm Xe Đạp</title>
    <link rel="stylesheet" href="add_bike.css">
</head>

<body>
    <div class="container">
        <h1>Thêm Xe Đạp</h1>
        <form action="add_bike.php" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="bikeType">Loại Xe</label>
                <!-- <input type="text" id="bikeType" name="bikeType" required> -->
                <select id="bikeType" name="bikeType" required>
                    <option value="MountainBike">MountianBike</option>
                    <option value="Road Bike">Road Bike</option>
                    <option value="City Bike">City Bike</option>
                </select>
            </div>
        <div class="form-group">
            <label for="description">Description</label>
            <input type="text" id="description" name="description" required>
        </div>
        <div class="form-group">
            <label for="price">Price</label>
            <input type="text" id="price" name="price" required>
        </div>
        <div class="form-group">
            <label for="img">Image</label>
            <input type="file" id="img" name="img" required>
        </div>
        <button type="submit" name="btn">Thêm Xe</button>
</form>

    </div>
</body>

</html>