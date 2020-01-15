<?php 
  session_start();
  error_reporting(0);
  include "includes/dbconnection.php";
  $sql = "SELECT products.*,categories.categoryName FROM products JOIN categories ON categories.id=products.category_id  WHERE products.id = '$_GET[id]' ";
    $result = mysqli_query($con,$sql);
  //  $row1 = mysqli_fetch_assoc($result);
    if(isset($_GET['action']) && $_GET['action']=="add"){
        $id=intval($_GET['id']);
        if(isset($_SESSION['cart'][$id])){
            $_SESSION['cart'][$id]['quantity']++;
        }else{
            $sql_p="SELECT * FROM products WHERE id= $id";
            $query_p=mysqli_query($con,$sql_p);
            if(mysqli_num_rows($query_p)!=0){
                $row_p=mysqli_fetch_array($query_p);
                $_SESSION['cart'][$row_p['id']]=array("quantity" => 1, "price" => $row_p['price']);
                echo "<script>alert('Bạn đã thêm vào giỏ hàng thành công!');</script>";
                header('location:detail.php?quanly=detail&id=<?php echo $$row_p["id"]?>');
}
}
}
?>
<!doctype html>
<html lang="en">

<head>
    <title>Vian Shop - <?php echo htmlentities($row1['name']);?></title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="css/style-index.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="shortcut icon" type="image/png" href="image-page/logo2.PNG">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
    <?php 
    include "includes/top-header.php";
    include 'includes/header.php';
    $row = mysqli_fetch_array($result);
   ?>
    <hr>
    <div class="container">
        <div class="name-page">
            <h6><a href="index.php">Trang chủ</a><span> / <?php echo htmlentities($row['name']);?></span></h6>
        </div>
        <br>
        <div class="row">
            <div class="col-md-8 left">
                <div class="row">
                    <div class="col-md-8">
                        <img src="image-product/<?php echo htmlentities($row['category_id']);?>/<?php echo htmlentities($row['image']);?>"
                            style="width:100%;height:auto" alt="">
                    </div>
                    <div class="col-md-4">
                        <div>
                            <h3><?php echo htmlentities($row['name']);?> </h3>
                        </div>
                        <div><?php echo htmlentities($row['price']);?> đ </div>
                        <div class="status"> Trạng thái:
                            <?php 
                              if ($row['quantity'] == 0 ){
                                echo "Hết hàng";
                              }else {
                                echo "Còn hàng";
                              }
                             ?>
                        </div>
                        <div class="desc"><?php echo htmlentities($row['decription']);?> </div>
                        <a href="">Mua ngay</a>
                        <a href="detail.php?page=product&action=add & id=<?php echo $row['id']; ?>">Thêm vào giỏ hàng</a>
                    </div>
                </div>
            </div>
            <div class="col-md-3" style="border:1px solid black">
                <h5>Thời gian nhận hàng</h5>
                <div>Từ 1 ngày - 5 ngày</div>
                <ul>
                    <li><img src="image-page/transport.png" alt=""> Vận chuyển toàn quốc</li>
                    <li><img src="image-page/exchange.png" alt=""> Đổi trả trong vòng 7 ngày</li>
                    <li><img src="image-page/pay-money.png" alt=""> Thanh toán khi nhận hàng</li>
                    <li><img src="image-page/phone.png" alt=""> Hot line: 1900 1717 71</li>
                </ul>
            </div>
        </div>
    </div>
    <?php include 'includes/FOOTER.php';?>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>
</body>

</html>