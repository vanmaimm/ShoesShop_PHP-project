<div class="header">
    <div class="container">
        <div class="row">
            <div class="col-md-2 header-image">
                <a href="index.php"><img src="image-page/logo1.png" class="header-image" alt=""></a>
            </div>
            <div class="col-md-9">
                <div class="header-catagory">
                    <ul class="header-right-menu">
                        <li>
                            <a href="products.php?name=giay-cao-got">
                                <div class="header-sub-category">
                                    <span>
                                        <img class="img" src="image-page/caogot.png" alt="">
                                    </span>
                                    <b class="detail">
                                        Giày cao gót
                                    </b>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="products.php?name=giay-the-thao">
                                <div class="header-sub-category">
                                    <span>
                                        <img class="img" src="image-page/sport.png" alt="">
                                    </span>
                                    <b class="detail">
                                        Giày thể thao
                                    </b>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="products.php?name=giay-bup-be">
                                <div class="header-sub-category">
                                    <span>
                                        <img class="img" src="image-page/bupbe.png" alt="">
                                    </span>
                                    <b class="detail">
                                        Giày búp bê
                                    </b>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="products.php?name=sandal">
                                <div class="header-sub-category">
                                    <span>
                                        <img class="img" src="image-page/sandal.png" alt="">
                                    </span>
                                    <b class="detail">
                                        Sandal
                                    </b>
                                </div>
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="header-search">
                    <form action="search-result.php?" method="get">
                        <div class="control-group">
                            <input class="search-field" placeholder="Search here..." name="search"
                                required="required" />
                            <button class="search-button" type="submit" name="submit"><i class="fa fa-search"
                                    aria-hidden="true"></i></button>
                        </div>
                    </form>
                    <div><i class="fa fa-phone" aria-hidden="true"></i> Đặt hàng nhanh: 1900 1717 71</div>
                </div>
            </div>
            <div class="col-md-1">
                <div class="cart">
                    <a href="card.php" class="basket"><i class="fa fa-shopping-basket" aria-hidden="true"></i>
                        <?php 
                          error_reporting(0);
                        $totalquantity=0;
                        if(isset($_SESSION['cart'])&& $_SESSION['cart']!=null){     
                            $sql="SELECT * FROM products WHERE id IN (";     
                                foreach($_SESSION['cart'] as $id => $value) { 
                                    $sql.=$id.","; 
                                }   
                                $sql=substr($sql, 0, -1).") ORDER BY name ASC"; 
                                $query=mysqli_query($con,$sql); 
                                $totalprice=0;
                                $totalquantity=0;
                                while($row=mysqli_fetch_array($query)){
                                   $subtotal= $_SESSION['cart'][$row['id']]['quantity']*$row['price'];
                                   $totalprice+=$subtotal;
                                   $totalquantity+=$_SESSION['cart'][$row['id']]['quantity'];
                                } ?>

                        <?php }?>
                        <span class='quantity-cart'><?php echo $totalquantity?></span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>