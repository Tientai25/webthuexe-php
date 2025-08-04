<?php
    include "connect.php";

    if(isset($_POST['btn'])){
        $title = $_POST['bikeType'];
        $des = $_POST['description'];
        $price = $_POST['price'];
        $quantity = $_POST['quantity'];
        $img = $_FILES['img']['name']; 
        $img_tmp_name = $_FILES['img']['tmp_name'];

        $sql = "INSERT INTO bicycles(title, description, price, img, quantity) 
                VALUES('$title', '$des', '$price', '$img', '$quantity')";

        if(mysqli_query($conn, $sql)){
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
                <input type="text" id="bikeType" name="bikeType" required>
            </div>
            <div class="form-group">
                <label for="description">Mô Tả</label>
                <input type="text" id="description" name="description" required>
            </div>
            <div class="form-group">
                <label for="price">Giá</label>
                <input type="text" id="price" name="price" required>
            </div>
            <div class="form-group">
                <label for="quantity">Số Lượng</label>
                <input type="number" id="quantity" name="quantity" required>
            </div>
            <div class="form-group">
                <label for="img">Hình Ảnh</label>
                <input type="file" id="img" name="img" required>
            </div>
            <button type="submit" name="btn">Thêm Xe</button>
        </form>
    </div>
</body>

</html>