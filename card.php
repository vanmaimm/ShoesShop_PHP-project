<?php 
  session_start();
  error_reporting(0);
  include "includes/dbconnection.php";
  if (isset($_GET['del'])) {
    $name = $_GET['name'];
    if (!empty($_SESSION['cart'])){
        unset($_SESSION['cart'][$name]);
    } 
    header('location: card.php');
    }
?>
<!doctype html>
<html lang="en">

<head>
    <title>Giỏ hàng</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="css/style-index.css">
    <link rel="shortcut icon" type="image/png" href="image-page/logo2.PNG">
    <link rel="stylesheet" href="css/card.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
    <?php 
    include "includes/top-header.php";
    include 'includes/header.php';
    ?>
    <hr>
    <div class="container">
        <div class="name-page">
            <h6><a href="index.php">Trang chủ</a><span> / Giỏ hàng</span></h6>
        </div>
        <br>
        <?php 
        if(isset($_SESSION['cart'])&& $_SESSION['cart']!=null){     
            $sql="SELECT * FROM products WHERE id IN (";     
                foreach($_SESSION['cart'] as $id => $value) { 
                    $sql.=$id.","; 
                }   
                $sql=substr($sql, 0, -1).") ORDER BY name ASC"; 
                $query=mysqli_query($con,$sql); ?>
        <table cellpadding="0" cellspacing="0" border="0" class="datatable-1 table table-bordered table-striped display"
            width="90%">
            <thead>
                <tr>
                    <th>Hình ảnh</th>
                    <th>Tên sản phẩm</th>
                    <th>Giá</th>
                    <th>Số lượng</th>
                    <th>Tổng tiền</th>
                    <th>...</th>
                </tr>
            </thead>
            <tbody>
                <?php $totalprice=0;
                     while($row=mysqli_fetch_array($query)){
                        $subtotal= $_SESSION['cart'][$row['id']]['quantity']*$row['price'];
                        $totalprice+=$subtotal;
                        ?>
                <tr>
                    <td> <img class='img-product'
                            src="image-product/<?php echo htmlentities($row['category_id']);?>/<?php echo htmlentities($row['image']);?>"
                            alt="" style="width:100px;height:100px"></td>
                    <td><?php echo $row['name'] ?></td>
                    <td><?php echo $row['price'] ?> đ</td>
                    <td><input class="form-control text-center"
                            value="<?php echo $_SESSION['cart'][$row['id']]['quantity'] ?>"
                            name="<?php echo $row[id]?> " type="number" style="width:100px">
                    <td><?php echo $subtotal?> đ</td>
                    <td><a href="card.php?&del=delete&name=<?php echo $row['id']?>"
                            onClick="return confirm('Bạn có muốn xóa không?')"><i class="fa fa-remove"
                                aria-hidden="true"></i></a></td>
                </tr>
                <?php }?>
                <tr>
                    <td colspan='4'><a href="index.php">Tiếp tục mua hàng</a></td>
                    <td colspan='2' style="text-align:right">Cập nhật giỏ hàng</td>
                </tr>
                <tr>
                    <td colspan="4" style="text-align:right">
                        <h4>Tạm tính: </h4>
                    </td>
                    <td>
                        <h4><?php echo $totalprice?> đ</h4>
                    </td>
                    <td><a href="order.php">Mua ngay</a></td>
                </tr>
            </tbody>
        </table>
        <br>
        <br>
        <script>
        // function Buy() {
        //     document.getElementById("form-buy").style.display = "block";
        // }
        // </script>

        <!-- <div id="form-buy" style="display:none;">
            <form action="" method="POST" role="form" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-sm-6" style='border-right:1px solid gray'>
                        <h4 style="text-align:center"> <b> Thông tin người mua/nhận hàng</b></h4>
                        <hr>
                        <div class="control-group">
                            <label class="control-lable" for="cusName"><b>Họ và tên</b><span class='note-red'>(*)</span></label>
                            <input type="text" class="control" name="cusName" id="cusName" value="" Required>
                        </div>
                        <div class="control-group">
                            <label class="control-lable" for="address"><b>Địa chỉ</b><span class='note-red'>(*)</span></label>
                            <input type="text" class="control" name="address" id="address" value="" Required>
                        </div>
                        <div class="control-group">
                            <label class="control-lable" for="phone"><b>Số điện thoại</b><span class='note-red'>(*)</span></label>
                            <input type="text" class="control" name='phone' value="" Required>
                        </div>
                        <div class="control-group">
                            <label class="control-lable" for="note"><b>Ghi chú</b></label>
                            <textarea type="text" class="control" name="note" id="note" value=""></textarea>
                        </div>
                        <div class="control-group">
                            <label class="control-lable" for="thanh-toan"><b>Phương thức thanh toán</b></label>
                            <select class="control" name="cate" Required>
                            <option  value="">Chọn hình thức thanh toán</option>	  
                            <option  value="">Thanh toán khi nhận hàng</option>                 <option  value="">Thanh toán online</option>   
                       </select> 
                        </div>
                    </div>
                    <div class="col-sm-6">
                     
                    </div>
                </div>
            </form>
        </div> -->


        <hr />
        <?php 
        }else{  echo "<p>Giỏ hàng trống!</p>";         } ?>
    </div>
    <?php include 'includes/footer.php';?>
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