<?php 
  session_start();
  error_reporting(0);
  include "includes/dbconnection.php";
  if(strlen($_SESSION['ulogin'])==0)
	{	
    header('location:login.php');
    }else{
        $totalprice=0;
?>
<!doctype html>
<html lang="en">

<head>
    <title>Đặt mua</title>
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
    $username=$_SESSION['ulogin'];
    if(isset($_POST['default'])) {
        $mysql = "SELECT * FROM users WHERE username='$username'";
        $result = mysqli_query($con, $mysql);
        $row1 = mysqli_fetch_array($result);
     //   $name= $row1[]
     $phone=$row1['phone'];
     $name=$row1['fullname'];
     $address = $row1['address'];
    }
    if(isset($_POST['buy'])) {
        $cusName=$_POST['cusName'];
        $cusAddress=$_POST['cusAddress'];
        $cusPhone=$_POST['cusPhone']; 
        $payment=$_POST['cate'];
        $userid=$_SESSION['id'];
        $insert= "INSERT INTO orders( total, customerName,phonenumber,address, payment, user_id  ) VALUES ('$totalprice','$cusName','$cusPhone','$cusAddress','$payment','$quantity')"; 
        mysqli_query($con,$insert);
        unset($_SESSION['cart']);
        header('location:index.php');
    }
    
    
    ?>
    <hr>
    <div class="container">
        <div class="name-page">
            <h6><a href="index.php">Trang chủ</a><span> / Đặt hàng</span></h6>
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
                </tr>
            </thead>
            <tbody>
                <?php $totalprice1=0;
                     while($row=mysqli_fetch_array($query)){
                        $subtotal= $_SESSION['cart'][$row['id']]['quantity']*$row['price'];
                        $totalprice+=$subtotal;
                        $totalprice1+=$subtotal;
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
                </tr>
                <?php }?>
                <tr>
                    <td colspan='2'><a href="card.php">Quay lại giỏ hàng</a></td>
                    <td colspan="2" style="text-align:right">
                        <h4>Tạm tính: </h4>
                    </td>
                    <td colspan='2'>
                        <h4><?php echo $totalprice1;?> đ</h4>
                    </td>
                </tr>
            </tbody>
        </table>
        <br>
        <br>
        <div id="form-buy">


            <div class="row">
                <div class="col-sm-6" style='border-right:1px solid gray'>
                    <h4 style="text-align:center"> <b> Thông tin người mua/nhận hàng</b></h4>
                    <form method="post">
                        <div class="control-group"> <button type="submit" name="default">Chọn thông tin mặc
                                định</button></div>
                    </form>
                    <hr>
                    <form action="" method="POST" role="form" enctype="multipart/form-data">
                        <div class="control-group">
                            <label class="control-lable" for="cusName"><b>Họ và tên</b><span
                                    class='note-red'>(*)</span></label>
                            <input type="text" class="control" name="cusName" id="cusName" value=" <?php echo $name?>" Required>
                        </div>
                        <div class="control-group">
                            <label class="control-lable" for="address"><b>Địa chỉ</b><span
                                    class='note-red'>(*)</span></label>
                            <input type="text" class="control" name="address" id="address" value="<?php echo $address?>" Required>
                        </div>
                        <div class="control-group">
                            <label class="control-lable" for="phone"><b>Số điện thoại</b><span
                                    class='note-red'>(*)</span></label>
                            <input type="text" class="control" name='phone' value="<?php echo $phone?>" Required>
                        </div>
                        <div class="control-group">
                            <label class="control-lable" for="note"><b>Ghi chú</b></label>
                            <textarea type="text" class="control" name="note" id="note" value=""></textarea>
                        </div>
                        <div class="control-group">
                            <label class="control-lable" for="thanh-toan"><b>Phương thức thanh toán</b></label>
                            <select class="control" name="cate" Required>
                                <option value="COD">Thanh toán khi nhận hàng</option>
                                <option value="online">Thanh toán online</option>
                            </select>
                        </div>
                        <div class="control-group"><button type="submit" name="buy">Mua</button></div>
                    </form>
                </div>
                <div class="col-sm-6">

                </div>
            </div>

        </div>


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
<?php }?>