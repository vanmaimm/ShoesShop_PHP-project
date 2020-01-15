<?php 
  error_reporting(0);
 include "include/dbconnection.php";
session_start();
if(strlen($_SESSION['alogin'])==0)
	{	
header('location:index.php');
}
else{
    $sql = "SELECT products.*,categories.categoryName FROM products JOIN categories ON categories.id=products.category_id  WHERE products.id = '$_GET[id]' ";
    $result = mysqli_query($con,$sql);
    $row = mysqli_fetch_array($result);//change to array
    $cate="SELECT * From categories";
    $caterun = mysqli_query($con,$cate);
    $id=$_GET['id'];
   if (isset($_POST['submit'])) {
       $name=$_POST['proName'];
       $cate=$_POST['cate'];
       $image=$_FILES['image']['name'];
       $desc=$_POST['desc'];
       $price=$_POST['price'];
       $quantity=$_POST['quantity'];

      move_uploaded_file($_FILES["image"]["tmp_name"],"../image-product/$cate/".$_FILES["image"]["name"]);
       $update= "UPDATE products SET name=' $name', category_id='$cate', image='$image', decription='$desc',price='$price',quantity='$quantity' WHERE id='$id'";
       $run=mysqli_query($con,$update);
        if(isset($run)){
            header('location: manage-products.php?edit="success"');
        }else header('location: manage-products.php?edit="fail"');
	   
}

?>
<!doctype html>
<html lang="en">
  <head>
    <title>Admin|Update product</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="css/welcome.css">
  </head>
  <body>
     <?php include "include/header.php" ?>     
     <div class="container">        
        <div class="row">
            <?php include "include/sidebar.php"?>
            <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9"> 
                <h3>Edit & Update product</h3> 
                                    
                <form action="" method="POST" role="form" enctype="multipart/form-data">                
                    <div class="control-group">
                        <label class="control-lable" for="proName">Name product</label>
                        <input type="text" class="control" name="proName" id="proName" value="<?php echo htmlentities($row['name']);?>" >
                    </div>
                    <div class="control-group">
                        <label class="control-lable" for="cate">Category</label>
                        <select class="control" name="cate">
                        <?php 
                        while( $row1 = mysqli_fetch_array($caterun))
                            {?>	
								<option  value="<?php echo htmlentities($row1['id']);?> "><?php echo htmlentities($row1['categoryName']);?></option>		
						<?php  } ?>
                       </select> 
                    </div>
                    <div class="control-group">
                        <label class="control-lable" for="image">Image</label>
                        <input type="file" class="" name='image' id="image" value="" >
                        <br>
                        <img src="../image-product/<?php echo htmlentities($row['category_id']);?>/<?php echo htmlentities($row['image']);?>" alt="" style="width:100px; height:100px;margin-left:180px; margin-bottom:10px">
                    </div>
                    <div class="control-group">
                        <label class="control-lable" for="desc">Description</label>
                        <textarea type="text" class="control" name="desc" id="desc" value="<?php echo htmlentities($row['decription']);?>"></textarea>
                    </div>
                    <div class="control-group">
                        <label class="control-lable" for="price">Price</label>
                        <input type="text" class="control" name ="price" id="price" value="<?php echo htmlentities($row['price']);?>">
                    </div>
                    <div class="control-group">
                        <label class="control-lable" for="quantity">Quantity</label>
                        <input type="text" class="control" name="quantity" id="quantity" value="<?php echo htmlentities($row['quantity']);?>">
                    </div>
                   
                    <button type="submit" name='submit' class="btn btn-primary update">Update</button>
                </form>                
            </div>      
        </div>       
     </div>
      
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>
<?php } ?>